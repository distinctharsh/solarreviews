<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use App\Models\CompanyReview;
use App\Models\NormalUser;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Services\OtpMailer;


use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;


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
     * Landing page for selecting a company via search before opening the modal.
     */
    public function landing(Request $request)
    {
        $companies = Company::query()
            ->select('id', 'owner_name', 'state_id')
            ->with([
                'state:id,name',
                'categories:id',
            ])
            ->where('is_active', true)
            ->orderBy('owner_name')
            ->get()
            ->map(function ($company) {
                return [
                    'id' => $company->id,
                    'name' => $company->owner_name,
                    'state_id' => $company->state_id,
                    'state_name' => $company->state?->name,
                    'category_ids' => $company->categories->pluck('id')->values(),
                ];
            });

        $states = State::select('id', 'name')
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('frontend.reviews.write', [
            'companies' => $companies,
            'states' => $states,
        ]);
    }

    /**
     * Store a newly created review in storage.
     */
    public function store(Request $request)
    {
        $requiresManualIdentity = $this->shouldRequireManualIdentity($request);

        $sessionNormalUserId = Session::get('normal_user_id');
        $sessionNormalUser = $sessionNormalUserId ? NormalUser::find($sessionNormalUserId) : null;

        // Handle manual company case
        $companyId = $request->input('company_id');
        $isManualCompany = $companyId === '0' || $companyId === 0 || empty($companyId);
        
        // Set company_id to null for manual companies
        if ($isManualCompany) {
            $request->merge(['company_id' => null]);
        }
        
        // Validate the request
        $validated = $request->validate([
            'company_id' => [
                'nullable',
                'integer',
                function ($attribute, $value, $fail) {
                    // Only validate if it's not a manual company
                    if ($value && !\App\Models\Company::where('id', $value)->exists()) {
                        $fail('The selected company is invalid.');
                    }
                },
            ],
            'manual_company_name' => [
                $isManualCompany ? 'required' : 'nullable',
                'string',
                'max:255'
            ],
            'company_url' => [
                $isManualCompany ? 'required' : 'nullable',
                'url',
                'max:255'
            ],
            'state_id' => 'nullable|exists:states,id',
            'category_id' => 'nullable|exists:categories,id',
            'reviewer_name' => ($sessionNormalUser ? 'nullable' : 'required') . '|string|max:255',
            'email' => ($sessionNormalUser ? 'nullable' : 'required') . '|email|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review_title' => 'nullable|string|max:255',
            'review_text' => 'required|string|min:1',
            'metrics' => 'nullable|array',
            'metrics.*' => 'nullable|integer|min:1|max:5',
            'photos' => 'nullable|array',
            'photos.*' => [
                'nullable',
                'file',
                'max:5120',
                function ($attribute, $value, $fail) {
                    $extension = strtolower((string) $value->getClientOriginalExtension());
                    $mime = strtolower((string) $value->getMimeType());

                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'svg'];
                    $allowedMimes = [
                        'image/jpeg',
                        'image/pjpeg',
                        'image/png',
                        'image/x-png',
                        'image/svg+xml',
                        'image/svg',
                    ];

                    $extensionAllowed = $extension !== '' && in_array($extension, $allowedExtensions, true);
                    $mimeAllowed = $mime !== '' && in_array($mime, $allowedMimes, true);

                    if (!$extensionAllowed && !$mimeAllowed) {
                        $fail('The ' . $attribute . ' field must be a file of type: ' . implode(', ', $allowedExtensions) . '.');
                    }
                },
            ],
            'system_size' => 'nullable|numeric|min:0',
            'system_price' => 'nullable|numeric|min:0',
            'year_installed' => 'nullable|integer|min:2000|max:' . now()->year,
            'panel_brand' => 'nullable|string|max:255',
            'inverter_brand' => 'nullable|string|max:255',
            'user_state' => ($requiresManualIdentity ? 'required' : 'nullable') . '|exists:states,id',
            'user_city' => ($requiresManualIdentity ? 'required' : 'nullable') . '|string|max:255',
        ]);

        if ($sessionNormalUser) {
            if (empty($validated['reviewer_name'])) {
                $validated['reviewer_name'] = $sessionNormalUser->name;
            }

            if (empty($validated['email'])) {
                $validated['email'] = $sessionNormalUser->email;
            }
        }

        try {
            // Start database transaction
            DB::beginTransaction();

            $normalUserId = $this->resolveNormalUserId($validated);

            // Create the review
            $review = new CompanyReview();
            $review->company_id = $isManualCompany ? null : $validated['company_id'] ?? null;
            $review->manual_company_name = $validated['manual_company_name'] ?? null;
            $review->company_url = $validated['company_url'] ?? null;
            $review->state_id = $validated['state_id'];
            $review->category_id = $validated['category_id'];
            $review->reviewer_name = $validated['reviewer_name'];
            $review->email = $validated['email'];
            $review->normal_user_id = $normalUserId;
            $review->reviewer_state_id = $validated['user_state'] ?? null;
            $review->reviewer_city = $validated['user_city'] ?? null;
            $review->rating = $validated['rating'];
            $review->experience_metrics = collect($request->input('metrics', []))
                ->filter(fn ($value) => filled($value))
                ->map(fn ($value) => (int) $value)
                ->toArray();
            $metricMap = [
                'sales_process' => 'sales_process_rating',
                'price_charged_as_quoted' => 'price_charged_as_quoted_rating',
                'on_schedule' => 'on_schedule_rating',
                'installation_quality' => 'installation_quality_rating',
                'after_sales_support' => 'after_sales_support_rating',
            ];

            foreach ($metricMap as $metricKey => $column) {
                $review->{$column} = $request->integer("metrics.{$metricKey}");
            }

            $review->system_size_kw = $request->input('system_size');
            $review->system_price = $request->input('system_price');
            $review->year_installed = $request->input('year_installed');
            $review->panel_brand = $request->input('panel_brand');
            $review->inverter_brand = $request->input('inverter_brand');
            $storedMedia = $this->storeReviewMedia($request);
            $review->media_paths = $storedMedia['paths'];
            $review->primary_media_path = $storedMedia['primary'];
            $review->media_terms_accepted = $request->boolean('media_terms');
            $review->review_title = $validated['review_title'] ?? null;
            $review->review_text = $validated['review_text'];
            $review->review_date = now();
            $review->is_approved = false; // Admin needs to approve first
            $review->save();

            // Update company's average rating and total reviews
            if (!empty($validated['company_id'])) {
                $company = Company::findOrFail($validated['company_id']);
                $totalReviews = $company->reviews()->count();
                $averageRating = $company->reviews()->avg('rating');
                
                $company->update([
                    'total_reviews' => $totalReviews,
                    'average_rating' => round($averageRating, 1)
                ]);
            }

            // Commit transaction
            DB::commit();

            // Send email notification to admin (in a real app)
            // $this->sendReviewNotification($review);

            session()->forget(['email_verified', 'email_verified_email']);

            $companyName = $review->company->name ?? 'the company';
    return response()->json([
        'success' => true,
        'message' => 'Review submitted successfully!',
        'redirect' => route('normal-user.reviews.index'),
        'company_name' => $companyName
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
     * Store uploaded review media and return stored paths.
     */
    protected function storeReviewMedia(Request $request): array
    {
        if (!$request->hasFile('photos')) {
            return [
                'paths' => [],
                'primary' => null,
            ];
        }

        $storedPaths = collect($request->file('photos'))
            ->filter(fn ($file) => $file->isValid())
            ->map(function ($file) {
                $hashPath = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('reviews', $hashPath, 'public');
                if (!$path) {
                    return null;
                }

                $url = Storage::disk('public')->url($path);
                return preg_replace('~(?<!:)/{2,}~', '/', $url);
            })
            ->filter()
            ->values();

        $paths = $storedPaths;
        $primaryMedia = $storedPaths->first();

        return [
            'paths' => $paths,
            'primary' => $primaryMedia,
        ];
    }

    protected function shouldRequireManualIdentity(Request $request): bool
    {
        if ($request->boolean('manual_identity_optional')) {
            return false;
        }

        $normalUserId = Session::get('normal_user_id');
        if ($normalUserId) {
            $normalUser = NormalUser::find($normalUserId);
            if ($normalUser && $normalUser->provider === 'google') {
                return false;
            }
        }

        $profile = Session::get('review_profile');
        if ($profile && ($profile['provider'] ?? null) === 'google') {
            return false;
        }

        return true;
    }

    protected function resolveNormalUserId(array $validated): ?int
    {
        $sessionUserId = Session::get('normal_user_id');
        if ($sessionUserId && NormalUser::find($sessionUserId)) {
            return $sessionUserId;
        }

        $email = $validated['email'] ?? null;
        if (!$email) {
            return null;
        }

        $normalUser = NormalUser::updateOrCreate(
            ['email' => $email],
            [
                'name' => $validated['reviewer_name'] ?? null,
                'phone_number' => $validated['phone_number'] ?? null, // Add this line
                'provider' => 'manual',
                'provider_id' => null,
                'avatar_url' => null,
                'last_login_at' => now(),
                'last_activity_at' => now(),
            ]
        );

         // Update phone number if it's provided but not yet saved
        if (isset($validated['phone_number']) && empty($normalUser->phone_number)) {
            $normalUser->update(['phone_number' => $validated['phone_number']]);
        }

        Session::put('normal_user_id', $normalUser->id);
        Session::put('review_profile', [
            'name' => $normalUser->name,
            'email' => $normalUser->email,
            'provider' => 'manual',
            'provider_id' => null,
            'avatar' => null,
        ]);

        return $normalUser->id;
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
        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT); // Generate 6-digit OTP
        
        // Save OTP to session for verification
        session([
            'otp' => $otp,
            'otp_email' => $email,
            'otp_expires_at' => now()->addMinutes(30)
        ]);
    
        // Send OTP via email
        try {
            Mail::to($email)->send(new SendEmail($otp, $email));
            
            \Log::info("OTP sent to {$email}: {$otp}");
            
            return response()->json([
                'success' => true,
                'message' => 'Verification code sent. Please check your email.',
            ]);
        } catch (\Exception $e) {
            \Log::error("Failed to send OTP to {$email}: " . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to send verification code. Please try again later.',
            ], 500);
        }
    }

    /**
     * Verify OTP
     */
    public function verifyOtp(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string|size:6',
            'reviewer_name' => 'nullable|string|max:255',
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
    
        // Verify OTP
        if ($request->otp !== $savedOtp || $request->email !== $otpEmail) {
            \Log::warning('Invalid OTP or email mismatch', [
                'provided_otp' => $request->otp,
                'provided_email' => $request->email
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Invalid verification code. Please try again.'
            ], 400);
        }
    
        // OTP verified successfully
        // Store verification in session
        session(['email_verified' => true]);
        
        // Clear OTP from session
        session()->forget(['otp', 'otp_email', 'otp_expires_at']);
    
        return response()->json([
            'success' => true,
            'message' => 'Email verified successfully!'
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
