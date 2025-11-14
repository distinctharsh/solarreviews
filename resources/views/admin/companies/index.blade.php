@extends('admin.layouts.app')

@push('styles')
<style>
    .companies-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .page-title {
        font-size: 24px;
        font-weight: 600;
        color: #2d3748;
        margin: 0;
    }

    .add-btn {
        background-color: #4a90e2;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        font-size: 14px;
        transition: background-color 0.2s;
    }

    .add-btn:hover {
        background-color: #357abd;
    }

    .companies-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .companies-table th {
        background-color: #f7fafc;
        color: #4a5568;
        text-align: left;
        padding: 12px 16px;
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px solid #e2e8f0;
    }

    .companies-table td {
        padding: 16px;
        border-bottom: 1px solid #edf2f7;
        vertical-align: middle;
    }

    .companies-table tr:last-child td {
        border-bottom: none;
    }

    .companies-table tr:hover {
        background-color: #f8fafc;
    }

    .company-logo {
        width: 50px;
        height: 50px;
        border-radius: 4px;
        object-fit: cover;
    }

    .logo-placeholder {
        width: 50px;
        height: 50px;
        background-color: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        border-radius: 4px;
    }

    .rating {
        display: flex;
        align-items: center;
    }

    .stars {
        color: #f59e0b;
        margin-right: 8px;
    }

    .status {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 500;
    }

    .status-active {
        background-color: #d1fae5;
        color: #065f46;
    }

    .status-inactive {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .btn {
        padding: 6px 10px;
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        background: white;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    .btn-edit {
        color: #3b82f6;
        border-color: #bfdbfe;
    }

    .btn-edit:hover {
        background-color: #eff6ff;
    }

    .btn-delete {
        color: #ef4444;
        border-color: #fecaca;
    }

    .btn-delete:hover {
        background-color: #fef2f2;
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #64748b;
    }

    .empty-state a {
        color: #3b82f6;
        text-decoration: none;
    }

    .empty-state a:hover {
        text-decoration: underline;
    }

    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 30px 0 10px;
        flex-wrap: wrap;
        gap: 4px;
        padding: 0 10px;
    }

    .pagination > * {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 32px;
        height: 32px;
        padding: 0 6px;
        border-radius: 4px;
        font-size: 13px;
        font-weight: 500;
        color: #4b5563;
        text-decoration: none;
        transition: all 0.2s ease;
        border: 1px solid #e2e8f0;
        background-color: white;
        line-height: 1;
    }

    .pagination a:hover:not(.disabled) {
        background-color: #f3f4f6;
        border-color: #d1d5db;
        color: #1f2937;
    }

    .pagination .active {
        background-color: #3b82f6;
        border-color: #3b82f6;
        color: white;
        font-weight: 600;
    }

    .pagination .disabled {
        color: #d1d5db;
        cursor: not-allowed;
        background-color: #f9fafb;
        border-color: #f3f4f6;
    }

    .pagination .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        width: 100%;
    }

    .pagination .page-item {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .pagination .ellipsis {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 24px;
        color: #9ca3af;
        padding: 0 4px;
        user-select: none;
    }

    .alert {
        padding: 12px 16px;
        border-radius: 4px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .alert-success {
        background-color: #d1fae5;
        color: #065f46;
        border: 1px solid #a7f3d0;
    }
</style>
@endpush

@section('content')
<div class="companies-container">
    <div class="page-header">
        <h1 class="page-title">Solar Companies</h1>
        <a href="{{ route('admin.companies.create') }}" class="add-btn">
            <i class="fas fa-plus" style="margin-right: 8px;"></i> Add Company
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($companies->count() > 0)
        <table class="companies-table">
            <thead>
                <tr>
                    <th>Company</th>
                    <th>Location</th>
                    <th>Rating</th>
                    <th>Reviews</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($companies as $company)
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 12px;">
                                @if(!empty($company->logo))
                                    <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }}" class="company-logo">
                                @else
                                    <img src="{{ asset('images/company/cmp.png') }}" alt="Default Company Logo" class="company-logo">
                                @endif
                                <span style="font-weight: 500;">{{ $company->name }}</span>
                            </div>
                        </td>
                        <td>{{ $company->state->name ?? 'N/A' }}</td>
                        <td>
                            <div class="rating">
                                <div class="stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= floor($company->average_rating))
                                            <i class="fas fa-star"></i>
                                        @elseif($i - 0.5 <= $company->average_rating)
                                            <i class="fas fa-star-half-alt"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </div>
                                <span>{{ number_format($company->average_rating, 1) }}</span>
                            </div>
                        </td>
                        <td>{{ $company->total_reviews }}</td>
                        <td>
                            <span class="status status-{{ $company->is_active ? 'active' : 'inactive' }}">
                                {{ $company->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.companies.edit', $company) }}" class="btn btn-edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.companies.destroy', $company) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this company?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if($companies->hasPages())
            @php
                $currentPage = $companies->currentPage();
                $lastPage = $companies->lastPage();
                $window = 2; // Number of pages to show on each side of the current page
                
                $startPage = max(1, $currentPage - $window);
                $endPage = min($lastPage, $currentPage + $window);
                
                // Adjust if we're near the start or end
                if ($currentPage <= $window + 1) {
                    $endPage = min(2 * $window + 1, $lastPage);
                } elseif ($currentPage >= $lastPage - $window) {
                    $startPage = max(1, $lastPage - 2 * $window);
                }
            @endphp

            <div class="pagination">
                {{-- Previous Page Link --}}
                @if ($companies->onFirstPage())
                    <span class="disabled">&laquo;</span>
                @else
                    <a href="{{ $companies->previousPageUrl() }}" rel="prev" class="page-link">&laquo;</a>
                @endif

                {{-- First Page --}}
                @if($startPage > 1)
                    <a href="{{ $companies->url(1) }}" class="page-link">1</a>
                    @if($startPage > 2)
                        <span class="ellipsis">...</span>
                    @endif
                @endif

                {{-- Page Numbers --}}
                @for($i = $startPage; $i <= $endPage; $i++)
                    @if ($i == $currentPage)
                        <span class="active">{{ $i }}</span>
                    @else
                        <a href="{{ $companies->url($i) }}" class="page-link">{{ $i }}</a>
                    @endif
                @endfor

                {{-- Last Page --}}
                @if($endPage < $lastPage)
                    @if($endPage < $lastPage - 1)
                        <span class="ellipsis">...</span>
                    @endif
                    <a href="{{ $companies->url($lastPage) }}" class="page-link">{{ $lastPage }}</a>
                @endif

                {{-- Next Page Link --}}
                @if ($companies->hasMorePages())
                    <a href="{{ $companies->nextPageUrl() }}" rel="next" class="page-link">&raquo;</a>
                @else
                    <span class="disabled">&raquo;</span>
                @endif
            </div>
        @endif
    @else
        <div class="empty-state">
            <p>No companies found. <a href="{{ route('admin.companies.create') }}">Add your first company</a>.</p>
        </div>
    @endif
</div>
@endsection
