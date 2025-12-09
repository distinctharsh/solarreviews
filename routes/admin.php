<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['web', 'auth', 'admin'],
    'prefix' => 'admin',
    'as' => 'admin.'
], function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Products
    Route::resource('products', ProductController::class);
    
    // Categories
    Route::resource('categories', CategoryController::class);
    
    // Brands
    Route::resource('brands', BrandController::class);
    
    // Reviews
    Route::resource('reviews', AdminReviewController::class);
    Route::post('reviews/{review}/approve', [AdminReviewController::class, 'approve'])->name('reviews.approve');
    Route::post('reviews/{review}/reject', [AdminReviewController::class, 'reject'])->name('reviews.reject');

    // Brand Categories Management
    Route::prefix('brand-categories')->name('brand-categories.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\BrandCategoryController::class, 'index'])->name('index');
        Route::put('/{brand}', [\App\Http\Controllers\Admin\BrandCategoryController::class, 'update'])->name('update');
        Route::get('/{brand}/get-categories', [\App\Http\Controllers\Admin\BrandCategoryController::class, 'getBrandCategories'])->name('get-categories');
    });
    

    // Products
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)->except(['show']);
    
    
    // Redirect to dashboard as the admin home
    Route::resource('companies', \App\Http\Controllers\Admin\CompanyController::class)->except(['show']);
    Route::get('companies/{company}', \App\Http\Controllers\Admin\CompanyController::class)->name('companies.show');
    
    Route::redirect('/', '/admin/dashboard');
});
