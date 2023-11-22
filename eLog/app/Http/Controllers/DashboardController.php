<?php

namespace App\Http\Controllers;

use App\Models\InspirationalQuote;
use App\Models\MeditationVideo;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $inspirationalQuote = $this->getRandomMotivationalQuote();
        $meditationVideos = $this->getRandomMeditationVideos();
        return view('dashboard', compact(['inspirationalQuote', 'meditationVideos']));
    }

    private function getRandomMotivationalQuote()
    {
        $inspirationalQuote = InspirationalQuote::inRandomOrder()->first();
        return $inspirationalQuote->title;
    }

    private function getRandomMeditationVideos()
    {
        $meditationVideos = MeditationVideo::inRandomOrder()
            ->take(6)->get()->pluck('link');
        return $meditationVideos;
    }
}
