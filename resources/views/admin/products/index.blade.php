@extends('admin.layouts.app')

@section('page_title', 'Products')

@section('content')
<div class="content-header">
    <div class="content-header-left">
        <h1>Products</h1>
        <p class="text-muted">Manage products for each company.</p>
    </div>
    <div class="content-header-right">
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Product
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body table-responsive">
        @if($products->count())
            <table class="table">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th>Name</th>
                        <th width="180">Company / Brand</th>
                        <th width="120">Category</th>
                        <th width="120">Price</th>
                        <th width="110">Status</th>
                        <th width="160">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                <div class="product-info">
                                    <div>
                                        <strong>{{ $product->name }}</strong>
                                        <div class="text-muted small">Model: {{ $product->model_number ?: '—' }}</div>
                                        <div class="text-muted small">
                                            {{ $product->wattage_or_capacity ?: $product->technology ?: 'No specs' }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="text-sm text-gray-800">
                                    {{ $product->company->name ?? '—' }}
                                </div>
                                <div class="text-muted small">
                                    {{ $product->brand->name ?? 'Unbranded' }}
                                </div>
                            </td>
                            <td>{{ $product->category->name ?? '—' }}</td>
                            <td>
                                @if($product->msrp)
                                    ₹{{ number_format($product->msrp, 2) }}
                                @else
                                    —
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.products.toggle-status', $product) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="status-badge {{ $product->is_active ? 'status-active' : 'status-inactive' }}">
                                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                                    </button>
                                </form>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-info" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this product?')">
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
                {{ $products->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-box"></i>
                <h3>No products found</h3>
                <p>Add your first product so it appears on company profiles.</p>
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Product
                </a>
            </div>
        @endif
    </div>
</div>

<style>
.product-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 999px;
    font-size: 0.75rem;
    border: none;
    cursor: pointer;
}

.status-active {
    background: #dcfce7;
    color: #166534;
}

.status-inactive {
    background: #fee2e2;
    color: #991b1b;
}

.action-buttons {
    display: flex;
    gap: 0.35rem;
}

.empty-state {
    text-align: center;
    padding: 3rem;
}

.empty-state i {
    font-size: 3.5rem;
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
