@extends('admin.layouts.app')

@section('page_title', 'Users Management')

@section('content')
<div class="users-page">
    <!-- Page Header -->
    <div class="page-header">
        <div class="header-content">
            <div class="header-info">
                <div class="header-badge">
                    <i class="fas fa-users"></i>
                    <span>User Management</span>
                </div>
                <h1>Users Management</h1>
                <p class="header-description">Manage system users, assign companies, and monitor user activity from one centralized dashboard.</p>
            </div>
        </div>
    </div>

    <!-- Metrics Container -->
    <div class="metrics-container">
        <div class="metric-card primary">
            <div class="metric-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="metric-content">
                <div class="metric-value">{{ $users->count() }}</div>
                <div class="metric-label">Total Users</div>
                <div class="metric-change">Active in system</div>
            </div>
        </div>
        
        <div class="metric-card success">
            <div class="metric-icon">
                <i class="fas fa-building"></i>
            </div>
            <div class="metric-content">
                <div class="metric-value">{{ $users->whereNotNull('company_id')->count() }}</div>
                <div class="metric-label">Assigned Users</div>
                <div class="metric-change">With companies</div>
            </div>
        </div>
        
        <div class="metric-card info">
            <div class="metric-icon">
                <i class="fas fa-user-slash"></i>
            </div>
            <div class="metric-content">
                <div class="metric-value">{{ $users->whereNull('company_id')->count() }}</div>
                <div class="metric-label">Unassigned</div>
                <div class="metric-change">Need assignment</div>
            </div>
        </div>
        
        <div class="metric-card warning">
            <div class="metric-icon">
                <i class="fas fa-building"></i>
            </div>
            <div class="metric-content">
                <div class="metric-value">{{ $availableCompanies->count() }}</div>
                <div class="metric-label">Available</div>
                <div class="metric-change">Companies to assign</div>
            </div>
        </div>
    </div>

    <!-- Table Container -->
    <div class="table-container">
        <div class="table-wrapper">
            <table class="users-table">
                <thead>
                    <tr>
                        <th class="col-company">Company</th>
                        <th class="col-owner">Owner Name</th>
                        <th class="col-email">Email</th>
                        <th class="col-status">Status</th>
                        <!-- <th class="col-actions">Actions</th> -->
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr class="user-row">
                            <td class="cell-company">
                                @if($user->company_id)
                                    <div class="company-assigned">
                                        <i class="fas fa-check-circle text-success"></i>
                                        <span>{{ $user->company->owner_name }}</span>
                                    </div>
                                @else
                                    <form method="POST" action="{{ route('admin.users.assign-company', $user->id) }}" class="assign-form">
                                        @csrf
                                        <div class="company-select-wrapper">
                                            <select name="company_id" class="company-select" onchange="this.form.submit()" onfocus="showSearchBox({{ $user->id }})" onblur="hideSearchBox({{ $user->id }})">
                                                <option value="">Select Company</option>
                                                @forelse($availableCompanies as $company)
                                                    <option value="{{ $company->id }}" data-name="{{ strtolower($company->owner_name) }}">{{ $company->owner_name }}</option>
                                                @empty
                                                    <option value="">No companies available</option>
                                                @endforelse
                                            </select>
                                            <div id="search-box-{{ $user->id }}" class="search-box-dropdown" style="display: none;">
                                                <input type="text" placeholder="Search company..." 
                                                       class="search-input" 
                                                       onkeyup="filterDropdown({{ $user->id }})"
                                                       onclick="event.stopPropagation()">
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </td>
                            <td class="cell-owner">
                                <div class="owner-info">
                                    <div class="owner-name">{{ $user->name }}</div>
                                </div>
                            </td>
                            <td class="cell-email">
                                <div class="email-info">
                                    <div class="email-address">
                                        <i class="fas fa-envelope"></i>
                                        <span>{{ $user->email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="cell-status">
                                @if($user->company_id)
                                    <span class="status-badge status-assigned">
                                        <span class="status-dot"></span>
                                        Assigned
                                    </span>
                                @else
                                    <span class="status-badge status-unassigned">
                                        <span class="status-dot"></span>
                                        Unassigned
                                    </span>
                                @endif
                            </td>
                            <!-- <td class="cell-actions">
                                <div class="action-buttons">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="action-btn edit-btn">
                                        <i class="fas fa-edit"></i>
                                        <span>Edit</span>
                                    </a>
                                </div>
                            </td> -->
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <i class="fas fa-users"></i>
                                    <h3>No Users Found</h3>
                                    <p>There are no users in the system yet.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('styles')
<style>
/* Users Page Styles */
.users-page {
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

.users-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.8rem;
    min-width: 700px;
}

.users-table thead {
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
}

.users-table th {
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

.users-table tbody tr {
    border-bottom: 1px solid #f1f5f9;
    transition: background-color 0.2s ease;
}

.users-table tbody tr:hover {
    background: #f8fafc;
}

.users-table td {
    padding: 0.75rem 0.6rem;
    vertical-align: middle;
}

/* Table Cells - Optimized widths */
.col-company { min-width: 200px; max-width: 250px; }
.col-owner { min-width: 150px; max-width: 180px; }
.col-email { min-width: 200px; max-width: 250px; }
.col-status { width: 100px; min-width: 100px; }
.col-actions { width: 150px; min-width: 150px; }

/* Company Assignment */
.company-assigned {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.8rem;
    color: #059669;
    font-weight: 500;
}

.company-assigned i {
    font-size: 0.9rem;
}

.company-select-wrapper {
    position: relative;
}

.company-select {
    width: 100%;
    padding: 0.4rem 0.6rem;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    font-size: 0.75rem;
    background: #f8fafc;
    transition: all 0.2s ease;
    min-width: 180px;
}

.company-select:focus {
    outline: none;
    border-color: #3b82f6;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

/* Owner Info */
.owner-info .owner-name {
    font-weight: 500;
    color: #475569;
    font-size: 0.8rem;
    word-break: break-word;
    line-height: 1.3;
}

/* Email Info */
.email-info .email-address {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    font-size: 0.75rem;
    color: #64748b;
    word-break: break-word;
    line-height: 1.2;
}

.email-address i {
    width: 12px;
    color: #94a3b8;
    flex-shrink: 0;
}

/* Status Badges */
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

.status-badge.status-assigned {
    background: #dcfce7;
    color: #166534;
}

.status-badge.status-unassigned {
    background: #f1f5f9;
    color: #64748b;
}

.status-dot {
    width: 3px;
    height: 3px;
    border-radius: 50%;
    background: currentColor;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 0.2rem;
    flex-direction: column;
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

.action-btn.edit-btn {
    background: #dbeafe;
    color: #1d4ed8;
    border-color: #bfdbfe;
}

.action-btn.edit-btn:hover {
    background: #bfdbfe;
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

/* Search Box Dropdown */
.search-box-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    z-index: 1000;
    background: white;
    border: 1px solid #d1d5db;
    border-top: none;
    padding: 0.5rem;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    border-radius: 0 0 6px 6px;
}

.search-input {
    width: 100%;
    padding: 0.4rem 0.6rem;
    border: 1px solid #d1d5db;
    border-radius: 4px;
    font-size: 0.7rem;
    background: #f8fafc;
}

.search-input:focus {
    outline: none;
    border-color: #3b82f6;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

/* Responsive Design */
@media (max-width: 1200px) {
    .metrics-container {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .users-table {
        font-size: 0.75rem;
        min-width: 650px;
    }
    
    .users-table th,
    .users-table td {
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
    
    .action-buttons {
        gap: 0.15rem;
    }
    
    .action-btn {
        justify-content: center;
    }
    
    .users-table {
        font-size: 0.7rem;
        min-width: 600px;
    }
    
    .users-table th,
    .users-table td {
        padding: 0.5rem 0.3rem;
    }
}

@media (max-width: 480px) {
    .page-header {
        padding: 0.8rem;
        border-radius: 6px;
    }
    
    .table-container {
        border-radius: 6px;
    }
    
    .users-table {
        min-width: 550px;
    }
    
    .action-btn {
        padding: 0.2rem 0.3rem;
        font-size: 0.6rem;
    }
}
</style>
@endpush

<script>
function showSearchBox(userId) {
    const searchBox = document.getElementById('search-box-' + userId);
    searchBox.style.display = 'block';
    searchBox.querySelector('input').focus();
}

function hideSearchBox(userId) {
    setTimeout(() => {
        const searchBox = document.getElementById('search-box-' + userId);
        searchBox.style.display = 'none';
    }, 200);
}

function filterDropdown(userId) {
    const searchInput = document.getElementById('search-box-' + userId).querySelector('input');
    const selectElement = document.querySelector('select[name="company_id"]');
    const searchTerm = searchInput.value.toLowerCase();
    
    // Get all options except first one (placeholder)
    const options = selectElement.querySelectorAll('option:not(:first-child)');
    
    options.forEach(option => {
        const companyName = option.getAttribute('data-name');
        if (companyName.includes(searchTerm)) {
            option.style.display = 'block';
        } else {
            option.style.display = 'none';
        }
    });
}
</script>
@endsection
