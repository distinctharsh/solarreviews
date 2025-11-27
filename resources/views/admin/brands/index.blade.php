@extends('admin.layouts.app')

@section('page_title', 'Brands')

@section('content')
<div class="content-header">
    <div class="content-header-left">
        <h1>Brands</h1>
        <p class="text-muted">Manage product brands</p>
    </div>
    <div class="content-header-right">
        <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Brand
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($brands->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
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
                                <td>{{ Str::limit($brand->description, 50) ?? '-' }}</td>
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

.btn-group {
    display: flex;
    gap: 0.5rem;
}

.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
    line-height: 1.5;
    border-radius: 0.2rem;
}

.status-badge {
    font-size: 0.75rem;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: all 0.2s;
    padding: 0.25rem 0.75rem;
    border-radius: 50px;
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
