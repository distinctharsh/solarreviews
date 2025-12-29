@extends('admin.layouts.app')

@section('page_title', 'Profile Submissions')

@php
    use App\Models\UserProfileSubmission;
    use Illuminate\Support\Str;
@endphp

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-start flex-wrap gap-3">

                <div>
                    <h2 class="card-title mb-1">Profile Submissions</h2>
                    <p class="text-muted small mb-0">Review distributor / supplier onboarding forms.</p>
                </div>
                <form method="GET" class="profile-filters">
                    <div class="filter-field">
                        <label class="filter-label" for="status-filter">Status</label>
                        <select id="status-filter" name="status" class="form-select">
                            <option value="">All statuses</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status }}" @selected($filters['status'] === $status)>{{ Str::title(str_replace('_', ' ', $status)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="filter-field">
                        <label class="filter-label" for="form-filter">Form type</label>
                        <select id="form-filter" name="form_type" class="form-select">
                            <option value="">All form types</option>
                            <option value="{{ UserProfileSubmission::FORM_DISTRIBUTOR }}" @selected($filters['form_type'] === UserProfileSubmission::FORM_DISTRIBUTOR)>Distributor</option>
                            <option value="{{ UserProfileSubmission::FORM_SUPPLIER }}" @selected($filters['form_type'] === UserProfileSubmission::FORM_SUPPLIER)>Supplier</option>
                        </select>
                    </div>
                    <div class="filter-field filter-search">
                        <label class="filter-label" for="search-filter">Search</label>
                        <div class="filter-search-input">
                            <input id="search-filter" type="search" name="search" class="form-control" placeholder="Name or email" value="{{ $filters['search'] }}">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-filter me-1"></i>
                                Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Form</th>
                            <th>Status</th>
                            <th>Submitted</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($submissions as $submission)
                            <tr>
                                <td>
                                    <div class="fw-semibold">{{ $submission->user?->name ?? 'Unknown' }}</div>
                                    <div class="text-muted small">{{ $submission->user?->email }}</div>
                                </td>
                                <td class="text-capitalize">{{ $submission->form_type }}</td>
                                <td>
                                    <span class="badge bg-{{ $submission->status === UserProfileSubmission::STATUS_APPROVED ? 'success' : ($submission->status === UserProfileSubmission::STATUS_NEEDS_CHANGES ? 'warning text-dark' : 'secondary') }}">
                                        {{ Str::title(str_replace('_', ' ', $submission->status)) }}
                                    </span>
                                </td>
                                <td>
                                    <div>{{ $submission->created_at?->format('d M Y, h:i A') }}</div>
                                    <div class="text-muted small">Updated {{ $submission->updated_at?->diffForHumans() }}</div>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.profile-submissions.show', $submission) }}" class="btn btn-sm btn-outline-primary">
                                        Review
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">No submissions found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer">
            {{ $submissions->links() }}
        </div>
    </div>
@endsection




@push('styles')
<style>
/* ===============================
   PROFILE SUBMISSIONS FILTER UI
   =============================== */

.profile-filters {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    align-items: flex-end;
}

.filter-field {
    display: flex;
    flex-direction: column;
    min-width: 180px;
}

.filter-search {
    flex: 1;
    min-width: 260px;
}

.filter-label {
    font-size: 12px;
    font-weight: 600;
    color: #64748b;
    margin-bottom: 6px;
    text-transform: uppercase;
    letter-spacing: .04em;
}

.form-select,
.form-control {
    border-radius: 8px;
    border: 1px solid #e2e8f0;
    padding: 8px 12px;
    font-size: 14px;
}

.form-select:focus,
.form-control:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 2px rgba(99,102,241,.15);
}

.filter-search-input {
    display: flex;
    gap: 8px;
}

.filter-search-input .btn {
    white-space: nowrap;
    padding: 8px 14px;
    border-radius: 8px;
}

/* Card header spacing fix */
.card-header {
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
}

/* Table polish */
.table thead th {
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: .04em;
    color: #64748b;
    border-bottom: 1px solid #e2e8f0;
}

.table tbody td {
    vertical-align: middle;
    font-size: 14px;
}

/* Badge polish */
.badge {
    font-size: 12px;
    padding: 6px 10px;
    border-radius: 999px;
}

/* Responsive */
@media (max-width: 768px) {
    .profile-filters {
        flex-direction: column;
        align-items: stretch;
    }
}



/* Header layout fix */
.card-header .d-flex {
    gap: 24px !important;
}

/* Left title block */
.card-header h2 {
    margin-bottom: 4px;
}

/* Filters container ko right side push karo */
.profile-filters {
    margin-left: auto;
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    align-items: flex-end;
}

/* Ensure filters don't squeeze */
.profile-filters .filter-field {
    min-width: 180px;
}

</style>
@endpush

