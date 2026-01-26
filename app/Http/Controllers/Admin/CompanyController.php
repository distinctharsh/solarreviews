<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\State;
use App\Models\City;
use App\Http\Requests\Admin\StoreCompanyRequest;
use App\Http\Requests\Admin\UpdateCompanyRequest;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $query = Company::query();
        
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('owner_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%");
            });
        }
        
        $companies = $query->latest()->paginate(15);
        $totalCompanies = Company::count();
        $activeCompanies = Company::where('status', 'active')->count();
        $installerCount = Company::where('company_type', 'installer')->count();
        
        return view('admin.companies.index', compact(
            'companies',
            'totalCompanies',
            'activeCompanies',
            'installerCount'
        ));
    }

    public function create()
    {
        $companyTypes = $this->companyTypes();
        $states = State::orderBy('name')->get();
        $cities = City::orderBy('name')->get();
        $company = new Company();
        
        return view('admin.companies.create', compact('companyTypes', 'states', 'cities', 'company'));
    }

    public function store(StoreCompanyRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = \Illuminate\Support\Str::slug($data['owner_name'] . ' ' . time());
        // Handle file upload if needed
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $path = 'uploads/companies/';
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Create directory if it doesn't exist
            if (!file_exists(public_path($path))) {
                mkdir(public_path($path), 0777, true);
            }
            
            // Move file to public directory
            $file->move(public_path($path), $filename);
            $data['logo_url'] = $path . $filename;
        }
        $company = Company::create($data);
        
        return redirect()->route('admin.companies.index')
            ->with('success', 'Company created successfully.');
    }

    public function show(Company $company)
    {
        return view('admin.companies.show', compact('company'));
    }

    public function edit(Company $company)
    {
        $companyTypes = $this->companyTypes();
        $states = State::orderBy('name')->get();
        $cities = City::orderBy('name')->get();
        
        return view('admin.companies.edit', compact('company', 'companyTypes', 'states', 'cities'));
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        \Log::info('Update method called', [
            'company_id' => $company->id,
            'request' => $request->all(), 
            'files' => $request->allFiles()
        ]);

        $data = $request->validated();
        \Log::info('Validated data', $data);
        
        // Handle file upload if needed
        if ($request->hasFile('logo')) {
            \Log::info('New logo file uploaded', [
                'originalName' => $request->file('logo')->getClientOriginalName(),
                'mimeType' => $request->file('logo')->getMimeType(),
                'size' => $request->file('logo')->getSize(),
            ]);

            // Create uploads directory if it doesn't exist
            $uploadPath = public_path('uploads/companies');
            if (!file_exists($uploadPath)) {
                \File::makeDirectory($uploadPath, 0755, true);
            }

            // Generate unique filename
            $filename = time() . '_' . $request->file('logo')->getClientOriginalName();
            
            // Move file to public/uploads/companies
            $request->file('logo')->move($uploadPath, $filename);
            
            // Delete old logo if exists
            if ($company->logo_url && file_exists(public_path($company->logo_url))) {
                \File::delete(public_path($company->logo_url));
            }

            // Store relative path
            $data['logo_url'] = 'uploads/companies/' . $filename;
            \Log::info('Logo uploaded to', ['path' => $data['logo_url']]);
        }

        $company->update($data);
        \Log::info('Company updated', ['company_id' => $company->id]);
        
        return redirect()->route('admin.companies.index')
            ->with('success', 'Company updated successfully.');
    }

    public function destroy(Company $company)
    {
        // Delete logo if exists
        if ($company->logo_url && \Storage::exists('public/' . $company->logo_url)) {
            \Storage::delete('public/' . $company->logo_url);
        }
        
        $company->delete();
        
        return redirect()->route('admin.companies.index')
            ->with('success', 'Company deleted successfully.');
    }

    public function updateVerification(Request $request, Company $company)
    {
        $data = $request->validate([
            'is_verified' => 'required|boolean',
        ]);

        $company->update([
            'is_verified' => (bool) $data['is_verified'],
        ]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'company_id' => $company->id,
                'is_verified' => (bool) $company->is_verified,
            ]);
        }

        return redirect()
            ->route('admin.companies.index', $request->query())
            ->with('success', 'Company verification updated successfully.');
    }

    protected function companyTypes(): array
    {
        return [
            'manufacturer' => 'Manufacturer',
            'distributor' => 'Distributor',
            'dealer' => 'Dealer',
            'installer' => 'Installer',
            'wholesaler' => 'Wholesaler',
            'retailer' => 'Retailer',
            'epc' => 'EPC',
        ];
    }
}