<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;

class BusinessGoogleLoginController extends Controller
{
    /**
     * Redirect the user to Google's OAuth page.
     */
    public function redirect(Request $request)
    {
        // Store intended URL to return after login (optional)
        $request->session()->put('url.intended', $request->input('redirect_to', url('/dashboard')));
        
        return Socialite::driver('google')
            ->redirectUrl(route('login.google.business.callback'))
            ->scopes(['openid', 'profile', 'email'])
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    /**
     * Handle callback from Google.
     */
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')
                ->redirectUrl(route('login.google.business.callback'))
                ->user();
        } catch (\Exception $e) {
            Log::error('Business Google OAuth failed', ['message' => $e->getMessage()]);
            return redirect()->route('login')->with('error', 'Google login failed. Please try again.');
        }

        // Check if user exists in 'users' table (business users)
        $user = User::where('email', $googleUser->getEmail())->first();
        
        if ($user) {
            // Log the user in
            Auth::login($user);
            
            // Always send business users to the dashboard after Google login
            return redirect()->route('dashboard');
        }

        // If user not found in 'users' table, redirect back with error
        return redirect()->route('login')->with('error', 'No business account found for this Google email. Please use the regular login form.');
    }
}
