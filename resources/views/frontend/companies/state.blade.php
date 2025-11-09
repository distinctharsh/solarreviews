@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Solar Companies in {{ $state['name'] }}</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold mb-3">Top Solar Companies in {{ $state['name'] }}</h1>
        <p class="lead text-muted">Compare the best solar installation companies in {{ $state['name'] }} based on verified customer reviews and ratings.</p>
    </div>

    <!-- Sorting and Filtering -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="d-flex align-items-center">
                <span class="me-2">Sort by:</span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-outline-primary active">Highest Rated</button>
                    <button type="button" class="btn btn-outline-primary">Most Reviews</button>
                    <button type="button" class="btn btn-outline-primary">Alphabetical</button>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-md-end">
            <div class="input-group" style="max-width: 300px; margin-left: auto;">
                <input type="text" class="form-control" placeholder="Search companies...">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Companies List -->
    <div class="row g-4">
        @forelse($companies as $company)
            <div class="col-12">
                <div class="card shadow-sm h-100">
                    <div class="row g-0">
                        <div class="col-md-2 d-flex align-items-center justify-content-center p-3 bg-light">
                            @if($company['logo'])
                                <img src="{{ $company['logo'] }}" class="img-fluid" alt="{{ $company['name'] }}" style="max-height: 80px; width: auto;">
                            @else
                                <div class="text-center">
                                    <i class="fas fa-solar-panel fa-3x text-muted"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h3 class="h5 mb-0">
                                        <a href="{{ route('company.show', ['state' => $state['slug'], 'company' => $company['slug']]) }}" class="text-decoration-none">
                                            {{ $company['name'] }}
                                        </a>
                                    </h3>
                                    <div class="rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $company['average_rating'])
                                                <i class="fas fa-star text-warning"></i>
                                            @elseif($i - 0.5 <= $company['average_rating'])
                                                <i class="fas fa-star-half-alt text-warning"></i>
                                            @else
                                                <i class="far fa-star text-warning"></i>
                                            @endif
                                        @endfor
                                        <span class="ms-1">{{ number_format($company['average_rating'], 1) }}</span>
                                        <small class="text-muted">({{ $company['total_reviews'] }} reviews)</small>
                                    </div>
                                </div>
                                
                                <p class="text-muted mb-2">
                                    <i class="fas fa-map-marker-alt me-1"></i> {{ $company['city'] }}, {{ $state['name'] }}
                                </p>
                                
                                @if($company['website'])
                                    <p class="mb-2">
                                        <i class="fas fa-globe me-1"></i> 
                                        <a href="{{ $company['website'] }}" target="_blank" class="text-decoration-none">
                                            {{ parse_url($company['website'], PHP_URL_HOST) }}
                                        </a>
                                    </p>
                                @endif
                                
                                @if($company['featured_review'])
                                    <div class="mt-3 p-3 bg-light rounded">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="me-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $company['featured_review']['rating'])
                                                        <i class="fas fa-star text-warning"></i>
                                                    @else
                                                        <i class="far fa-star text-warning"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <strong class="me-2">{{ $company['featured_review']['reviewer_name'] }}</strong>
                                            <small class="text-muted">{{ $company['featured_review']['date'] }}</small>
                                        </div>
                                        <p class="mb-0">"{{ Str::limit($company['featured_review']['review_text'], 150) }}"</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-items-center justify-content-center p-3 border-start">
                            <div class="text-center">
                                <div class="display-6 fw-bold text-primary">{{ number_format($company['average_rating'], 1) }}</div>
                                <div class="text-warning mb-2">
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
                                <p class="text-muted mb-3">{{ $company['total_reviews'] }} verified reviews</p>
                                <a href="{{ route('company.show', ['state' => $state['slug'], 'company' => $company['slug']]) }}" 
                                   class="btn btn-primary">
                                    View Company
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-building fa-3x text-muted mb-3"></i>
                    <h3>No companies found in {{ $state['name'] }}</h3>
                    <p class="text-muted">Check back later or view companies in other states.</p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if(method_exists($companies, 'links'))
        <div class="d-flex justify-content-center mt-5">
            {{ $companies->links() }}
        </div>
    @endif

    <!-- Call to Action -->
    <div class="card bg-light mt-5">
        <div class="card-body text-center p-5">
            <h2 class="h3 mb-3">Can't find your company?</h2>
            <p class="lead mb-4">Add your company to our directory and start receiving reviews from your customers.</p>
            <a href="#" class="btn btn-primary btn-lg">List Your Company</a>
        </div>
    </div>
</div>

<!-- How It Works Section -->
<section class="bg-light py-5 mt-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="h1">How It Works</h2>
            <p class="lead text-muted">Find the best solar company for your needs</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 text-center p-4">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center" 
                         style="width: 80px; height: 80px; margin: 0 auto 1.5rem;">
                        <i class="fas fa-search fa-2x"></i>
                    </div>
                    <h3 class="h5">1. Search Companies</h3>
                    <p class="text-muted mb-0">Browse and compare top-rated solar companies in your area.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 text-center p-4">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center" 
                         style="width: 80px; height: 80px; margin: 0 auto 1.5rem;">
                        <i class="fas fa-file-invoice-dollar fa-2x"></i>
                    </div>
                    <h3 class="h5">2. Get Quotes</h3>
                    <p class="text-muted mb-0">Request free quotes from multiple installers.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 text-center p-4">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center" 
                         style="width: 80px; height: 80px; margin: 0 auto 1.5rem;">
                        <i class="fas fa-solar-panel fa-2x"></i>
                    </div>
                    <h3 class="h5">3. Go Solar</h3>
                    <p class="text-muted mb-0">Choose the best option and start saving with solar energy.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
