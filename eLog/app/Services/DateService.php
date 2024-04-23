<?php

namespace App\Services;

use Carbon\Carbon;

class DateService
{
        
    /**
     * Returns an array of the days of the month ordered by the starting day.
     *
     * @return array
     */
    public function getDaysofTheWeekOrdered(): array
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
    
    /**
     * Returns the current date formatted to 'Y-m-d'.
     *
     * @return string
     */
    public function getCurrentDate(): string
    {
        return Carbon::now()->format('Y-m-d');
    }
}
