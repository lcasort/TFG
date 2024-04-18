<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJournalEntryRequest;
use App\Models\JournalEntry;
use App\Models\User;
use App\Repositories\JournalRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JournalController extends Controller
{
    protected JournalRepository $journalRepository;
    public function __construct()
    {
        $this->journalRepository = app(JournalRepository::class);
    }

    public function list()
    {
        $entry = session()->get('data');

        if (is_null($entry)) {
            $user = User::find(Auth::user()->id);
            $entry = JournalEntry::where([
                ['user_id', '=', $user->id],
                ['created_at', 'like',  Carbon::now()->toDateString() . '%']
            ])->first();
        }

        return view('journal', compact([
            'entry'
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
            "text" => $request->text
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
