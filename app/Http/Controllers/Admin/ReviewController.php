<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    /**
     * Display a listing of the reviews.
     */
    public function index()
    {
        $reviews = CompanyReview::with(['company'])
            ->latest()
            ->paginate(20);
            
        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * Show the form for editing the specified review.
     */
    public function edit(CompanyReview $review)
    {
        $review->load(['company']);
        return view('admin.reviews.edit', compact('review'));
    }

    /**
     * Update the specified review in storage.
     */
    public function update(Request $request, CompanyReview $review)
    {
        $validated = $request->validate([
            'reviewer_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'required|string',
            'review_date' => 'required|date',
            'source' => 'required|string|max:50',
            'is_featured' => 'boolean',
        ]);

        DB::transaction(function () use ($review, $validated) {
            $review->update($validated);
            
            // Update company's average rating and total reviews
            $company = $review->company;
            $company->updateAverageRating();
        });

        return redirect()
            ->route('admin.reviews.edit', $review)
            ->with('success', 'Review updated successfully.');
    }

    /**
     * Remove the specified review from storage.
     */
    public function destroy(CompanyReview $review)
    {
        $company = $review->company;
        
        DB::transaction(function () use ($review, $company) {
            $review->delete();
            $company->updateAverageRating();
        });

        return redirect()
            ->route('admin.reviews.index')
            ->with('success', 'Review deleted successfully.');
    }

    /**
     * Toggle featured status of a review.
     */
    public function toggleFeatured(CompanyReview $review)
    {
        $review->update([
            'is_featured' => !$review->is_featured
        ]);

        return response()->json([
            'success' => true,
            'is_featured' => $review->is_featured
        ]);
    }
}
