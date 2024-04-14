<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class UserHabitLog extends Component
{
    public Collection $habits;
    /**
     * Create a new component instance.
     */
    public function __construct(Collection $habits)
    {
        $this->habits = $habits;
        $this->habits = $habits;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-habit-log');
    }
}
