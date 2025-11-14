<nav class="navbar">
    <div class="nav-container">
        <a href="{{ url('/') }}" class="logo">
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
