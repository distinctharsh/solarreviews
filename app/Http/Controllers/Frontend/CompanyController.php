<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyReview;
use App\Models\State;
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
        $states = State::select('name', 'slug')
            ->where('is_active', true)
            ->orderBy('name')
            ->get()
            ->toArray();
            
        // Get the current state from the URL
        $currentState = State::where('slug', $stateSlug)
            ->select('id', 'name', 'slug')
            ->firstOrFail();
            
        $cacheKey = "state_companies_{$stateSlug}";
        
        // Only cache the companies data, not the state data
        $companies = Cache::remember($cacheKey, now()->addHours(12), function () use ($currentState) {
            return Company::with(['state', 'reviews'])
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
        $data = [
            'state' => [
                'name' => $currentState->name,
                'slug' => $currentState->slug,
            ],
            'states' => $states,
            'companies' => $companies
        ];
        
        return view('frontend.companies.state', $data);
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
