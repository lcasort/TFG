<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\InspirationalQuote;
use App\Models\MeditationVideo;
use App\Repositories\MoodRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected MoodRepository $moodRepository;
    public function __construct()
    {
        $this->moodRepository = app(MoodRepository::class);
    }


    /**
     * -------------------------------------------------------------------------
     * PUBLIC METHODS
     * -------------------------------------------------------------------------
     */

    /**
     * Method that sends to the dashboard view the following data:
     * - A randomly selected motivational quote from our DB.
     * - Six randomly selected meditation videos from our DB.
     * - A summary view of the user's mood for today and the previous 3 days.
     * - A summary view of the user's habits for today.
     * - A summary view of the user's journal entry for today. 
     *
     * @return Factory|View
     */
    public function index(): View
    {
        // We get the logged user.
        $user = User::find(Auth::user()->id);

        // We get a random motivational quote.
        $inspirationalQuote = $this->getRandomMotivationalQuote();

        // We get a 6 random motivation videos.
        $meditationVideos = $this->getRandomMeditationVideos();

        // We get all the possible moods
        $moodOptions = $this->moodRepository->getAllMoods();
        // We get all the moods related to the user with the date parsed.
        $moods = $this->moodRepository->getUserMoodsWithParsedDate($user);
        // We get the mood of the user today
        $moodToday = $this->moodRepository->getTodaysMood($moods);

        return view('dashboard', compact([
            'inspirationalQuote',
            'meditationVideos',
            'moodOptions',
            'moodToday'
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
    
    /**
     * Method that returns the link for 6 randomly selected meditation videos
     * from out DB.
     *
     * @return string
     */
    private function getRandomMeditationVideos(): string
    {
        $meditationVideos = MeditationVideo::inRandomOrder()
            ->take(6)->get()->pluck('link');
        return $meditationVideos;
    }
}
