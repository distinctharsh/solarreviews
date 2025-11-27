<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use App\Models\CompanyReview;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    /**
     * Display the multi-category review submission page.
     */
    public function create()
    {
        $categoryTemplates = [
            'solar-installers' => [
                'label' => 'Solar Installer',
                'description' => 'Review the installers who put panels on your roof and help other homeowners pick the right partner.',
                'cta' => 'Share installer experience',
                'icon' => 'bi-building-gear'
            ],
            'solar-panels' => [
                'label' => 'Solar Panels',
                'description' => 'Tell us how your panels have performed, their durability, and real-world production.',
                'cta' => 'Talk about panel performance',
                'icon' => 'bi-sun'
            ],
            'solar-inverters' => [
                'label' => 'Solar Inverter',
                'description' => 'Share how reliable your inverter has been and how easy it is to monitor.',
                'cta' => 'Review inverter reliability',
                'icon' => 'bi-lightning-charge'
            ],
            'battery-storage' => [
                'label' => 'Battery Storage',
                'description' => 'Let others know how your storage system performs during outages and daily cycling.',
                'cta' => 'Rate your battery backup',
                'icon' => 'bi-battery-charging'
            ],
        ];

        $requestedSlugs = array_keys($categoryTemplates);
        $categories = Category::whereIn('slug', $requestedSlugs)->get()->keyBy('slug');

        $categoryTiles = collect($categoryTemplates)->map(function ($template, $slug) use (&$categories) {
            $category = $categories->get($slug);

            if (!$category) {
                $category = Category::create([
                    'name' => $template['label'],
                    'slug' => $slug,
                    'description' => $template['description'],
                    'is_active' => true,
                ]);

                $categories[$slug] = $category;
            }

            return [
                'id' => $category->id ?? null,
                'slug' => $slug,
                'label' => $template['label'],
                'description' => $template['description'],
                'cta' => $template['cta'],
                'icon' => $template['icon'],
            ];
        })->values();

        $activeCategory = $categoryTiles->firstWhere('id') ?? $categoryTiles->first();
        $activeCategoryId = $activeCategory['id'] ?? null;

        $states = State::with(['cities' => function ($query) {
            $query->orderBy('name');
        }])->orderBy('name')->get();

        $companies = Company::select('id', 'state_id')
            ->selectRaw('COALESCE(owner_name, slug) as name')
            ->orderBy('owner_name')
            ->get();

        return view('frontend.reviews.create', [
            'categoryTiles' => $categoryTiles,
            'states' => $states,
            'companies' => $companies,
            'activeCategoryId' => $activeCategoryId,
        ]);
    }

    /**
     * Store a newly created review in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'state_id' => 'required|exists:states,id',
            'category_id' => 'required|exists:categories,id',
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

        if (!session('email_verified') || session('email_verified_email') !== $validated['email']) {
            return response()->json([
                'success' => false,
                'message' => 'Please verify your email with the OTP sent to you.'
            ], 422);
        }

        try {
            // Start database transaction
            DB::beginTransaction();

            // Create the review
            $review = new CompanyReview();
            $review->company_id = $validated['company_id'];
            $review->state_id = $validated['state_id'];
            $review->category_id = $validated['category_id'];
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

        session()->forget(['email_verified', 'email_verified_email']);
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
        
        // Save OTP to session for verification
        session(['otp' => $otp, 'otp_email' => $email, 'otp_expires_at' => now()->addMinutes(10)]);
        
        // Log OTP to file for testing
        $logMessage = "[" . now() . "] OTP for $email: $otp\n";
        file_put_contents(storage_path('logs/otp.log'), $logMessage, FILE_APPEND);
        
        // Log to Laravel log
        \Log::info("OTP for $email: $otp");
        
        // For local development, we'll just log the email
        if (app()->environment('local')) {
            return response()->json([
                'success' => true,
                'message' => 'OTP logged to storage/logs/otp.log',
                'otp' => $otp // Only for development
            ]);
        }
        
        // In production, send the email
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

        $savedOtp = session('otp');
        $otpEmail = session('otp_email');
        $otpExpiresAt = session('otp_expires_at');

        // Debug log
        \Log::info('OTP Verification Attempt', [
            'email' => $request->email,
            'otp' => $request->otp,
            'saved_otp' => $savedOtp,
            'otp_email' => $otpEmail,
            'otp_expires_at' => $otpExpiresAt
        ]);

        // Check if OTP exists and not expired
        if (!$savedOtp || !$otpEmail || !$otpExpiresAt) {
            \Log::warning('OTP not found or expired in session');
            return response()->json([
                'success' => false,
                'message' => 'No OTP found or OTP expired. Please request a new one.'
            ], 400);
        }

        if (now()->gt($otpExpiresAt)) {
            \Log::warning('OTP has expired');
            return response()->json([
                'success' => false,
                'message' => 'OTP has expired. Please request a new one.'
            ], 400);
        }

        if ($otpEmail !== $request->email) {
            \Log::warning('Email does not match', [
                'expected' => $otpEmail,
                'actual' => $request->email
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Email does not match the one OTP was sent to.'
            ], 400);
        }

        if ($savedOtp !== $request->otp) {
            \Log::warning('Invalid OTP', [
                'expected' => $savedOtp,
                'actual' => $request->otp
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP. Please try again.'
            ], 400);
        }

        // Clear the OTP after successful verification
        session()->forget(['otp', 'otp_email', 'otp_expires_at']);

        // Mark email as verified in session
        session([
            'email_verified' => true,
            'email_verified_email' => $request->email,
        ]);

        \Log::info('OTP verified successfully');
        return response()->json([
            'success' => true,
            'message' => 'OTP verified successfully.'
        ]);
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
