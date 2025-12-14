@extends('admin.layouts.app')

@section('page_title', 'Profile Submissions')

@php
    use App\Models\UserProfileSubmission;
@endphp

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h2 class="card-title mb-0">Profile Submissions</h2>
                <p class="text-muted small mb-0">Review distributor / supplier onboarding forms.</p>
            </div>
            <form method="GET" class="d-flex gap-2 flex-wrap">
                <select name="status" class="form-select">
                    <option value="">All statuses</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status }}" @selected($filters['status'] === $status)>{{ Str::title(str_replace('_', ' ', $status)) }}</option>
                    @endforeach
                </select>
                <select name="form_type" class="form-select">
                    <option value="">All form types</option>
                    <option value="{{ UserProfileSubmission::FORM_DISTRIBUTOR }}" @selected($filters['form_type'] === UserProfileSubmission::FORM_DISTRIBUTOR)>Distributor</option>
                    <option value="{{ UserProfileSubmission::FORM_SUPPLIER }}" @selected($filters['form_type'] === UserProfileSubmission::FORM_SUPPLIER)>Supplier</option>
                </select>
                <div class="input-group">
                    <input type="search" name="search" class="form-control" placeholder="Search user" value="{{ $filters['search'] }}">
                    <button class="btn btn-primary" type="submit">Filter</button>
                </div>
            </form>
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
