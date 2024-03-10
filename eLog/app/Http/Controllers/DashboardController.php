<?php

namespace App\Http\Controllers;

use App\Models\InspirationalQuote;
use App\Models\MeditationVideo;
use Illuminate\Http\Request;

class DashboardController extends Controller
{    
    /**
     * Method that sends to the dashboard view the following data:
     * - A randomly selected motivational quote from our DB.
     * - Six randomly selected meditation videos from our DB.
     * - A summary view of the user's mood for today and the previous 3 days.
     * - A summary view of the user's habits for today.
     * - A summary view of the user's journal entry for today. 
     *
     * @return view
     */
    public function index()
    {
        $inspirationalQuote = $this->getRandomMotivationalQuote();
        $meditationVideos = $this->getRandomMeditationVideos();
        // TODO: Get today's and past 3 day's mood.
        // TODO: Get user's habits for today.
        // TODO: Get today's journal entry preview.
        return view('dashboard', compact(['inspirationalQuote', 'meditationVideos']));
    }
    
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
