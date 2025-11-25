<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\ProductLineType;
use App\Models\ServiceType;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'company_type' => ['required', Rule::in(['manufacturer', 'distributor'])],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'max:32'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

            // Company basics
            'company_name' => ['required', 'string', 'max:255'],
            'brand_name' => ['nullable', 'string', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
            'year_founded' => ['nullable', 'integer', 'between:1900,'.date('Y')],
            'employee_count' => ['nullable', 'string', 'max:255'],
            'primary_goal' => ['required', Rule::in(['showcase_products','list_services','find_partners','track_portfolio'])],

            // Address
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:255'],
            'country' => ['required', Rule::in(['IN','US','GB'])],

            // Manufacturer fields
            'production_capacity' => ['nullable', 'string', 'max:255'],
            'distribution_regions' => ['nullable', 'string', 'max:255'],
            'product_lines' => ['required_if:company_type,manufacturer', 'array'],
            'product_lines.*' => ['string', 'exists:product_line_types,slug'],
            'certifications' => ['nullable', 'string'],

            // Distributor fields
            'coverage_states' => ['nullable', 'string', 'max:255'],
            'installations_per_year' => ['nullable', 'integer', 'min:0'],
            'service_categories' => ['required_if:company_type,distributor', 'array'],
            'service_categories.*' => ['string', 'exists:service_types,slug'],
            'licenses' => ['nullable', 'string'],

            'terms' => ['accepted'],
        ], [
            'product_lines.required_if' => 'Please select at least one product line.',
            'service_categories.required_if' => 'Please select at least one service you provide.',
        ]);

        $user = null;

        DB::transaction(function () use (&$user, $validated, $request) {
            $fullName = trim($validated['first_name'].' '.$validated['last_name']);

            $user = User::create([
                'name' => $fullName,
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'company_type' => $validated['company_type'],
                'password' => Hash::make($validated['password']),
            ]);

            /** @var CompanyProfile $companyProfile */
            $companyProfile = $user->companyProfile()->create([
                'company_type' => $validated['company_type'],
                'company_name' => $validated['company_name'],
                'brand_name' => $validated['brand_name'] ?? null,
                'website' => $validated['website'] ?? null,
                'year_founded' => $validated['year_founded'] ?? null,
                'employee_count' => $validated['employee_count'] ?? null,
                'primary_goal' => $validated['primary_goal'],
                'production_capacity' => $validated['production_capacity'] ?? null,
                'distribution_regions' => $validated['distribution_regions'] ?? null,
                'coverage_states' => $validated['coverage_states'] ?? null,
                'installations_per_year' => $validated['installations_per_year'] ?? null,
                'certifications' => $validated['certifications'] ?? null,
                'licenses' => $validated['licenses'] ?? null,
                'address' => $validated['address'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'postal_code' => $validated['postal_code'],
                'country' => $validated['country'],
                'metadata' => [
                    'product_lines_input' => $request->input('product_lines', []),
                    'service_categories_input' => $request->input('service_categories', []),
                ],
            ]);

            if ($validated['company_type'] === 'manufacturer') {
                $productLineIds = ProductLineType::whereIn('slug', $request->input('product_lines', []))->pluck('id');
                $companyProfile->productLineTypes()->sync($productLineIds);
            }

            if ($validated['company_type'] === 'distributor') {
                $serviceTypeIds = ServiceType::whereIn('slug', $request->input('service_categories', []))->pluck('id');
                $companyProfile->serviceTypes()->sync($serviceTypeIds);
            }
        });

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
