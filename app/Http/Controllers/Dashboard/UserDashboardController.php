<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\UserProfileSubmission;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserDashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user();

        $requiresDistributorIntake = $user?->isDistributor() &&
            !$user->hasCompletedProfileForm(UserProfileSubmission::FORM_DISTRIBUTOR);

        $requiresSupplierIntake = $user?->isSupplier() &&
            !$user->hasCompletedProfileForm(UserProfileSubmission::FORM_SUPPLIER);

        return view('dashboard', [
            'requiresDistributorIntake' => $requiresDistributorIntake,
            'requiresSupplierIntake' => $requiresSupplierIntake,
        ]);
    }
}
