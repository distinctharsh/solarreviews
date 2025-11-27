<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class BrandCategoryController extends Controller
{
    /**
     * Show the form for managing brand categories
     */
    public function index()
    {
        $brands = Brand::with('categories')->orderBy('name')->get();
        $categories = Category::where('status', 'active')->orderBy('name')->get();
        
        return view('admin.brand-categories.index', compact('brands', 'categories'));
    }

    /**
     * Update the specified brand's categories
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $brand->categories()->sync($request->categories ?? []);

        return redirect()->route('admin.brand-categories.index')
            ->with('success', 'Brand categories updated successfully.');
    }

    /**
     * Get categories for a specific brand (for AJAX requests)
     */
    public function getBrandCategories(Brand $brand)
    {
        return response()->json([
            'categories' => $brand->categories->pluck('id')->toArray()
        ]);
    }
}
