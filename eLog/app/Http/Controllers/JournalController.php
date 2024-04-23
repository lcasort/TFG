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
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;

class JournalController extends Controller
{
    protected JournalRepository $journalRepository;
    protected \Illuminate\Database\Eloquent\Collection $prompts;
    public function __construct()
    {
        $this->journalRepository = app(JournalRepository::class);
        $this->prompts = Prompt::all();
    }
    
    /**
     * Method that sends to the journal view the data of the journal entry
     * (today's if there's no entry in the element 'data' of the session) and
     * a collection of possible journaling prompts.
     *
     * @return View|Factory
     */
    public function show(): View|Factory
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
    
    /**
     * Method that calls the journal view with the previous journal entry
     * (to the current one) in the 'data' element of the session.
     * 
     * If any exception is raise while trying to get the previous journal entry,
     * we will be returned to the previous page.
     *
     * @param  int $entry
     * @return Redirector|RedirectResponse
     */
    public function showPreviousEntry(int $entry): Redirector|RedirectResponse
    {
        $user = User::find(Auth::user()->id);

        try {
            $entry = $this->journalRepository->getPreviousJournalEntry($user, $entry);
            return redirect()->route('journal')->with([ 'data' => $entry ]);
        } catch (\Exception $e) {
            return back();
        }
    }
    
    /**
     * Method that calls the journal view with the next journal entry
     * (to the current one) in the 'data' element of the session.
     * 
     * If any exception is raise while trying to get the next journal entry,
     * we will be returned to the previous page.
     *
     * @param  int $entry
     * @return Redirector|RedirectResponse
     */
    public function showNextEntry(int $entry): Redirector|RedirectResponse
    {
        $user = User::find(Auth::user()->id);

        try {
            $entry = $this->journalRepository->getNextJournalEntry($user, $entry);
            return redirect()->route('journal')->with([ 'data' => $entry ]);
        } catch (\Exception $e) {
            return back();
        }
    }
    
    /**
     * Save today's journal entry for the authorized user.
     *
     * @param  StoreJournalEntryRequest $request
     * @return RedirectResponse
     */
    public function save(StoreJournalEntryRequest $request): RedirectResponse
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

    /**
     * Updates today's journal entry for the authorized user.
     *
     * @param  StoreJournalEntryRequest $request
     * @return RedirectResponse
     */
    public function update(StoreJournalEntryRequest $request): RedirectResponse
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
            $this->journalRepository->updateUserJournalEntryToday($user, $data);
            return back();
        } catch (\Exception $e) {
            return back();
        }
    }
}
