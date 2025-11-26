<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\City;
use App\Models\Company;
use App\Models\State;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CompanyController extends Controller
{
    /**
     * List companies.
     */
    public function index(): View
    {
        $companies = Company::with(['state', 'city', 'categories', 'brands'])
            ->latest()
            ->paginate(15);

        return view('admin.companies.index', compact('companies'));
    }

    /**
     * Show create form.
     */
    public function create(): View
    {
        return view('admin.companies.create', $this->formDependencies(new Company()));
    }

    /**
     * Store a company.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatedData($request);

        if ($logoPath = $this->handleLogoUpload($request, $validated['name'])) {
            $validated['logo'] = $logoPath;
        }

        DB::transaction(function () use (&$company, $validated, $request) {
            $company = Company::create($validated);
            $company->categories()->sync($request->input('category_ids', []));
            $company->brands()->sync($request->input('brand_ids', []));
        });

        return redirect()->route('admin.companies.index')
            ->with('success', 'Company created successfully.');
    }

    /**
     * Show edit form.
     */
    public function edit(Company $company): View
    {
        $company->load(['categories', 'brands']);

        return view('admin.companies.edit', $this->formDependencies($company));
    }

    /**
     * Update company.
     */
    public function update(Request $request, Company $company): RedirectResponse
    {
        $validated = $this->validatedData($request, $company);

        if ($logoPath = $this->handleLogoUpload($request, $validated['name'], $company)) {
            $validated['logo'] = $logoPath;
        }

        DB::transaction(function () use ($company, $validated, $request) {
            $company->update($validated);
            $company->categories()->sync($request->input('category_ids', []));
            $company->brands()->sync($request->input('brand_ids', []));
        });

        return redirect()->route('admin.companies.index')
            ->with('success', 'Company updated successfully.');
    }

    /**
     * Delete company.
     */
    public function destroy(Company $company): RedirectResponse
    {
        if ($company->logo && file_exists(public_path($company->logo))) {
            @unlink(public_path($company->logo));
        }

        $company->categories()->detach();
        $company->brands()->detach();
        $company->delete();

        return redirect()->route('admin.companies.index')
            ->with('success', 'Company deleted successfully.');
    }

    /**
     * Toggle active status.
     */
    public function toggleStatus(Company $company): RedirectResponse
    {
        $company->update(['is_active' => ! $company->is_active]);

        return back()->with('success', 'Company status updated.');
    }

    /**
     * Collect shared form data.
     */
    private function formDependencies(Company $company): array
    {
        return [
            'company' => $company,
            'states' => State::orderBy('name')->get(),
            'cities' => City::orderBy('name')->get(),
            'categories' => Category::active()->ordered()->get(),
            'brands' => Brand::active()->ordered()->get(),
            'companyTypes' => Company::getTypeOptions(),
        ];
    }

    /**
     * Validate request payload.
     */
    private function validatedData(Request $request, ?Company $company = null): array
    {
        $typeOptions = array_keys(Company::getTypeOptions());

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'company_type' => ['required', Rule::in($typeOptions)],
            'about' => 'nullable|string',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'nullable|exists:cities,id',
            'address_line1' => 'nullable|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'service_area' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'phone' => 'nullable|string|max:32',
            'email' => 'nullable|email|max:255',
            'years_in_business' => 'nullable|integer|min:1900|max:' . date('Y'),
            'gst_number' => 'nullable|string|max:64',
            'certifications' => 'nullable|string|max:255',
            'licenses' => 'nullable|string|max:255',
            'coverage_states' => 'nullable|string|max:255',
            'installations_per_year' => 'nullable|integer|min:0',
            'production_capacity' => 'nullable|string|max:255',
            'distribution_regions' => 'nullable|string|max:255',
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'exists:categories,id',
            'brand_ids' => 'nullable|array',
            'brand_ids.*' => 'exists:brands,id',
            'is_active' => 'sometimes|boolean',
            'is_featured' => 'sometimes|boolean',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['is_featured'] = $request->boolean('is_featured');

        return $validated;
    }

    /**
     * Handle logo upload/delete.
     */
    private function handleLogoUpload(Request $request, string $name, ?Company $company = null): ?string
    {
        if (! $request->hasFile('logo')) {
            return null;
        }

        $directory = public_path('uploads/companies');
        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        if ($company && $company->logo && file_exists(public_path($company->logo))) {
            @unlink(public_path($company->logo));
        }

        $file = $request->file('logo');
        $filename = Str::slug($name) . '-' . time() . '.' . $file->getClientOriginalExtension();
        $file->move($directory, $filename);

        return 'uploads/companies/' . $filename;
    }
}
