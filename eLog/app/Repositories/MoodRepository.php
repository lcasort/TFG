<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Mood;
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

    public function getAllMoods(): Collection
    {
        return Mood::all();
    }

    public function getTodaysMood(Collection $moods): Mood|null
    {
        $today = $this->dateService->getCurrentDate();
        $moodToday = $moods->where('date', 'like', $today)->first();

        return $moodToday ? $moodToday->mood : null;
    }

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
}
