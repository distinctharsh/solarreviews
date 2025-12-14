@extends('admin.layouts.app')

@section('page_title', 'Review Submission')

@php
    use App\Models\UserProfileSubmission;
@endphp

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.profile-submissions.index') }}" class="btn btn-link p-0">
            ← Back to submissions
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Submitted Data</h3>
                </div>
                <div class="card-body">
                    @forelse($submission->payload ?? [] as $key => $value)
                        <div class="mb-3">
                            <p class="text-muted text-uppercase small mb-1">{{ Str::headline($key) }}</p>
                            @if(is_array($value))
                                <pre class="bg-light p-3 rounded">{{ json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                            @elseif(Str::endsWith($value, ['.pdf', '.png', '.jpg', '.jpeg']))
                                <a href="{{ Storage::url($value) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                    View file
                                </a>
                            @else
                                <p class="mb-0">{{ $value }}</p>
                            @endif
                        </div>
                    @empty
                        <p class="text-muted">No payload recorded.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title mb-0">Meta</h3>
                </div>
                <div class="card-body">
                    <dl class="mb-0">
                        <dt>User</dt>
                        <dd>{{ $submission->user?->name }} <small class="text-muted d-block">{{ $submission->user?->email }}</small></dd>
                        <dt class="mt-3">Form Type</dt>
                        <dd class="text-capitalize">{{ $submission->form_type }}</dd>
                        <dt class="mt-3">Submitted</dt>
                        <dd>{{ $submission->created_at?->format('d M Y, h:i A') }}</dd>
                        <dt class="mt-3">Status</dt>
                        <dd>
                            <span class="badge bg-{{ $submission->status === UserProfileSubmission::STATUS_APPROVED ? 'success' : ($submission->status === UserProfileSubmission::STATUS_NEEDS_CHANGES ? 'warning text-dark' : 'secondary') }}">
                                {{ Str::title(str_replace('_', ' ', $submission->status)) }}
                            </span>
                        </dd>
                        @if($submission->reviewed_by)
                            <dt class="mt-3">Reviewed by</dt>
                            <dd>{{ $submission->reviewer?->name }} <small class="text-muted d-block">{{ $submission->reviewed_at?->diffForHumans() }}</small></dd>
                        @endif
                    </dl>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Update Status</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.profile-submissions.update', $submission) }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                @foreach($statuses as $status)
                                    <option value="{{ $status }}" @selected($submission->status === $status)>{{ Str::title(str_replace('_', ' ', $status)) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Review notes</label>
                            <textarea name="review_notes" rows="4" class="form-control" placeholder="Add reviewer notes (optional)">{{ old('review_notes', $submission->review_notes) }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
