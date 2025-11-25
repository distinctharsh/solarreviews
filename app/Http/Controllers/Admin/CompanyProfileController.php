<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CompanyProfileController extends Controller
{
    /**
     * Display a listing of the company profiles created through registration.
     */
    public function index(): View
    {
        /** @var LengthAwarePaginator $profiles */
        $profiles = CompanyProfile::with(['user', 'productLineTypes', 'serviceTypes'])
            ->orderByDesc('created_at')
            ->paginate(20)
            ->withQueryString();

        return view('admin.company-profiles.index', compact('profiles'));
    }

    /**
     * Display the specified company profile.
     */
    public function show(CompanyProfile $companyProfile): View
    {
        $companyProfile->load(['user', 'productLineTypes', 'serviceTypes']);

        return view('admin.company-profiles.show', [
            'profile' => $companyProfile,
        ]);
    }
}
