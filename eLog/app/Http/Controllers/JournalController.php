<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJournalEntryRequest;
use App\Models\JournalEntry;
use App\Models\Prompt;
use App\Models\User;
use App\Repositories\JournalRepository;
use Carbon\Carbon;
use Illuminate\Console\View\Components\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JournalController extends Controller
{
    protected JournalRepository $journalRepository;
    protected \Illuminate\Database\Eloquent\Collection $prompts;
    public function __construct()
    {
        $this->journalRepository = app(JournalRepository::class);
        $this->prompts = Prompt::all();
    }

    public function list(): View|Factory
    {
        $entry = session()->get('data');

        if (is_null($entry)) {
            $user = User::find(Auth::user()->id);
            $entry = JournalEntry::where([
                ['user_id', '=', $user->id],
                ['created_at', 'like',  Carbon::now()->toDateString() . '%']
            ])->first();
        }

        $prompts = $this->prompts;

        return view('journal', compact([
            'entry',
            'prompts'
        ]));
    }

    public function show()
    {
        // TODO: Show today's journal entry
    }

    public function showPreviousEntry(int $entry)
    {
        $user = User::find(Auth::user()->id);

        try {
            $entry = $this->journalRepository->getPreviousJournalEntry($user, $entry);
            return redirect()->route('journal')->with([ 'data' => $entry ]);
        } catch (\Exception $e) {
            return back();
        }
    }

    public function showNextEntry(int $entry)
    {
        $user = User::find(Auth::user()->id);

        try {
            $entry = $this->journalRepository->getNextJournalEntry($user, $entry);
            return redirect()->route('journal')->with([ 'data' => $entry ]);
        } catch (\Exception $e) {
            return back();
        }
    }

    public function save(StoreJournalEntryRequest $request)
    {
        // We get the logged user.
        $user = User::find(Auth::user()->id);

        // We get the information we want from the request
        $data = [
            "title" => $request->title, 
            "text" => $request->text,
            "prompt_id" => $request->prompt
        ];

        try {
            // We save today's log for the habit.
            $this->journalRepository->saveUserJournalEntryToday($user, $data);
            return back();
        } catch (\Exception $e) {
            return back();
        }
    }
}
