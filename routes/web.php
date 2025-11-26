<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\CityController;
use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/top-reviews', function () {
    return view('frontend.reviews.top-installers');
})->name('reviews.top');

// Category-based company comparison (temporarily disabled until frontend is ready)
// Route::get('/compare/{categorySlug}', [\App\Http\Controllers\Frontend\CompanyController::class, 'categoryComparison'])
//     ->name('companies.compare');

// State Companies (temporarily using dummy data)
Route::get('/state/{stateSlug}', function ($stateSlug) {
    $states = [
        ['id' => 1, 'name' => 'Maharashtra', 'slug' => 'maharashtra'],
        ['id' => 2, 'name' => 'Gujarat', 'slug' => 'gujarat'],
        ['id' => 3, 'name' => 'Rajasthan', 'slug' => 'rajasthan'],
        ['id' => 4, 'name' => 'Karnataka', 'slug' => 'karnataka'],
        ['id' => 5, 'name' => 'Tamil Nadu', 'slug' => 'tamil-nadu'],
        ['id' => 6, 'name' => 'Uttar Pradesh', 'slug' => 'uttar-pradesh'],
        ['id' => 7, 'name' => 'Delhi', 'slug' => 'delhi'],
    ];
    
    $state = collect($states)->firstWhere('slug', $stateSlug);
    if (!$state) {
        abort(404);
    }
    
    return view('frontend.companies.state', [
        'state' => $state,
        'states' => $states,
        'categories' => [],
    ]);
})->name('state.companies');

// Review Routes (temporarily disabled)
Route::prefix('reviews')->group(function () {
    Route::get('/create', function () {
        return redirect('/');
    })->name('reviews.create');
    
    Route::post('/', function () {
        return response()->json(['success' => false, 'message' => 'Reviews temporarily disabled']);
    })->name('reviews.store');
    
    Route::post('/send-otp', function () {
        return response()->json(['success' => true, 'otp' => '123456']);
    })->name('reviews.send-otp');
    
    Route::post('/verify-otp', function () {
        return response()->json(['success' => true]);
    })->name('reviews.verify-otp');
});

// Admin Routes
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'App\Http\Middleware\Admin'])
    ->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // States
    Route::resource('states', StateController::class);

    // Cities
    Route::resource('cities', CityController::class);

    // Categories
    Route::resource('categories', CategoryController::class);
    Route::patch('categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('categories.toggle-status');
    
    // Brands
    Route::resource('brands', BrandController::class);
    Route::patch('brands/{brand}/toggle-status', [BrandController::class, 'toggleStatus'])->name('brands.toggle-status');
    
    // Companies
    Route::resource('companies', CompanyController::class);
    Route::patch('companies/{company}/toggle-status', [CompanyController::class, 'toggleStatus'])->name('companies.toggle-status');
    
    // Products
    Route::resource('products', ProductController::class);
    Route::patch('products/{product}/toggle-status', [ProductController::class, 'toggleStatus'])->name('products.toggle-status');
    
    // Reviews
    Route::resource('reviews', ReviewController::class);
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
