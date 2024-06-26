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
        // We check if there's any entry in the 'data' element of the session
        $entry = session()->get('data');

        // If there's not we get today's entry
        if (is_null($entry)) {
            // We get the logged user
            $user = User::find(Auth::user()->id);
            // We get the user's journal entry for today
            $entry = $this->journalRepository->getUserTodayJournalEntry($user);
        }

        // We get all the journaling prompts
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
        // We get the logged user
        $user = User::find(Auth::user()->id);

        try {
            // We get the previous journal entry to $entry
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
        // We get the logged user
        $user = User::find(Auth::user()->id);

        try {
            // We get the next journal entry to $entry
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
        // We get the logged user
        $user = User::find(Auth::user()->id);

        // We get the information we want from the request
        $data = [
            "title" => $request->title, 
            "text" => $request->text,
            "prompt_id" => $request->prompt
        ];

        try {
            // We save today's journal entry
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
        // We get the logged user
        $user = User::find(Auth::user()->id);

        // We get the information we want from the request
        $data = [
            "title" => $request->title, 
            "text" => $request->text,
            "prompt_id" => $request->prompt
        ];

        try {
            // We update today's journal log
            $this->journalRepository->updateUserJournalEntryToday($user, $data);
            return back();
        } catch (\Exception $e) {
            return back();
        }
    }
}
