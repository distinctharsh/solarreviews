<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm" style="z-index: 1100;">
    <div class="container" style="max-width: 1200px;">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.jpg') }}" alt="SolarReviews Logo" style="height: 60px;">
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse">
            <div class="navbar-nav ms-auto d-flex align-items-center gap-3">
                <a class="nav-link text-dark fw-medium" href="#solar-calculator">Solar Calculator</a>
                @if (Route::has('login'))
                    @auth
                        <a class="nav-link text-dark fw-medium" href="{{ url('/dashboard') }}">Dashboard</a>
                    @else
                        <a class="nav-link text-dark fw-medium" href="{{ route('login') }}">Log in</a>
                        @if (Route::has('register'))
                            <!-- <a class="nav-link text-dark fw-medium" href="{{ route('register') }}">Sign up</a> -->
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </div>
</nav>

<!-- Mobile Sidebar (Offcanvas) -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="mobileSidebarLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-dark fw-medium py-3" href="#solar-calculator" data-bs-dismiss="offcanvas">Solar Calculator</a>
            </li>
            @if (Route::has('login'))
                @auth
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-medium py-3" href="{{ url('/dashboard') }}">Dashboard</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-medium py-3" href="{{ route('login') }}">Log in</a>
                    </li>
                    @if (Route::has('register'))
                        <!-- <li class="nav-item">
                            <a class="nav-link text-dark fw-medium py-3" href="{{ route('register') }}">Sign up</a>
                        </li> -->
                    @endif
                @endauth
            @endif
        </ul>
    </div>
</div>

<style>
    body {
        padding-top: 76px;
    }
    
    .navbar-nav .nav-link:hover {
        color: #1e40af !important;
    }
</style>
