@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('state.companies', $company['state']['slug']) }}">Solar Companies in {{ $company['state']['name'] }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $company['name'] }}</li>
        </ol>
    </nav>

    <!-- Company Header -->
    <div class="row mb-5">
        <div class="col-md-8">
            <div class="d-flex align-items-start">
                @if($company['logo'])
                    <img src="{{ $company['logo'] }}" alt="{{ $company['name'] }}" class="rounded me-4" style="width: 120px; height: auto;">
                @endif
                <div>
                    <h1 class="h2 mb-2">{{ $company['name'] }}</h1>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-3">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $company['average_rating'])
                                    <i class="fas fa-star text-warning"></i>
                                @elseif($i - 0.5 <= $company['average_rating'])
                                    <i class="fas fa-star-half-alt text-warning"></i>
                                @else
                                    <i class="far fa-star text-warning"></i>
                                @endif
                            @endfor
                            <span class="ms-1 fw-bold">{{ number_format($company['average_rating'], 1) }}</span>
                            <span class="text-muted ms-1">({{ $company['total_reviews'] }} reviews)</span>
                        </div>
                        <div class="badge bg-success">
                            <i class="fas fa-check-circle me-1"></i> Verified Company
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <div class="text-muted">
                            <i class="fas fa-map-marker-alt me-1"></i> {{ $company['address'] }}, {{ $company['city'] }}, {{ $company['state']['name'] }}
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-3">
                        @if($company['website'])
                            <a href="{{ $company['website'] }}" target="_blank" class="text-decoration-none">
                                <i class="fas fa-globe me-1"></i> Website
                            </a>
                        @endif
                        @if($company['phone'])
                            <a href="tel:{{ $company['phone'] }}" class="text-decoration-none">
                                <i class="fas fa-phone me-1"></i> {{ $company['phone'] }}
                            </a>
                        @endif
                        @if($company['email'])
                            <a href="mailto:{{ $company['email'] }}" class="text-decoration-none">
                                <i class="fas fa-envelope me-1"></i> Email
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="display-4 fw-bold text-primary mb-2">{{ number_format($company['average_rating'], 1) }}/5</div>
                    <div class="text-warning mb-3">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $company['average_rating'])
                                <i class="fas fa-star"></i>
                            @elseif($i - 0.5 <= $company['average_rating'])
                                <i class="fas fa-star-half-alt"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif
                        @endfor
                    </div>
                    <p class="text-muted mb-3">Based on {{ $company['total_reviews'] }} verified reviews</p>
                    <a href="#write-review" class="btn btn-primary w-100 mb-2">
                        <i class="far fa-edit me-1"></i> Write a Review
                    </a>
                    <a href="#" class="btn btn-outline-primary w-100">
                        <i class="fas fa-phone-alt me-1"></i> Request a Quote
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Left Column -->
        <div class="col-lg-8">
            <!-- About Company -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h2 class="h5 mb-4">About {{ $company['name'] }}</h2>
                    @if($company['description'])
                        <div class="mb-4">
                            {!! nl2br(e($company['description'])) !!}
                        </div>
                    @else
                        <div class="alert alert-info">
                            No description available for this company.
                        </div>
                    @endif

                    <h3 class="h6 mb-3">Services Offered</h3>
                    <div class="row g-2 mb-4">
                        <div class="col-6 col-md-4">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Solar Panel Installation</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>Battery Storage</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span>EV Chargers</span>
                            </div>
                        </div>
                    </div>

                    <h3 class="h6 mb-3">Service Areas</h3>
                    <p>Serving {{ $company['city'] }} and surrounding areas in {{ $company['state']['name'] }}.</p>
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="card shadow-sm mb-4" id="reviews">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="h5 mb-0">Customer Reviews</h2>
                        <a href="#write-review" class="btn btn-sm btn-outline-primary">
                            <i class="far fa-edit me-1"></i> Write a Review
                        </a>
                    </div>

                    <!-- Review Filters -->
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-secondary btn-sm active">All Reviews ({{ $company['total_reviews'] }})</button>
                            @for($i = 5; $i >= 1; $i--)
                                <button type="button" class="btn btn-outline-secondary btn-sm">
                                    {{ $i }} Star{{ $i > 1 ? 's' : '' }} ({{ $rating_distribution[$i] ?? 0 }})
                                </button>
                            @endfor
                        </div>
                    </div>

                    <!-- Review List -->
                    @forelse($reviews as $review)
                        <div class="border-bottom pb-4 mb-4 {{ $review['is_featured'] ? 'featured-review' : '' }}">
                            @if($review['is_featured'])
                                <div class="d-flex align-items-center mb-2">
                                    <span class="badge bg-warning text-dark me-2">
                                        <i class="fas fa-star"></i> Featured
                                    </span>
                                    <small class="text-muted">This review was selected by our team</small>
                                </div>
                            @endif
                            
                            <div class="d-flex justify-content-between mb-2">
                                <div>
                                    <h5 class="mb-1">{{ $review['reviewer_name'] }}</h5>
                                    <div class="text-warning mb-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review['rating'])
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                        <span class="text-muted ms-1">{{ $review['date'] }}</span>
                                    </div>
                                </div>
                                <div>
                                    <span class="badge bg-light text-dark">
                                        <i class="fab fa-{{ strtolower($review['source']) }} me-1"></i> {{ $review['source'] }}
                                    </span>
                                </div>
                            </div>
                            
                            <p class="mb-2">{{ $review['review_text'] }}</p>
                            
                            <div class="d-flex gap-2">
                                <button class="btn btn-sm btn-outline-secondary">
                                    <i class="far fa-thumbs-up"></i> Helpful ({{ rand(0, 10) }})
                                </button>
                                <button class="btn btn-sm btn-outline-secondary">
                                    <i class="far fa-flag"></i> Report
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <i class="far fa-comment-alt fa-3x text-muted mb-3"></i>
                            <h5>No reviews yet</h5>
                            <p class="text-muted">Be the first to review {{ $company['name'] }}</p>
                            <a href="#write-review" class="btn btn-primary">
                                <i class="far fa-edit me-1"></i> Write a Review
                            </a>
                        </div>
                    @endforelse

                    <!-- Pagination -->
                    @if(count($reviews) > 5)
                        <nav aria-label="Reviews pagination" class="mt-4">
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    @endif
                </div>
            </div>

            <!-- Write Review Form -->
            <div class="card shadow-sm mb-4" id="write-review">
                <div class="card-body">
                    <h2 class="h5 mb-4">Write a Review</h2>
                    <form action="#" method="POST">
                        @csrf
                        <input type="hidden" name="company_id" value="{{ $company['id'] }}">
                        
                        <div class="mb-4">
                            <label class="form-label">Your Rating</label>
                            <div class="rating-input mb-2">
                                <input type="radio" id="star5" name="rating" value="5" required>
                                <label for="star5" title="5 stars"><i class="fas fa-star"></i></label>
                                
                                <input type="radio" id="star4" name="rating" value="4" required>
                                <label for="star4" title="4 stars"><i class="fas fa-star"></i></label>
                                
                                <input type="radio" id="star3" name="rating" value="3" required>
                                <label for="star3" title="3 stars"><i class="fas fa-star"></i></label>
                                
                                <input type="radio" id="star2" name="rating" value="2" required>
                                <label for="star2" title="2 stars"><i class="fas fa-star"></i></label>
                                
                                <input type="radio" id="star1" name="rating" value="1" required>
                                <label for="star1" title="1 star"><i class="fas fa-star"></i></label>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="review_title" class="form-label">Review Title</label>
                            <input type="text" class="form-control" id="review_title" name="title" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="review_text" class="form-label">Your Review</label>
                            <textarea class="form-control" id="review_text" name="review_text" rows="5" required></textarea>
                            <div class="form-text">Share details about your experience with {{ $company['name'] }}.</div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="reviewer_name" class="form-label">Your Name</label>
                                <input type="text" class="form-control" id="reviewer_name" name="reviewer_name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="reviewer_email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="reviewer_email" name="reviewer_email" required>
                                <div class="form-text">Your email will not be published.</div>
                            </div>
                        </div>
                        
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="terms" required>
                            <label class="form-check-label" for="terms">
                                I certify that this review is based on my own experience and is my genuine opinion of this company.
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-1"></i> Submit Review
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-lg-4">
            <!-- Rating Breakdown -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h3 class="h6 mb-3">Rating Breakdown</h3>
                    @for($i = 5; $i >= 1; $i--)
                        <div class="row align-items-center mb-2">
                            <div class="col-2 text-end">
                                <span class="text-muted">{{ $i }} <i class="fas fa-star text-warning"></i></span>
                            </div>
                            <div class="col-7 px-0">
                                <div class="progress" style="height: 8px;">
                                    @php
                                        $percentage = $company['total_reviews'] > 0 
                                            ? ($rating_distribution[$i] / $company['total_reviews']) * 100 
                                            : 0;
                                    @endphp
                                    <div class="progress-bar bg-warning" role="progressbar" 
                                         style="width: {{ $percentage }}%" 
                                         aria-valuenow="{{ $percentage }}" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <small class="text-muted">{{ $rating_distribution[$i] ?? 0 }}</small>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Company Information -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h3 class="h6 mb-3">Company Information</h3>
                    <ul class="list-unstyled mb-0">
                        @if($company['address'])
                            <li class="mb-2">
                                <i class="fas fa-map-marker-alt text-muted me-2"></i>
                                {{ $company['address'] }}, {{ $company['city'] }}, {{ $company['state']['name'] }}
                            </li>
                        @endif
                        @if($company['phone'])
                            <li class="mb-2">
                                <i class="fas fa-phone text-muted me-2"></i>
                                <a href="tel:{{ $company['phone'] }}" class="text-decoration-none">{{ $company['phone'] }}</a>
                            </li>
                        @endif
                        @if($company['email'])
                            <li class="mb-2">
                                <i class="fas fa-envelope text-muted me-2"></i>
                                <a href="mailto:{{ $company['email'] }}" class="text-decoration-none">{{ $company['email'] }}</a>
                            </li>
                        @endif
                        @if($company['website'])
                            <li class="mb-2">
                                <i class="fas fa-globe text-muted me-2"></i>
                                <a href="{{ $company['website'] }}" target="_blank" class="text-decoration-none">
                                    {{ parse_url($company['website'], PHP_URL_HOST) }}
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

            <!-- Similar Companies -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="h6 mb-3">Similar Companies</h3>
                    <div class="list-group list-group-flush">
                        @for($i = 1; $i <= 3; $i++)
                            <a href="#" class="list-group-item list-group-item-action border-0 px-0 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" 
                                             style="width: 40px; height: 40px;">
                                            <i class="fas fa-solar-panel text-muted"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0">Solar Company {{ $i }}</h6>
                                            <small class="text-warning">
                                                <i class="fas fa-star"></i> {{ rand(35, 50) / 10 }}
                                            </small>
                                        </div>
                                        <small class="text-muted">{{ $company['city'] }}, {{ $company['state']['name'] }}</small>
                                    </div>
                                </div>
                            </a>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Call to Action -->
<section class="bg-primary text-white py-5">
    <div class="container text-center">
        <h2 class="h3 mb-3">Ready to go solar with {{ $company['name'] }}?</h2>
        <p class="lead mb-4">Get a free, no-obligation quote today and start saving on your energy bills.</p>
        <a href="#" class="btn btn-light btn-lg px-4 me-2">
            <i class="fas fa-phone-alt me-2"></i> Call Now
        </a>
        <a href="#" class="btn btn-outline-light btn-lg px-4">
            <i class="fas fa-envelope me-2"></i> Email Us
        </a>
    </div>
</section>

@push('styles')
<style>
    .featured-review {
        background-color: #f8f9fa;
        border-left: 4px solid #ffc107;
        padding-left: 1rem;
        margin-left: -1rem;
    }
    
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
    .rating-input label:hover ~ label,
    .rating-input input:checked ~ label:hover,
    .rating-input input:checked ~ label:hover ~ label {
        color: #ffc107;
    }
    
    .progress {
        background-color: #e9ecef;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                    
                    // Update URL without page reload
                    history.pushState(null, '', targetId);
                }
            });
        });
    });
</script>
@endpush
@endsection
