<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\State;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Product::with(['category', 'variants'])
            ->latest()
            ->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        $states = State::where('is_active', true)->get();
        
        return view('admin.products.create', compact('categories', 'states'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*' => 'string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'manufacturer' => 'nullable|string|max:255',
            'model_number' => 'nullable|string|max:100',
            'warranty_years' => 'nullable|numeric|min:0|max:100',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'variants' => 'required|array|min:1',
            'variants.*.state_id' => 'required|exists:states,id',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.sale_price' => 'nullable|numeric|lt:variants.*.price',
            'variants.*.sale_start_date' => 'nullable|date|required_with:variants.*.sale_price',
            'variants.*.sale_end_date' => 'nullable|date|after_or_equal:variants.*.sale_start_date|required_with:variants.*.sale_price',
            'variants.*.stock_quantity' => 'required|integer|min:0',
            'variants.*.sku' => 'nullable|string|max:100|unique:product_variants,sku',
            'variants.*.weight' => 'nullable|numeric|min:0',
            'variants.*.length' => 'nullable|numeric|min:0',
            'variants.*.width' => 'nullable|numeric|min:0',
            'variants.*.height' => 'nullable|numeric|min:0',
        ]);

        try {
            // Handle image upload
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('products', 'public');
                $validated['image'] = $path;
            }

            // Generate slug
            $validated['slug'] = Str::slug($validated['name']);
            
            // Create product
            $product = Product::create($validated);

            // Create variants
            foreach ($request->variants as $variant) {
                $product->variants()->create($variant);
            }

            return redirect()->route('admin.products.index')
                ->with('success', 'Product created successfully.');
                
        } catch (\Exception $e) {
            // Delete uploaded image if there was an error
            if (isset($path) && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
            
            return back()->withInput()
                ->with('error', 'Error creating product: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        $product->load(['category', 'variants.state', 'reviews' => function($query) {
            $query->where('status', 'approved')->latest();
        }]);

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        $product->load('variants');
        $categories = Category::where('is_active', true)->get();
        $states = State::where('is_active', true)->get();
        
        return view('admin.products.edit', compact('product', 'categories', 'states'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*' => 'string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'manufacturer' => 'nullable|string|max:255',
            'model_number' => 'nullable|string|max:100',
            'warranty_years' => 'nullable|numeric|min:0|max:100',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'variants' => 'required|array|min:1',
            'variants.*.id' => 'nullable|exists:product_variants,id,product_id,' . $product->id,
            'variants.*.state_id' => 'required|exists:states,id',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.sale_price' => 'nullable|numeric|lt:variants.*.price',
            'variants.*.sale_start_date' => 'nullable|date|required_with:variants.*.sale_price',
            'variants.*.sale_end_date' => 'nullable|date|after_or_equal:variants.*.sale_start_date|required_with:variants.*.sale_price',
            'variants.*.stock_quantity' => 'required|integer|min:0',
            'variants.*.sku' => [
                'nullable',
                'string',
                'max:100',
                Rule::unique('product_variants', 'sku')
                    ->ignore(optional($request->variants)[0]['id'] ?? 0, 'id')
            ],
            'variants.*.weight' => 'nullable|numeric|min:0',
            'variants.*.length' => 'nullable|numeric|min:0',
            'variants.*.width' => 'nullable|numeric|min:0',
            'variants.*.height' => 'nullable|numeric|min:0',
        ]);

        try {
            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }
                
                $path = $request->file('image')->store('products', 'public');
                $validated['image'] = $path;
            }

            // Generate slug if name changed
            if ($product->name !== $validated['name']) {
                $validated['slug'] = Str::slug($validated['name']);
            }
            
            // Update product
            $product->update($validated);

            // Update or create variants
            $existingVariantIds = [];
            
            foreach ($request->variants as $variantData) {
                if (isset($variantData['id'])) {
                    // Update existing variant
                    $variant = $product->variants()->find($variantData['id']);
                    if ($variant) {
                        $variant->update($variantData);
                        $existingVariantIds[] = $variant->id;
                    }
                } else {
                    // Create new variant
                    $newVariant = $product->variants()->create($variantData);
                    $existingVariantIds[] = $newVariant->id;
                }
            }

            // Delete variants that were removed
            $product->variants()->whereNotIn('id', $existingVariantIds)->delete();

            return redirect()->route('admin.products.index')
                ->with('success', 'Product updated successfully.');
                
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Error updating product: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        try {
            // Delete product image if exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            
            $product->delete();
            
            return redirect()->route('admin.products.index')
                ->with('success', 'Product deleted successfully.');
                
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting product: ' . $e->getMessage());
        }
    }
}
