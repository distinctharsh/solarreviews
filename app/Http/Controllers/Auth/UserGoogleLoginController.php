<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class UserGoogleLoginController extends Controller
{
    public function redirect(Request $request)
    {
        $intended = $request->query('redirect_to', route('dashboard'));
        $request->session()->put('auth_google_intended', $intended);

        $request->session()->put('auth_google_login_flow', true);

        $callbackUrl = rtrim(config('app.url'), '/') . '/auth/google/callback';

        Log::info('Auth Google OAuth redirect', [
            'callback_url' => $callbackUrl,
            'host' => $request->getHost(),
        ]);

        return Socialite::driver('google')
            ->redirectUrl($callbackUrl)
            ->scopes(['openid', 'profile', 'email'])
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    public function callback(Request $request)
    {
        $callbackUrl = rtrim(config('app.url'), '/') . '/auth/google/callback';

        try {
            $googleUser = Socialite::driver('google')
                ->redirectUrl($callbackUrl)
                ->user();
        } catch (\Exception $exception) {
            Log::error('Auth Google OAuth failed', [
                'message' => $exception->getMessage(),
            ]);

            return redirect()->route('login')
                ->withErrors(['email' => 'Unable to sign in with Google. Please try again.']);
        }

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

        $redirectTo = $request->session()->pull('auth_google_intended') ?: route('dashboard');

        return redirect()->to($redirectTo);
    }
}
