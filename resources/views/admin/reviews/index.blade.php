@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Customer Reviews</h1>
        <div>
            <a href="#" class="btn btn-outline-secondary me-2" data-bs-toggle="modal" data-bs-target="#filterModal">
                <i class="fas fa-filter"></i> Filter
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Reviewer</th>
                            <th>Company</th>
                            <th>Rating</th>
                            <th>Review</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reviews as $review)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" 
                                                 style="width: 36px; height: 36px;">
                                                {{ strtoupper(substr($review->reviewer_name, 0, 1)) }}
                                            </div>
                                        </div>
                                        <div class="ms-2">
                                            <div class="fw-semibold">{{ $review->reviewer_name }}</div>
                                            <small class="text-muted">{{ $review->source }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('admin.companies.edit', $review->company) }}" class="text-decoration-none">
                                        {{ Str::limit($review->company->name, 20) }}
                                    </a>
                                </td>
                                <td>
                                    <span class="text-warning">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rating)
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                    </span>
                                </td>
                                <td>
                                    <div class="text-truncate" style="max-width: 250px;" 
                                         data-bs-toggle="tooltip" 
                                         title="{{ $review->review_text }}">
                                        {{ Str::limit(strip_tags($review->review_text), 50) }}
                                    </div>
                                </td>
                                <td>
                                    {{ $review->review_date->format('M d, Y') }}
                                </td>
                                <td>
                                    <span class="badge bg-{{ $review->is_featured ? 'success' : 'secondary' }}">
                                        {{ $review->is_featured ? 'Featured' : 'Standard' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.reviews.edit', $review) }}" 
                                           class="btn btn-sm btn-outline-primary"
                                           data-bs-toggle="tooltip"
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-sm {{ $review->is_featured ? 'btn-warning' : 'btn-outline-warning' }}"
                                                data-bs-toggle="tooltip"
                                                title="{{ $review->is_featured ? 'Unfeature' : 'Feature' }}"
                                                onclick="toggleFeatured({{ $review->id }})">
                                            <i class="fas fa-star"></i>
                                        </button>
                                        <form action="{{ route('admin.reviews.destroy', $review) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this review?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-outline-danger"
                                                    data-bs-toggle="tooltip"
                                                    title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="text-muted">No reviews found.</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($reviews->hasPages())
                <div class="d-flex justify-content-center p-3">
                    {{ $reviews->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.reviews.index') }}" method="GET">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Filter Reviews</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Rating</label>
                        <div class="d-flex">
                            @for($i = 5; $i >= 1; $i--)
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="checkbox" 
                                           name="rating[]" value="{{ $i }}" 
                                           id="rating{{ $i }}"
                                           {{ in_array($i, (array)request('rating', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="rating{{ $i }}">
                                        @for($j = 1; $j <= $i; $j++)
                                            <i class="fas fa-star text-warning"></i>
                                        @endfor
                                    </label>
                                </div>
                            @endfor
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" 
                                   name="featured" value="1" 
                                   id="featured"
                                   {{ request('featured') ? 'checked' : '' }}>
                            <label class="form-check-label" for="featured">
                                Featured Only
                            </label>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="start_date" class="form-label">From Date</label>
                                <input type="date" class="form-control" id="start_date" 
                                       name="start_date" value="{{ request('start_date') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="end_date" class="form-label">To Date</label>
                                <input type="date" class="form-control" id="end_date" 
                                       name="end_date" value="{{ request('end_date') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });

    // Toggle featured status
    function toggleFeatured(reviewId) {
        fetch(`/admin/reviews/${reviewId}/toggle-featured`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>
@endpush
@endsection
