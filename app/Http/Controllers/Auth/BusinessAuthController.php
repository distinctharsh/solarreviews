<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class BusinessAuthController extends Controller
{
    /**
     * Redirect to Google OAuth for business users
     */
    public function redirectToGoogle(Request $request)
    {
        $returnUrl = $request->query('return_url', route('dashboard'));
        Session::put('business_google_return_url', $returnUrl);
        
        // Determine context based on return URL
        $context = str_contains($returnUrl, 'register') ? 'register' : 'login';
        Session::put('business_google_context', $context);

        return Socialite::driver('google')
            ->scopes(['openid', 'profile', 'email'])
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    /**
     * Handle Google OAuth callback for business users
     */
    public function handleGoogleCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $exception) {
            Log::error('Business Google OAuth failed', [
                'message' => $exception->getMessage(),
            ]);

            return redirect()->route('login')
                ->with('error', 'Unable to sign in with Google. Please try again.');
        }

        $email = $googleUser->getEmail();
        
        // Check if user exists
        $user = User::where('email', $email)->first();

        if ($user) {
            // Existing user - login directly and send to dashboard (admins to admin dashboard)
            Auth::login($user);

            $redirectUrl = $user->is_admin
                ? route('admin.dashboard')
                : route('dashboard');

            return redirect($redirectUrl)->with('success', 'Welcome back!');
        } else {
            // New user - check context
            $context = Session::get('business_google_context', 'login');
            
            if ($context === 'register') {
                // Store Google data in session and redirect to registration
                Session::put('business_google_data', [
                    'name' => $googleUser->getName(),
                    'email' => $email,
                    'avatar' => $googleUser->getAvatar(),
                    'provider_id' => $googleUser->getId(),
                ]);

                return redirect()->route('register')
                    ->with('google_data', true)
                    ->with('success', 'Google account connected. Please complete registration.');
            }

            // Login context - stay on login page and prompt registration
            return redirect()->route('login')
                ->with('error', 'Account not found. Please register first by using the Create Account form.');
        }
    }

    /**
     * Send OTP for business email login/registration
     */
    public function sendOtp(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email|max:255',
            ]);

            $email = $validated['email'];
            
            // Generate 6-digit OTP
            $otp = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            
            // Save OTP to session for verification
            Session::put('business_otp', $otp);
            Session::put('business_otp_email', $email);
            Session::put('business_otp_expires_at', now()->addMinutes(10));

            // Send OTP via email
            try {
                Mail::to($email)->send(new SendEmail($otp, $email));
                Log::info("Business OTP email sent successfully to {$email}");
            } catch (\Exception $e) {
                Log::error('Error sending business OTP email', [
                    'email' => $email,
                    'error' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]);
                
                // In development, still allow OTP to work (it's logged)
                if (app()->environment('local')) {
                    Log::info("Business OTP for {$email} (email failed, but OTP logged): {$otp}");
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to send verification code. Please check your email settings or try again later.',
                    ], 500);
                }
            }

            // Log OTP for development/testing
            if (app()->environment('local')) {
                Log::info("Business OTP for {$email}: {$otp}");
            }

            return response()->json([
                'success' => true,
                'message' => 'Verification code sent to your email.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Unexpected error in business sendOtp', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again.',
            ], 500);
        }
    }

    /**
     * Verify OTP for business login/registration
     */
    public function verifyOtp(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email|max:255',
                'otp' => 'required|string|size:6',
            ]);

            $savedOtp = Session::get('business_otp');
            $otpEmail = Session::get('business_otp_email');
            $otpExpiresAt = Session::get('business_otp_expires_at');

            // Check if OTP exists and not expired
            if (!$savedOtp || !$otpEmail || !$otpExpiresAt) {
                return response()->json([
                    'success' => false,
                    'message' => 'No OTP found or OTP expired. Please request a new one.',
                ], 400);
            }

            if (now()->gt($otpExpiresAt)) {
                return response()->json([
                    'success' => false,
                    'message' => 'OTP has expired. Please request a new one.',
                ], 400);
            }

            if ($otpEmail !== $validated['email']) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email does not match the one OTP was sent to.',
                ], 400);
            }

            if ($savedOtp !== $validated['otp']) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid verification code. Please try again.',
                ], 400);
            }

            // Clear the OTP after successful verification
            Session::forget(['business_otp', 'business_otp_email', 'business_otp_expires_at']);

            // Check if user exists
            $user = User::where('email', $validated['email'])->first();

            if ($user) {
                // Existing user - login
                Auth::login($user);
                
                // Check if admin and redirect accordingly
                $redirectUrl = $user->is_admin ? route('admin.dashboard') : route('dashboard');
                
                return response()->json([
                    'success' => true,
                    'message' => 'Login successful!',
                    'redirect' => $redirectUrl,
                    'requires_registration' => false,
                ]);
            } else {
                // New user - mark email as verified and redirect to registration
                Session::put('business_email_verified', true);
                Session::put('business_verified_email', $validated['email']);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Email verified. Please complete registration.',
                    'requires_registration' => true,
                    'redirect' => route('register', ['email' => $validated['email'], 'otp_verified' => 1]),
                ]);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Unexpected error in business verifyOtp', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again.',
            ], 500);
        }
    }
}

