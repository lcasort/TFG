<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mood;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class MoodController extends Controller
{
    public function __construct()
    {
        // TODO: Add protected variable and assignmet here.
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
     * @return view
     */
    public function index()
    {
        // We get the logged user.
        $user = User::find(Auth::user()->id);

        // We get all the moods related to the user with the date parsed.
        $moods = $this->getUserMoodsWithParsedDate($user);

        // We get the dates of today and a week prior from today.
        $today = Carbon::now()->format('Y-m-d');
        $startOfWeek = Carbon::now()->subDays(6)->format('Y-m-d');
        
        // We create an array that assigns the mood to the corresponding date.
        $moodsByDate = $this->mergeMoodsAndDays($moods);

        // Calculate the days of the week in the correct order
        $daysOfTheWeek = $this->getDaysofTheWeekOrdered();

        // We get all the possible moods
        $moodOptions = Mood::all();

        // We get the mood of the user today
        $moodToday = $moods->where('date', 'like', $today)->first();
        $moodToday = $moodToday ? $moodToday->mood : null;
        
        return view('moods', compact([
            'today',
            'startOfWeek',
            'moodsByDate',
            'daysOfTheWeek',
            'moodOptions',
            'moodToday'
        ]));

    }

    public function save(Request $request)
    {
        // TODO: Save today's user mood.
        return $request;
    }

    public function update(Request $request)
    {
        // TODO: Update today's mood.
        return $request;
    }

    ////////////////////////////////////////////////////////////////////////////
    //          TODO: Move all these methods to the MoodRepository.           //
    ////////////////////////////////////////////////////////////////////////////
    private function getUserMoodsWithParsedDate(User $user): Collection
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

    private function mergeMoodsAndDays(Collection $moods)
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

    private function getDaysofTheWeekOrdered()
    {
        $nameFirstDayMonth = Carbon::now()->startOfMonth();

        if ($nameFirstDayMonth->isMonday()) {
            return ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'];
        } elseif ($nameFirstDayMonth->isTuesday()) {
            return ['TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN', 'MON'];
        } elseif ($nameFirstDayMonth->isWednesday()) {
            return ['WED', 'THU', 'FRI', 'SAT', 'SUN', 'MON', 'TUE'];
        } elseif ($nameFirstDayMonth->isThursday()) {
            return ['THU', 'FRI', 'SAT', 'SUN', 'MON', 'TUE', 'WED'];
        } elseif ($nameFirstDayMonth->isFriday()) {
            return ['FRI', 'SAT', 'SUN', 'MON', 'TUE', 'WED', 'THU'];
        } elseif ($nameFirstDayMonth->isSaturday()) {
            return ['SAT','SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI'];
        } else {
            return ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
        }
    }
    ////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////
}
