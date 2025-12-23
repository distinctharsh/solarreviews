<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\NormalUser;
use App\Services\OtpMailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirectToGoogle(Request $request)
    {
        $returnUrl = $request->query('return_url', url()->previous() ?? url('/'));
        Session::put('google_review_return_url', $returnUrl);

        return Socialite::driver('google')
            ->scopes(['openid', 'profile', 'email'])
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $exception) {
            Log::error('Google OAuth failed', [
                'message' => $exception->getMessage(),
            ]);

            return redirect($this->consumeReturnUrl() ?? route('reviews.create'))
                ->with('google_oauth_error', 'Unable to sign in with Google. Please try again.');
        }

        $normalUser = NormalUser::updateOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'provider' => 'google',
                'provider_id' => $googleUser->getId(),
                'avatar_url' => $googleUser->getAvatar(),
                'last_login_at' => now(),
                'last_activity_at' => now(),
            ]
        );

        Session::put('normal_user_id', $normalUser->id);

        Session::put('review_profile', [
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'avatar' => $googleUser->getAvatar(),
            'provider' => 'google',
            'provider_id' => $googleUser->getId(),
        ]);

        // Redirect to profile page after Google login
        return redirect($this->consumeReturnUrl() ?? route('normal-user.reviews.index'))
            ->with('google_oauth_success', 'Google account connected.');
    }

    /**
     * Send OTP for email login
     */
    public function sendOtp(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
        ]);

        $email = $validated['email'];
        
        // Generate 6-digit OTP
        $otp = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Save OTP to session for verification
        Session::put('login_otp', $otp);
        Session::put('login_otp_email', $email);
        Session::put('login_otp_expires_at', now()->addMinutes(10));

        // Send OTP via email
        try {
            $mailer = new OtpMailer();
            $sent = $mailer->send($email, $otp);

            if (!$sent) {
                Log::warning('Failed to send OTP email', ['email' => $email]);
                // Still return success for development, but log the issue
                // In production, you might want to return an error
            }

            // Log OTP for development/testing
            if (app()->environment('local')) {
                Log::info("Login OTP for {$email}: {$otp}");
            }
        } catch (\Exception $e) {
            Log::error('Error sending OTP email', [
                'email' => $email,
                'error' => $e->getMessage(),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Verification code sent to your email.',
        ]);
    }

    /**
     * Verify OTP and login user
     */
    public function verifyOtp(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'otp' => 'required|string|size:6',
        ]);

        $savedOtp = Session::get('login_otp');
        $otpEmail = Session::get('login_otp_email');
        $otpExpiresAt = Session::get('login_otp_expires_at');

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
        Session::forget(['login_otp', 'login_otp_email', 'login_otp_expires_at']);

        // Find or create user
        $normalUser = NormalUser::firstOrCreate(
            ['email' => $validated['email']],
            [
                'name' => explode('@', $validated['email'])[0], // Default name from email
                'provider' => 'email',
                'provider_id' => null,
                'avatar_url' => null,
                'last_login_at' => now(),
                'last_activity_at' => now(),
            ]
        );

        // Update last login if user already exists
        if ($normalUser->wasRecentlyCreated === false) {
            $normalUser->update([
                'last_login_at' => now(),
                'last_activity_at' => now(),
            ]);
        }

        // Set session
        Session::put('normal_user_id', $normalUser->id);
        Session::put('review_profile', [
            'name' => $normalUser->name,
            'email' => $normalUser->email,
            'provider' => 'email',
            'provider_id' => null,
            'avatar' => $normalUser->avatar_url,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Login successful!',
        ]);
    }

    public function disconnect(Request $request)
    {
        Session::forget('review_profile');
        Session::forget('normal_user_id');

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('google_oauth_success', 'Google account disconnected.');
    }

    protected function consumeReturnUrl(): ?string
    {
        return Session::pull('google_review_return_url');
    }
}
