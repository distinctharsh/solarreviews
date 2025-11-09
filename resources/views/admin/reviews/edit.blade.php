@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Edit Review</h1>
        <div>
            <a href="{{ route('admin.reviews.index') }}" class="btn btn-outline-secondary me-2">
                <i class="fas fa-arrow-left"></i> Back to Reviews
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-body">
                    <form action="{{ route('admin.reviews.update', $review) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="reviewer_name" class="form-label">Reviewer Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('reviewer_name') is-invalid @enderror" 
                                           id="reviewer_name" name="reviewer_name" 
                                           value="{{ old('reviewer_name', $review->reviewer_name) }}" required>
                                    @error('reviewer_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="source" class="form-label">Source <span class="text-danger">*</span></label>
                                    <select class="form-select @error('source') is-invalid @enderror" 
                                            id="source" name="source" required>
                                        <option value="" disabled>Select Source</option>
                                        <option value="Google" {{ old('source', $review->source) == 'Google' ? 'selected' : '' }}>Google</option>
                                        <option value="Facebook" {{ old('source', $review->source) == 'Facebook' ? 'selected' : '' }}>Facebook</option>
                                        <option value="Yelp" {{ old('source', $review->source) == 'Yelp' ? 'selected' : '' }}>Yelp</option>
                                        <option value="Website" {{ old('source', $review->source) == 'Website' ? 'selected' : '' }}>Our Website</option>
                                        <option value="Other" {{ old('source', $review->source) == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('source')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="review_date" class="form-label">Review Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('review_date') is-invalid @enderror" 
                                           id="review_date" name="review_date" 
                                           value="{{ old('review_date', $review->review_date->format('Y-m-d')) }}" required>
                                    @error('review_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="rating" class="form-label">Rating <span class="text-danger">*</span></label>
                                    <div class="rating-input">
                                        @for($i = 5; $i >= 1; $i--)
                                            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" 
                                                   {{ (int)old('rating', $review->rating) === $i ? 'checked' : '' }}>
                                            <label for="star{{ $i }}" title="{{ $i }} stars">
                                                <i class="fas fa-star"></i>
                                            </label>
                                        @endfor
                                    </div>
                                    @error('rating')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="review_text" class="form-label">Review Text <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('review_text') is-invalid @enderror" 
                                      id="review_text" name="review_text" rows="5" required>{{ old('review_text', $review->review_text) }}</textarea>
                            @error('review_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" 
                                   value="1" {{ old('is_featured', $review->is_featured) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">Featured Review</label>
                            <div class="form-text">Featured reviews will be highlighted on the website.</div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Update Review
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Review Details</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" 
                                 style="width: 48px; height: 48px; font-size: 1.25rem;">
                                {{ strtoupper(substr($review->reviewer_name, 0, 1)) }}
                            </div>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0">{{ $review->reviewer_name }}</h6>
                            <small class="text-muted">{{ $review->source }}</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <h6>Company</h6>
                        <p class="mb-0">
                            <a href="{{ route('admin.companies.edit', $review->company) }}" class="text-decoration-none">
                                {{ $review->company->name }}
                            </a>
                        </p>
                    </div>

                    <div class="mb-3">
                        <h6>Rating</h6>
                        <div class="text-warning">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $review->rating)
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                            <span class="ms-1">{{ $review->rating }}.0</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <h6>Status</h6>
                        <span class="badge bg-{{ $review->is_featured ? 'success' : 'secondary' }}">
                            {{ $review->is_featured ? 'Featured' : 'Standard' }}
                        </span>
                    </div>

                    <div class="mb-3">
                        <h6>Date</h6>
                        <p class="mb-0">{{ $review->review_date->format('F j, Y') }}</p>
                    </div>

                    <div class="d-grid gap-2">
                        <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" 
                              onsubmit="return confirm('Are you sure you want to delete this review?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger w-100">
                                <i class="fas fa-trash me-1"></i> Delete Review
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .rating-input {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
    }
    
    .rating-input input {
        display: none;
    }
    
    .rating-input label {
        color: #ddd;
        font-size: 1.5rem;
        padding: 0 0.2rem;
        cursor: pointer;
    }
    
    .rating-input input:checked ~ label,
    .rating-input input:checked ~ label ~ label {
        color: #ffc107;
    }
    
    .rating-input label:hover,
    .rating-input label:hover ~ label {
        color: #ffc107;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize any JavaScript here if needed
    });
</script>
@endpush

@endsection
