<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\HabitRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class HabitController extends Controller
{
    protected HabitRepository $habitRepository;
    public function __construct()
    {
        $this->habitRepository = app(HabitRepository::class);
    }

    public function list()
    {
        // We get the logged user.
        $user = User::find(Auth::user()->id);

        // We get all the user's habits.
        $habits = $this->habitRepository->getAllUserHabitsLogsForCurrentMonth($user);
        return view('habits', compact(['habits']));
    }
    
    /**
     * Save a new habit the user wishes to track.
     *
     * @param  Request $request
     * @return RedirectResponse
     */
    public function save(Request $request)
    {
        // We get the logged user.
        $user = User::find(Auth::user()->id);

        // Save the new user's habit.
        try {
            $this->habitRepository->saveUserHabit($user, $request->habit_name);
            return back()->with("success", "Data saved successfully!");
        } catch (\Exception $e) {
            // If there's a duplicate entry exception
            if ($e instanceof \Illuminate\Database\UniqueConstraintViolationException) {
                return back()->with("error", "You've alredy saved this habit! Data not saved.");
            }
            // Other exceptions
            return back()->with("error", "Error occurred! Data not saved.");
        }
    }

    /**
     * Save a new habit the user wishes to track.
     *
     * @param  int $habitId
     * @return RedirectResponse
     */
    public function delete(Request $request, int $habitId): RedirectResponse
    {
        // We get the logged user.
        $user = User::find(Auth::user()->id);

        try {
            // We delete the habit.
            $this->habitRepository->deleteUserHabit($user, $habitId);
            return back();
        } catch (\Exception $e) {
            return back();
        }
    }

    public function saveHabitLog(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'habit' => 'required|integer|exists:user_habits,id',
        ]);

        if ($validator->fails()) {
            return back()->with("error", "Habit does not exist");
        }

        // We get the logged user.
        $user = User::find(Auth::user()->id);

        try {
            // We save today's log for the habit.
            $this->habitRepository->saveUserHabitToday($user, $request->habit);
            return back();
        } catch (\Exception $e) {
            return back();
        }
    }

    public function deleteHabitLog(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'habit' => 'required|integer|exists:user_habits,id',
        ]);

        if ($validator->fails()) {
            return back()->with("error", "Habit does not exist");
        }

        // We get the logged user.
        $user = User::find(Auth::user()->id);

        try {
            // We save today's log for the habit.
            $this->habitRepository->deleteUserHabitToday($user, $request->habit);
            return back();
        } catch (\Exception $e) {
            return back();
        }
    }
}
