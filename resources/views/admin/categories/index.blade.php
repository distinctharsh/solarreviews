@extends('admin.layouts.app')

@section('page_title', 'Categories')

@section('content')
@php
    $totalCategories = $categories->total() ?? $categories->count();
    $activeCount = $categories->filter(fn ($cat) => $cat->is_active)->count();
    $inactiveCount = $categories->filter(fn ($cat) => ! $cat->is_active)->count();
@endphp

<div class="page-hero">
    <div>
        <p class="eyebrow">Master data</p>
        <h1>Categories</h1>
        <p class="hero-copy">Manage product categories (Inverter, Panel, Battery, EPC) and keep your catalog tidy.</p>
    </div>
    <div class="hero-actions">
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-pill">
            <i class="fas fa-plus"></i>
            Add Category
        </a>
    </div>
</div>

<div class="metrics-grid">
    <article class="metric-card">
        <span class="metric-label">Total categories</span>
        <div class="metric-value">{{ number_format($totalCategories) }}</div>
        <small>{{ $categories->count() }} on this page</small>
    </article>
    <article class="metric-card">
        <span class="metric-label">Active</span>
        <div class="metric-value text-success">{{ number_format($activeCount) }}</div>
        <small>Ready for selection</small>
    </article>
    <article class="metric-card">
        <span class="metric-label">Inactive</span>
        <div class="metric-value text-danger">{{ number_format($inactiveCount) }}</div>
        <small>Hidden from public pages</small>
    </article>
</div>

<div class="card surface-card">
    <div class="card-body">
        @if($categories->count() > 0)
            <div class="table-intro">
                <div>
                    <h4>All categories</h4>
                    <p class="text-muted">Ordered by priority, includes hero image preview.</p>
                </div>
                <div class="table-actions">
                    <div class="input-chip">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search (coming soon)" disabled>
                    </div>
                </div>
            </div>

            <table class="table modern-table">
                <thead>
                    <tr>
                        <th width="60">#</th>
                        <th width="80">Image</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th width="100">Order</th>
                        <th width="100">Status</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>
                                @if($category->image)
                                    <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="table-img">
                                @else
                                    <div class="table-img-placeholder">
                                        <i class="fas fa-layer-group"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $category->name }}</strong>
                                @if($category->description)
                                    <br><small class="text-muted">{{ Str::limit($category->description, 50) }}</small>
                                @endif
                            </td>
                            <td><code>{{ $category->slug }}</code></td>
                            <td>{{ $category->sort_order }}</td>
                            <td>
                                <form action="{{ route('admin.categories.toggle-status', $category) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="status-badge {{ $category->is_active ? 'status-active' : 'status-inactive' }}">
                                        {{ $category->is_active ? 'Active' : 'Inactive' }}
                                    </button>
                                </form>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-info" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this category?')">
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

            <div class="pagination-wrapper">
                {{ $categories->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-layer-group"></i>
                <h3>No Categories Found</h3>
                <p>Start by adding your first category.</p>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Category
                </a>
            </div>
        @endif
    </div>
</div>

<style>
.page-hero {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1.5rem;
    padding: 1.8rem;
    border-radius: 24px;
    background: linear-gradient(135deg, #0f172a, #1d4ed8);
    color: #fff;
    margin-bottom: 1.75rem;
    box-shadow: 0 20px 45px rgba(15, 23, 42, 0.25);
}

.page-hero h1 {
    font-size: 2rem;
    margin-bottom: 0.35rem;
}

.page-hero .hero-copy {
    color: rgba(255, 255, 255, 0.8);
}

.eyebrow {
    text-transform: uppercase;
    letter-spacing: 0.15em;
    font-size: 0.75rem;
    color: rgba(255, 255, 255, 0.7);
    margin-bottom: 0.45rem;
}

.hero-actions {
    display: flex;
    align-items: center;
    gap: 0.8rem;
}

.btn-pill {
    border-radius: 999px;
    padding: 0.85rem 1.6rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.metrics-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.metric-card {
    background: #fff;
    padding: 1.25rem;
    border-radius: 18px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 15px 35px rgba(15, 23, 42, 0.08);
}

.metric-label {
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: #94a3b8;
}

.metric-value {
    font-size: 1.8rem;
    font-weight: 700;
    color: #111827;
    margin: 0.35rem 0;
}

.surface-card {
    border-radius: 24px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 25px 60px rgba(15, 23, 42, 0.08);
}

.table-intro {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 1.5rem;
    margin-bottom: 1.25rem;
}

.table-intro h4 {
    margin-bottom: 0.2rem;
}

.table-actions {
    display: flex;
    gap: 1rem;
}

.input-chip {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.6rem 1rem;
    border-radius: 999px;
    border: 1px solid #e2e8f0;
    background: #f8fafc;
    color: #94a3b8;
}

.input-chip input {
    border: none;
    background: transparent;
    outline: none;
    font-size: 0.9rem;
    color: #94a3b8;
}

.modern-table thead th {
    background: #f8fafc;
    border-bottom: none;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    font-size: 0.7rem;
    color: #94a3b8;
}

.modern-table tbody tr {
    border-radius: 18px;
    overflow: hidden;
}

.modern-table tbody td {
    vertical-align: middle;
}

.table-img {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 8px 20px rgba(15, 23, 42, 0.12);
}

.table-img-placeholder {
    width: 50px;
    height: 50px;
    background: #f8fafc;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #94a3b8;
    font-size: 1.1rem;
    border: 1px dashed #cbd5f5;
}

.status-badge {
    padding: 0.3rem 0.9rem;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: transform 0.2s;
}

.status-badge:hover {
    transform: translateY(-1px);
}

.status-active {
    background: #dcfce7;
    color: #0f5132;
}

.status-inactive {
    background: #fee2e2;
    color: #b91c1c;
}

.empty-state {
    text-align: center;
    padding: 4rem 2rem;
}

.empty-state i {
    font-size: 4rem;
    color: #cbd5e1;
    margin-bottom: 1rem;
}

.empty-state h3 {
    color: #1e293b;
}

.empty-state p {
    color: #94a3b8;
    margin-bottom: 1.5rem;
}

@media (max-width: 768px) {
    .page-hero {
        flex-direction: column;
        align-items: flex-start;
    }

    .table-intro {
        flex-direction: column;
    }

    .table-actions {
        width: 100%;
    }

    .input-chip {
        width: 100%;
    }
}
</style>
@endsection

