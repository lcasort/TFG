<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Mood;
use App\Models\UserMood;
use App\Services\DateService;
use Carbon\Carbon;
use Illuminate\Support\Collection;
//use Your Model

/**
 * Class MoodRepository.
 */
class MoodRepository
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
     * Returns all possible moods.
     *
     * @return Collection
     */
    public function getAllMoods(): Collection
    {
        return Mood::all();
    }
    
    /**
     * Method that returns today's mood from a collection of all the user's
     * registered moods.
     *
     * @param  Collection $moods
     * @return Mood|null
     */
    public function getTodaysMood(Collection $moods): Mood|null
    {
        $today = $this->dateService->getCurrentDate();
        $moodToday = $moods->where('date', 'like', $today)->first();

        return $moodToday ? $moodToday->mood : null;
    }
    
    /**
     * Method that returns the user's mood with the dates parsed.
     *
     * @param  User $user
     * @return Collection
     */
    public function getUserMoodsWithParsedDate(User $user): Collection
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
    public function mergeMoodsAndDays(Collection $moods): array
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
    public function saveUserMood(User $user, string $mood): void
    {
        $mood = Mood::where('name', $mood)->firstOrFail();

        $data = [
            'user_id' => $user->id,
            'mood_id' => $mood->id,
        ];
        
        UserMood::create($data);
    }
    
    /**
     * Method that updates today's user's mood.
     *
     * @param  User $user
     * @param  string $mood
     * @return void
     */
    public function updateUserMood(User $user, string $mood)
    {
        $mood = Mood::where('name', $mood)->firstOrFail();

        $todaysMood = $this->getTodaysUserMood($user);
        $todaysMood->mood_id = $mood->id;
        $todaysMood->save();
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
     * @return UserMood
     */
    private function getTodaysUserMood(User $user): UserMood
    {
        $today = Carbon::now()->toDateString();

        return $user->userMoods()
            ->where('updated_at', 'like', $today.'%')
            ->firstOrFail();
    }
}
