<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Company;
use App\Models\CompanyReview;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ReviewController extends Controller
{
    /**
     * Display a listing of the reviews for all reviewable entities.
     */
 public function index(Request $request): View
{
    $reviewableTypes = [
        'company' => [
            'class' => Company::class,
            'label' => __('Company'),
            'label_plural' => __('Companies'),
        ],
        'brand' => [
            'class' => Brand::class,
            'label' => __('Brand'),
            'label_plural' => __('Brands'),
        ],
        'product' => [
            'class' => Product::class,
            'label' => __('Product'),
            'label_plural' => __('Products'),
        ],
    ];

    // Set default filters if not provided
    $filters = array_merge([
        'type'      => 'company',
        'rating'    => null,
        'search'    => '',
        'date_from' => null,
        'date_to'   => null,
    ], $request->validate([
        'type' => ['nullable', Rule::in(array_keys($reviewableTypes))],
        'rating' => ['nullable', 'integer', 'between:1,5'],
        'search' => ['nullable', 'string', 'max:100'],
        'date_from' => ['nullable', 'date'],
        'date_to' => ['nullable', 'date'],
    ]));


    $isCompanyReviewListing = $filters['type'] === 'company';

    $reviews = null;
    $companyReviews = null;

    if ($isCompanyReviewListing) {
        $companyReviewsQuery = CompanyReview::query()
            ->with(['company:id,owner_name,slug,website_url']);

        if ($filters['rating']) {
            $companyReviewsQuery->where('rating', (int) $filters['rating']);
        }

        if ($filters['search']) {
            $searchTerm = '%' . $filters['search'] . '%';
            $companyReviewsQuery->where(function ($query) use ($searchTerm) {
                $query->where('review_title', 'like', $searchTerm)
                    ->orWhere('review_text', 'like', $searchTerm)
                    ->orWhere('reviewer_name', 'like', $searchTerm)
                    ->orWhereHas('company', function ($companyQuery) use ($searchTerm) {
                        $companyQuery->where('owner_name', 'like', $searchTerm);
                    });
            });
        }

        if ($filters['date_from']) {
            $companyReviewsQuery->whereDate(
                'created_at',
                '>=',
                $filters['date_from']
            );
        }

        if ($filters['date_to']) {
            $companyReviewsQuery->whereDate(
                'created_at',
                '<=',
                $filters['date_to']
            );
        }


        $companyReviews = $companyReviewsQuery
            ->latest()
            ->paginate(20)
            ->withQueryString();
    } else {
        $reviewsQuery = Review::query()
            ->with(['user', 'reviewable'])
            ->latest();

        if ($filters['type']) {
            $reviewsQuery->where('reviewable_type', $reviewableTypes[$filters['type']]['class']);
        }

        if ($filters['rating']) {
            $reviewsQuery->where('rating', (int) $filters['rating']);
        }

        if ($filters['search']) {
            $searchTerm = '%' . $filters['search'] . '%';
            $reviewsQuery->where(function ($query) use ($searchTerm) {
                $query->where('title', 'like', $searchTerm)
                    ->orWhere('comment', 'like', $searchTerm);
            });
        }

        $reviews = $reviewsQuery->paginate(20)->withQueryString();
    }

    // Count total company reviews from the 'company_reviews' table
    $companyReviewCount = CompanyReview::count();  // Only company reviews

    // Count total companies from the 'companies' table
    $companyCount = Company::count();  // Total companies

    // Prepare the stats array
    $stats = [
        'total' => $companyReviewCount,  // Show only company review count as total
        'by_type' => [
            'company' => $companyReviewCount,  // Only company review count
        ],
        'company_count' => $companyCount,  // Total company count
    ];

    // Prepare metadata for only the 'company' reviewable type
    $reviewableTypeMetaByClass = collect($reviewableTypes)
        ->filter(function ($meta, $key) {
            return $key === 'company';  // Only keep the 'company' type
        })
        ->mapWithKeys(function ($meta, $key) {
            return [$meta['class'] => array_merge($meta, ['key' => $key])];
        })
        ->all();

    return view('admin.reviews.index', [
        'reviews' => $reviews,
        'reviewableTypes' => $reviewableTypes,
        'reviewableTypeMetaByClass' => $reviewableTypeMetaByClass,
        'filters' => $filters,
        'stats' => $stats,
        'isCompanyReviewListing' => $isCompanyReviewListing,
        'companyReviews' => $companyReviews,
    ]);
}


    /**
     * Approve a company review.
     */
    public function approveCompanyReview(CompanyReview $companyReview): RedirectResponse
    {
        try {
            DB::transaction(function () use ($companyReview) {
                if (!$companyReview->company_id) {
                    $manualCompanyName = trim((string) $companyReview->manual_company_name);
                    $companyUrl = trim((string) $companyReview->company_url);

                    if ($manualCompanyName === '' && $companyUrl === '') {
                        throw new \RuntimeException('Missing company reference for review approval.');
                    }

                    $company = null;

                    if ($companyUrl !== '') {
                        $company = Company::query()->where('website_url', $companyUrl)->first();
                    }

                    if (!$company && $manualCompanyName !== '') {
                        $company = Company::query()->where('owner_name', $manualCompanyName)->first();
                    }

                    if (!$company) {
                        $slugBase = Str::slug($manualCompanyName !== '' ? $manualCompanyName : $companyUrl);
                        $slug = $slugBase !== '' ? $slugBase : 'company';
                        $originalSlug = $slug;
                        $suffix = 2;

                        while (Company::query()->where('slug', $slug)->exists()) {
                            $slug = $originalSlug . '-' . $suffix;
                            $suffix++;
                        }

                        $company = Company::create([
                            'owner_id' => null,
                            'slug' => $slug,
                            'company_type' => 'installer',
                            'owner_name' => $manualCompanyName !== '' ? $manualCompanyName : $companyUrl,
                            'phone' => null,
                            'website_url' => $companyUrl !== '' ? $companyUrl : null,
                            'logo_url' => null,
                            'description' => null,
                            'status' => 'active',
                            'email' => null,
                            'years_in_business' => null,
                            'gst_number' => null,
                            'address' => '',
                            'city' => '',
                            'pincode' => '',
                            'state_id' => null,
                            'city_id' => null,
                            'is_active' => true,
                        ]);
                    }

                    $companyReview->company_id = $company->id;
                }

                $companyReview->is_approved = true;
                $companyReview->save();
            });
        } catch (\Throwable $e) {
            return back()->with('error', __('Unable to approve company review.'));
        }

        return back()->with('success', __('Company review approved.'));
    }

    /**
     * Reject a company review.
     */
    public function rejectCompanyReview(CompanyReview $companyReview): RedirectResponse
    {
        $companyReview->update([
            'is_approved' => false,
        ]);

        return back()->with('success', __('Company review rejected.'));
    }

    /**
     * Remove a legacy morph review (brands/products) from storage.
     */
    public function destroy(Review $review): RedirectResponse
    {
        $review->delete();

        return redirect()
            ->route('admin.reviews.index')
            ->with('success', __('Review deleted successfully.'));
    }
}
