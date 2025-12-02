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
    <article class="metric-card">
        <span class="metric-label">Installers</span>
        <div class="metric-value">{{ number_format($installerCount) }}</div>
        <small>Company type = installer</small>
    </article>
</div>

<div class="card surface-card">
    <div class="card-body table-responsive">
        <div class="table-intro">
            <div>
                <h4>All companies</h4>
                <p class="text-muted">Owner details with contact methods and status badges.</p>
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
                        <strong>{{ $company->name ?? $company->owner_name }}</strong>
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
                            <a href="{{ route('admin.companies.show', $company) }}" class="btn btn-sm btn-outline-secondary" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
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
            {{ $companies->links() }}
        </div>
    </div>
</div>
@endsection