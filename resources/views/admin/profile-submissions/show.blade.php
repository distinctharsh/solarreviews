@extends('admin.layouts.app')

@section('page_title', 'Review Submission')

@php
    use App\Models\UserProfileSubmission;
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;

    $statusColor = match ($submission->status) {
        UserProfileSubmission::STATUS_APPROVED => 'success',
        UserProfileSubmission::STATUS_NEEDS_CHANGES => 'warning text-dark',
        default => 'secondary',
    };
@endphp

@section('content')
    <div class="submission-header card mb-4">
        <div class="submission-header__background"></div>
        <div class="card-body submission-header__body">
            <div class="submission-header__left">
                <a href="{{ route('admin.profile-submissions.index') }}" class="btn btn-sm btn-link px-0 text-decoration-none text-muted">
                    <i class="fas fa-arrow-left me-1"></i> Back to submissions
                </a>
                <div class="submission-header__identity">
                    <div class="submission-header__avatar">
                        {{ strtoupper(substr($submission->user?->name ?? 'U', 0, 1)) }}
                    </div>
                    <div>
                        <div class="badge bg-light text-dark text-uppercase small mb-2">{{ Str::title($submission->form_type) }} intake</div>
                        <h1 class="submission-header__title">{{ $submission->user?->name ?? 'Unknown user' }}</h1>
                        <p class="text-muted mb-0">{{ $submission->user?->email ?? 'No email available' }}</p>
                    </div>
                </div>
            </div>
            <div class="submission-header__right">
                <span class="badge bg-{{ $statusColor }} submission-status-pill">
                    {{ Str::title(str_replace('_', ' ', $submission->status)) }}
                </span>
                <div class="submission-header__stats">
                    <div>
                        <p class="text-muted mb-1 small text-uppercase">Submitted</p>
                        <p class="mb-0 fw-semibold">{{ $submission->created_at?->format('d M Y · h:i A') ?? '—' }}</p>
                    </div>
                    <div>
                        <p class="text-muted mb-1 small text-uppercase">Last updated</p>
                        <p class="mb-0 fw-semibold">{{ $submission->updated_at?->diffForHumans() ?? '—' }}</p>
                    </div>
                    @if($submission->reviewed_by)
                        <div>
                            <p class="text-muted mb-1 small text-uppercase">Reviewer</p>
                            <p class="mb-0 fw-semibold">{{ $submission->reviewer?->name ?? '—' }}</p>
                            <small class="text-muted">{{ $submission->reviewed_at?->format('d M Y · h:i A') }}</small>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="submission-grid">
        <div class="card submission-card">
            <div class="card-header border-0 pb-0">
                <p class="text-muted text-uppercase small mb-1">Applicant</p>
                <h3 class="card-title mb-0">Snapshot</h3>
            </div>
            <div class="card-body submission-meta">
                <div>
                    <p class="text-muted mb-1">User name</p>
                    <p class="mb-0 fw-semibold">{{ $submission->user?->name ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-muted mb-1">Email</p>
                    <p class="mb-0 fw-semibold">{{ $submission->user?->email ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-muted mb-1">Form type</p>
                    <p class="mb-0 fw-semibold text-capitalize">{{ $submission->form_type }}</p>
                </div>
                <div>
                    <p class="text-muted mb-1">Submission ID</p>
                    <p class="mb-0 fw-semibold">#{{ $submission->id }}</p>
                </div>
            </div>
            <div class="card-footer bg-white border-top-0">
                <div class="d-flex gap-2 flex-wrap">
                    <a href="mailto:{{ $submission->user?->email }}" class="btn btn-sm btn-outline-primary" @empty($submission->user?->email) disabled @endempty>
                        <i class="fas fa-envelope me-1"></i> Email applicant
                    </a>
                    <a href="{{ route('admin.profile-submissions.index') }}" class="btn btn-sm btn-outline-secondary">
                        View all submissions
                    </a>
                </div>
            </div>
        </div>

        <div class="card submission-card submission-review-card">
            <div class="card-header border-0 pb-0 d-flex justify-content-between align-items-start">
                <div>
                    <p class="text-muted text-uppercase small mb-1">Decision</p>
                    <h3 class="card-title mb-0">Review status</h3>
                </div>
                <span class="badge bg-light text-dark">{{ Str::title($submission->form_type) }}</span>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.profile-submissions.update', $submission) }}" class="submission-status-form">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label class="form-label text-muted small text-uppercase">Status</label>
                        <select name="status" class="form-select" required>
                            @foreach($statuses as $status)
                                <option value="{{ $status }}" @selected($submission->status === $status)>{{ Str::title(str_replace('_', ' ', $status)) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-muted small text-uppercase">Reviewer notes</label>
                        <textarea name="review_notes" rows="4" class="form-control" placeholder="Share context for the applicant">{{ old('review_notes', $submission->review_notes) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save me-1"></i>
                        Save decision
                    </button>
                </form>
            </div>
            <div class="card-footer bg-white border-top-0">
                <div class="submission-review-helper">
                    <p class="text-muted small mb-1">Need to request changes?</p>
                    <span class="text-muted small">Select “Needs changes” and outline the gaps above.</span>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4 submission-data-card">
        <div class="card-header d-flex align-items-center justify-content-between border-0 pb-0">
            <div>
                <p class="text-muted text-uppercase small mb-1">Form payload</p>
                <h3 class="card-title mb-0">Submission data</h3>
            </div>
            <span class="badge bg-light text-dark">{{ count($submission->payload ?? []) }} fields</span>
        </div>
        <div class="card-body">
            @if($submission->payload)
                <div class="payload-grid">
                    @foreach($submission->payload as $key => $value)
                        <div class="payload-card">
                            <div class="payload-card__label">{{ Str::headline($key) }}</div>
                            <div class="payload-card__value">
                                @if(is_array($value))
                                    <ul class="payload-card__list">
                                        @foreach($value as $subKey => $subValue)
                                            <li>
                                                <strong>{{ is_int($subKey) ? $subKey + 1 : Str::headline($subKey) }}:</strong>
                                                <span>{{ is_array($subValue) ? json_encode($subValue, JSON_UNESCAPED_UNICODE) : ($subValue ?: '—') }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @elseif((is_string($value) && Storage::disk('public')->exists($value)) || (is_string($value) && Str::startsWith($value, ['http://', 'https://'])))
                                    <a href="{{ Str::startsWith($value, ['http://', 'https://']) ? $value : Storage::url($value) }}" target="_blank" class="btn btn-sm btn-outline-primary w-100">
                                        <i class="fas fa-paperclip me-1"></i>
                                        View attachment
                                    </a>
                                @elseif(is_string($value) && Str::endsWith($value, ['.pdf', '.png', '.jpg', '.jpeg']))
                                    <a href="{{ Storage::url($value) }}" target="_blank" class="btn btn-sm btn-outline-primary w-100">
                                        <i class="fas fa-paperclip me-1"></i>
                                        View attachment
                                    </a>
                                @else
                                    <span>{{ $value ?: '—' }}</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center text-muted py-5">
                    <i class="fas fa-inbox mb-2 d-block"></i>
                    No payload recorded.
                </div>
            @endif
        </div>
    </div>
@endsection

@push('styles')
<style>
.submission-header {
    position: relative;
    overflow: hidden;
}
.submission-header__background {
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at top right, rgba(59,130,246,0.08), transparent),
                radial-gradient(circle at bottom left, rgba(16,185,129,0.08), transparent);
    pointer-events: none;
}
.submission-header__body {
    position: relative;
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    align-items: center;
    justify-content: space-between;
}
.submission-header__identity {
    display: flex;
    gap: 1rem;
    align-items: center;
    margin-top: 0.5rem;
}
.submission-header__avatar {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    background: #f1f5f9;
    color: #0f172a;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 1.25rem;
}
.submission-header__title {
    margin-bottom: 0.25rem;
    font-size: 1.5rem;
    font-weight: 600;
}
.submission-header__right {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}
.submission-status-pill {
    font-size: 0.85rem;
    padding: 0.45rem 0.85rem;
    border-radius: 999px;
}
.submission-header__stats {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
}
.submission-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
}
.submission-meta {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 1rem;
}
.submission-review-card {
    border: 1px solid #e2e8f0;
    box-shadow: 0 10px 30px rgba(15,23,42,0.08);
}
.submission-data-card {
    border: 1px solid #e2e8f0;
}
.payload-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1rem;
}
.payload-card {
    border: 1px solid #e5e7eb;
    border-radius: 0.85rem;
    padding: 1rem;
    background: #fdfdfd;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    min-height: 160px;
}
.payload-card__label {
    text-transform: uppercase;
    font-size: 0.72rem;
    letter-spacing: 0.08em;
    color: #94a3b8;
    font-weight: 600;
}
.payload-card__value {
    font-weight: 600;
    color: #0f172a;
    font-size: 0.95rem;
    word-break: break-word;
}
.payload-card__list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}
.payload-card__list li {
    font-size: 0.88rem;
    font-weight: 500;
    color: #0f172a;
}
.payload-card__list strong {
    color: #475569;
    font-size: 0.78rem;
    font-weight: 600;
    margin-right: 0.4rem;
}
.submission-card .card-header {
    border-bottom: 1px solid #e5e7eb;
}
.submission-status-form textarea {
    resize: vertical;
}
@media (max-width: 768px) {
    .submission-header__body {
        flex-direction: column;
        align-items: flex-start;
    }
    .submission-header__stats {
        flex-direction: column;
        gap: 0.5rem;
    }
    .payload-row {
        grid-template-columns: 1fr;
    }
}
</style>
@endpush
