<!-- resources/views/admin/companies/index.blade.php -->
@extends('admin.layouts.app')

@section('page_title', 'Companies')

@section('content')
@php
    $totalCompanies = $companies->total() ?? $companies->count();
    $activeCompanies = $companies->filter(fn ($company) => $company->status === 'active')->count();
    $installerCount = $companies->filter(fn ($company) => ($company->company_type ?? '') === 'installer')->count();
    $verifiedCount = $companies->filter(fn ($company) => $company->is_verified)->count();
    $subscribedCount = $companies->filter(fn ($company) => $company->is_subscribed)->count();
@endphp

<div class="companies-page">
    <!-- Page Header -->
    <div class="page-header">
        <div class="header-content">
            <div class="header-info">
                <div class="header-badge">
                    <i class="fas fa-building"></i>
                    <span>Master Data</span>
                </div>
                <h1>Companies Management</h1>
                <p class="header-description">Manage registered companies, verification status, and subscription details from one centralized dashboard.</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('admin.companies.create') }}" class="btn-primary">
                    <i class="fas fa-plus"></i>
                    <span>Add Company</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Metrics Cards -->
    <div class="metrics-container">
        <div class="metric-card primary">
            <div class="metric-icon">
                <i class="fas fa-building"></i>
            </div>
            <div class="metric-content">
                <div class="metric-value">{{ number_format($totalCompanies) }}</div>
                <div class="metric-label">Total Companies</div>
                <div class="metric-change">{{ $companies->count() }} listed</div>
            </div>
        </div>
        
        <div class="metric-card success">
            <div class="metric-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="metric-content">
                <div class="metric-value">{{ number_format($activeCompanies) }}</div>
                <div class="metric-label">Active</div>
                <div class="metric-change">Live on marketplace</div>
            </div>
        </div>
        
        <div class="metric-card info">
            <div class="metric-icon">
                <i class="fas fa-shield-alt"></i>
            </div>
            <div class="metric-content">
                <div class="metric-value">{{ number_format($verifiedCount) }}</div>
                <div class="metric-label">Verified</div>
                <div class="metric-change">Trust approved</div>
            </div>
        </div>
        
        <div class="metric-card warning">
            <div class="metric-icon">
                <i class="fas fa-star"></i>
            </div>
            <div class="metric-content">
                <div class="metric-value">{{ number_format($subscribedCount) }}</div>
                <div class="metric-label">Subscribed</div>
                <div class="metric-change">Premium members</div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="filters-section">
        <div class="filters-header">
            <h3>All Companies</h3>
            <p class="filters-description">Browse and manage company profiles with verification and subscription status</p>
        </div>
        
        <div class="filters-controls">
            <form method="GET" action="{{ route('admin.companies.index') }}" class="search-form">
                <div class="search-input-group">
                    <i class="fas fa-search"></i>
                    <input 
                        type="text" 
                        name="search" 
                        class="search-input" 
                        placeholder="Search companies by name, email, or owner..." 
                        value="{{ request('search') }}"
                        aria-label="Search companies"
                    >
                </div>
                
                @if(request('search'))
                    <a href="{{ route('admin.companies.index') }}" class="btn-clear" title="Clear search">
                        <i class="fas fa-times"></i>
                        <span>Clear</span>
                    </a>
                @endif
        
                <button type="submit" class="btn-search">
                    <i class="fas fa-search"></i>
                    <span>Search</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Companies Table -->
    <div class="table-container">
        <div class="table-wrapper">
            <table class="companies-table">
                <thead>
                    <tr>
                        <!-- <th class="col-id">ID</th> -->
                        <th class="col-company">Company</th>
                        <th class="col-type">Type</th>
                        <th class="col-owner">Owner</th>
                        <th class="col-contact">Contact</th>
                        <th class="col-status">Status</th>
                        <th class="col-actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($companies as $company)
                    <tr class="company-row">
                        <!-- <td class="cell-id">
                            <span class="id-badge">#{{ $company->id }}</span>
                        </td> -->
                        <td class="cell-company">
                            <div class="company-info">
                                <div class="company-name">{{ $company->owner_name }}</div>
                                <div class="company-slug">{{ $company->slug ?? '—' }}</div>
                            </div>
                        </td>
                        <td class="cell-type">
                            <span class="type-badge">
                                <i class="fas fa-tag"></i>
                                {{ ucfirst($company->company_type ?? 'N/A') }}
                            </span>
                        </td>
                        <td class="cell-owner">
                            <div class="owner-info">
                                <div class="owner-name">{{ $company->owner_name }}</div>
                            </div>
                        </td>
                        <td class="cell-contact">
                            <div class="contact-info">
                                @if($company->email)
                                    <div class="contact-item">
                                        <i class="fas fa-envelope"></i>
                                        <span>{{ $company->email }}</span>
                                    </div>
                                @endif
                                @if($company->phone)
                                    <div class="contact-item">
                                        <i class="fas fa-phone"></i>
                                        <span>{{ $company->phone }}</span>
                                    </div>
                                @endif
                                @if(!$company->email && !$company->phone)
                                    <span class="no-contact">No contact info</span>
                                @endif
                            </div>
                        </td>
                        <td class="cell-status">
                            <span class="status-badge {{ $company->status === 'active' ? 'status-active' : 'status-inactive' }}">
                                <span class="status-dot"></span>
                                {{ ucfirst($company->status ?? 'inactive') }}
                            </span>
                        </td>
                        <td class="cell-actions">
                            <div class="action-buttons">
                                <form action="{{ route('admin.companies.verification', $company) }}" 
                                    method="POST" 
                                    class="action-form verify-form" 
                                    title="{{ $company->is_verified ? 'Revoke verification' : 'Verify company' }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="is_verified" value="{{ $company->is_verified ? 0 : 1 }}">
                                    <button type="submit" class="action-btn {{ $company->is_verified ? 'verified' : 'unverified' }}">
                                        <i class="fas {{ $company->is_verified ? 'fa-check-circle' : 'fa-shield-alt' }}"></i>
                                        <span>{{ $company->is_verified ? 'Verified' : 'Verify' }}</span>
                                    </button>
                                </form>
                                
                                <form action="{{ route('admin.companies.subscription', $company) }}" 
                                    method="POST" 
                                    class="action-form subscribe-form" 
                                    title="{{ $company->is_subscribed ? 'Cancel subscription' : 'Subscribe company' }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="is_subscribed" value="{{ $company->is_subscribed ? 0 : 1 }}">
                                    <button type="submit" class="action-btn {{ $company->is_subscribed ? 'subscribed' : 'unsubscribed' }}">
                                        <i class="fas {{ $company->is_subscribed ? 'fa-star' : 'fa-star' }}"></i>
                                        <span>{{ $company->is_subscribed ? 'Subscribed' : 'Subscribe' }}</span>
                                    </button>
                                </form>
                                
                                <a href="{{ route('admin.companies.edit', $company) }}" class="action-btn edit-btn" title="Edit company">
                                    <i class="fas fa-edit"></i>
                                    <span>Edit</span>
                                </a>
                                
                                <form action="{{ route('admin.companies.destroy', $company) }}" method="POST" class="action-form delete-form" title="Delete company">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this company? This action cannot be undone.')">
                                        <i class="fas fa-trash"></i>
                                        <span>Delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr class="empty-row">
                        <td colspan="7">
                            <div class="empty-state">
                                <i class="fas fa-building"></i>
                                <h3>No companies found</h3>
                                <p>Get started by adding your first company or adjust your search filters.</p>
                                <a href="{{ route('admin.companies.create') }}" class="btn-primary">
                                    <i class="fas fa-plus"></i>
                                    <span>Add Company</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($companies->hasPages())
            <div class="pagination-container">
                {{ $companies->withQueryString()
                    ->onEachSide(1)
                    ->links('pagination::bootstrap-4') 
                }}
            </div>
        @endif
    </div>
</div>
@endsection


@push('styles')
<style>
/* Companies Page Styles */
.companies-page {
    padding: 0;
    background: transparent;
    max-width: 100%;
    overflow-x: hidden;
}

/* Page Header */
.page-header {
    background: linear-gradient(135deg, #0f172a, #1d4ed8);
    border-radius: 16px;
    padding: 1.5rem;
    margin-bottom: 1rem;
    box-shadow: 0 12px 28px rgba(15, 23, 42, 0.15);
    color: #fff;
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 1rem;
}

.header-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    background: rgba(255, 255, 255, 0.15);
    padding: 0.3rem 0.6rem;
    border-radius: 999px;
    font-size: 0.7rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 0.6rem;
}

.header-badge i {
    color: #60a5fa;
}

.header-info h1 {
    font-size: 1.75rem;
    font-weight: 700;
    margin: 0 0 0.6rem 0;
    line-height: 1.2;
}

.header-description {
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.8);
    margin: 0;
    line-height: 1.4;
}

.header-actions {
    flex-shrink: 0;
}

.btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    background: rgba(255, 255, 255, 0.2);
    color: #fff;
    border: 1px solid rgba(255, 255, 255, 0.3);
    padding: 0.6rem 1rem;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s ease;
    backdrop-filter: blur(10px);
    font-size: 0.85rem;
}

.btn-primary:hover {
    background: rgba(255, 255, 255, 0.25);
    border-color: rgba(255, 255, 255, 0.4);
    transform: translateY(-2px);
}

/* Metrics Container */
.metrics-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.metric-card {
    background: #fff;
    border-radius: 12px;
    padding: 1rem;
    border: 1px solid #e2e8f0;
    box-shadow: 0 6px 16px rgba(15, 23, 42, 0.05);
    display: flex;
    align-items: center;
    gap: 0.75rem;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.metric-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(15, 23, 42, 0.08);
}

.metric-card.primary .metric-icon {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    color: #fff;
}

.metric-card.success .metric-icon {
    background: linear-gradient(135deg, #10b981, #059669);
    color: #fff;
}

.metric-card.info .metric-icon {
    background: linear-gradient(135deg, #06b6d4, #0891b2);
    color: #fff;
}

.metric-card.warning .metric-icon {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: #fff;
}

.metric-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
}

.metric-content {
    flex: 1;
}

.metric-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 0.1rem;
}

.metric-label {
    font-size: 0.7rem;
    font-weight: 600;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 0.1rem;
}

.metric-change {
    font-size: 0.65rem;
    color: #94a3b8;
}

/* Filters Section */
.filters-section {
    background: #fff;
    border-radius: 12px;
    padding: 1.25rem;
    margin-bottom: 1rem;
    border: 1px solid #e2e8f0;
    box-shadow: 0 6px 16px rgba(15, 23, 42, 0.05);
}

.filters-header h3 {
    font-size: 1.1rem;
    font-weight: 700;
    color: #0f172a;
    margin: 0 0 0.3rem 0;
}

.filters-description {
    color: #64748b;
    margin: 0 0 0.8rem 0;
    font-size: 0.85rem;
}

.filters-controls {
    display: flex;
    gap: 0.6rem;
    align-items: center;
    flex-wrap: wrap;
}

.search-form {
    display: flex;
    gap: 0.6rem;
    align-items: center;
    flex: 1;
    min-width: 250px;
}

.search-input-group {
    position: relative;
    flex: 1;
    display: flex;
    align-items: center;
}

.search-input-group i {
    position: absolute;
    left: 0.75rem;
    color: #94a3b8;
    z-index: 1;
}

.search-input {
    width: 100%;
    padding: 0.6rem 0.75rem 0.6rem 2rem;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 0.85rem;
    background: #f8fafc;
    transition: all 0.2s ease;
}

.search-input:focus {
    outline: none;
    border-color: #3b82f6;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.btn-clear {
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    padding: 0.6rem 0.75rem;
    background: #f1f5f9;
    color: #64748b;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.2s ease;
    white-space: nowrap;
    font-size: 0.8rem;
}

.btn-clear:hover {
    background: #e2e8f0;
    color: #475569;
}

.btn-search {
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    padding: 0.6rem 1rem;
    background: #3b82f6;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    white-space: nowrap;
    font-size: 0.8rem;
}

.btn-search:hover {
    background: #2563eb;
    transform: translateY(-1px);
}

/* Table Container */
.table-container {
    background: #fff;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 6px 16px rgba(15, 23, 42, 0.05);
    overflow: hidden;
}

.table-wrapper {
    overflow-x: auto;
    max-width: 100%;
}

.companies-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.8rem;
    min-width: 700px;
}

.companies-table thead {
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
}

.companies-table th {
    padding: 0.75rem 0.6rem;
    text-align: left;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: #64748b;
    font-size: 0.65rem;
    border-bottom: 1px solid #e2e8f0;
    white-space: nowrap;
}

.companies-table tbody tr {
    border-bottom: 1px solid #f1f5f9;
    transition: background-color 0.2s ease;
}

.companies-table tbody tr:hover {
    background: #f8fafc;
}

.companies-table td {
    padding: 0.75rem 0.6rem;
    vertical-align: middle;
}

/* Table Cells - More optimized widths */
.col-id { width: 60px; min-width: 60px; }
.col-company { min-width: 220px; max-width: 280px; }
.col-type { width: 90px; min-width: 90px; }
.col-owner { min-width: 120px; max-width: 150px; }
.col-contact { min-width: 160px; max-width: 200px; }
.col-status { width: 90px; min-width: 90px; }
.col-actions { width: 260px; min-width: 260px; }

.id-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #f1f5f9;
    color: #64748b;
    padding: 0.15rem 0.3rem;
    border-radius: 4px;
    font-size: 0.65rem;
    font-weight: 600;
    font-family: 'Courier New', monospace;
}

.company-info .company-name {
    font-weight: 600;
    color: #0f172a;
    margin-bottom: 0.1rem;
    font-size: 0.8rem;
    word-break: break-word;
    overflow-wrap: break-word;
    hyphens: auto;
    line-height: 1.3;
    max-width: 100%;
}

.company-info .company-slug {
    font-size: 0.6rem;
    color: #94a3b8;
    font-family: 'Courier New', monospace;
    word-break: break-word;
    overflow-wrap: break-word;
    hyphens: auto;
    line-height: 1.2;
    max-width: 100%;
}

.type-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    background: #e0f2fe;
    color: #0369a1;
    padding: 0.2rem 0.4rem;
    border-radius: 999px;
    font-size: 0.65rem;
    font-weight: 600;
    white-space: nowrap;
}

.type-badge i {
    font-size: 0.55rem;
}

.owner-info .owner-name {
    font-weight: 500;
    color: #475569;
    font-size: 0.75rem;
    word-wrap: break-word;
    line-height: 1.3;
}

.contact-info {
    display: flex;
    flex-direction: column;
    gap: 0.2rem;
}

.contact-item {
    display: flex;
    align-items: flex-start;
    gap: 0.25rem;
    font-size: 0.7rem;
    color: #64748b;
    word-wrap: break-word;
    line-height: 1.2;
}

.contact-item i {
    width: 10px;
    color: #94a3b8;
    flex-shrink: 0;
    margin-top: 0.1rem;
}

.no-contact {
    font-size: 0.7rem;
    color: #cbd5e1;
    font-style: italic;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    padding: 0.2rem 0.4rem;
    border-radius: 999px;
    font-size: 0.65rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    white-space: nowrap;
}

.status-badge.status-active {
    background: #dcfce7;
    color: #166534;
}

.status-badge.status-inactive {
    background: #f1f5f9;
    color: #64748b;
}

.status-dot {
    width: 3px;
    height: 3px;
    border-radius: 50%;
    background: currentColor;
}

/* Action Buttons - Ultra compact */
.action-buttons {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.2rem;
    max-width: 200px;
}

.action-form {
    display: inline-block;
}

.action-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.15rem;
    padding: 0.25rem 0.4rem;
    border: 1px solid;
    border-radius: 3px;
    font-size: 0.65rem;
    font-weight: 500;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.2s ease;
    white-space: nowrap;
}

.action-btn.verified {
    background: #dcfce7;
    color: #166534;
    border-color: #bbf7d0;
}

.action-btn.verified:hover {
    background: #bbf7d0;
}

.action-btn.unverified {
    background: #f8fafc;
    color: #64748b;
    border-color: #e2e8f0;
}

.action-btn.unverified:hover {
    background: #f1f5f9;
    border-color: #cbd5e1;
}

.action-btn.subscribed {
    background: #fef3c7;
    color: #92400e;
    border-color: #fde68a;
}

.action-btn.subscribed:hover {
    background: #fde68a;
}

.action-btn.unsubscribed {
    background: #f8fafc;
    color: #64748b;
    border-color: #e2e8f0;
}

.action-btn.unsubscribed:hover {
    background: #f1f5f9;
    border-color: #cbd5e1;
}

.action-btn.edit-btn {
    background: #dbeafe;
    color: #1d4ed8;
    border-color: #bfdbfe;
}

.action-btn.edit-btn:hover {
    background: #bfdbfe;
}

.action-btn.delete-btn {
    background: #fee2e2;
    color: #dc2626;
    border-color: #fecaca;
}

.action-btn.delete-btn:hover {
    background: #fecaca;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 2rem 1rem;
}

.empty-state i {
    font-size: 2rem;
    color: #cbd5e1;
    margin-bottom: 0.6rem;
}

.empty-state h3 {
    color: #1e293b;
    margin-bottom: 0.5rem;
    font-size: 1rem;
}

.empty-state p {
    color: #94a3b8;
    margin-bottom: 1rem;
    font-size: 0.8rem;
}

/* Pagination */
.pagination-container {
    padding: 0.8rem;
    border-top: 1px solid #f1f5f9;
    display: flex;
    justify-content: center;
}

.pagination-container .pagination {
    display: flex;
    align-items: center;
    gap: 0.3rem;
    margin: 0;
}

.pagination .page-link {
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 32px;
    height: 32px;
    padding: 0 0.5rem;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    background: #fff;
    color: #6b7280;
    font-weight: 500;
    transition: all 0.2s ease;
    font-size: 0.75rem;
    text-decoration: none;
}

.pagination .page-link:hover {
    border-color: #3b82f6;
    color: #3b82f6;
    background: #f8fafc;
    transform: translateY(-1px);
}

.pagination .page-item.active .page-link {
    background: #3b82f6;
    border-color: #3b82f6;
    color: #fff;
    font-weight: 600;
}

.pagination .page-item.disabled .page-link {
    background: #f9fafb;
    color: #d1d5db;
    border-color: #e5e7eb;
    cursor: not-allowed;
    opacity: 0.6;
}

/* Hide pagination dots and make them cleaner */
.pagination .page-item.disabled:not(.prev):not(.next) {
    display: none;
}

/* Custom prev/next styling */
.pagination .page-item.prev .page-link,
.pagination .page-item.next .page-link {
    padding: 0 0.75rem;
    font-weight: 600;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .metrics-container {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .companies-table {
        font-size: 0.75rem;
        min-width: 650px;
    }
    
    .companies-table th,
    .companies-table td {
        padding: 0.6rem 0.5rem;
    }
}

@media (max-width: 768px) {
    .header-content {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.6rem;
    }
    
    .header-info h1 {
        font-size: 1.4rem;
    }
    
    .metrics-container {
        grid-template-columns: 1fr;
    }
    
    .filters-controls {
        flex-direction: column;
        align-items: stretch;
    }
    
    .search-form {
        flex-direction: column;
        min-width: auto;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 0.15rem;
    }
    
    .action-btn {
        justify-content: center;
    }
    
    .companies-table {
        font-size: 0.7rem;
        min-width: 600px;
    }
    
    .companies-table th,
    .companies-table td {
        padding: 0.5rem 0.3rem;
    }
}

@media (max-width: 480px) {
    .page-header {
        padding: 0.8rem;
        border-radius: 6px;
    }
    
    .filters-section {
        padding: 0.8rem;
        border-radius: 6px;
    }
    
    .table-container {
        border-radius: 6px;
    }
    
    .companies-table {
        min-width: 550px;
    }
    
    .action-buttons {
        gap: 0.15rem;
    }
    
    .action-btn {
        padding: 0.2rem 0.3rem;
        font-size: 0.6rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    // Handle verification forms
    document.querySelectorAll('form.verify-form').forEach((form) => {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const button = form.querySelector('button[type="submit"]');
            const input = form.querySelector('input[name="is_verified"]');
            if (!button || !input) return;

            const url = form.getAttribute('action');
            const nextValue = input.value;

            const originalHtml = button.innerHTML;
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';

            try {
                const response = await fetch(url, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': csrf || '',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ is_verified: Number(nextValue) }),
                });

                if (!response.ok) {
                    throw new Error('Request failed');
                }

                const data = await response.json();
                const isVerified = !!data.is_verified;

                input.value = isVerified ? 0 : 1;

                button.classList.remove('verified', 'unverified');

                if (isVerified) {
                    button.classList.add('verified');
                    button.innerHTML = '<i class="fas fa-check-circle"></i> Verified';
                } else {
                    button.classList.add('unverified');
                    button.innerHTML = '<i class="fas fa-shield-alt"></i> Verify';
                }
            } catch (err) {
                button.innerHTML = originalHtml;
                alert('Unable to update verification. Please try again.');
            } finally {
                button.disabled = false;
            }
        });
    });

    // Handle subscription forms
    document.querySelectorAll('form.subscribe-form').forEach((form) => {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const button = form.querySelector('button[type="submit"]');
            const input = form.querySelector('input[name="is_subscribed"]');
            if (!button || !input) return;

            const url = form.getAttribute('action');
            const nextValue = input.value;

            const originalHtml = button.innerHTML;
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';

            try {
                const response = await fetch(url, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': csrf || '',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ is_subscribed: Number(nextValue) }),
                });

                if (!response.ok) {
                    throw new Error('Request failed');
                }

                const data = await response.json();
                const isSubscribed = !!data.is_subscribed;

                input.value = isSubscribed ? 0 : 1;

                button.classList.remove('subscribed', 'unsubscribed');

                if (isSubscribed) {
                    button.classList.add('subscribed');
                    button.innerHTML = '<i class="fas fa-star"></i> Subscribed';
                } else {
                    button.classList.add('unsubscribed');
                    button.innerHTML = '<i class="fas fa-star"></i> Subscribe';
                }
            } catch (err) {
                button.innerHTML = originalHtml;
                alert('Unable to update subscription. Please try again.');
            } finally {
                button.disabled = false;
            }
        });
    });
});
</script>
@endpush
