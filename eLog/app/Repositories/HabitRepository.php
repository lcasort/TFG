<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Mood;
use App\Models\UserHabit;
use App\Models\UserHabitLog;
use App\Services\DateService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

/**
 * Class MoodRepository.
 */
class HabitRepository
{
    protected DateService $dateService;
    public function __construct()
    {
        $this->dateService = app(DateService::class);
    }

    /**
     * -------------------------------------------------------------------------
     * PUBLIC METHODS
     * -------------------------------------------------------------------------
     */
        
    /**
     * Method that returns all user's habits and logs for the current week.
     *
     * @param  User $user
     * @return Collection
     */
    public function getAllUserHabitsForCurrentWeek(User $user): Collection
    {
        // We get all the user's habit and logs
        $userHabits = $user->userHabits()->with(['logs'])->get()->each(
            function ($habit) {
                return $habit->logs->map(
                    function ($log) {
                        $log->date = Carbon::parse($log->updated_at)->toDateString();
                        return $log;
                    }
                );
            }
        )->sortBy('name');

        $res = [];
        // We iterate through every habit
        foreach ($userHabits as $habit) {
            $logs = [];
            $endOfWeek = Carbon::now()->endOfWeek();
            $day = Carbon::now()->startOfWeek();
            // We iterate through the days of the week
            while ($day->lte($endOfWeek)) {
                // If there's a log for said date, we saver 'true' in $logs
                // Else, we save false
                if ($habit->logs->where('date', $day->toDateString())->first()) {
                    array_push($logs, true);
                } else {
                    array_push($logs, false);
                }
                $day->addDay();
            }
            // We save the user's $logs for the $habit
            $res[$habit->name] = ["id" => $habit->id, "logs" => $logs];
        }

        return collect($res);
    }

    /**
     * Method that returns all user's habits and logs for the current month.
     *
     * @param  User $user
     * @return Collection
     */
    public function getAllUserHabitsLogsForCurrentMonth(User $user): Collection
    {
        // We get all the user's habit and logs
        $userHabits = $user->userHabits()->with(['logs'])->get()->each(
            function ($habit) {
                return $habit->logs->map(
                    function ($log) {
                        // We format the dates of the logs
                        $log->date = Carbon::parse($log->updated_at)->toDateString();
                        return $log;
                    }
                );
            }
        )->sortBy('name');

        
        $res = [];
        // We iterate through every habit
        foreach ($userHabits as $habit) {
            $logs = [];
            $endOfMonth = Carbon::now()->endOfMonth();
            $day = Carbon::now()->startOfMonth();
            // We iterate through the days of the month
            while ($day->lte($endOfMonth)) {
                // If there's a log for said date, we saver 'true' in $logs
                // Else, we save false
                if ($habit->logs->where('date', $day->toDateString())->first()) {
                    array_push($logs, true);
                } else {
                    array_push($logs, false);
                }
                $day->addDay();
            }
            // We save the user's $logs for the $habit
            $res[$habit->name] = ["id" => $habit->id, "logs" => $logs];
        }

        return collect($res);
    }
    
    /**
     * Methods that saves a new habit for the user to track.
     *
     * @param  User $user
     * @param  string $mood
     * @return void
     */
    public function saveUserHabit(User $user, string $habit): void
    {
        // We get the data for the new user habit
        $data = [
            'user_id' => $user->id,
            'name' => $habit,
        ];

        // We save it
        UserHabit::create($data);
    }

    /**
     * Methods that saves today's log for the user's habit.
     *
     * @param  User $user
     * @param  string $mood
     * @return void
     */
    public function saveUserHabitToday(User $user, int $habit): void
    {
        // We try to get the user's habit
        $userHabit = UserHabit::where([
            ['user_id', '=', $user->id],
            ['id', '=', $habit]
        ])->firstOrFail();

        // We save a new habit log for the user today in said habit
        UserHabitLog::create([
            'user_habit_id' => $userHabit->id,
            'date' => Carbon::now()->toDate()
        ]);
    }
    
    /**
     * Method that deletes today's habit log for the user.
     *
     * @param  User $user
     * @param  string $mood
     * @return void
     */
    public function deleteUserHabitToday(User $user, int $habit): void
    {
        // We try to get the user's habit
        $userHabit = UserHabit::where([
            ['user_id', '=', $user->id],
            ['id', '=', $habit]
        ])->firstOrFail();

        // We try to get the user's habit log for today and delete it
        UserHabitLog::where([
            ['user_habit_id', '=', $userHabit->id],
            ['date', 'like', Carbon::now()->toDateString()]
        ])->firstOrFail()->delete();
    }

    /**
     * Method that deletes user's habit.
     *
     * @param  User $user
     * @param  string $habitId
     * @return void
     */
    public function deleteUserHabit(User $user, int $habitId): void
    {
        // We try to get the user's habit
        $userHabit = UserHabit::where([
            ['user_id', '=', $user->id],
            ['id', '=', $habitId]
        ])->firstOrFail();

        // We delete it
        $userHabit->delete();
    }
}
