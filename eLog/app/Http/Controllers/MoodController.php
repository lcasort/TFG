<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\MoodRepository;
use App\Services\DateService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class MoodController extends Controller
{
    protected MoodRepository $moodRepository;
    protected DateService $dateService;
    public function __construct()
    {
        $this->moodRepository = app(MoodRepository::class);
        $this->dateService = app(DateService::class);
    }
    
    /**
     * Method that sends to the mood view the following data:
     * - Today's date.
     * - The date of the start of the week.
     * - The moods of the user sorted by date.
     * - The day's of the week.
     * - The available mood options.
     * - The mood of the user today.
     *
     * @return Factory|View
     */
    public function index(): Factory|View
    {
        // We get the logged user.
        $user = User::find(Auth::user()->id);

        // We get all the moods related to the user with the date parsed.
        $moods = $this->moodRepository->getUserMoodsWithParsedDate($user);
        
        // We create an array that assigns the mood to the corresponding date.
        $moodsByDate = $this->moodRepository->mergeMoodsAndDays($moods);

        // Calculate the days of the week in the correct order
        $daysOfTheWeek = $this->dateService->getDaysofTheWeekOrdered();

        // We get all the possible moods
        $moodOptions = $this->moodRepository->getAllMoods();

        // We get the mood of the user today
        $moodToday = $this->moodRepository->getTodaysMood($moods);
        
        return view('moods', compact([
            'moodsByDate',
            'daysOfTheWeek',
            'moodOptions',
            'moodToday'
        ]));
    }

    /**
     * Save today's mood for the authorized user.
     *
     * @param  Request $request
     * @return RedirectResponse
     */
    public function save(Request $request): RedirectResponse
    {
        // We get the logged user.
        $user = User::find(Auth::user()->id);

        // We save the user's mood for today.
        $this->moodRepository->saveUserMood($user, $request->mood);

        return back();
    }
    
    /**
     * Update today's mood for the authorized user.
     *
     * @param  Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        // We get the logged user.
        $user = User::find(Auth::user()->id);

        // We update the user's mood for today.
        $this->moodRepository->updateUserMood($user, $request->mood);

        return back();
    }
}
