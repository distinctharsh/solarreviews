@extends('frontend.layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-5 text-center">
                    <div class="mb-4">
                        <div class="checkmark-circle">
                            <div class="checkmark draw"></div>
                        </div>
                    </div>
                    <h2 class="h4 mb-3">Thank You for Your Review!</h2>
                    <p class="text-muted mb-4">
                        Your review has been submitted successfully and is pending approval. 
                        It will be visible after our team verifies it (usually within 2 hours).
                    </p>
                    
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('home') }}" class="btn btn-outline-primary">
                            <i class="fas fa-home me-2"></i> Back to Home
                        </a>
                        <a href="{{ route('companies.index') }}" class="btn btn-primary">
                            <i class="fas fa-search me-2"></i> Browse More Companies
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .checkmark-circle {
        width: 80px;
        height: 80px;
        background-color: #e8f5e9;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
    }
    
    .checkmark {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: block;
        stroke-width: 3;
        stroke: #4caf50;
        stroke-miterlimit: 10;
        box-shadow: inset 0px 0px 0px #4caf50;
        animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
    }
    
    .checkmark__check {
        transform-origin: 50% 50%;
        stroke-dasharray: 48;
        stroke-dashoffset: 48;
        animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
    }
    
    @keyframes stroke {
        100% { stroke-dashoffset: 0; }
    }
    
    @keyframes scale {
        0%, 100% { transform: none; }
        50% { transform: scale3d(1.1, 1.1, 1); }
    }
    
    @keyframes fill {
        100% { box-shadow: inset 0px 0px 0px 30px #4caf50; }
    }
</style>
@endsection