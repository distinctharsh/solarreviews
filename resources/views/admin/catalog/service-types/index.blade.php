@extends('admin.layouts.app')

@section('page_title', 'Service Types')

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

    .btn-primary {
        background: #14b8a6;
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
        color: #0f172a;
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
        <h1>Service types</h1>
        <a href="{{ route('admin.catalog.service-types.create') }}" class="btn-primary">+ Add Service</a>
    </div>

    @if($services->isEmpty())
        <p class="text-slate-500">No service types yet.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Group</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                    <tr>
                        <td>{{ $service->name }}</td>
                        <td><code>{{ $service->slug }}</code></td>
                        <td>{{ $service->service_group ?? '—' }}</td>
                        <td>{{ $service->description ?? '—' }}</td>
                        <td>
                            <span class="status-pill {{ $service->is_active ? 'active' : 'inactive' }}">
                                {{ $service->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="actions">
                            <a href="{{ route('admin.catalog.service-types.edit', $service) }}">Edit</a>
                            <form method="POST" action="{{ route('admin.catalog.service-types.destroy', $service) }}" onsubmit="return confirm('Delete this service type?');">
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
            {{ $services->links() }}
        </div>
    @endif
</div>
@endsection
