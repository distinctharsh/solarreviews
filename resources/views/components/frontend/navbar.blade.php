<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm" style="z-index: 1100;">
    <div class="container" style="max-width: 1200px;">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.jpg') }}" alt="SolarReviews Logo" class="navbar-logo">
        </a>
        
        <!-- Desktop Nav Links -->
        <div class="desktop-nav d-none d-lg-flex align-items-center gap-3">
            <a class="nav-link fw-medium" href="#solar-calculator">Solar Calculator</a>
            @if (Route::has('login'))
                @auth
                    <a class="nav-link fw-medium" href="{{ url('/dashboard') }}">Dashboard</a>
                @else
                    <a class="nav-link fw-medium" href="{{ route('login') }}">Log in</a>
                    @if (Route::has('register'))
                        <!-- <a class="nav-link fw-medium" href="{{ route('register') }}">Sign up</a> -->
                    @endif
                @endauth
            @endif
        </div>
        
        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </span>
        </button>
    </div>
</nav>

<!-- Mobile Sidebar (Offcanvas) -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="mobileSidebarLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
            <span class="close-icon"></span>
        </button>
    </div>
    <div class="offcanvas-body">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link fw-medium py-3" href="#solar-calculator" data-bs-dismiss="offcanvas">Solar Calculator</a>
            </li>
            @if (Route::has('login'))
                @auth
                    <li class="nav-item">
                        <a class="nav-link fw-medium py-3" href="{{ url('/dashboard') }}">Dashboard</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link fw-medium py-3" href="{{ route('login') }}">Log in</a>
                    </li>
                    @if (Route::has('register'))
                        <!-- <li class="nav-item">
                            <a class="nav-link fw-medium py-3" href="{{ route('register') }}">Sign up</a>
                        </li> -->
                    @endif
                @endauth
            @endif
        </ul>
    </div>
</div>

<style>
    body {
        padding-top: 60px;
    }
    
    /* Navbar height reduction */
    .navbar {
        padding-top: 0;
        padding-bottom: 0;
        min-height: 60px;
    }
    
    .navbar .container {
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    /* Logo size */
    .navbar-logo {
        height: 45px;
        width: auto;
        transition: transform 0.3s ease;
    }
    
    .navbar-logo:hover {
        transform: scale(1.05);
    }
    
    /* Desktop Nav Links */
    .desktop-nav {
        margin-left: auto;
    }
    
    /* Nav links color */
    .navbar-nav .nav-link,
    .desktop-nav .nav-link {
        color: #1e40af !important;
        transition: color 0.3s ease, transform 0.2s ease;
        text-decoration: none;
    }
    
    .navbar-nav .nav-link:hover,
    .desktop-nav .nav-link:hover {
        color: #1e3a8a !important;
        transform: translateY(-1px);
    }
    
    /* Mobile toggle button */
    .navbar-toggler {
        border: none;
        padding: 0.25rem 0.5rem;
        outline: none;
        box-shadow: none;
    }
    
    .navbar-toggler:focus {
        box-shadow: none;
    }
    
    .navbar-toggler-icon {
        width: 25px;
        height: 20px;
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    
    .icon-bar {
        display: block;
        width: 100%;
        height: 3px;
        background-color: #1e40af;
        border-radius: 2px;
        transition: all 0.3s ease;
    }
    
    /* Animated hamburger icon */
    .navbar-toggler[aria-expanded="true"] .icon-bar:nth-child(1) {
        transform: rotate(45deg) translate(8px, 8px);
    }
    
    .navbar-toggler[aria-expanded="true"] .icon-bar:nth-child(2) {
        opacity: 0;
    }
    
    .navbar-toggler[aria-expanded="true"] .icon-bar:nth-child(3) {
        transform: rotate(-45deg) translate(7px, -7px);
    }
    
    /* Offcanvas animation */
    .offcanvas {
        transition: transform 0.3s ease-in-out;
    }
    
    .offcanvas.show {
        transform: translateX(0);
    }
    
    .offcanvas.offcanvas-end {
        transform: translateX(100%);
    }
    
    /* Close button animation */
    .btn-close {
        position: relative;
        width: 30px;
        height: 30px;
        opacity: 1;
        background: transparent;
        border: none;
        padding: 0;
    }
    
    .close-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 20px;
        height: 2px;
        background-color: #1e40af;
        transform: translate(-50%, -50%) rotate(45deg);
        transition: all 0.3s ease;
    }
    
    .close-icon::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #1e40af;
        transform: rotate(90deg);
    }
    
    .btn-close:hover .close-icon {
        transform: translate(-50%, -50%) rotate(135deg);
        background-color: #1e3a8a;
    }
    
    .btn-close:hover .close-icon::after {
        background-color: #1e3a8a;
    }
    
    /* Mobile sidebar links */
    .offcanvas-body .nav-link {
        color: #1e40af !important;
        transition: all 0.3s ease;
    }
    
    .offcanvas-body .nav-link:hover {
        color: #1e3a8a !important;
        background-color: rgba(30, 64, 175, 0.1);
        padding-left: 1rem;
    }
    
    /* Hide default Bootstrap close icon */
    .btn-close::before {
        display: none;
    }
</style>
