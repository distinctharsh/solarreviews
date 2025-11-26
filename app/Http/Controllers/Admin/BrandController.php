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
        $brands = Brand::with('categories')
                       ->ordered()
                       ->paginate(15);
                       
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new brand.
     */
    public function create()
    {
        $categories = Category::active()->ordered()->get();
        return view('admin.brands.create', compact('categories'));
    }

    /**
     * Store a newly created brand.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:brands,name',
            'description' => 'nullable|string|max:2000',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'website' => 'nullable|url|max:255',
            'country' => 'nullable|string|max:100',
            'established_year' => 'nullable|integer|min:1800|max:' . date('Y'),
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = Str::slug($validated['name']) . '-' . time() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('uploads/brands'), $logoName);
            $validated['logo'] = 'uploads/brands/' . $logoName;
        }

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');
        $validated['is_featured'] = $request->has('is_featured');

        $brand = Brand::create($validated);

        // Sync categories
        if ($request->has('categories')) {
            $brand->categories()->sync($request->categories);
        }

        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand created successfully.');
    }

    /**
     * Display the specified brand.
     */
    public function show(Brand $brand)
    {
        $brand->load('categories');
        return view('admin.brands.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified brand.
     */
    public function edit(Brand $brand)
    {
        $categories = Category::active()->ordered()->get();
        $brand->load('categories');
        return view('admin.brands.edit', compact('brand', 'categories'));
    }

    /**
     * Update the specified brand.
     */
    public function update(Request $request, Brand $brand)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:brands,name,' . $brand->id,
            'description' => 'nullable|string|max:2000',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'website' => 'nullable|url|max:255',
            'country' => 'nullable|string|max:100',
            'established_year' => 'nullable|integer|min:1800|max:' . date('Y'),
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($brand->logo && file_exists(public_path($brand->logo))) {
                unlink(public_path($brand->logo));
            }
            
            $logo = $request->file('logo');
            $logoName = Str::slug($validated['name']) . '-' . time() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('uploads/brands'), $logoName);
            $validated['logo'] = 'uploads/brands/' . $logoName;
        }

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');
        $validated['is_featured'] = $request->has('is_featured');

        $brand->update($validated);

        // Sync categories
        $brand->categories()->sync($request->categories ?? []);

        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand updated successfully.');
    }

    /**
     * Remove the specified brand.
     */
    public function destroy(Brand $brand)
    {
        // Delete logo if exists
        if ($brand->logo && file_exists(public_path($brand->logo))) {
            unlink(public_path($brand->logo));
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
