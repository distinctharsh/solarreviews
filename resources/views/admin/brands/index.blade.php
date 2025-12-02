@extends('admin.layouts.app')

@section('page_title', 'Brands')

@section('content')
@php
    $totalBrands = $brands->total() ?? $brands->count();
    $logoReady = $brands->filter(fn ($brand) => filled($brand->logo_url))->count();
    $uniqueCountries = $brands->pluck('country')->filter()->unique()->count();
@endphp

<div class="page-hero">
    <div>
        <p class="eyebrow">Master data</p>
        <h1>Brands</h1>
        <p class="hero-copy">Manage product brands, logos, and provenance for solar components.</p>
    </div>
    <div class="hero-actions">
        <a href="{{ route('admin.brands.create') }}" class="btn btn-primary btn-pill">
            <i class="fas fa-plus"></i>
            Add Brand
        </a>
    </div>
</div>

<div class="metrics-grid">
    <article class="metric-card">
        <span class="metric-label">Total brands</span>
        <div class="metric-value">{{ number_format($totalBrands) }}</div>
        <small>{{ $brands->count() }} visible on this page</small>
    </article>
    <article class="metric-card">
        <span class="metric-label">Logos on file</span>
        <div class="metric-value text-success">{{ number_format($logoReady) }}</div>
        <small>Ready for listing cards</small>
    </article>
    <article class="metric-card">
        <span class="metric-label">Countries</span>
        <div class="metric-value">{{ number_format($uniqueCountries) }}</div>
        <small>Represented in catalog</small>
    </article>
</div>

<div class="card surface-card">
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($brands->count() > 0)
            <div class="table-intro">
                <div>
                    <h4>All brands</h4>
                    <p class="text-muted">Includes logos, country of origin, and short descriptions.</p>
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
                            <th width="60">#</th>
                            <th>Logo</th>
                            <th>Name</th>
                            <th>Country</th>
                            <th>Description</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($brands as $brand)
                            <tr>
                                <td>{{ $brand->id }}</td>
                                <td>
                                    @if($brand->logo_url)
                                        <img src="{{ asset($brand->logo_url) }}" alt="{{ $brand->name }}" class="table-img">
                                    @else
                                        <div class="table-img-placeholder">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $brand->name }}</strong>
                                    <div class="text-muted small">{{ $brand->slug }}</div>
                                </td>
                                <td>{{ $brand->country ?? '-' }}</td>
                                <td>{{ Str::limit($brand->description, 60) ?? '-' }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-sm btn-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this brand?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $brands->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-tags"></i>
                <h3>No Brands Found</h3>
                <p>Start by adding your first brand like Tata, Luminous, Havells, etc.</p>
                <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Brand
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
