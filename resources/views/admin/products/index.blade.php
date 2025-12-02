{{-- resources/views/admin/products/index.blade.php --}}
@extends('admin.layouts.app')

@section('page_title', 'Products')

@section('content')
@php
    $totalProducts = $products->total() ?? $products->count();
    $capacityCount = $products->filter(fn ($product) => filled($product->capacity_kw))->count();
    $categoryCoverage = $products->pluck('category.name')->filter()->unique()->count();
@endphp

<div class="page-hero">
    <div>
        <p class="eyebrow">Master data</p>
        <h1>Products</h1>
        <p class="hero-copy">Manage solar hardware models, specs, and brand/category alignment.</p>
    </div>
    <div class="hero-actions">
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-pill">
            <i class="fas fa-plus"></i>
            Add Product
        </a>
    </div>
</div>

<div class="metrics-grid">
    <article class="metric-card">
        <span class="metric-label">Total products</span>
        <div class="metric-value">{{ number_format($totalProducts) }}</div>
        <small>{{ $products->count() }} shown here</small>
    </article>
    <article class="metric-card">
        <span class="metric-label">Capacity filled</span>
        <div class="metric-value text-success">{{ number_format($capacityCount) }}</div>
        <small>Have kW data</small>
    </article>
    <article class="metric-card">
        <span class="metric-label">Categories covered</span>
        <div class="metric-value">{{ number_format($categoryCoverage) }}</div>
        <small>Unique category assignments</small>
    </article>
</div>

<div class="card surface-card">
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-intro">
            <div>
                <h4>All products</h4>
                <p class="text-muted">Model, brand, and category data for every product record.</p>
            </div>
            <div class="table-actions">
                <div class="input-chip">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search (coming soon)" disabled>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table modern-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Category</th>
                        <th>Model</th>
                        <th>Type</th>
                        <th>Capacity (kW)</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>
                                <strong>{{ $product->product_name }}</strong>
                                <div class="text-muted small">Slug: {{ $product->slug }}</div>
                            </td>
                            <td>{{ $product->brand->name ?? 'N/A' }}</td>
                            <td>{{ $product->category->name ?? 'N/A' }}</td>
                            <td>{{ $product->model_name }}</td>
                            <td>{{ $product->type ?? '-' }}</td>
                            <td>{{ $product->capacity_kw ? $product->capacity_kw . ' kW' : '-' }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                       class="btn btn-sm btn-primary"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this product?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection