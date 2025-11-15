<style>
    body.has-fixed-nav {
        padding-top: 60px;
    }

    .site-navbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        width: 100%;
        z-index: 1100;
        background-color: #fff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .site-navbar .nav-inner {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0.1rem 0rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1.5rem;
    }

    .site-navbar .nav-brand {
        display: flex;
        align-items: center;
        gap: 0.65rem;
        font-weight: 600;
        color: #0f172a;
        text-decoration: none;
    }

    .nav-brand img {
        height: 60px;
    }

    .site-navbar .nav-links {
        display: flex;
        align-items: center;
        gap: 1.25rem;
        flex-wrap: wrap;
    }

    .site-navbar .nav-link {
        color: #1f2937;
        font-weight: 500;
        text-decoration: none;
        transition: color 0.25s ease;
    }

    .site-navbar .nav-link:hover {
        color: #1e40af;
    }

    .site-navbar .btn-link {
        padding: 0.45rem 1rem;
        border: 1px solid #1e40af;
        border-radius: 999px;
        color: #1e40af;
    }

    .site-navbar .btn-link:hover {
        background-color: #1e40af;
        color: #fff;
    }

    @media (max-width: 640px) {
        .site-navbar .nav-inner {
            flex-direction: column;
            align-items: flex-start;
        }

        .site-navbar .nav-links {
            width: 100%;
        }
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.body.classList.add('has-fixed-nav');
    });
</script>
<nav class="site-navbar">
    <div class="nav-inner">
        <a class="nav-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.jpg') }}" alt="SolarReviews Logo" />
        </a>
        <div class="nav-links">
            <a href="#solar-calculator">Solar Calculator</a>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Log in</a>
                    @if (Route::has('register'))
                        <!-- <a href="{{ route('register') }}">Sign up</a> -->
                    @endif
                @endauth
            @endif
        </div>
    </div>
</nav>
