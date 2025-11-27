<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Company;
use App\Models\CompanyReview;
use App\Models\Product;
use App\Models\State;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CompanyController extends Controller
{
    /**
     * Display the companies listing for a state
     */
    public function stateCompanies($stateSlug)
    {
        // Get all active states for the sidebar
        $states = State::where('is_active', true)
            ->orderBy('name')
            ->get();
            
        // Get the current state from the URL
        $currentState = State::where('slug', $stateSlug)
            ->select('id', 'name', 'slug')
            ->firstOrFail();
            
        // Include a version suffix in the cache key to invalidate old cached data
        // (needed after adding category_ids and other new fields)
        $cacheKey = "state_companies_{$stateSlug}_v2";
        
        // Only cache the companies data, not the state data
        $companies = Cache::remember($cacheKey, now()->addHours(12), function () use ($currentState) {
            return Company::with(['state', 'reviews', 'categories'])
                ->where('state_id', $currentState->id)
                ->where('is_active', true)
                ->orderBy('average_rating', 'desc')
                ->get()
                ->map(function($company) {
                    return [
                        'id' => $company->id,
                        'name' => $company->name,
                        'slug' => $company->slug,
                        'logo' => $company->logo ? asset('storage/' . $company->logo) : null,
                        'state' => $company->state->name,
                        'description' => $company->description,
                        'average_rating' => (float) $company->average_rating,
                        'total_reviews' => $company->total_reviews,
                        'category_ids' => $company->categories->pluck('id')->toArray(),
                        'featured_review' => $company->reviews->where('is_featured', true)->first() ? [
                            'reviewer_name' => $company->reviews->where('is_featured', true)->first()->reviewer_name,
                            'review_text' => $company->reviews->where('is_featured', true)->first()->review_text,
                            'rating' => $company->reviews->where('is_featured', true)->first()->rating,
                            'date' => $company->reviews->where('is_featured', true)->first()->review_date->format('M d, Y'),
                        ] : null
                    ];
                });
        });
        
        // Prepare the data for the view
        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $data = [
            'state' => [
                'id' => $currentState->id,
                'name' => $currentState->name,
                'slug' => $currentState->slug,
            ],
            'states' => $states,
            'companies' => $companies,
            'categories' => $categories,
        ];
        
        return view('frontend.companies.state', $data);
    }

    /**
     * Show top 20 companies for a given category based on reviews.
     */
    public function categoryComparison($categorySlug)
    {
        $category = Category::where('slug', $categorySlug)
            ->where('status', 'active')
            ->firstOrFail();

        $companies = Company::query()
            ->select('companies.*',
                DB::raw('COALESCE(rs.avg_rating, 0) as avg_rating'),
                DB::raw('COALESCE(rs.total_reviews, 0) as total_reviews'))
            ->leftJoin('rating_summaries as rs', function ($join) {
                $join->on('rs.reviewable_id', '=', 'companies.id')
                    ->where('rs.reviewable_type', '=', Company::class);
            })
            ->whereHas('categories', function ($q) use ($category) {
                $q->where('categories.id', $category->id);
            })
            ->where('is_active', true)
            ->orderByDesc('avg_rating')
            ->orderByDesc('total_reviews')
            ->limit(20)
            ->with(['state'])
            ->get();

        $brandsByReviews = Brand::query()
            ->select(
                'brands.id',
                'brands.name',
                'brands.slug',
                'brands.logo_url',
                DB::raw('COALESCE(rs.avg_rating, 0) as avg_rating'),
                DB::raw('COALESCE(rs.total_reviews, 0) as total_reviews')
            )
            ->leftJoin('rating_summaries as rs', function ($join) {
                $join->on('rs.reviewable_id', '=', 'brands.id')
                    ->where('rs.reviewable_type', '=', Brand::class);
            })
            ->whereHas('categories', function ($q) use ($category) {
                $q->where('categories.id', $category->id);
            })
            ->orderByDesc('avg_rating')
            ->orderByDesc('total_reviews')
            ->limit(20)
            ->get();

        $topEfficiencyBrands = Product::query()
            ->select(
                'brands.id as brand_id',
                'brands.name as brand_name',
                'brands.logo_url',
                DB::raw('AVG(products.efficiency) as avg_efficiency'),
                DB::raw('MAX(products.efficiency) as max_efficiency'),
                DB::raw('COUNT(products.id) as product_count')
            )
            ->join('brands', 'brands.id', '=', 'products.brand_id')
            ->where('products.category_id', $category->id)
            ->whereNotNull('products.efficiency')
            ->groupBy('brands.id', 'brands.name', 'brands.logo_url')
            ->orderByDesc('avg_efficiency')
            ->limit(10)
            ->get();

        return view('frontend.companies.category-comparison', [
            'category' => $category,
            'companies' => $companies,
            'brandsByReviews' => $brandsByReviews,
            'topEfficiencyBrands' => $topEfficiencyBrands,
        ]);
    }

    /**
     * Display a single company with reviews
     */
    public function show($stateSlug, $companySlug)
    {
        $cacheKey = "company_{$companySlug}";
        
        $data = Cache::remember($cacheKey, now()->addHours(12), function () use ($stateSlug, $companySlug) {
            $company = Company::with(['city.state', 'reviews' => function($query) {
                $query->orderBy('is_featured', 'desc')
                      ->orderBy('review_date', 'desc');
            }])
            ->where('slug', $companySlug)
            ->whereHas('city.state', function($query) use ($stateSlug) {
                $query->where('slug', $stateSlug);
            })
            ->where('is_active', true)
            ->firstOrFail();
            
            $reviews = $company->reviews->map(function($review) {
                return [
                    'id' => $review->id,
                    'reviewer_name' => $review->reviewer_name,
                    'review_text' => $review->review_text,
                    'rating' => (int) $review->rating,
                    'date' => $review->review_date->format('M d, Y'),
                    'source' => $review->source,
                    'is_featured' => (bool) $review->is_featured,
                ];
            });
            
            return [
                'company' => [
                    'id' => $company->id,
                    'name' => $company->name,
                    'description' => $company->description,
                    'logo' => $company->logo ? asset('storage/' . $company->logo) : null,
                    'average_rating' => (float) $company->average_rating,
                    'total_reviews' => $company->total_reviews,
                    'state' => [
                        'name' => $company->city->state->name,
                        'slug' => $company->city->state->slug,
                    ],
                ],
                'reviews' => $reviews,
                'rating_distribution' => $this->getRatingDistribution($company->id),
            ];
        });
        
        return view('frontend.companies.show', $data);
    }
    
    /**
     * Get rating distribution for a company
     */
    private function getRatingDistribution($companyId)
    {
        return [
            5 => CompanyReview::where('company_id', $companyId)->where('rating', 5)->count(),
            4 => CompanyReview::where('company_id', $companyId)->where('rating', 4)->count(),
            3 => CompanyReview::where('company_id', $companyId)->where('rating', 3)->count(),
            2 => CompanyReview::where('company_id', $companyId)->where('rating', 2)->count(),
            1 => CompanyReview::where('company_id', $companyId)->where('rating', 1)->count(),
        ];
    }
}
