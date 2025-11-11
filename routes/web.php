<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', function () {
    return view('welcome');
});

// Admin Routes
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'App\Http\Middleware\Admin'])
    ->namespace('App\Http\Controllers\Admin')
    ->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Companies
    Route::resource('companies', CompanyController::class);
    
    // Products
    Route::resource('products', ProductController::class);
    
    // Reviews
    Route::resource('reviews', ReviewController::class);
    Route::post('reviews/{review}/toggle-featured', [ReviewController::class, 'toggleFeatured'])->name('reviews.toggle-featured');
    
    // States
    Route::resource('states', StateController::class)->except(['show']);
    
    // Cities
    Route::resource('cities', CityController::class)->except(['show']);
    
    // Users
    Route::resource('users', 'App\Http\Controllers\Admin\UserController');
});

// User Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
