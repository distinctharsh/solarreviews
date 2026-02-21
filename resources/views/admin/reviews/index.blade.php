@extends('admin.layouts.app')

@section('page_title', 'Reviews')

@section('content')
<div class="content-header">
    <div class="content-header-left">
        <h1>Reviews</h1>
        <p class="text-muted">Monitor every review submitted for companies</p>
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
        @if($key === 'company')  <!-- Only show 'companies' stats -->
            <div class="col">
                <div class="stat-card">
                    <div class="stat-label">{{ __('Total Companies') }}</div>
                    <div class="stat-value">{{ number_format($stats['company_count']) }}</div>
                </div>
            </div>
        @endif
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
                        
                        @foreach($reviewableTypes as $key => $meta)
                            @if($key === 'company')  <!-- Only show 'company' type -->
                                <option value="{{ $key }}" @selected($filters['type'] === $key)>
                                    {{ $meta['label_plural'] }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="rating">Rating</label>
                    <select id="rating" name="rating" class="form-control">
                        <option value="" @selected(!$filters['rating'])>All Ratings</option>
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

                <div class="form-group">
                    <label for="date_from">From Date</label>
                    <input
                        type="date"
                        id="date_from"
                        name="date_from"
                        class="form-control"
                        value="{{ $filters['date_from'] }}"
                    >
                </div>

                <div class="form-group">
                    <label for="date_to">To Date</label>
                    <input
                        type="date"
                        id="date_to"
                        name="date_to"
                        class="form-control"
                        value="{{ $filters['date_to'] }}"
                    >
                </div>



                <div class="form-group align-self-end mt-5">
                    <button class="btn btn-primary"><i class="fas fa-filter"></i> Apply</button>
                    <a href="{{ route('admin.reviews.index') }}" class="btn btn-link" style="margin-top: 25px;">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>

@if($isCompanyReviewListing)
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Company</th>
                            <th>Reviewer</th>
                            <th>Rating</th>
                            <th>Review Title</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($companyReviews as $review)
                            <tr>
                                <td>
                                    @php
                                        $companyName = $review->company_id
                                            ? (optional($review->company)->owner_name ?? 'Company')
                                            : ($review->manual_company_name ?? 'Company');
                                    @endphp
                                    <strong>{{ $companyName }}</strong>
                                    @if($review->company_id)
                                        <div class="text-muted small">#{{ $review->company_id }}</div>
                                        @if(optional($review->company)->website_url)
                                            <div class="text-muted small">{{ $review->company->website_url }}</div>
                                        @endif
                                    @else
                                        @if($review->company_url)
                                            <div class="text-muted small">{{ $review->company_url }}</div>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    <div>{{ $review->reviewer_name ?? 'Anonymous' }}</div>
                                    <div class="text-muted small">{{ $review->email ?? '—' }}</div>
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
                                    <strong>{{ $review->review_title ?: '—' }}</strong>
                                    <div class="text-muted small">{{ Str::limit($review->review_text, 80) }}</div>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $review->is_approved ? 'success' : 'warning' }}">
                                        {{ $review->is_approved ? 'Approved' : 'Pending' }}
                                    </span>
                                    <div class="text-muted small">
                                        {{ optional($review->review_date ?? $review->created_at)->format('d M Y') }}
                                    </div>
                                </td>
                                <td class="text-end">
                                    @php
                                        $isDefaultDummyName = !$review->company_id && $review->manual_company_name === 'Other Solar Company';
                                    @endphp
                                    
                                    @if($isDefaultDummyName)
                                        <!-- Show Edit Name button for default dummy company -->
                                        <button type="button" class="btn btn-sm btn-primary" data-edit-company-name="{{ $review->id }}" title="Update company name before approval">
                                            <i class="fas fa-edit"></i> Update Name
                                        </button>
                                    @else
                                        <!-- Show Approve/Reject buttons for real companies or already-named manual companies -->
                                        <form action="{{ route('admin.reviews.company.approve', $review) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success" {{ $review->is_approved ? 'disabled' : '' }}>
                                                Approve
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.reviews.company.reject', $review) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-warning" {{ !$review->is_approved ? 'disabled' : '' }}>
                                                Reject
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-5">
                                    <i class="fas fa-star mb-2"></i>
                                    <p class="mb-0">No company reviews found for the selected filters.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $companyReviews->onEachSide(1)->links('components.admin.pagination') }}
            </div>
        </div>
    </div>

    <!-- Edit Company Name Modal -->
    <div id="editCompanyNameModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Company Name</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editCompanyNameForm" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="companyName">Company Name</label>
                            <input type="text" id="companyName" name="manual_company_name" class="form-control" required>
                            <small class="text-muted">Enter the actual company name</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update & Approve</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@else
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
                {{ $reviews->onEachSide(1)->links('components.admin.pagination') }}
            </div>
        </div>
    </div>
@endif
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

/* Modal Styles */
.modal {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1050;
    width: 100%;
    height: 100%;
    overflow: hidden;
    outline: 0;
}

.modal.show {
    overflow-y: auto;
}

.modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1040;
    width: 100vw;
    height: 100vh;
    background-color: #000;
}

.modal-backdrop.fade {
    opacity: 0;
    transition: opacity 0.15s linear;
}

.modal-backdrop.show {
    opacity: 0.5;
}

.modal-dialog {
    position: relative;
    width: auto;
    margin: auto;
    max-width: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100%;
}

.modal-content {
    position: relative;
    display: flex;
    flex-direction: column;
    width: 100%;
    pointer-events: auto;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 0.3rem;
    outline: 0;
}

.modal-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    padding: 1rem;
    border-bottom: 1px solid #dee2e6;
}

.modal-header .close {
    padding: 0;
    background-color: transparent;
    border: 0;
    font-size: 1.5rem;
    font-weight: 700;
    line-height: 1;
    color: #000;
    opacity: 0.5;
    cursor: pointer;
}

.modal-header .close:hover {
    opacity: 0.75;
}

.modal-body {
    position: relative;
    flex: 1 1 auto;
    padding: 1rem;
}

.modal-footer {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: flex-end;
    padding: 0.75rem;
    border-top: 1px solid #dee2e6;
}

.modal-footer > :not(:last-child) {
    margin-right: 0.25rem;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const modalEl = document.getElementById('editCompanyNameModal');
    const form = document.getElementById('editCompanyNameForm');
    const companyNameInput = document.getElementById('companyName');
    
    function closeModal() {
        modalEl.style.display = 'none';
        modalEl.classList.remove('show');
        modalEl.setAttribute('aria-hidden', 'true');
        
        const backdrop = document.querySelector('.modal-backdrop');
        if (backdrop) {
            backdrop.remove();
        }
        
        document.body.classList.remove('modal-open');
    }
    
    function openModal(reviewId, currentName) {
        // Set current name in input
        companyNameInput.value = currentName;
        
        // Set form action using proper Laravel route
        const baseUrl = '{{ route('admin.reviews.company.update-name', ':id') }}';
        form.action = baseUrl.replace(':id', reviewId);
        
        // Show modal
        modalEl.style.display = 'block';
        modalEl.classList.add('show');
        modalEl.setAttribute('aria-hidden', 'false');
        
        // Add backdrop
        let backdrop = document.querySelector('.modal-backdrop');
        if (!backdrop) {
            backdrop = document.createElement('div');
            backdrop.className = 'modal-backdrop fade show';
            backdrop.addEventListener('click', closeModal);
            document.body.appendChild(backdrop);
        }
        
        document.body.classList.add('modal-open');
        companyNameInput.focus();
    }
    
    // Handle Edit Company Name button clicks
    document.querySelectorAll('[data-edit-company-name]').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const reviewId = this.getAttribute('data-edit-company-name');
            const row = this.closest('tr');
            const companyNameElement = row.querySelector('td strong');
            const currentName = companyNameElement.textContent.trim();
            
            openModal(reviewId, currentName);
        });
    });
    
    // Handle modal close button
    document.querySelectorAll('[data-dismiss="modal"]').forEach(closeBtn => {
        closeBtn.addEventListener('click', function(e) {
            e.preventDefault();
            closeModal();
        });
    });
    
    // Close modal when clicking outside
    modalEl.addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
});
</script>
@endpush
