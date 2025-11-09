<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

// State Map
Route::get('/state-map', function () {
    return view('state-map');
})->name('state.map');

// State Details
Route::get('/state/{state}', function ($state) {
    // Convert URL-encoded state name back to normal format
    $stateName = str_replace('-', ' ', $state);
    $stateName = ucwords($stateName);
    
    return view('state-details', [
        'stateName' => $stateName
    ]);
})->where('state', '[A-Za-z-]+')->name('state.details');

// Auth routes
require __DIR__.'/auth.php';

// Admin routes
require __DIR__.'/admin.php';

// User dashboard (if needed)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
