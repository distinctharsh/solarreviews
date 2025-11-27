<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of brands.
     */
    public function index()
    {
        $brands = Brand::ordered()->paginate(15);
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new brand.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created brand.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:brands,name',
            'description' => 'nullable|string|max:2000',
            'logo_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'country' => 'nullable|string|max:100',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo_url')) {
            $logo = $request->file('logo_url');
            $logoName = Str::slug($validated['name']) . '-' . time() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('uploads/brands'), $logoName);
            $validated['logo_url'] = 'uploads/brands/' . $logoName;
        }

        $validated['slug'] = Str::slug($validated['name']);
        
        Brand::create($validated);

        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand created successfully.');
    }

    /**
     * Display the specified brand.
     */
    public function show(Brand $brand)
    {
        return view('admin.brands.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified brand.
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified brand.
     */
    public function update(Request $request, Brand $brand)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:brands,name,' . $brand->id,
            'description' => 'nullable|string|max:2000',
            'logo_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'country' => 'nullable|string|max:100',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo_url')) {
            // Delete old logo if exists
            if ($brand->logo_url && file_exists(public_path($brand->logo_url))) {
                unlink(public_path($brand->logo_url));
            }
            
            $logo = $request->file('logo_url');
            $logoName = Str::slug($validated['name']) . '-' . time() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('uploads/brands'), $logoName);
            $validated['logo_url'] = 'uploads/brands/' . $logoName;
        }

        // Update slug if name was changed
        if ($request->has('name') && $request->name !== $brand->name) {
            $validated['slug'] = Str::slug($request->name);
        }

        $brand->update($validated);

        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand updated successfully.');
    }

    /**
     * Remove the specified brand.
     */
    public function destroy(Brand $brand)
    {
        // Delete logo if exists
        if ($brand->logo_url && file_exists(public_path($brand->logo_url))) {
            unlink(public_path($brand->logo_url));
        }

        $brand->delete();

        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand deleted successfully.');
    }

    /**
     * Toggle brand active status
     */
    public function toggleStatus(Brand $brand)
    {
        $brand->update(['is_active' => !$brand->is_active]);
        
        return back()->with('success', 'Brand status updated.');
    }
}
