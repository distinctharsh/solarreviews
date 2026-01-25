<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class UserGoogleRegisterController extends Controller
{
    public function redirect(Request $request)
    {
        $validated = $request->validate([
            'user_type_id' => ['required', 'exists:user_types,id'],
            'phone' => ['required', 'string', 'max:32'],
        ]);

        $request->session()->put('auth_google_register_flow', true);
        $request->session()->put('auth_google_register_payload', [
            'user_type_id' => (int) $validated['user_type_id'],
            'phone' => $validated['phone'],
        ]);

        $callbackUrl = rtrim(config('app.url'), '/') . '/auth/google/callback';

        Log::info('Auth Google register redirect', [
            'callback_url' => $callbackUrl,
            'host' => $request->getHost(),
        ]);

        return Socialite::driver('google')
            ->redirectUrl($callbackUrl)
            ->scopes(['openid', 'profile', 'email'])
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }
}
