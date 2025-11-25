<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm" style="z-index: 1100; border-bottom: 4px solid #e6b800; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
    <div class="container" style="max-width: 1200px;">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('images/1.png') }}" alt="SolarReviews Logo" class="navbar-logo">
        </a>
        
        <!-- Desktop Nav Links -->
        <div class="desktop-nav d-none d-lg-flex align-items-center gap-3">
            <a class="nav-link fw-medium">Learn About Solar</a>
            <a class="nav-link fw-medium nav-btn-primary" href="{{ route('login') }}">Login / Register</a>
            <a class="nav-link fw-medium nav-btn-submit" href="{{ route('reviews.create') }}" style="color: white !important;">Submit Review</a>
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
                <a class="nav-link fw-medium py-3" >Learn About Solar</a>
            </li>
            @if (Route::has('login'))
                @auth
                    <li class="nav-item">
                        <a class="nav-link fw-medium py-3 nav-btn-outline" href="{{ url('/dashboard') }}">Dashboard</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link fw-medium py-3 nav-btn-outline" href="{{ route('login') }}">Login / Register</a>
                    </li>
                @endauth
            @endif
            <li class="nav-item">
                <a class="nav-link fw-medium py-3" href="{{ route('reviews.create') }}">Submit Review</a>
            </li>
        </ul>
    </div>
</div>

<style>
    body {
        padding-top: 72px;
    }

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

    .desktop-nav {
        margin-left: auto;
    }

    .desktop-nav .nav-link {
        transition: color 0.3s ease, transform 0.2s ease;
        text-decoration: none;
        cursor: pointer;
    }

    .desktop-nav .nav-link:not(.nav-btn-primary) {
        color: #1e293b !important;
    }

    .desktop-nav .nav-link:not(.nav-btn-primary):hover {
        color: #fecf39 !important;
    }

    .nav-btn-primary {
        background: #fecf39;
        color: #1e293b !important;
        border: none;
        padding: 0.5rem 1.25rem;
        border-radius: 8px;
        font-size: 0.95rem;
        font-weight: 600;
        letter-spacing: 0.01em;
        box-shadow: 0 3px 12px rgba(254, 207, 57, 0.25);
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.3rem;
    }

    .nav-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(254, 207, 57, 0.4);
        background: #ffdb4d;
    }

    .nav-btn-submit {
        background-color: #3ba14c;
        color: white !important;
        padding: 0.5rem 1.25rem;
        border-radius: 8px;
        font-size: 0.95rem;
        font-weight: 600;
        letter-spacing: 0.01em;
        box-shadow: 0 3px 12px rgba(59, 161, 76, 0.25);
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.3rem;
    }

    .nav-btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(59, 161, 76, 0.4);
        background: #4db96f;
    }

    /* Mobile-specific styles */
    .offcanvas-body .nav-link {
        color: #1e40af !important;
        transition: all 0.3s ease;
    }

    .offcanvas-body .nav-link:hover {
        color: #1e3a8a !important;
        background-color: rgba(30, 64, 175, 0.1);
        padding-left: 1rem;
    }

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
</style>
