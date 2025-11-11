<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CompanyReview;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    /**
     * Store a newly created review in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'state_id' => 'required|exists:states,id',
            'reviewer_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review_title' => 'nullable|string|max:255',
            'review_text' => 'required|string|min:10',
            'otp' => 'required|string|size:6',
        ]);

        // Check if OTP is verified (in a real app, you would verify the OTP here)
        // For demo, we'll just check if it's 6 digits
        if (strlen($validated['otp']) !== 6) {
            return response()->json([
                'success' => false,
                'message' => 'Please verify your email with OTP first.'
            ], 422);
        }

        try {
            // Start database transaction
            DB::beginTransaction();

            // Create the review
            $review = new CompanyReview();
            $review->company_id = $validated['company_id'];
            $review->state_id = $validated['state_id'];
            $review->reviewer_name = $validated['reviewer_name'];
            $review->email = $validated['email'];
            $review->rating = $validated['rating'];
            $review->review_title = $validated['review_title'] ?? null;
            $review->review_text = $validated['review_text'];
            $review->review_date = now();
            $review->is_approved = false; // Admin needs to approve first
            $review->save();

            // Update company's average rating and total reviews
            $company = Company::findOrFail($validated['company_id']);
            $totalReviews = $company->reviews()->count();
            $averageRating = $company->reviews()->avg('rating');
            
            $company->update([
                'total_reviews' => $totalReviews,
                'average_rating' => round($averageRating, 1)
            ]);

            // Commit transaction
            DB::commit();

            // Send email notification to admin (in a real app)
            // $this->sendReviewNotification($review);

            return response()->json([
                'success' => true,
                'message' => 'Thank you for your review! It will be visible after approval.'
            ]);

        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();
            
            Log::error('Error submitting review: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to submit review. Please try again.'
            ], 500);
        }
    }

    /**
     * Send OTP to user's email
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->email;
        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // In a real app, you would save this OTP to the database with an expiration time
        // and send it to the user's email
        
        // For demo, we'll just log it
        Log::info("OTP for $email: $otp");
        
        // In a real app, you would send an email here
        Mail::to($email)->send(new OtpMail($otp));
        
        return response()->json([
            'success' => true,
            'message' => 'OTP sent successfully.'
        ]);
    }

    /**
     * Verify OTP
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string|size:6',
        ]);

        // In a real app, you would verify the OTP from the database
        // For demo, we'll just check if it's 6 digits
        $isValid = strlen($request->otp) === 6;
        
        if ($isValid) {
            return response()->json([
                'success' => true,
                'message' => 'OTP verified successfully.'
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Invalid OTP. Please try again.'
        ], 422);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
