<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Project;
use App\Models\State;
use App\Models\UserProfileSubmission;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserDashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user();

        $projects = Project::query()
            ->where('user_id', $user?->id)
            ->with('images')
            ->latest()
            ->get();

        $states = State::query()
            ->orderBy('name')
            ->get(['id', 'name']);

        $cities = City::query()
            ->orderBy('name')
            ->get(['id', 'name', 'state_id']);

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
            'states' => $states,
            'cities' => $cities,
            'projects' => $projects,
        ]);
    }
}
