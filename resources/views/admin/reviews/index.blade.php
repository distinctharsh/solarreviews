@extends('admin.layouts.app')

@section('page_title', 'Reviews')

@section('content')
<div class="content-header">
    <div class="content-header-left">
        <h1>Reviews</h1>
        <p class="text-muted">Monitor every review submitted for companies, brands, and products</p>
    </div>
</div>

<div class="row stats-row">
    <div class="col">
        <div class="stat-card">
            <div class="stat-label">{{ __('Total Reviews') }}</div>
            <div class="stat-value">{{ number_format($stats['total']) }}</div>
        </div>
    </div>
    @foreach($reviewableTypes as $key => $meta)
        <div class="col">
            <div class="stat-card">
                <div class="stat-label">{{ $meta['label_plural'] }}</div>
                <div class="stat-value">{{ number_format($stats['by_type'][$key] ?? 0) }}</div>
            </div>
        </div>
    @endforeach
</div>

<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Filters</h3>
    </div>
    <div class="card-body">
        <form method="GET" class="filters-form">
            <div class="filters-grid">
                <div class="form-group">
                    <label for="type">Review Type</label>
                    <select id="type" name="type" class="form-control">
                        <option value="">All Types</option>
                        @foreach($reviewableTypes as $key => $meta)
                            <option value="{{ $key }}" @selected($filters['type'] === $key)>
                                {{ $meta['label_plural'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="rating">Rating</label>
                    <select id="rating" name="rating" class="form-control">
                        <option value="">All Ratings</option>
                        @for($i = 5; $i >= 1; $i--)
                            <option value="{{ $i }}" @selected((string)$filters['rating'] === (string)$i)>
                                {{ $i }} Stars
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label for="search">Search</label>
                    <input type="text" id="search" name="search" class="form-control"
                           value="{{ $filters['search'] }}" placeholder="Title or comment keywords">
                </div>
                <div class="form-group align-self-end">
                    <button class="btn btn-primary"><i class="fas fa-filter"></i> Apply</button>
                    <a href="{{ route('admin.reviews.index') }}" class="btn btn-link">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Review</th>
                        <th>Rating</th>
                        <th>Reviewable</th>
                        <th>User</th>
                        <th>Submitted</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reviews as $review)
                        <tr>
                            <td>
                                <strong>{{ $review->title ?? 'Untitled' }}</strong>
                                <div class="text-muted small">{{ Str::limit($review->comment, 80) ?: '—' }}</div>
                            </td>
                            <td>
                                <div class="rating-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star{{ $i <= $review->rating ? ' text-warning' : '-o text-muted' }}"></i>
                                    @endfor
                                </div>
                                <div class="small text-muted">{{ $review->rating }} / 5</div>
                            </td>
                            <td>
                                @php
                                    $meta = $reviewableTypeMetaByClass[$review->reviewable_type] ?? null;
                                @endphp
                                <div class="badge badge-light">
                                    {{ optional($meta)['label'] ?? class_basename($review->reviewable_type) }}
                                </div>
                                <div class="text-muted small">
                                    {{ $review->reviewable->name ?? $review->reviewable->owner_name ?? 'N/A' }}
                                </div>
                            </td>
                            <td>
                                <div>{{ $review->user->name ?? 'Guest' }}</div>
                                <div class="text-muted small">{{ $review->user->email ?? '—' }}</div>
                            </td>
                            <td>
                                <div>{{ $review->created_at->format('d M Y') }}</div>
                                <div class="text-muted small">{{ $review->created_at->format('H:i') }}</div>
                            </td>
                            <td class="text-right">
                                <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST"
                                      onsubmit="return confirm('Delete this review?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">
                                <i class="fas fa-star mb-2"></i>
                                <p class="mb-0">No reviews found for the selected filters.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $reviews->links() }}
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.stats-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.stat-card {
    background: #fff;
    border-radius: 12px;
    padding: 1.25rem;
    box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08);
    border: 1px solid #e2e8f0;
}

.stat-label {
    font-size: 0.875rem;
    color: #64748b;
    margin-bottom: 0.35rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.stat-value {
    font-size: 1.75rem;
    font-weight: 600;
    color: #0f172a;
}

.filters-form .filters-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1rem;
}

.rating-stars {
    color: #fbbf24;
}

.badge-light {
    background-color: #f1f5f9;
    color: #475569;
    padding: 0.35rem 0.65rem;
    border-radius: 999px;
    font-size: 0.75rem;
}

.table td {
    vertical-align: middle;
}

.table td .btn {
    margin-bottom: 0;
}
</style>
@endpush
