<?php

use App\Http\Controllers\DashboardController;
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
Route::middleware(['auth', 'verified'])->group(function () {
    // Mood
    // Route::get('/moods', [MoodController::class, 'list'])->name('moods');
    // Route::post('/mood', [MoodController::class, 'save'])->name('mood.save');
    // Route::patch('/mood', [MoodController::class, 'update'])->name('mood.update');

    // Habits
    // Route::get('/habits', [HabitController::class, 'list'])->name('habits');
    // Route::post('/habit', [HabitController::class, 'save'])->name('habit.save');
    // Route::delete('/habit', [HabitController::class, 'destroy'])->name('habit.destroy');
    // Route::post('/habit-logs', [HabitController::class, 'listHabitLogs'])->name('habit-logs');
    // Route::post('/habit-log', [HabitController::class, 'saveHabitLog'])->name('habit-log.save');
    // Route::path('/habit-log', [HabitController::class, 'updateHabitLog'])->name('habit-log.update');

    // Journal
    // Route::get('/journal-entries', [JournalController::class, 'list'])->name('habits');
    // Route::get('/journal-entry', [JournalController::class, 'show'])->name('habits');
    // Route::get('/journal-entries', [JournalController::class, 'list'])->name('habits');
});

require __DIR__.'/auth.php';
