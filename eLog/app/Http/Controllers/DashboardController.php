<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\InspirationalQuote;
use App\Models\MeditationVideo;
use App\Repositories\HabitRepository;
use App\Repositories\JournalRepository;
use App\Repositories\MoodRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected MoodRepository $moodRepository;
    protected HabitRepository $habitRepository;
    protected JournalRepository $journalRepository;
    public function __construct()
    {
        $this->moodRepository = app(MoodRepository::class);
        $this->habitRepository = app(HabitRepository::class);
        $this->journalRepository = app(JournalRepository::class);
    }


    /**
     * -------------------------------------------------------------------------
     * PUBLIC METHODS
     * -------------------------------------------------------------------------
     */

    /**
     * Method that sends to the dashboard view the following data:
     * - A randomly selected motivational quote from our DB.
     * - A summary view of the user's mood for today and the previous 3 days.
     * - A summary view of the user's habits for today.
     * - A suggestion of prompt for the user's journal entry for today. 
     * - User's journal entry for today.
     * - User's previous journal entry.
     *
     * @return Factory|View
     */
    public function index(): View
    {
        // We get the logged user.
        $user = User::find(Auth::user()->id);

        // We get a random motivational quote.
        $inspirationalQuote = $this->getRandomMotivationalQuote();

        // We get all the possible moods
        $moodOptions = $this->moodRepository->getAllMoods();
        // We get all the moods related to the user with the date parsed.
        $moods = $this->moodRepository->getUserMoodsWithParsedDate($user);
        // We get the mood of the user today
        $moodToday = $this->moodRepository->getTodaysMood($moods);

        // We get the user's habits
        $habits = $this->habitRepository->getAllUserHabitsForCurrentWeek($user);

        // We get a random journal prompts
        $prompt = $this->journalRepository->getRandomJournalingPrompt();
        // We get the user's last journal entry (today's)
        $todaysEntry = $this->journalRepository->getUserTodayJournalEntry($user);
        // We get the user's previous journal entry
        $prevEntry = $this->journalRepository->getPreviousJournalEntry($user, 0);

        return view('dashboard', compact([
            'inspirationalQuote',
            'moodOptions',
            'moodToday',
            'habits',
            'prompt',
            'todaysEntry',
            'prevEntry'
        ]));
    }


    /**
     * -------------------------------------------------------------------------
     * PRIVATE METHODS
     * -------------------------------------------------------------------------
     */

    /**
     * Method that returns a randomly selected motivational quote from our DB.
     *
     * @return string
     */
    private function getRandomMotivationalQuote(): string
    {
        $inspirationalQuote = InspirationalQuote::inRandomOrder()->first();
        return $inspirationalQuote->title;
    }
}
