<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\State;
use App\Models\City;
use App\Http\Requests\Admin\StoreCompanyRequest;
use App\Http\Requests\Admin\UpdateCompanyRequest;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::latest()->paginate(15);
        return view('admin.companies.index', compact('companies'));
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
            $path = $request->file('logo')->store('companies', 'public');
            $data['logo_url'] = '/storage/' . $path;
        }
        
        Company::create($data);
        
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
        $data = $request->validated();
        
        // Handle file upload if needed
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($company->logo_url && \Storage::exists('public/' . $company->logo_url)) {
                \Storage::delete('public/' . $company->logo_url);
            }
            
            $path = $request->file('logo')->store('companies', 'public');
            $data['logo_url'] = '/storage/' . $path;
        }
        
        $company->update($data);
        
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