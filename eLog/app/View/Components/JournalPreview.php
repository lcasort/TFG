<?php

namespace App\View\Components;

use App\Models\JournalEntry;
use App\Models\Prompt;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class JournalPreview extends Component
{
    public Prompt $prompt;
    public JournalEntry|null $todaysEntry;
    public JournalEntry|null $prevEntry;

    /**
     * Create a new component instance.
     */
    public function __construct(
        Prompt $prompt,
        JournalEntry|null $todaysEntry,
        JournalEntry|null $prevEntry
    )
    {
        $this->prompt = $prompt;
        $this->todaysEntry = $todaysEntry;
        $this->prevEntry = $prevEntry;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.journal-preview');
    }
}
