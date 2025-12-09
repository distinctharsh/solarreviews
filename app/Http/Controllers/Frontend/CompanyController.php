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
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    /**
     * Display all active companies in a tabular directory.
     */
    public function index()
    {
        $reviewStats = CompanyReview::query()
            ->select(
                'company_id',
                DB::raw('AVG(rating) as avg_rating'),
                DB::raw('COUNT(*) as total_reviews')
            )
            ->where('is_approved', true)
            ->groupBy('company_id');

        $companies = Company::query()
            ->select(
                'companies.*',
                DB::raw('COALESCE(review_stats.avg_rating, 0) as avg_rating'),
                DB::raw('COALESCE(review_stats.total_reviews, 0) as total_reviews')
            )
            ->leftJoinSub($reviewStats, 'review_stats', function ($join) {
                $join->on('review_stats.company_id', '=', 'companies.id');
            })
            ->where('is_active', true)
            ->orderBy('companies.owner_name')
            ->get();

        $states = State::select('name', 'slug')
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('frontend.companies.index', [
            'companies' => $companies,
            'totalCompanies' => $companies->count(),
            'states' => $states,
        ]);
    }

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
    public function show(Company $company)
    {
        $company->loadMissing('ratingSummary');

        $averageRating = round((float) ($company->ratingSummary->avg_rating ?? $company->average_rating ?? 0), 2);
        $totalReviews = (int) ($company->ratingSummary->total_reviews ?? $company->total_reviews ?? 0);

        $ratingDistribution = $this->getRatingDistribution($company->id);
        $ratingBreakdown = $this->buildRatingBreakdown($company, $averageRating);
        $expertScoreRaw = collect($ratingBreakdown)->avg('score');

        $expertScore = [
            'value' => round($expertScoreRaw),
            'label' => $this->expertScoreLabel($expertScoreRaw),
            'stars' => round($expertScoreRaw / 20, 1),
        ];

        return view('frontend.companies.show', [
            'company' => $company,
            'logoUrl' => $this->companyLogoUrl($company),
            'companyTypeLabel' => Str::headline($company->company_type ?? 'Installer'),
            'tenureCopy' => $company->years_in_business
                ? 'Installing solar for ' . $company->years_in_business . '+ years'
                : 'Trusted solar professional',
            'ratingSummary' => [
                'average' => $averageRating,
                'total' => $totalReviews,
                'updated_at' => $company->updated_at,
            ],
            'ratingDistribution' => $ratingDistribution,
            'ratingBreakdown' => $ratingBreakdown,
            'expertScore' => $expertScore,
        ]);
    }

    /**
     * Get rating distribution for a company
     */
    private function getRatingDistribution(int $companyId): array
    {
        $distribution = CompanyReview::select('rating', DB::raw('COUNT(*) as total'))
            ->where('company_id', $companyId)
            ->groupBy('rating')
            ->pluck('total', 'rating')
            ->toArray();

        $result = [];
        for ($i = 5; $i >= 1; $i--) {
            $result[$i] = (int) ($distribution[$i] ?? 0);
        }

        return $result;
    }

    private function buildRatingBreakdown(Company $company, float $averageRating): array
    {
        $baseScore = $this->clampScore($averageRating / 5 * 100);
        $yearsScore = $this->scoreFromYears($company->years_in_business);

        $metrics = [
            'Time in business' => $yearsScore,
            'Verification of licenses and insurance' => $this->clampScore($baseScore + 8),
            'Consumer reviews performance' => $this->clampScore($baseScore + 4),
            'Company size and location' => $this->clampScore($baseScore + 2),
            'Vertical integration' => $this->clampScore($baseScore - 2),
            'Competitiveness of loan options' => $this->clampScore($baseScore - 4),
            'Employee satisfaction and safety record' => $this->clampScore($baseScore + 6),
            'Litigation and background' => $this->clampScore($baseScore - 6),
            'Profitability of installer' => $this->clampScore($baseScore - 3),
            'Transparency of pricing and sales process' => $this->clampScore($baseScore + 5),
            'Quality of brands sold' => $this->clampScore($baseScore + 7),
            'Sustainable pricing of systems' => $this->clampScore($baseScore + 1),
        ];

        return collect($metrics)
            ->map(fn ($score, $label) => [
                'label' => $label,
                'score' => (int) $score,
            ])
            ->values()
            ->all();
    }

    private function scoreFromYears(?int $years): int
    {
        if (! $years) {
            return 65;
        }

        $normalized = min($years, 25) / 25;
        return $this->clampScore(55 + ($normalized * 45));
    }

    private function clampScore(float $score): int
    {
        return (int) max(35, min(100, round($score)));
    }

    private function expertScoreLabel(float $score): string
    {
        return match (true) {
            $score >= 85 => 'Elite',
            $score >= 70 => 'Excellent',
            $score >= 55 => 'Strong',
            default => 'Developing',
        };
    }

    private function companyLogoUrl(Company $company): string
    {
        $logo = $company->logo ?? $company->logo_url;

        if ($logo) {
            if (Str::startsWith($logo, ['http://', 'https://'])) {
                return $logo;
            }

            return asset('storage/' . ltrim($logo, '/'));
        }

        return asset('images/company/cmp.png');
    }
}
