<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ChatbotOptionController;
use App\Http\Controllers\Admin\ChatbotQuestionController;
use App\Http\Controllers\Admin\ChatbotReportController;
use App\Http\Controllers\Frontend\CompanyController as FrontendCompanyController;
use App\Http\Controllers\Frontend\ReviewController as FrontendReviewController;
use App\Http\Controllers\Frontend\BrandController as FrontendBrandController;
use App\Http\Controllers\Dashboard\UserDashboardController;
use App\Http\Controllers\Dashboard\UserProfileSubmissionController;
use Illuminate\Support\Facades\Route;
use App\Models\Company;


// Frontend Routes
Route::get('/', function () {
    $companies = Company::query()
        ->select('slug', 'owner_name')
        ->where('is_active', true)
        ->whereNotNull('slug')
        ->orderBy('owner_name')
        ->limit(5)
        ->get()
        ->map(function ($company) {
            return [
                'name' => $company->owner_name ?? $company->slug,
                'slug' => $company->slug,
            ];
        });

    return view('welcome', [
        'companies' => $companies,
    ]);
});

Route::get('/write-review', [FrontendReviewController::class, 'landing'])->name('reviews.write');

Route::view('/faq', 'frontend.faq')->name('faq');

Route::get('/top-reviews', function () {
    return view('frontend.reviews.top-installers');
})->name('reviews.top');

// All companies listing
Route::get('/compare/companies', [FrontendCompanyController::class, 'index'])
    ->name('companies.index');

// Category-based company comparison (temporarily disabled until frontend is ready)
Route::get('/compare/{categorySlug}', [\App\Http\Controllers\Frontend\CompanyController::class, 'categoryComparison'])
    ->name('companies.compare');

// routes/web.php
// routes/web.php
Route::get('/brand/{brand:slug}', [FrontendBrandController::class, 'compareBrand'])
    ->name('brands.compare');

// Company profile
Route::get('/companies/{company:slug}', [FrontendCompanyController::class, 'show'])->name('companies.show');




// State Companies
Route::get('/state/{stateSlug}', [FrontendCompanyController::class, 'stateCompanies'])
    ->name('state.companies');

// Review Routes
Route::prefix('reviews')->name('reviews.')->group(function () {
    Route::get('/create', [FrontendReviewController::class, 'create'])->name('create');
    Route::post('/', [FrontendReviewController::class, 'store'])->name('store');
    Route::post('/send-otp', [FrontendReviewController::class, 'sendOtp'])->name('send-otp');
    Route::post('/verify-otp', [FrontendReviewController::class, 'verifyOtp'])->name('verify-otp');
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
    Route::resource('reviews', AdminReviewController::class);
    Route::post('reviews/company/{companyReview}/approve', [AdminReviewController::class, 'approveCompanyReview'])
        ->name('reviews.company.approve');
    Route::post('reviews/company/{companyReview}/reject', [AdminReviewController::class, 'rejectCompanyReview'])
        ->name('reviews.company.reject');

    // Chatbot (Questions + Options)
    Route::prefix('chatbot')->name('chatbot.')->group(function () {
        Route::resource('questions', ChatbotQuestionController::class);

        Route::get('questions/{question}/options/create', [ChatbotOptionController::class, 'create'])
            ->name('questions.options.create');
        Route::post('questions/{question}/options', [ChatbotOptionController::class, 'store'])
            ->name('questions.options.store');
        Route::get('questions/{question}/options/{option}/edit', [ChatbotOptionController::class, 'edit'])
            ->name('questions.options.edit');
        Route::put('questions/{question}/options/{option}', [ChatbotOptionController::class, 'update'])
            ->name('questions.options.update');
        Route::delete('questions/{question}/options/{option}', [ChatbotOptionController::class, 'destroy'])
            ->name('questions.options.destroy');

        Route::resource('reports', ChatbotReportController::class)->only(['index', 'show']);
    });
});

// User Dashboard
Route::get('/dashboard', UserDashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::post('/dashboard/distributor-profile', [UserProfileSubmissionController::class, 'storeDistributor'])
        ->middleware('verified')
        ->name('dashboard.distributor-profile.store');
    Route::post('/dashboard/supplier-profile', [UserProfileSubmissionController::class, 'storeSupplier'])
        ->middleware('verified')
        ->name('dashboard.supplier-profile.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
