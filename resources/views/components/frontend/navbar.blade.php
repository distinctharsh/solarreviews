<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm" style="z-index: 1100; border-bottom: 4px solid #e6b800; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
    <div class="container" style="max-width: 1200px;">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('images/1.png') }}" alt="SolarReviews Logo" class="navbar-logo">
        </a>
        
        <!-- Desktop Nav Links -->
        <div class="desktop-nav d-none d-lg-flex align-items-center gap-3">

        <a class="nav-link fw-medium">Learn About Solar</a>
        <a class="nav-link fw-medium nav-btn-primary" href="{{ route('login') }}">Login / Register</a>
        <a class="nav-link fw-medium nav-btn-submit" style="background-color: #3ba14c; color: white !important; padding: 0.65rem 1.5rem; border-radius: 10px; font-weight: 600; letter-spacing: 0.01em; box-shadow: 0 4px 15px rgba(59, 161, 76, 0.3); transition: all 0.3s ease; display: inline-flex; align-items: center; justify-content: center; gap: 0.35rem;">Submit Review</a>
           
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
            <!-- <li class="nav-item">
                <a class="nav-link fw-medium py-3" href="#solar-calculator" data-bs-dismiss="offcanvas">Solar Calculator</a>
            </li> -->
            @if (Route::has('login'))
                @auth
                    <li class="nav-item">
                        <a class="nav-link fw-medium py-3 nav-btn-outline" href="{{ url('/dashboard') }}">Dashboard</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link fw-medium py-3 nav-btn-outline" href="{{ route('login') }}">Sign in</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link fw-medium py-3 nav-btn-outline" href="{{ route('register') }}">Register</a>
                        </li>
                    @endif
                @endauth
            @endif
        </ul>
    </div>
</div>

<style>

    body {
        padding-top: 72px;
    }
    
    /* Navbar height reduction */
    .navbar {
        padding-top: 0;
        padding-bottom: 0;
        min-height: 60px;
    }
    
    .navbar .container {
        padding: 0.5rem 1.5rem;
        max-width: 1200px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .navbar-logo {
        height: 72px;
        padding: 10px 0px;
        width: auto;
        transition: transform 0.3s ease;
        margin: -14px 0;
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
        transition: color 0.3s ease, transform 0.2s ease;
        text-decoration: none;
        cursor: pointer;
    }

    .desktop-nav .nav-link:not(.nav-btn-primary),
    .navbar-nav .nav-link.nav-link-secondary,
    .nav-btn-outline,
    .nav-link-secondary {
        color: #1e293b !important;
    }
    
    .desktop-nav .nav-link:not(.nav-btn-primary):hover,
    .navbar-nav .nav-link.nav-link-secondary:hover,
    .nav-btn-outline:hover,
    .nav-link-secondary:hover {
        color: #fecf39 !important;
    }

    .nav-btn-primary {
        background: #fecf39;
        color: #1e293b !important;
        border: none;
        padding: 0.65rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        letter-spacing: 0.01em;
        box-shadow: 0 4px 15px rgba(254, 207, 57, 0.3);
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.35rem;
    }

    .nav-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(254, 207, 57, 0.4);
        background: #ffdb4d;
    }

    .nav-btn-outline {
        border: 1px solid rgba(41, 66, 89, 0.3);
        border-radius: 10px;
        padding: 0.65rem 1.5rem;
        font-weight: 600;
        letter-spacing: 0.01em;
        position: relative;
        overflow: hidden;
    }

    .nav-btn-outline::after {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: inherit;
        background: linear-gradient(120deg, rgba(41,66,89,0.15), transparent, rgba(255,255,255,0.2));
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .nav-btn-outline:hover::after {
        opacity: 1;
    }

    .nav-btn-outline:hover {
        transform: translateY(-1px);
        border-color: rgba(41, 66, 89, 0.5);
    }
    
    .navbar-nav .nav-link:hover,
    .desktop-nav .nav-link:hover {
        color: #294259 !important;
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
