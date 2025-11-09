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
        $cacheKey = "state_companies_{$stateSlug}";
        
        $data = Cache::remember($cacheKey, now()->addHours(12), function () use ($stateSlug) {
            $state = State::where('slug', $stateSlug)->firstOrFail();
            
            $companies = Company::with(['city', 'reviews'])
                ->whereHas('city', function($query) use ($state) {
                    $query->where('state_id', $state->id);
                })
                ->where('is_active', true)
                ->orderBy('average_rating', 'desc')
                ->get()
                ->map(function($company) {
                    return [
                        'id' => $company->id,
                        'name' => $company->name,
                        'slug' => $company->slug,
                        'logo' => $company->logo ? asset('storage/' . $company->logo) : null,
                        'city' => $company->city->name,
                        'average_rating' => (float) $company->average_rating,
                        'total_reviews' => $company->total_reviews,
                        'website' => $company->website,
                        'featured_review' => $company->reviews->where('is_featured', true)->first() ? [
                            'reviewer_name' => $company->reviews->where('is_featured', true)->first()->reviewer_name,
                            'review_text' => $company->reviews->where('is_featured', true)->first()->review_text,
                            'rating' => $company->reviews->where('is_featured', true)->first()->rating,
                            'date' => $company->reviews->where('is_featured', true)->first()->review_date->format('M d, Y'),
                        ] : null
                    ];
                });
            
            return [
                'state' => [
                    'name' => $state->name,
                    'slug' => $state->slug,
                ],
                'companies' => $companies
            ];
        });
        
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
                    'website' => $company->website,
                    'phone' => $company->phone,
                    'email' => $company->email,
                    'address' => $company->address,
                    'average_rating' => (float) $company->average_rating,
                    'total_reviews' => $company->total_reviews,
                    'city' => $company->city->name,
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
