<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index(): View
    {
        $products = Product::with(['company', 'brand', 'category'])
            ->latest()
            ->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create(): View
    {
        return view('admin.products.create', $this->formDependencies(new Product()));
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatedData($request);

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product): View
    {
        return view('admin.products.edit', $this->formDependencies($product));
    }

    /**
     * Update the specified product.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $this->validatedData($request, $product);

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }

    /**
     * Toggle product active status.
     */
    public function toggleStatus(Product $product): RedirectResponse
    {
        $product->update(['is_active' => ! $product->is_active]);

        return back()->with('success', 'Product status updated.');
    }

    /**
     * Shared data for forms.
     */
    private function formDependencies(Product $product): array
    {
        return [
            'product' => $product,
            'companies' => Company::orderBy('name')->get(),
            'brands' => Brand::active()->ordered()->get(),
            'categories' => Category::active()->ordered()->get(),
        ];
    }

    /**
     * Validate request input.
     */
    private function validatedData(Request $request, ?Product $product = null): array
    {
        $validated = $request->validate([
            'company_id' => ['required', 'exists:companies,id'],
            'brand_id' => ['nullable', 'exists:brands,id'],
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'model_number' => ['nullable', 'string', 'max:255'],
            'variant' => ['nullable', 'string', 'max:255'],
            'wattage_or_capacity' => ['nullable', 'string', 'max:255'],
            'technology' => ['nullable', 'string', 'max:255'],
            'efficiency' => ['nullable', 'numeric', 'between:0,100'],
            'warranty_years' => ['nullable', 'integer', 'between:0,50'],
            'datasheet_url' => ['nullable', 'url', 'max:255'],
            'msrp' => ['nullable', 'numeric', 'min:0'],
            'specs' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['efficiency'] = $validated['efficiency'] ?? null;
        $validated['msrp'] = $validated['msrp'] ?? null;
        $validated['is_active'] = $request->boolean('is_active', true);

        if (! empty($validated['specs'])) {
            $validated['specs'] = array_filter(array_map('trim', explode("\n", $validated['specs'])));
        } else {
            $validated['specs'] = null;
        }

        return $validated;
    }
}
