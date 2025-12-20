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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Models\Company;
use App\Models\CompanyReview;
use App\Models\State;
use Illuminate\Support\Str;
use App\Http\Controllers\Admin\UserProfileSubmissionController as AdminProfileSubmissionController;



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

    $trendingBaseQuery = Company::query()
        ->select([
            'companies.id',
            'companies.slug',
            'companies.owner_name',
            'companies.website_url',
            'companies.logo_url',
            'states.name as state_name',
        ])
        ->selectRaw('AVG(company_reviews.rating) as avg_rating')
        ->selectRaw('COUNT(company_reviews.id) as review_count')
        ->join('company_reviews', 'company_reviews.company_id', '=', 'companies.id')
        ->leftJoin('states', 'states.id', '=', 'companies.state_id')
        ->where('companies.is_active', true)
        ->where('company_reviews.is_approved', true)
        ->groupBy(
            'companies.id',
            'companies.slug',
            'companies.owner_name',
            'companies.website_url',
            'companies.logo_url',
            'states.name'
        );

    $perfectCompanies = (clone $trendingBaseQuery)
        ->havingRaw('AVG(company_reviews.rating) = 5')
        ->orderByDesc('review_count')
        ->limit(10)
        ->get();

    $remaining = max(0, 10 - $perfectCompanies->count());

    $additionalCompanies = collect();

    if ($remaining > 0) {
        $additionalCompanies = (clone $trendingBaseQuery)
            ->havingRaw('AVG(company_reviews.rating) < 5')
            ->when($perfectCompanies->isNotEmpty(), function ($query) use ($perfectCompanies) {
                return $query->whereNotIn('companies.id', $perfectCompanies->pluck('id'));
            })
            ->orderByDesc('avg_rating')
            ->orderByDesc('review_count')
            ->limit($remaining)
            ->get();
    }

    $resolveLogoUrl = function (?string $logoPath) {
        if (empty($logoPath)) {
            return asset('images/company/cmp.png');
        }

        if (Str::startsWith($logoPath, ['http://', 'https://'])) {
            return $logoPath;
        }

        return asset(ltrim($logoPath, '/'));
    };

    $computeInitials = function (?string $text, ?string $fallback = null) {
        $initials = collect(preg_split('/\s+/', (string) $text, -1, PREG_SPLIT_NO_EMPTY))
            ->map(fn ($part) => Str::upper(Str::substr($part, 0, 1)))
            ->take(2)
            ->implode('');

        if ($initials === '') {
            $initials = Str::upper(Str::substr($fallback ?? 'SR', 0, 2));
        }

        return $initials;
    };

    $formatTrendingCompanies = function ($collection) use ($resolveLogoUrl, $computeInitials) {
        return $collection->map(function ($company) use ($resolveLogoUrl, $computeInitials) {
            $name = $company->owner_name ?? $company->slug;

            $websiteHost = null;
            if (!empty($company->website_url)) {
                $parsed = parse_url($company->website_url);
                $websiteHost = $parsed['host'] ?? ltrim($company->website_url, '/');
                $websiteHost = Str::replaceFirst('www.', '', $websiteHost);
            }

            return [
                'id' => $company->id,
                'slug' => $company->slug,
                'name' => $name,
                'state' => $company->state_name,
                'website_url' => $company->website_url,
                'website_host' => $websiteHost,
                'avg_rating' => round((float) $company->avg_rating, 1),
                'review_count' => (int) $company->review_count,
                'initials' => $computeInitials($name, $company->slug),
                'logo' => $resolveLogoUrl($company->logo_url),
            ];
        });
    };

    $trendingCompanies = $formatTrendingCompanies(
        $perfectCompanies->concat($additionalCompanies)
    );

    $formatWebsiteHost = function (?string $url) {
        if (empty($url)) {
            return null;
        }

        $parsed = parse_url($url);
        $host = $parsed['host'] ?? ltrim($url, '/');

        return Str::replaceFirst('www.', '', $host);
    };

    $recentReviews = CompanyReview::query()
        ->with(['company.state'])
        ->where('is_approved', true)
        ->orderByDesc('review_date')
        ->orderByDesc('created_at')
        ->limit(20)
        ->get()
        ->map(function ($review) use ($formatWebsiteHost, $resolveLogoUrl, $computeInitials) {
            $company = $review->company;
            $companyName = $company?->owner_name ?? $company?->slug ?? 'Solar EPC';
            $reviewerName = $review->reviewer_name ?: 'Verified customer';

            $avatar = Str::upper(Str::substr($reviewerName, 0, 1)) ?: Str::upper(Str::substr($companyName, 0, 1));

            $websiteUrl = $company?->website_url;

            return [
                'id' => $review->id,
                'reviewer' => $reviewerName,
                'avatar' => $avatar,
                'rating' => (int) $review->rating,
                'text' => Str::limit(strip_tags((string) $review->review_text), 220),
                'date' => optional($review->review_date ?? $review->created_at)->format('M d, Y'),
                'company' => [
                    'name' => $companyName,
                    'slug' => $company?->slug,
                    'state' => $company?->state?->name,
                    'website_url' => $websiteUrl,
                    'website_host' => $formatWebsiteHost($websiteUrl),
                    'logo' => $company ? $resolveLogoUrl($company->logo_url) : asset('images/company/cmp.png'),
                    'initials' => $computeInitials($companyName, $company?->slug),
                ],
            ];
        });

    return view('welcome', [
        'companies' => $companies,
        'trendingCompanies' => $trendingCompanies,
        'recentReviews' => $recentReviews,
    ]);
});

Route::get('/write-review', [FrontendReviewController::class, 'landing'])->name('reviews.write');

Route::view('/faq', 'frontend.faq')->name('faq');

Route::get('/top-reviews', function (Request $request) {
    $stateFilter = $request->query('state');

    $states = State::query()
        ->select('name', 'slug')
        ->orderBy('name')
        ->get();

    $resolveLogoUrl = function (?string $logoPath) {
        if (empty($logoPath)) {
            return asset('images/company/cmp.png');
        }

        if (Str::startsWith($logoPath, ['http://', 'https://'])) {
            return $logoPath;
        }

        return asset(ltrim($logoPath, '/'));
    };

    $topCompaniesQuery = Company::query()
        ->select([
            'companies.id',
            'companies.slug',
            'companies.owner_name',
            'companies.website_url',
            'companies.logo_url',
            'states.name as state_name',
        ])
        ->selectRaw('AVG(company_reviews.rating) as avg_rating')
        ->selectRaw('COUNT(company_reviews.id) as review_count')
        ->join('company_reviews', function ($join) {
            $join->on('company_reviews.company_id', '=', 'companies.id')
                ->where('company_reviews.is_approved', true);
        })
        ->leftJoin('states', 'states.id', '=', 'companies.state_id')
        ->where('companies.is_active', true)
        ->groupBy(
            'companies.id',
            'companies.slug',
            'companies.owner_name',
            'companies.website_url',
            'companies.logo_url',
            'states.name'
        )
        ->when($stateFilter, function ($query) use ($stateFilter) {
            $query->whereHas('state', function ($stateQuery) use ($stateFilter) {
                $stateQuery->where('slug', $stateFilter);
            });
        })
        ->orderByDesc('avg_rating')
        ->orderByDesc('review_count');

    $topCompanies = $topCompaniesQuery
        ->get()
        ->map(function ($company) use ($resolveLogoUrl) {
            $websiteHost = null;
            if (!empty($company->website_url)) {
                $parsed = parse_url($company->website_url);
                $websiteHost = $parsed['host'] ?? ltrim($company->website_url, '/');
                $websiteHost = Str::replaceFirst('www.', '', $websiteHost);
            }

            return [
                'id' => $company->id,
                'name' => $company->owner_name ?? $company->slug,
                'slug' => $company->slug,
                'state' => $company->state_name,
                'website_url' => $company->website_url,
                'website_host' => $websiteHost,
                'avg_rating' => round((float) $company->avg_rating, 2),
                'review_count' => (int) $company->review_count,
                'logo' => $resolveLogoUrl($company->logo_url),
            ];
        });

    $activeState = $stateFilter
        ? $states->firstWhere('slug', $stateFilter)
        : null;

    return view('frontend.reviews.top-installers', [
        'states' => $states,
        'topCompanies' => $topCompanies,
        'activeState' => $activeState,
    ]);
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

// OAuth for review modal/profile + normal reviewer sessions
Route::get('/auth/google/redirect', [SocialLoginController::class, 'redirectToGoogle'])->name('oauth.google.redirect');
Route::get('/auth/google/callback', [SocialLoginController::class, 'handleGoogleCallback'])->name('oauth.google.callback');
Route::post('/auth/google/disconnect', [SocialLoginController::class, 'disconnect'])->name('oauth.google.disconnect');
Route::post('/reviews/session/logout', [SocialLoginController::class, 'disconnect'])->name('reviews.session.logout');

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


       // Profile submissions
    Route::get('profile-submissions', [AdminProfileSubmissionController::class, 'index'])->name('profile-submissions.index');
    Route::get('profile-submissions/{submission}', [AdminProfileSubmissionController::class, 'show'])->name('profile-submissions.show');
    Route::patch('profile-submissions/{submission}', [AdminProfileSubmissionController::class, 'update'])->name('profile-submissions.update');

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
