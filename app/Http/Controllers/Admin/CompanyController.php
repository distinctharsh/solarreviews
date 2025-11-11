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
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean'
        ]);

        try {
            // Generate slug from name
            $validated['slug'] = Str::slug($validated['name']);
            
            // Handle logo upload - Save directly to public directory
            if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
                $file = $request->file('logo');
                $uploadPath = public_path('uploads/company');
                
                // Create directory if it doesn't exist
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
                
                // Generate unique filename
                $fileName = 'company_'.time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
                
                // Move the file to the public directory
                if ($file->move($uploadPath, $fileName)) {
                    // Save the relative path to the database
                    $validated['logo'] = 'uploads/company/'.$fileName;
                } else {
                    throw new \Exception('Failed to move uploaded file');
                }
            }
            
            // Set default values
            $validated['average_rating'] = 0;
            $validated['total_reviews'] = 0;
            $validated['is_active'] = $request->has('is_active');
            
            $company = Company::create($validated);
            
            return redirect()
                ->route('admin.companies.index')
                ->with('success', 'Company created successfully.');
                
        } catch (\Exception $e) {
            \Log::error('Error creating company: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Error creating company: ' . $e->getMessage());
        }
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
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);
        
        try {
            // Handle logo upload - Save directly to public directory
            if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
                $file = $request->file('logo');
                $uploadPath = public_path('uploads/company');
                
                // Create directory if it doesn't exist
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
                
                // Delete old logo if exists
                if ($company->logo && file_exists(public_path($company->logo))) {
                    unlink(public_path($company->logo));
                }
                
                // Generate unique filename
                $fileName = 'company_'.time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
                
                // Move the file to the public directory
                if ($file->move($uploadPath, $fileName)) {
                    // Save the relative path to the database
                    $validated['logo'] = 'uploads/company/'.$fileName;
                } else {
                    throw new \Exception('Failed to move uploaded file');
                }
            }
            
            // Update company
            $company->update($validated);
            
            return redirect()
                ->route('admin.companies.index')
                ->with('success', 'Company updated successfully.');
                
        } catch (\Exception $e) {
            \Log::error('Error updating company: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Error updating company: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified company from storage.
     */
    public function destroy(Company $company)
    {
        // Delete logo if exists
        if ($company->logo && file_exists(public_path($company->logo))) {
            unlink(public_path($company->logo));
        }
        
        $company->delete();
        
        return redirect()
            ->route('admin.companies.index')
            ->with('success', 'Company deleted successfully.');
    }
}
