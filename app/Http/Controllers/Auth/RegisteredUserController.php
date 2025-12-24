<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $userTypes = UserType::orderBy('name')->get(['id', 'name', 'slug']);

        return view('auth.register', compact('userTypes'));
    }

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $userTypes = UserType::orderBy('name')->get(['id', 'name', 'slug']);
        
        // Check for Google data in session
        $googleData = session('business_google_data');
        $emailVerified = session('business_email_verified', false);
        $verifiedEmail = session('business_verified_email');
        
        // Pre-fill email if from OTP or Google
        $prefilledEmail = request()->query('email') ?? $googleData['email'] ?? $verifiedEmail ?? old('email');
        $otpVerified = request()->query('otp_verified') ?? $emailVerified;

        return view('auth.register', compact('userTypes', 'googleData', 'prefilledEmail', 'otpVerified'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $googleData = session('business_google_data');
        $emailVerified = session('business_email_verified', false);
        $verifiedEmail = session('business_verified_email');
        
        // Password is optional if coming from Google or OTP verified
        $passwordRequired = !$googleData && !$emailVerified;
        
        $rules = [
            'user_type_id' => ['required', 'exists:user_types,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'max:32'],
            'terms' => ['accepted'],
        ];

        // Add password rules only if required
        if ($passwordRequired) {
            $rules['password'] = ['required', 'confirmed', Rules\Password::defaults()];
        } else {
            // Password is optional but if provided, must meet requirements
            $rules['password'] = ['nullable', 'confirmed', Rules\Password::defaults()];
        }

        $validated = $request->validate($rules);

        // Use Google data if available
        $userData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'user_type_id' => $validated['user_type_id'],
        ];

        // Set password only if provided or required
        if (!empty($validated['password'])) {
            $userData['password'] = Hash::make($validated['password']);
        } else {
            // Generate a random password for OTP/Google users (they won't use it)
            $userData['password'] = Hash::make(uniqid('otp_', true) . random_bytes(16));
        }

        $user = User::create($userData);

        // Clear session data
        session()->forget(['business_google_data', 'business_email_verified', 'business_verified_email']);

        event(new Registered($user));

        Auth::login($user);

        // Check if admin and redirect accordingly
        if ($user->is_admin) {
            return redirect(route('admin.dashboard', absolute: false));
        }

        return redirect(route('dashboard', absolute: false));
    }
}
