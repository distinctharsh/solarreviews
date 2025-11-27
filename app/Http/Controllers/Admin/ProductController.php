<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use App\Models\ProductSpec;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index(): View
    {
        $products = Product::with(['brand', 'category'])
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
    public function store(Request $request)
    {
        $validated = $this->validatedData($request);
        $validated['slug'] = Str::slug($validated['product_name']);

        $product = Product::create($validated);
        
        // Save specs
        $this->saveProductSpecs($product, $request->input('specs', []));

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
    public function update(Request $request, Product $product)
    {
        $validated = $this->validatedData($request, $product);
        
        if ($request->has('product_name') && $product->product_name !== $request->product_name) {
            $validated['slug'] = Str::slug($validated['product_name']);
        }

        $product->update($validated);
        
        // Delete existing specs and save new ones
        $product->specs()->delete();
        $this->saveProductSpecs($product, $request->input('specs', []));

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }


    private function saveProductSpecs(Product $product, array $specs)
    {
        $specsData = [];
        $specNames = $request->input('spec_name', []);
        $specValues = $request->input('spec_value', []);
        
        foreach ($specNames as $index => $name) {
            if (!empty($name) && isset($specValues[$index])) {
                $specsData[] = [
                    'spec_name' => $name,
                    'spec_value' => $specValues[$index],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        
        $product->specs()->createMany($specsData);
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
     * Shared data for forms.
     */
    private function formDependencies(Product $product): array
    {
        return [
            'product' => $product,
            'brands' => Brand::orderBy('name')->get(),
            'categories' => Category::orderBy('name')->get(),
            'types' => [
                'Solar Panel',
                'Inverter',
                'Battery',
                'Mounting System',
                'Charge Controller',
                'Monitoring System',
                'Other'
            ]
        ];
    }

    /**
     * Validate request input.
     */
    private function validatedData(Request $request, ?Product $product = null): array
    {
        $rules = [
            'brand_id' => ['required', 'exists:brands,id'],
            'category_id' => ['required', 'exists:categories,id'],
            'product_name' => ['required', 'string', 'max:255'],
            'model_name' => ['required', 'string', 'max:255'],
            'type' => ['nullable', 'string', 'max:255'],
            'capacity_kw' => ['nullable', 'numeric', 'min:0'],
            'size' => ['nullable', 'string', 'max:255'],
            'warranty' => ['nullable', 'string', 'max:255'],
            'specs' => ['nullable', 'array'],
            'specs.*.name' => ['required_with:specs', 'string', 'max:255'],
            'specs.*.value' => ['required_with:specs.*.name', 'string'],
        ];

        if ($request->isMethod('post')) {
            $rules['product_name'][] = Rule::unique('products', 'product_name');
        } else {
            $rules['product_name'][] = Rule::unique('products', 'product_name')->ignore($product->id);
        }

        return $request->validate($rules);
    }
}