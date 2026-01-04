@extends('admin.layouts.app')

@section('page_title', 'Get Quotes')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-start flex-wrap gap-3">
                <div>
                    <h2 class="card-title mb-1">Get Quote Requests</h2>
                    <p class="text-muted small mb-0">Leads submitted from the frontend get-quote form.</p>
                </div>

                <form method="GET" class="profile-filters">
                    <div class="filter-field">
                        <label class="filter-label" for="service-type-filter">Service type</label>
                        <select id="service-type-filter" name="service_type" class="form-select">
                            <option value="">All</option>
                            @foreach($serviceTypes as $type)
                                <option value="{{ $type }}" @selected(($filters['service_type'] ?? null) === $type)>
                                    {{ $type }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-field filter-search">
                        <label class="filter-label" for="search-filter">Search</label>
                        <div class="filter-search-input">
                            <input id="search-filter" type="search" name="search" class="form-control"
                                   placeholder="Name, mobile, email, location" value="{{ $filters['search'] ?? '' }}">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-filter me-1"></i>
                                Filter
                            </button>
                        </div>
                    </div>

                    <div class="filter-field" style="min-width: 120px;">
                        <label class="filter-label">&nbsp;</label>
                        <a href="{{ route('admin.get-quotes.index') }}" class="btn btn-link" style="padding: 8px 0;">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Service</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Company</th>
                            <th>State</th>
                            <th>Submitted</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($quotes as $quote)
                            <tr>
                                <td>
                                    <div class="fw-semibold">{{ $quote->name }}</div>
                                    @if($quote->location)
                                        <div class="text-muted small">{{ $quote->location }}</div>
                                    @endif
                                </td>
                                <td class="text-capitalize">{{ $quote->service_type }}</td>
                                <td>{{ $quote->mobile_number }}</td>
                                <td>{{ $quote->email ?: '—' }}</td>
                                <td>
                                    @if($quote->company)
                                        <div class="fw-semibold">{{ $quote->company->owner_name ?? 'Company' }}</div>
                                        <div class="text-muted small">#{{ $quote->company->id }}</div>
                                    @else
                                        —
                                    @endif
                                </td>
                                <td>{{ $quote->state?->name ?: '—' }}</td>
                                <td>
                                    <div>{{ $quote->created_at?->format('d M Y, h:i A') }}</div>
                                    <div class="text-muted small">Updated {{ $quote->updated_at?->diffForHumans() }}</div>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.get-quotes.show', $quote) }}" class="btn btn-sm btn-outline-primary">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">No quote requests found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer">
            {{ $quotes->links() }}
        </div>
    </div>
@endsection

@push('styles')
<style>
.profile-filters {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    align-items: flex-end;
    margin-left: auto;
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
.card-header {
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
}
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
@media (max-width: 768px) {
    .profile-filters {
        flex-direction: column;
        align-items: stretch;
        margin-left: 0;
    }
}
</style>
@endpush
