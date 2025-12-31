<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Company;
use App\Models\CompanyReview;
use App\Models\NormalUser;
use App\Models\UserType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        $userTypes = UserType::query()
            ->orderBy('name')
            ->get();

        $stats = [
            'listed_epc' => Company::query()
                ->where('is_active', true)
                ->count(),
            'total_reviews' => CompanyReview::query()
                ->where('is_approved', true)
                ->count(),
            'active_users' => NormalUser::query()->count(),
        ];

        return view('auth.login', compact('userTypes', 'stats'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Check if user is admin and redirect accordingly
        if (auth()->check() && auth()->user()->is_admin) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->intended(route('dashboard'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
