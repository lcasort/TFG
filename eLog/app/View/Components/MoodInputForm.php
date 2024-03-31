<?php

namespace App\View\Components;

use App\Models\Mood;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Collection;

class MoodInputForm extends Component
{
    public Mood|null $moodToday;
    public Collection $moodOptions;
    /**
     * Create a new component instance.
     */
    public function __construct(Mood|null $moodToday, Collection $moodOptions)
    {
        $this->moodToday = $moodToday;
        $this->moodOptions = $moodOptions;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.mood-input-form');
    }
}
