<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class ContentController extends Controller
{
    /**
     * Method to go to list films and series (home page).
     *
     * @return RedirectResponse
     */
    public function index(): RedirectResponse
    {
        return Redirect::to('/');
    }

    /**
     * Method to list films.
     * 
     * The view receives a string that indicates that the content to be listed
     * are films exclusively.
     *
     * @return View
     */
    public function films(): View
    {
        $films = 'films';
        return view('list', compact('films'));
    }

    /**
     * Method to list series.
     * 
     * The view receives a string that indicates that the content to be listed
     * are series exclusively.
     *
     * @return View
     */
    public function series(): View
    {
        $series = 'series';
        return view('list', compact('series'));
    }

    /**
     * Method to show a certain film or serie detailed view.
     * 
     * The view receives the id that indicates the film or serie to be shown the
     * detailed view of. 
     *
     * @param  int  $id
     * @return View
     */
    public function show($id): View
    {
        return view('show', compact($id));
    }
        
    /**
     * Method to show the user's list of watched movies.
     * 
     * The view receives a list of Content objects to be shown.
     *
     * @param  Request  $request
     * @return View
     */
    public function watched(Request $request): View
    {
        $user = $request->user();
        $watched = Content::where([
            ['user_id', $user->id],
            ['tag', 'watched']
        ])->get();

        return view('saved-list', compact($watched));
    }
    
    /**
     * Method to show the user's list of watched movies.
     * 
     * The view receives a list of Content objects to be shown.
     *
     * @param  Request  $request
     * @return View
     */
    public function toWatch(Request $request): View
    {
        $user = $request->user();
        $watched = Content::where([
            ['user_id', $user->id],
            ['tag', 'to watch']
        ])->get();

        return view('saved-list', compact($watched));
    }
}
