<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductLineType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductLineTypeController extends Controller
{
    public function index(): View
    {
        $lines = ProductLineType::orderBy('name')->paginate(20)->withQueryString();

        return view('admin.catalog.product-line-types.index', compact('lines'));
    }

    public function create(): View
    {
        return view('admin.catalog.product-line-types.form', [
            'line' => new ProductLineType(),
            'title' => 'Add Product Line Type',
            'route' => route('admin.catalog.product-line-types.store'),
            'method' => 'POST',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);
        ProductLineType::create($data);

        return redirect()
            ->route('admin.catalog.product-line-types.index')
            ->with('success', 'Product line type created successfully.');
    }

    public function edit(ProductLineType $productLineType): View
    {
        return view('admin.catalog.product-line-types.form', [
            'line' => $productLineType,
            'title' => 'Edit Product Line Type',
            'route' => route('admin.catalog.product-line-types.update', $productLineType),
            'method' => 'PUT',
        ]);
    }

    public function update(Request $request, ProductLineType $productLineType): RedirectResponse
    {
        $data = $this->validateData($request, $productLineType->id);
        $productLineType->update($data);

        return redirect()
            ->route('admin.catalog.product-line-types.index')
            ->with('success', 'Product line type updated.');
    }

    public function destroy(ProductLineType $productLineType): RedirectResponse
    {
        $productLineType->delete();

        return redirect()
            ->route('admin.catalog.product-line-types.index')
            ->with('success', 'Product line type deleted.');
    }

    private function validateData(Request $request, ?int $id = null): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:product_line_types,slug'.($id ? ','.$id : '')],
            'description' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $data['slug'] = Str::slug($data['slug'] ?? $data['name']);
        $data['is_active'] = $request->boolean('is_active', true);

        return $data;
    }
}
