<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
{
    /**
     * Display a listing of the companies.
     */
    public function index()
    {
        $companies = Company::with('state')
            ->orderBy('name')
            ->paginate(20);
            
        return view('admin.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new company.
     */
    public function create()
    {
        $states = State::where('is_active', true)
            ->orderBy('name')
            ->get();
            
        return view('admin.companies.form', [
            'company' => new Company(),
            'states' => $states,
            'title' => 'Add New Company',
            'buttonText' => 'Create Company',
            'route' => route('admin.companies.store'),
            'method' => 'POST'
        ]);
    }

    /**
     * Store a newly created company in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'state_id' => 'required|exists:states,id',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
            'is_active' => 'boolean'
        ]);

        // Generate slug from name
        $validated['slug'] = Str::slug($validated['name']);
        
        // Handle logo upload
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('public/company-logos');
            $validated['logo'] = str_replace('public/', '', $path);
        }
        
        // Set default values
        $validated['average_rating'] = 0;
        $validated['total_reviews'] = 0;
        $validated['is_active'] = $request->has('is_active');
        
        $company = Company::create($validated);
        
        return redirect()
            ->route('admin.companies.index')
            ->with('success', 'Company created successfully.');
    }

    /**
     * Show the form for editing the specified company.
     */
    public function edit(Company $company)
    {
        $states = State::where('is_active', true)
            ->orderBy('name')
            ->get();
            
        return view('admin.companies.form', [
            'company' => $company,
            'states' => $states,
            'title' => 'Edit Company',
            'buttonText' => 'Update Company',
            'route' => route('admin.companies.update', $company),
            'method' => 'PUT'
        ]);
    }

    /**
     * Update the specified company in storage.
     */
    public function update(Request $request, Company $company)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'state_id' => 'required|exists:states,id',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);
        
        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($company->logo) {
                Storage::delete('public/' . $company->logo);
            }
            
            $path = $request->file('logo')->store('public/company-logos');
            $validated['logo'] = str_replace('public/', '', $path);
        }
        
        $validated['is_active'] = $request->has('is_active');
        $company->update($validated);
        
        return redirect()
            ->route('admin.companies.index')
            ->with('success', 'Company updated successfully.');
    }

    /**
     * Remove the specified company from storage.
     */
    public function destroy(Company $company)
    {
        // Delete logo if exists
        if ($company->logo) {
            Storage::delete('public/' . $company->logo);
        }
        
        $company->delete();
        
        return redirect()
            ->route('admin.companies.index')
            ->with('success', 'Company deleted successfully.');
    }
}
