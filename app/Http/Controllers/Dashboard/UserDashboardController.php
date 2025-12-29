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


            $distributorStatus = $user?->isDistributor() 
    ? $user->getProfileStatus(UserProfileSubmission::FORM_DISTRIBUTOR)
    : null;
    
$supplierStatus = $user?->isSupplier() 
    ? $user->getProfileStatus(UserProfileSubmission::FORM_SUPPLIER)
    : null;



        return view('dashboard', [
             'distributorStatus' => $distributorStatus,
             'supplierStatus' => $supplierStatus,
            'requiresDistributorIntake' => $requiresDistributorIntake,
            'requiresSupplierIntake' => $requiresSupplierIntake,
        ]);
    }
}
