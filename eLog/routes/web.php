<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HabitController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\MoodController;
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

// Welcome
Route::get('/', function () {
    return view('welcome');
})->middleware(['guest']);

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Mood, habits & journal
Route::middleware(['auth', 'verified', 'web'])->group(function () {
    // Mood
    Route::get('/moods', [MoodController::class, 'index'])->name('moods');
    Route::post('/mood', [MoodController::class, 'save'])->name('mood.save');
    Route::patch('/mood/update', [MoodController::class, 'update'])->name('mood.update');

    // Habits
    Route::get('/habits', [HabitController::class, 'list'])->name('habits');
    Route::post('/habit', [HabitController::class, 'save'])->name('habit.save');
    Route::delete('/habit/{habit_id}', [HabitController::class, 'delete'])->name('habit.delete');
    Route::post('/habit-log', [HabitController::class, 'saveHabitLog'])->name('habit-log.save');
    Route::delete('/habit-log', [HabitController::class, 'deleteHabitLog'])->name('habit-log.delete');

    // Journal
    Route::get('/journal-entries/{entry?}', [JournalController::class, 'show'])->name('journal');
    Route::get('/journal-entry/{entry}/prev', [JournalController::class, 'showPreviousEntry'])->name('journal.show-prev');
    Route::get('/journal-entry/{entry}/next', [JournalController::class, 'showNextEntry'])->name('journal.show-next');
    Route::post('/journal-entry', [JournalController::class, 'save'])->name('journal.save');
    Route::patch('/journal-entry/update', [JournalController::class, 'update'])->name('journal.update');
});

require __DIR__.'/auth.php';
