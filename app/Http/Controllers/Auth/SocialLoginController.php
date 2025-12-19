<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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

        Session::put('review_profile', [
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'avatar' => $googleUser->getAvatar(),
            'provider' => 'google',
            'provider_id' => $googleUser->getId(),
        ]);

        return redirect($this->consumeReturnUrl() ?? route('reviews.create'))
            ->with('google_oauth_success', 'Google account connected.');
    }

    public function disconnect(Request $request)
    {
        Session::forget('review_profile');

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
