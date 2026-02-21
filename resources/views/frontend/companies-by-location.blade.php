@extends('layouts.app')

@section('title', 'Available Companies in Your Area')

@section('content')
<div class="container-custom" style="padding: 60px 0;">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Page Header -->
            <div class="text-center mb-5">
                <h1 class="display-4 fw-bold mb-3">Available Companies in Your Area</h1>
                <p class="lead text-muted">
                    Find trusted solar installation companies near your location
                </p>
            </div>

            <!-- Location Info Card -->
            @if($locationInfo['state'] || $locationInfo['city'] || $locationInfo['pincode'])
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-map-marker-alt text-primary fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Your Location</h6>
                            <p class="mb-0 text-muted">
                                @if($locationInfo['city']){{ $locationInfo['city'] }}@if($locationInfo['state']), {{ $locationInfo['state'] }}@endif@endif
                                @if($locationInfo['pincode']) - {{ $locationInfo['pincode'] }}@endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Companies List -->
            @forelse($companies as $company)
                <div class="row">
                        @if($company['is_subscribed'] == 1)
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 shadow-sm company-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <h5 class="card-title mb-1">{{ $company['name'] }}</h5>
                                            @if($company['city_name'] && $company['city_name'] != 'Unknown')
                                                <p class="text-muted mb-0">
                                                    <i class="fas fa-map-marker-alt me-1"></i>
                                                    {{ $company['city_name'] }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="text-end">
                                            @if($company['logo'])
                                                <img src="{{ $company['logo'] }}" alt="{{ $company['name'] }}" class="company-logo" style="max-width: 60px; max-height: 40px; object-fit: contain;">
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            @if(isset($company['avg_rating']) && $company['avg_rating'] > 0)
                                                <div class="mb-2">
                                                    <span class="text-warning">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            @if($i <= floor($company['avg_rating']))
                                                                <i class="fas fa-star"></i>
                                                            @else
                                                                <i class="far fa-star"></i>
                                                            @endif
                                                        @endfor
                                                    </span>
                                                    <span class="text-muted ms-1">{{ number_format($company['avg_rating'], 1) }}</span>
                                                </div>
                                            @endif
                                            
                                            @if(isset($company['total_reviews']) && $company['total_reviews'] > 0)
                                                <small class="text-muted">{{ $company['total_reviews'] }} reviews</small>
                                            @endif
                                        </div>
                                        
                                        <a href="{{ route('companies.show', $company['slug']) }}" 
                                           class="btn btn-primary btn-sm">
                                            View Profile
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            @empty
                <!-- No Companies Found -->
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-search text-muted" style="font-size: 4rem;"></i>
                    </div>
                    <h4 class="mb-3">No Companies Found</h4>
                    <p class="text-muted mb-4">
                        We couldn't find any subscribed companies in your area. 
                        Try searching with a different pincode or contact us directly.
                    </p>
                    <a href="{{ route('companies.index') }}" class="btn btn-outline-primary">
                        Browse All Companies
                    </a>
                </div>
            @endforelse

            <!-- Back Button -->
            <div class="text-center mt-5">
                <a href="{{ url('/') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>
                    Back to Home
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.company-card {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.company-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.company-logo {
    border-radius: 4px;
    background: #f8f9fa;
    padding: 4px;
}

.card-title {
    color: #2c3e50;
    font-weight: 600;
}

.text-warning {
    color: #ffc107 !important;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    padding: 8px 20px;
    font-weight: 500;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
}
</style>
@endsection
