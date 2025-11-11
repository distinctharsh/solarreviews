<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CompanyController extends Controller
{
    /**
     * Get companies by city
     */
    public function getByCity($citySlug)
    {
        $cacheKey = 'companies_city_' . $citySlug;
        
        return Cache::remember($cacheKey, now()->addHours(24), function () use ($citySlug) {
            $city = City::where('slug', $citySlug)
                ->with(['state'])
                ->firstOrFail();
            
            $companies = Company::where('city_id', $city->id)
                ->withCount('reviews')
                ->orderBy('average_rating', 'desc')
                ->get()
                ->map(function ($company) {
                    return [
                        'id' => $company->id,
                        'name' => $company->name,
                        'slug' => $company->slug,
                        'logo' => $company->logo ? asset('storage/' . $company->logo) : null,
                        'average_rating' => (float) $company->average_rating,
                        'total_reviews' => $company->reviews_count,
                        'website' => $company->website,
                        'phone' => $company->phone,
                        'address' => $company->address,
                    ];
                });
            
            return response()->json([
                'city' => [
                    'name' => $city->name,
                    'state' => $city->state->name,
                ],
                'companies' => $companies
            ]);
        });
    }

    /**
     * Get company details with reviews
     */
    public function show($slug)
    {
        $cacheKey = 'company_' . $slug;
        
        return Cache::remember($cacheKey, now()->addHours(12), function () use ($slug) {
            $company = Company::where('slug', $slug)
                ->with(['city.state', 'reviews' => function($query) {
                    $query->orderBy('created_at', 'desc');
                }])
                ->withCount('reviews')
                ->firstOrFail();
            
            $reviews = $company->reviews->map(function ($review) {
                return [
                    'id' => $review->id,
                    'reviewer_name' => $review->reviewer_name,
                    'rating' => (int) $review->rating,
                    'review_text' => $review->review_text,
                    'review_date' => $review->review_date->format('M d, Y'),
                    'source' => $review->source,
                    'is_featured' => (bool) $review->is_featured,
                ];
            });
            
            return response()->json([
                'id' => $company->id,
                'name' => $company->name,
                'description' => $company->description,
                'logo' => $company->logo ? asset('storage/' . $company->logo) : null,
                'average_rating' => (float) $company->average_rating,
                'total_reviews' => $company->reviews_count,
                'address' => $company->address,
                'state' => $company->city->state->name,
                'reviews' => $reviews
            ]);
        });
    }
}
