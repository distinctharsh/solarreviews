@extends('admin.layouts.app')

@section('page_title', 'Get Solutions')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-start flex-wrap gap-3">
                <div>
                    <h2 class="card-title mb-1">Get Solution Requests</h2>
                    <p class="text-muted small mb-0">Service requests submitted from the frontend get-solution form.</p>
                </div>

                <form method="GET" class="profile-filters">
                    <div class="filter-field">
                        <label class="filter-label" for="service-type-filter">Service Type</label>
                        <select id="service-type-filter" name="service_type" class="form-select">
                            <option value="">All</option>
                            @foreach($serviceTypes as $type)
                                <option value="{{ $type }}" @selected(request('service_type') === $type)>
                                    {{ $type }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-field">
                        <label class="filter-label" for="location-filter">Location Preference</label>
                        <select id="location-filter" name="use_location" class="form-select">
                            <option value="">All</option>
                            <option value="dropdown" @selected(request('use_location') === 'dropdown')">Dropdown</option>
                            <option value="other" @selected(request('use_location') === 'other')">Manual</option>
                        </select>
                    </div>

                    <div class="filter-field filter-search">
                        <label class="filter-label" for="search-filter">Search</label>
                        <div class="filter-search-input">
                            <input id="search-filter" type="search" name="search" class="form-control"
                                   placeholder="Name, mobile, email" value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-filter me-1"></i>
                                Filter
                            </button>
                        </div>
                    </div>

                    <div class="filter-field" style="min-width: 120px;">
                        <label class="filter-label">&nbsp;</label>
                        <a href="{{ route('admin.get-solutions.index') }}" class="btn btn-link" style="padding: 8px 0;">Reset</a>
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
                            <th>Service Type</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Location</th>
                            <th>Submitted</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($solutions as $solution)
                            <tr>
                                <td>
                                    <div class="fw-semibold">{{ $solution->name }}</div>
                                    @if($solution->details)
                                        <div class="text-muted small">{{ Str::limit($solution->details, 50) }}</div>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-primary text-white">{{ $solution->service_type }}</span>
                                </td>
                                <td>{{ $solution->mobile_number }}</td>
                                <td>{{ $solution->email ?: '—' }}</td>
                                <td>
                                    @if($solution->use_location === 'dropdown')
                                        <div class="fw-semibold">{{ $solution->city ?: '—' }}</div>
                                        <div class="text-muted small">{{ $solution->state?->name ?? '—' }}, {{ $solution->pincode }}</div>
                                    @else
                                        <div class="fw-semibold">Manual Location</div>
                                        <div class="text-muted small">{{ Str::limit($solution->other_location, 30) }}</div>
                                    @endif
                                </td>
                                <td>
                                    <div>{{ $solution->created_at?->format('d M Y, h:i A') }}</div>
                                    <div class="text-muted small">{{ $solution->created_at?->diffForHumans() }}</div>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.get-solutions.show', $solution) }}" class="btn btn-sm btn-outline-primary">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">No solution requests found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer">
            {{ $solutions->links() }}
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
