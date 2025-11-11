@extends('admin.layouts.app')

@section('content')
<div class="admin-reviews-container">
    <!-- Header Section -->
    <div class="reviews-header">
        <h1>Customer Reviews</h1>
        <div class="header-actions">
            <button class="btn-filter" data-bs-toggle="modal" data-bs-target="#filterModal">
                <i class="fas fa-filter"></i> Filter
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Reviews Table -->
    <div class="reviews-table-container">
        <table class="reviews-table">
            <thead>
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
                        <td class="reviewer-cell">
                            <div class="reviewer-avatar">
                                {{ strtoupper(substr($review->reviewer_name, 0, 1)) }}
                            </div>
                            <div class="reviewer-info">
                                <div class="reviewer-name">{{ $review->reviewer_name }}</div>
                                <small class="reviewer-source">{{ $review->source }}</small>
                            </div>
                        </td>
                        <td class="company-cell">
                            <a href="{{ route('admin.companies.edit', $review->company) }}" class="company-link">
                                {{ Str::limit($review->company->name, 20) }}
                            </a>
                        </td>
                        <td class="rating-cell">
                            <div class="star-rating">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="star {{ $i <= $review->rating ? 'filled' : '' }}">★</span>
                                @endfor
                            </div>
                        </td>
                        <td class="review-cell">
                            <div class="review-text" title="{{ strip_tags($review->review_text) }}">
                                {{ Str::limit(strip_tags($review->review_text), 50) }}
                            </div>
                        </td>
                        <td class="date-cell">
                            {{ $review->review_date->format('M d, Y') }}
                        </td>
                        <td class="status-cell">
                            <span class="status-badge {{ $review->is_featured ? 'featured' : 'standard' }}">
                                {{ $review->is_featured ? 'Featured' : 'Standard' }}
                            </span>
                        </td>
                        <td class="actions-cell">
                            <div class="action-buttons">
                                <!-- <a href="{{ route('admin.reviews.edit', $review) }}" 
                                   class="btn-edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a> -->
                                <button class="btn-feature {{ $review->is_featured ? 'featured' : '' }}"
                                        title="{{ $review->is_featured ? 'Unfeature' : 'Feature' }}"
                                        onclick="toggleFeatured({{ $review->id }})">
                                    <i class="fas fa-star"></i>
                                </button>
                                <form action="{{ route('admin.reviews.destroy', $review) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Are you sure you want to delete this review?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="no-reviews">
                            <div class="no-reviews-content">
                                <i class="fas fa-comment-slash"></i>
                                <p>No reviews found</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($reviews->hasPages())
            <div class="pagination-wrapper">
                {{ $reviews->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Filter Modal (same as before) -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.reviews.index') }}" method="GET">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Filter Reviews</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="filter-group">
                        <label class="filter-label">Rating</label>
                        <div class="rating-filters">
                            @for($i = 5; $i >= 1; $i--)
                                <div class="rating-option">
                                    <input type="checkbox" 
                                           name="rating[]" 
                                           value="{{ $i }}" 
                                           id="rating{{ $i }}"
                                           {{ in_array($i, (array)request('rating', [])) ? 'checked' : '' }}>
                                    <label for="rating{{ $i }}" class="rating-stars">
                                        @for($j = 1; $j <= $i; $j++)
                                            <span class="star filled">★</span>
                                        @endfor
                                    </label>
                                </div>
                            @endfor
                        </div>
                    </div>
                    
                    <div class="filter-group">
                        <div class="form-check">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   name="featured" 
                                   value="1" 
                                   id="featured"
                                   {{ request('featured') ? 'checked' : '' }}>
                            <label class="form-check-label" for="featured">
                                Show Featured Only
                            </label>
                        </div>
                    </div>
                    
                    <div class="date-range">
                        <div class="date-input">
                            <label for="start_date" class="filter-label">From Date</label>
                            <input type="date" 
                                   class="form-control" 
                                   id="start_date" 
                                   name="start_date" 
                                   value="{{ request('start_date') }}">
                        </div>
                        <div class="date-input">
                            <label for="end_date" class="filter-label">To Date</label>
                            <input type="date" 
                                   class="form-control" 
                                   id="end_date" 
                                   name="end_date" 
                                   value="{{ request('end_date') }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-apply">Apply Filters</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Base Styles */
.admin-reviews-container {
    padding: 2rem;
    max-width: 1400px;
    margin: 0 auto;
}

/* Header */
.reviews-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #e5e7eb;
}

.reviews-header h1 {
    font-size: 1.75rem;
    font-weight: 600;
    color: #111827;
    margin: 0;
}

/* Buttons */
.btn-filter {
    background-color: #f3f4f6;
    color: #4b5563;
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    font-weight: 500;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.2s;
}

.btn-filter:hover {
    background-color: #e5e7eb;
}

/* Table Styles */
.reviews-table-container {
    background: white;
    border-radius: 0.5rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.reviews-table {
    width: 100%;
    border-collapse: collapse;
}

.reviews-table th {
    background-color: #f9fafb;
    padding: 1rem 1.5rem;
    text-align: left;
    font-size: 0.75rem;
    font-weight: 600;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border-bottom: 1px solid #e5e7eb;
}

.reviews-table td {
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #f3f4f6;
    vertical-align: middle;
}

.reviews-table tr:last-child td {
    border-bottom: none;
}

.reviews-table tr:hover {
    background-color: #f9fafb;
}

/* Table Cells */
.reviewer-cell {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.reviewer-avatar {
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 50%;
    background-color: #e0f2fe;
    color: #0369a1;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 1rem;
}

.reviewer-info {
    display: flex;
    flex-direction: column;
}

.reviewer-name {
    font-weight: 500;
    color: #111827;
}

.reviewer-source {
    font-size: 0.75rem;
    color: #6b7280;
}

.company-cell .company-link {
    color: #3b82f6;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s;
}

.company-cell .company-link:hover {
    color: #2563eb;
    text-decoration: underline;
}

.star-rating {
    color: #f59e0b;
    font-size: 1rem;
    letter-spacing: 0.1em;
}

.star-rating .star {
    color: #d1d5db;
}

.star-rating .star.filled {
    color: #f59e0b;
}

.review-text {
    max-width: 250px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    color: #4b5563;
}

.status-badge {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 500;
}

.status-badge.standard {
    background-color: #f3f4f6;
    color: #6b7280;
}

.status-badge.featured {
    background-color: #dbeafe;
    color: #1e40af;
}

/* Action Buttons */
.actions-cell .action-buttons {
    display: flex;
    gap: 0.5rem;
}

.btn-edit,
.btn-feature,
.btn-delete {
    width: 2rem;
    height: 2rem;
    border-radius: 0.375rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    border: 1px solid transparent;
    transition: all 0.2s;
}

.btn-edit {
    color: #3b82f6;
    background-color: #eff6ff;
    border-color: #dbeafe;
}

.btn-edit:hover {
    background-color: #dbeafe;
}

.btn-feature {
    color: #f59e0b;
    background-color: #fffbeb;
    border-color: #fef3c7;
}

.btn-feature.featured {
    background-color: #fef3c7;
}

.btn-feature:hover {
    background-color: #fef3c7;
}

.btn-delete {
    color: #ef4444;
    background-color: #fef2f2;
    border-color: #fee2e2;
}

.btn-delete:hover {
    background-color: #fee2e2;
}

/* No Reviews */
.no-reviews {
    padding: 3rem 1rem;
    text-align: center;
}

.no-reviews-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
    color: #9ca3af;
}

.no-reviews-content i {
    font-size: 2rem;
    opacity: 0.5;
}

/* Pagination */
.pagination-wrapper {
    padding: 1.5rem;
    display: flex;
    justify-content: center;
}

.pagination {
    display: flex;
    gap: 0.5rem;
}

.pagination .page-item .page-link {
    padding: 0.5rem 0.75rem;
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    color: #4b5563;
    text-decoration: none;
    transition: all 0.2s;
}

.pagination .page-item.active .page-link {
    background-color: #3b82f6;
    border-color: #3b82f6;
    color: white;
}

.pagination .page-item:not(.disabled) .page-link:hover {
    background-color: #f3f4f6;
}

/* Modal Styles */
.modal-content {
    border: none;
    border-radius: 0.5rem;
    overflow: hidden;
}

.modal-header {
    background-color: #f9fafb;
    border-bottom: 1px solid #e5e7eb;
    padding: 1.25rem 1.5rem;
}

.modal-title {
    font-weight: 600;
    color: #111827;
    margin: 0;
}

.modal-body {
    padding: 1.5rem;
}

.modal-footer {
    background-color: #f9fafb;
    border-top: 1px solid #e5e7eb;
    padding: 1.25rem 1.5rem;
    display: flex;
    justify-content: flex-end;
    gap: 0.75rem;
}

/* Filter Form */
.filter-group {
    margin-bottom: 1.5rem;
}

.filter-label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: #374151;
}

.rating-filters {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
}

.rating-option {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.rating-stars {
    color: #f59e0b;
    cursor: pointer;
}

.date-range {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.date-input {
    display: flex;
    flex-direction: column;
}

.form-control {
    padding: 0.5rem 0.75rem;
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    font-size: 0.875rem;
    transition: border-color 0.2s;
}

.form-control:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

/* Buttons */
.btn-cancel,
.btn-apply {
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
    font-weight: 500;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-cancel {
    background-color: #f3f4f6;
    color: #4b5563;
    border: 1px solid #d1d5db;
}

.btn-cancel:hover {
    background-color: #e5e7eb;
}

.btn-apply {
    background-color: #3b82f6;
    color: white;
    border: 1px solid #3b82f6;
}

.btn-apply:hover {
    background-color: #2563eb;
    border-color: #2563eb;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .reviews-table th,
    .reviews-table td {
        padding: 0.75rem;
    }
    
    .reviewer-cell {
        min-width: 200px;
    }
    
    .review-text {
        max-width: 200px;
    }
}

@media (max-width: 768px) {
    .admin-reviews-container {
        padding: 1rem;
    }
    
    .reviews-table {
        display: block;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    
    .date-range {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 640px) {
    .reviews-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .header-actions {
        width: 100%;
    }
    
    .btn-filter {
        width: 100%;
        justify-content: center;
    }
}
</style>

<script>
function toggleFeatured(reviewId) {
    // Toggle featured status via AJAX
    fetch(`/admin/reviews/${reviewId}/toggle-featured`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
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

// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
@endsection