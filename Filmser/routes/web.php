<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/**
 * Route to the home page.
 * 
 * Does not require authentication.
 */
Route::get('/', function () {
    return view('index');
})->name('index');

/**
 * Routes to the list of films, the list of series and the detailed views of
 * each of those.
 * 
 * Does not require authentication.
 */
Route::controller(ContentController::class)->group(function () {
    Route::get('/films', 'films')->name('films');
    Route::get('/series', 'series')->name('series');
    Route::get('/films/{id}', 'show')->name('film');
    Route::get('/series/{id}', 'show')->name('serie');
});

/**
 * The following routes require authentication.
 */
Route::middleware('auth')->group(function () {
    /**
     * Routes to edit, update and delete the user profile.
     */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /**
     * Routes to see the list of watched and to watch lists of the user.
     */
    Route::controller(ContentController::class)->group(function () {
        Route::get('/watched', 'watched')->name('watched');
        Route::get('/to-watch', 'toWatch')->name('to-watch');
    });
});

require __DIR__.'/auth.php';
