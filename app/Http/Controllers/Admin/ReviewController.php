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

        $validatedFilters = $request->validate([
            'type' => ['nullable', Rule::in(array_keys($reviewableTypes))],
            'rating' => ['nullable', 'integer', 'between:1,5'],
            'search' => ['nullable', 'string', 'max:100'],
        ]);

        $filters = array_merge([
            'type' => null,
            'rating' => null,
            'search' => null,
        ], $validatedFilters);

        $isCompanyReviewListing = $filters['type'] === 'company';

        $reviews = null;
        $companyReviews = null;

        if ($isCompanyReviewListing) {
            $companyReviewsQuery = CompanyReview::query()
                ->with(['company:id,owner_name,slug']);

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
                            $companyQuery->where('name', 'like', $searchTerm)
                                ->orWhere('owner_name', 'like', $searchTerm);
                        });
                });
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

            /** @var LengthAwarePaginator $reviews */
            $reviews = $reviewsQuery->paginate(20)->withQueryString();
        }

        $typeCounts = Review::selectRaw('reviewable_type, COUNT(*) as total')
            ->groupBy('reviewable_type')
            ->pluck('total', 'reviewable_type');

        $companyReviewCount = CompanyReview::count();

        $stats = [
            'total' => Review::count() + $companyReviewCount,
            'by_type' => collect($reviewableTypes)->mapWithKeys(function ($meta, $key) use ($typeCounts) {
                if ($key === 'company') {
                    return [$key => CompanyReview::count()];
                }

                return [$key => $typeCounts[$meta['class']] ?? 0];
            })->all(),
        ];

        $reviewableTypeMetaByClass = collect($reviewableTypes)
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
        $companyReview->update([
            'is_approved' => true,
        ]);

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
}
