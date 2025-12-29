<!-- resources/views/admin/companies/index.blade.php -->
@extends('admin.layouts.app')

@section('page_title', 'Companies')

@section('content')
@php
    $totalCompanies = $companies->total() ?? $companies->count();
    $activeCompanies = $companies->filter(fn ($company) => $company->status === 'active')->count();
    $installerCount = $companies->filter(fn ($company) => ($company->company_type ?? '') === 'installer')->count();
@endphp

<div class="page-hero">
    <div>
        <p class="eyebrow">Master data</p>
        <h1>Companies</h1>
        <p class="hero-copy">Manage registered companies, owners, and contact information from one control panel.</p>
    </div>
    <div class="hero-actions">
        <a href="{{ route('admin.companies.create') }}" class="btn btn-primary btn-pill">
            <i class="fas fa-plus"></i>
            Add Company
        </a>
    </div>
</div>

<div class="metrics-grid">
    <article class="metric-card">
        <span class="metric-label">Total companies</span>
        <div class="metric-value">{{ number_format($totalCompanies) }}</div>
        <small>{{ $companies->count() }} listed here</small>
    </article>
    <article class="metric-card">
        <span class="metric-label">Active</span>
        <div class="metric-value text-success">{{ number_format($activeCompanies) }}</div>
        <small>Live on marketplace</small>
    </article>
    <!--<article class="metric-card">-->
    <!--    <span class="metric-label">Installers</span>-->
    <!--    <div class="metric-value">{{ number_format($installerCount) }}</div>-->
    <!--    <small>Company type = installer</small>-->
    <!--</article>-->
</div>

<div class="card surface-card">
    <div class="card-body table-responsive">
        <div class="table-intro">
            <div>
                <h4>All companies</h4>
                <p class="text-muted">Owner details with contact methods and status badges.</p>
            </div>
            <div class="table-actions mb-3">
                <form method="GET" action="{{ route('admin.companies.index') }}" class="search-form d-flex align-items-center gap-2 flex-wrap">
                    <div class="input-group">
                        <!--<span class="input-group-text"><i class="fas fa-search"></i></span>-->
                        <input 
                            type="text" 
                            name="search" 
                            class="form-control" 
                            placeholder="Search companies..." 
                            value="{{ request('search') }}"
                            aria-label="Search companies"
                        >
                    </div>
            
                    @if(request('search'))
                        <a href="{{ route('admin.companies.index') }}" class="btn btn-outline-secondary" title="Clear search">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
            
                    <button class="btn btn-primary" type="submit">Search</button>
                </form>
            </div>


        </div>

        <table class="table modern-table">
            <thead>
                <tr>
                    <th width="60">ID</th>
                    <th>Company</th>
                    <th>Type</th>
                    <th>Owner</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th width="120">Status</th>
                    <th width="160">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($companies as $company)
                <tr>
                    <td>{{ $company->id }}</td>
                   <td>
                        <strong>{{ $company->owner_name }}</strong>
                        <div class="text-muted small">Slug: {{ $company->slug ?? '—' }}</div>
                    </td>

                    <td>{{ ucfirst($company->company_type ?? 'n/a') }}</td>
                    <td>{{ $company->owner_name }}</td>
                    <td>{{ $company->email ?: '—' }}</td>
                    <td>{{ $company->phone ?: '—' }}</td>
                    <td>
                        <span class="status-badge {{ $company->status === 'active' ? 'status-active' : 'status-inactive' }}">
                            {{ ucfirst($company->status ?? 'inactive') }}
                        </span>
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <!-- <a href="{{ route('admin.companies.show', $company) }}" class="btn btn-sm btn-outline-secondary" title="View">
                                <i class="fas fa-eye"></i>
                            </a> -->
                            <a href="{{ route('admin.companies.edit', $company) }}" class="btn btn-sm btn-primary" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.companies.destroy', $company) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">No companies found</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
   <div class="pagination-wrapper d-flex justify-content-end mt-4">
    {{ $companies->withQueryString()
        ->onEachSide(1)
        ->withQueryString()
        ->links('pagination::bootstrap-4') 
    }}
</div>
</div>

        </div>
    </div>
</div>
@endsection


@push('styles')
<style>
.pagination-wrapper .pagination {
    margin: 0;
}
 
.pagination .page-link {
    padding: 0.5rem 0.75rem;
    color: #4b5563;
    border: 1px solid #e5e7eb;
    margin: 0 0.25rem;
    border-radius: 0.375rem;
}
 
.pagination .page-item.active .page-link {
    background-color: #0d6efd;
    border-color: #0d6efd;
    color: white;
}
 
.pagination .page-item.disabled .page-link {
    color: #9ca3af;
    background-color: #f9fafb;
    border-color: #e5e7eb;
}





.pagination-wrapper .pagination {
    margin: 0;
    display: flex;
    justify-content: flex-end;
    flex-wrap: wrap;
    gap: 0.5rem;
    font-family: 'Inter', sans-serif; /* Optional: Better font */
}

.pagination .page-link {
    padding: 0.5rem 0.9rem;
    color: #374151; /* Dark gray */
    border: 1px solid #d1d5db; /* Light gray border */
    margin: 0 0.2rem;
    border-radius: 0.5rem;
    background-color: #fff;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease;
    user-select: none;
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 38px;
}

.pagination .page-link:hover:not(.disabled):not(.active) {
    background-color: #f3f4f6; /* Slightly lighter bg on hover */
    border-color: #93c5fd; /* Light blue border on hover */
    color: #2563eb; /* Blue text on hover */
}

.pagination .page-item.active .page-link {
    background-color: #2563eb; /* Blue */
    border-color: #2563eb;
    color: white;
    cursor: default;
    font-weight: 600;
}

.pagination .page-item.disabled .page-link {
    color: #9ca3af; /* Light gray */
    background-color: #f9fafb;
    border-color: #e5e7eb;
    cursor: not-allowed;
}

.pagination .page-item {
    list-style: none;
}

/* Responsive: center pagination on small screens */
@media (max-width: 576px) {
    .pagination-wrapper .pagination {
        justify-content: center;
    }
}
.table-actions form {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    align-items: center;
}

.table-actions .input-group {
    flex: 1 1 auto; /* Makes input expand nicely */
    min-width: 250px;
}

.table-actions .btn {
    white-space: nowrap;
}




/* Container form */
.search-form {
    flex-wrap: nowrap; /* Keep on one line */
    gap: 0.5rem;
    flex-wrap: wrap; /* Responsive wrap on very small screens */
}

/* Input group styling */
.search-form .input-group {
    flex-grow: 1; /* Input takes available space */
    min-width: 250px;
    max-width: 500px;
}

/* Input field inside input-group */
.search-form .form-control {
    border-top-left-radius: 0.375rem;
    border-bottom-left-radius: 0.375rem;
}

/* Icon inside input group */
.search-form .input-group-text {
    background-color: #fff;
    border-right: 0;
    border-top-left-radius: 0.375rem;
    border-bottom-left-radius: 0.375rem;
}

/* Reset button spacing */
.search-form a.btn-outline-secondary {
    padding: 0.375rem 0.5rem;
}

/* Submit button */
.search-form button.btn-primary {
    white-space: nowrap;
}

/* On very small screens, stack vertically */
@media (max-width: 480px) {
    .search-form {
        flex-wrap: wrap;
    }
    .search-form .input-group,
    .search-form a.btn-outline-secondary,
    .search-form button.btn-primary {
        flex-grow: 1;
        max-width: 100%;
    }
}

</style>
@endpush
