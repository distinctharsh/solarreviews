@extends('admin.layouts.app')

@section('page_title', 'Companies')

@section('content')
<div class="content-header">
    <div class="content-header-left">
        <h1>Companies</h1>
        <p class="text-muted">Manage registered distributors and manufacturers.</p>
    </div>
    <div class="content-header-right">
        <a href="{{ route('admin.companies.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Company
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body table-responsive">
        @if($companies->count())
            <table class="table">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th>Company</th>
                        <th width="130">Type</th>
                        <th width="180">Location</th>
                        <th>Categories</th>
                        <th width="110">Status</th>
                        <th width="160">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($companies as $company)
                        <tr>
                            <td>{{ $company->id }}</td>
                            <td>
                                <div class="company-info">
                                    <div class="company-logo">
                                        @if($company->logo_url)
                                            <img src="{{ $company->logo_url }}" alt="{{ $company->name }} logo">
                                        @else
                                            <span>{{ strtoupper(Str::substr($company->name, 0, 2)) }}</span>
                                        @endif
                                    </div>
                                    <div>
                                        <strong>{{ $company->name }}</strong>
                                        <div class="text-muted small">
                                            {{ $company->website ?: '—' }}
                                        </div>
                                        <div class="text-muted small">
                                            Rating: {{ number_format($company->average_rating, 1) }} · Reviews: {{ $company->total_reviews }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-soft">
                                    {{ Str::headline($company->company_type) }}
                                </span>
                            </td>
                            <td>
                                {{ $company->city->name ?? '—' }}, {{ $company->state->name ?? '—' }}
                            </td>
                            <td>
                                @forelse($company->categories as $category)
                                    <span class="category-tag">{{ $category->name }}</span>
                                @empty
                                    <span class="text-muted">No categories</span>
                                @endforelse
                            </td>
                            <td>
                                <form action="{{ route('admin.companies.toggle-status', $company) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="status-badge {{ $company->is_active ? 'status-active' : 'status-inactive' }}">
                                        {{ $company->is_active ? 'Active' : 'Inactive' }}
                                    </button>
                                </form>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.companies.edit', $company) }}" class="btn btn-sm btn-info" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.companies.destroy', $company) }}" method="POST" onsubmit="return confirm('Delete this company?')" style="display:inline;">
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
                {{ $companies->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-building"></i>
                <h3>No companies found</h3>
                <p>Start by adding your first distributor or manufacturer.</p>
                <a href="{{ route('admin.companies.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Company
                </a>
            </div>
        @endif
    </div>
</div>

<style>
.company-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.company-logo {
    width: 46px;
    height: 46px;
    border-radius: 10px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    color: #475569;
    text-transform: uppercase;
    overflow: hidden;
}

.company-logo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.badge-soft {
    display: inline-block;
    padding: 0.2rem 0.65rem;
    background: #e0f2fe;
    color: #0369a1;
    border-radius: 999px;
    font-size: 0.75rem;
}

.category-tag {
    display: inline-block;
    padding: 0.2rem 0.45rem;
    background: #f1f5f9;
    color: #475569;
    border-radius: 4px;
    font-size: 0.75rem;
    margin: 0.15rem;
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
