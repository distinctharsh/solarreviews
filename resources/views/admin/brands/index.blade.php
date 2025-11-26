@extends('admin.layouts.app')

@section('page_title', 'Brands')

@section('content')
<div class="content-header">
    <div class="content-header-left">
        <h1>Brands</h1>
        <p class="text-muted">Manage product brands (Tata, Luminous, Havells, etc.)</p>
    </div>
    <div class="content-header-right">
        <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Brand
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($brands->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th width="60">#</th>
                        <th width="80">Logo</th>
                        <th>Name</th>
                        <th>Categories</th>
                        <th width="100">Country</th>
                        <th width="80">Order</th>
                        <th width="100">Status</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($brands as $brand)
                        <tr>
                            <td>{{ $brand->id }}</td>
                            <td>
                                @if($brand->logo)
                                    <img src="{{ asset($brand->logo) }}" alt="{{ $brand->name }}" class="table-img">
                                @else
                                    <div class="table-img-placeholder">
                                        <i class="fas fa-building"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $brand->name }}</strong>
                                @if($brand->is_featured)
                                    <span class="badge-featured">Featured</span>
                                @endif
                                @if($brand->website)
                                    <br><a href="{{ $brand->website }}" target="_blank" class="text-muted small">
                                        <i class="fas fa-external-link-alt"></i> Website
                                    </a>
                                @endif
                            </td>
                            <td>
                                @forelse($brand->categories as $category)
                                    <span class="category-tag">{{ $category->name }}</span>
                                @empty
                                    <span class="text-muted">No categories</span>
                                @endforelse
                            </td>
                            <td>{{ $brand->country ?? '-' }}</td>
                            <td>{{ $brand->sort_order }}</td>
                            <td>
                                <form action="{{ route('admin.brands.toggle-status', $brand) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="status-badge {{ $brand->is_active ? 'status-active' : 'status-inactive' }}">
                                        {{ $brand->is_active ? 'Active' : 'Inactive' }}
                                    </button>
                                </form>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-sm btn-info" title="Edit">
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

            <div class="pagination-wrapper">
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

<style>
.table-img {
    width: 50px;
    height: 50px;
    object-fit: contain;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
    background: #fff;
    padding: 4px;
}

.table-img-placeholder {
    width: 50px;
    height: 50px;
    background: #f1f5f9;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #94a3b8;
    font-size: 1.25rem;
}

.badge-featured {
    display: inline-block;
    padding: 0.15rem 0.5rem;
    background: #fef3c7;
    color: #92400e;
    border-radius: 50px;
    font-size: 0.65rem;
    font-weight: 600;
    margin-left: 0.5rem;
    text-transform: uppercase;
}

.category-tag {
    display: inline-block;
    padding: 0.2rem 0.5rem;
    background: #e0f2fe;
    color: #0369a1;
    border-radius: 4px;
    font-size: 0.75rem;
    margin: 0.1rem;
}

.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: all 0.2s;
}

.status-active {
    background: #dcfce7;
    color: #166534;
}

.status-inactive {
    background: #fee2e2;
    color: #991b1b;
}

.status-badge:hover {
    opacity: 0.8;
}

.empty-state {
    text-align: center;
    padding: 3rem;
}

.empty-state i {
    font-size: 4rem;
    color: #cbd5e1;
    margin-bottom: 1rem;
}

.empty-state h3 {
    color: #475569;
    margin-bottom: 0.5rem;
}

.empty-state p {
    color: #94a3b8;
    margin-bottom: 1.5rem;
}
</style>
@endsection
