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
        // We get the current date
        $today = $this->dateService->getCurrentDate();
        // We get the mood of today from the collection
        $moodToday = $moods->where('date', 'like', $today)->first();

        // If there's a mood for today, we return it.
        // Else, we return null.
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
        // We get all the user moods
        $moods = $user->userMoods()->with(['mood'])->get()->map(
            function ($mood)
            {
                // We format the dates
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
        // We get the start and end of the month
        $endOfMonth = Carbon::now()->endOfMonth();
        $startOfMonth = Carbon::now()->startOfMonth();

        // We iterate through the days of the month
        $moodsByDate = [];
        for ($i = 0; $i < $endOfMonth->day; $i++)
        {
            // We get the day formated
            $date = Carbon::parse($startOfMonth)->addDays($i)->format('Y-m-d');
            // We get the mood for said date
            $mood = $moods->where('date', 'like', $date)->first();
            // We add it to the array
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
        // We get the mood
        $mood = Mood::where('name', $mood)->firstOrFail();

        // We create an array with the necessary data to save the user's mood
        // for today
        $data = [
            'user_id' => $user->id,
            'mood_id' => $mood->id,
        ];
        
        // We save the user's mood with the current date
        UserMood::create($data);
    }
    
    /**
     * Method that updates today's user's mood.
     *
     * @param  User $user
     * @param  string $mood
     * @return void
     */
    public function updateUserMood(User $user, string $mood): void
    {
        // We get the mood
        $mood = Mood::where('name', $mood)->firstOrFail();

        // We get the user's mood for today and update it
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
        // We get the current date
        $today = Carbon::now()->toDateString();

        // We return the user's mood today
        return $user->userMoods()
            ->where('updated_at', 'like', $today.'%')
            ->firstOrFail();
    }
}
