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
        $userHabits = $user->userHabits()->with(['logs'])->get()->each(
            function ($habit) {
                return $habit->logs->map(
                    function ($log) {
                        $log->date = Carbon::parse($log->updated_at)->toDateString();
                        return $log;
                    }
                );
            }
        );

        $res = [];
        foreach ($userHabits as $habit) {
            $logs = [];
            $endOfWeek = Carbon::now()->endOfWeek();
            $day = Carbon::now()->startOfWeek();
            while ($day->lte($endOfWeek)) {
                if ($habit->logs->where('date', $day->toDateString())->first()) {
                    array_push($logs, true);
                } else {
                    array_push($logs, false);
                }
                $day->addDay();
            }
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
        $userHabits = $user->userHabits()->with(['logs'])->get()->each(
            function ($habit) {
                return $habit->logs->map(
                    function ($log) {
                        $log->date = Carbon::parse($log->updated_at)->toDateString();
                        return $log;
                    }
                );
            }
        );

        $res = [];
        foreach ($userHabits as $habit) {
            $logs = [];
            $endOfMonth = Carbon::now()->endOfMonth();
            $day = Carbon::now()->startOfMonth();
            while ($day->lte($endOfMonth)) {
                if ($habit->logs->where('date', $day->toDateString())->first()) {
                    array_push($logs, true);
                } else {
                    array_push($logs, false);
                }
                $day->addDay();
            }
            $res[$habit->name] = ["id" => $habit->id, "logs" => $logs];
        }
        return collect($res);
    }
    
    /**
     * Method that returns the user's mood with the dates parsed.
     *
     * @param  User $user
     * @return Collection
     */
    public function getUserHabitsWithParsedDate(User $user): Collection
    {
        $moods = $user->userMoods()->with(['mood'])->get()->map(
            function ($mood)
            {
                $mood->date = Carbon::parse($mood->created_at)->format('Y-m-d');
                return $mood;
            }
        );

        return $moods;
    }
    
    /**
     * Method that returns the moods merged with the corresponding days.
     *
     * @param  Collection $moods
     * @return array
     */
    public function mergeHabitsAndDays(Collection $moods): array
    {
        $endOfMonth = Carbon::now()->endOfMonth();
        $startOfMonth = Carbon::now()->startOfMonth();

        $moodsByDate = [];
        for ($i = 0; $i < $endOfMonth->day; $i++)
        {
            $date = Carbon::parse($startOfMonth)->addDays($i)->format('Y-m-d');
            $mood = $moods->where('date', 'like', $date)->first();
            $moodsByDate[$date] = $mood;
        }

        return $moodsByDate;
    }
    
    /**
     * Methods that saves today's user's mood.
     *
     * @param  User $user
     * @param  string $mood
     * @return void
     */
    public function saveUserHabit(User $user, string $habit): void
    {
        $data = [
            'user_id' => $user->id,
            'name' => $habit,
        ];
        
        UserHabit::create($data);
    }

    public function saveUserHabitToday(User $user, int $habit): void
    {
        $userHabit = UserHabit::where([
            ['user_id', '=', $user->id],
            ['id', '=', $habit]
        ])->firstOrFail();
        
        UserHabitLog::create([
            'user_habit_id' => $userHabit->id,
            'date' => Carbon::now()->toDate()
        ]);
    }
    
    /**
     * Method that updates today's user's mood.
     *
     * @param  User $user
     * @param  string $mood
     * @return void
     */
    public function deleteUserHabitToday(User $user, int $habit): void
    {
        $userHabit = UserHabit::where([
            ['user_id', '=', $user->id],
            ['id', '=', $habit]
        ])->firstOrFail();
        
        UserHabitLog::where([
            ['user_habit_id', '=', $userHabit->id],
            ['date', 'like', Carbon::now()->toDateString()]
        ])->first()->delete();
    }


    /**
     * -------------------------------------------------------------------------
     * PRIVATE METHODS
     * -------------------------------------------------------------------------
     */

    /**
     * Method that returns today's user's mood.
     *
     * @param  User $user
     * @return UserHabit
     */
    private function getTodaysUserHabit(User $user): UserHabit
    {
        // TODO
    }
}
