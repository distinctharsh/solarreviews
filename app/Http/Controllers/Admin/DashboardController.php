<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyReview;
use App\Models\State;
use App\Models\City;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Basic counts
        $stats = [
            'total_companies' => Company::count(),
            'total_products' => Product::count(),
            'total_reviews' => CompanyReview::count(),
            'total_states' => State::count(),
            'total_cities' => City::count(),
            'total_users' => User::count(),
        ];

        // Recent reviews with company and category info
        $recentReviews = CompanyReview::with(['company', 'category'])
            ->latest()
            ->take(5)
            ->get()
            ->map(function($review) {
                return [
                    'id' => (string)$review->id,
                    'reviewer_name' => (string)$review->reviewer_name,
                    'rating' => (int)$review->rating,
                    'review_text' => (string)$review->review_text,
                    'created_at' => $review->created_at,
                    'company' => $review->company ? [
                        'id' => (string)$review->company->id,
                        'name' => (string)$review->company->name,
                        'logo' => $review->company->logo ? (string)$review->company->logo : null,
                    ] : null,
                    'category' => $review->category ? [
                        'id' => (string)$review->category->id,
                        'name' => (string)$review->category->name,
                    ] : null,
                ];
            });

        // Companies with most reviews
        $topCompanies = Company::withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->orderBy('reviews_count', 'desc')
            ->take(5)
            ->get()
            ->map(function($company) {
                return [
                    'id' => (string)$company->id,
                    'name' => (string)$company->name,
                    'logo' => $company->logo ? (string)asset('storage/' . $company->logo) : null,
                    'reviews_count' => (int)$company->reviews_count,
                    'reviews_avg_rating' => (float)($company->reviews_avg_rating ?? 0),
                ];
            });

        // Products with highest ratings
        $topProducts = Product::withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->with('company')
            ->having('reviews_avg_rating', '>', 0)
            ->orderBy('reviews_avg_rating', 'desc')
            ->take(5)
            ->get()
            ->map(function($product) {
                return [
                    'id' => (string)$product->id,
                    'name' => (string)$product->name,
                    'image' => $product->image ? (string)asset('storage/' . $product->image) : null,
                    'reviews_count' => (int)$product->reviews_count,
                    'reviews_avg_rating' => (float)$product->reviews_avg_rating,
                    'company' => $product->company ? [
                        'id' => (string)$product->company->id,
                        'name' => (string)$product->company->name,
                    ] : null,
                ];
            });

        // Recent signups
        $recentUsers = User::latest()
            ->take(5)
            ->get()
            ->map(function($user) {
                return [
                    'id' => (string)$user->id,
                    'name' => (string)$user->name,
                    'email' => (string)$user->email,
                    'created_at' => $user->created_at,
                    'is_admin' => (bool)($user->is_admin ?? false),
                ];
            });

        // Get reviews by state
        $reviewsByState = State::withCount(['companies' => function($query) {
                $query->withCount('reviews');
            }])
            ->having('companies_count', '>', 0)
            ->orderBy('name')
            ->get()
            ->map(function($state) {
                $totalReviews = $state->companies->sum('reviews_count');
                return [
                    'id' => (string)$state->id,
                    'name' => (string)$state->name,
                    'total_reviews' => (int)$totalReviews,
                    'companies_count' => (int)$state->companies_count,
                ];
            });

        return view('admin.dashboard', compact(
            'stats',
            'recentReviews',
            'topCompanies',
            'topProducts',
            'recentUsers',
            'reviewsByState'
        ));
    }
}
