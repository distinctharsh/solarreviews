@extends('admin.layouts.app')

@section('page_title', 'Product Line Types')

@push('styles')
<style>
    .catalog-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
        border: 1px solid #e2e8f0;
        padding: 20px;
    }

    .catalog-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .catalog-header h1 {
        margin: 0;
        font-size: 22px;
        color: #0f172a;
    }

    .btn-primary {
        background: #2563eb;
        color: #fff;
        padding: 10px 16px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 12px;
        border-bottom: 1px solid #e2e8f0;
        text-align: left;
        font-size: 14px;
    }

    th {
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.05em;
        color: #94a3b8;
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        padding: 4px 10px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-pill.active {
        background: #dcfce7;
        color: #15803d;
    }

    .status-pill.inactive {
        background: #fee2e2;
        color: #b91c1c;
    }

    .actions {
        display: flex;
        gap: 10px;
    }

    .actions a,
    .actions button {
        text-decoration: none;
        color: #2563eb;
        font-weight: 600;
        background: none;
        border: none;
        cursor: pointer;
    }
</style>
@endpush

@section('content')
<div class="catalog-card">
    <div class="catalog-header">
        <h1>Product line types</h1>
        <a href="{{ route('admin.catalog.product-line-types.create') }}" class="btn-primary">
            + Add Product Line
        </a>
    </div>

    @if($lines->isEmpty())
        <p class="text-slate-500">No product lines yet.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($lines as $line)
                    <tr>
                        <td>{{ $line->name }}</td>
                        <td><code>{{ $line->slug }}</code></td>
                        <td>{{ $line->description ?? '—' }}</td>
                        <td>
                            <span class="status-pill {{ $line->is_active ? 'active' : 'inactive' }}">
                                {{ $line->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="actions">
                            <a href="{{ route('admin.catalog.product-line-types.edit', $line) }}">Edit</a>
                            <form method="POST" action="{{ route('admin.catalog.product-line-types.destroy', $line) }}" onsubmit="return confirm('Delete this product line?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top:16px;">
            {{ $lines->links() }}
        </div>
    @endif
</div>
@endsection
