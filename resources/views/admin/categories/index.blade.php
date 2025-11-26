@extends('admin.layouts.app')

@section('page_title', 'Categories')

@section('content')
<div class="content-header">
    <div class="content-header-left">
        <h1>Categories</h1>
        <p class="text-muted">Manage product categories (Inverter, Panel, Battery, EPC)</p>
    </div>
    <div class="content-header-right">
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Category
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($categories->count() > 0)
            <table class="table">
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
.table-img {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
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

