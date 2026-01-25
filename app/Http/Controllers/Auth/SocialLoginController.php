<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use App\Mail\SendEmail;
use App\Models\NormalUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
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

        if (Session::pull('auth_google_register_flow')) {
            $payload = Session::pull('auth_google_register_payload');
            if (! is_array($payload) || empty($payload['user_type_id']) || empty($payload['phone'])) {
                return redirect()->route('register')
                    ->withErrors(['email' => 'Please complete registration details before continuing with Google.']);
            }

            $email = $googleUser->getEmail();
            if (! $email) {
                return redirect()->route('register')
                    ->withErrors(['email' => 'Google account did not provide an email address.']);
            }

            $existing = User::query()->where('email', $email)->first();
            if ($existing) {
                return redirect()->route('login')
                    ->withErrors(['email' => 'An account already exists for this Google email. Please log in.']);
            }

            $user = User::create([
                'name' => $googleUser->getName() ?: ($email ? explode('@', $email)[0] : 'Account'),
                'email' => $email,
                'phone' => (string) $payload['phone'],
                'user_type_id' => (int) $payload['user_type_id'],
                'password' => Hash::make(Str::random(40)),
            ]);

            event(new Registered($user));

            Auth::login($user);

            Session::forget('normal_user_id');
            Session::forget('review_profile');
            Session::forget('google_review_return_url');

            return redirect()->route('dashboard');
        }

        if (Session::pull('auth_google_login_flow')) {
            $email = $googleUser->getEmail();
            if (! $email) {
                return redirect()->route('login')
                    ->withErrors(['email' => 'Google account did not provide an email address.']);
            }

            $user = User::query()->where('email', $email)->first();

            if (! $user) {
                return redirect()->route('login')
                    ->withErrors(['email' => 'No account found for this Google email. Please use your email & password.']);
            }

            Auth::login($user);

            Session::forget('normal_user_id');
            Session::forget('review_profile');
            Session::forget('google_review_return_url');

            $redirectTo = Session::pull('auth_google_intended');
            if (! is_string($redirectTo) || $redirectTo === '') {
                $redirectTo = route('dashboard');
            } else {
                $appHost = parse_url(config('app.url'), PHP_URL_HOST);
                $targetHost = parse_url($redirectTo, PHP_URL_HOST);
                if ($targetHost && $appHost && strcasecmp($targetHost, $appHost) !== 0) {
                    $redirectTo = route('dashboard');
                }
            }

            return redirect($redirectTo);
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
        try {
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

            // Send OTP via email using SendEmail Mailable
            try {
                Mail::to($email)->send(new SendEmail($otp, $email));
                Log::info("OTP email sent successfully to {$email}");
            } catch (\Exception $e) {
                Log::error('Error sending OTP email', [
                    'email' => $email,
                    'error' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString(),
                ]);
                
                // In development, still allow OTP to work (it's logged)
                if (app()->environment('local')) {
                    Log::info("Login OTP for {$email} (email failed, but OTP logged): {$otp}");
                    // Continue - OTP is saved in session and logged
                } else {
                    // In production, return error if email sending fails
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to send verification code. Please check your email settings or try again later.',
                    ], 500);
                }
            }

            // Log OTP for development/testing (always log for debugging)
            if (app()->environment('local')) {
                Log::info("Login OTP for {$email}: {$otp}");
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
            Log::error('Unexpected error in sendOtp', [
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
