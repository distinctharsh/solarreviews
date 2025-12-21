<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Solar Reviews') }} - Admin</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @stack('styles')
</head>
<body>
    <div class="admin-shell">
        <aside class="admin-sidebar">
            <div class="sidebar-logo">
                <i class="fas fa-solar-panel"></i>
                <span>Admin</span>
            </div>
            <nav class="sidebar-nav">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-pie"></i>
                    Dashboard
                </a>
                
                <div class="sidebar-section-title">Master Data</div>
                
                <!-- <a href="{{ route('admin.categories.index') }}" class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i class="fas fa-layer-group"></i>
                    Categories
                </a>
                <a href="{{ route('admin.brands.index') }}" class="sidebar-link {{ request()->routeIs('admin.brands.*') ? 'active' : '' }}">
                    <i class="fas fa-tags"></i>
                    Brands
                </a> -->
                <a href="{{ route('admin.companies.index') }}" class="sidebar-link {{ request()->routeIs('admin.companies.*') ? 'active' : '' }}">
                    <i class="fas fa-building"></i>
                    Companies
                </a>
                <!-- <a href="{{ route('admin.products.index') }}" class="sidebar-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="fas fa-box"></i>
                    Products
                </a> -->
                
                <div class="sidebar-section-title">Reviews</div>
                
                <a href="{{ route('admin.reviews.index') }}" class="sidebar-link {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
                    <i class="fas fa-star"></i>
                    All Reviews
                </a>
                <a href="{{ route('admin.profile-submissions.index') }}" class="sidebar-link {{ request()->routeIs('admin.profile-submissions.*') ? 'active' : '' }}">
                    <i class="fas fa-user-check"></i>
                    Profile Submissions
                </a>

                <div class="sidebar-section-title">Chatbot</div>

                <a href="{{ route('admin.chatbot.questions.index') }}" class="sidebar-link {{ request()->routeIs('admin.chatbot.questions.*') ? 'active' : '' }}">
                    <i class="fas fa-robot"></i>
                    Questions & Flows
                </a>
                <a href="{{ route('admin.chatbot.reports.index') }}" class="sidebar-link {{ request()->routeIs('admin.chatbot.reports.*') ? 'active' : '' }}">
                    <i class="fas fa-comments"></i>
                    Conversation Logs
                </a>
            </nav>
            <div class="sidebar-footer">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <div class="admin-content-area">
            <header class="admin-topbar">
                <div class="topbar-title">
                    @yield('page_title', 'Dashboard')
                </div>
                <div class="topbar-actions">
                    <div class="topbar-search">
                        <input type="text" placeholder="Search...">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="admin-user">
                        <div class="admin-user-avatar">
                            {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                        </div>
                        <div class="admin-user-info">
                            <p>{{ auth()->user()->name ?? 'Admin' }}</p>
                            <small>{{ auth()->user()->email ?? '' }}</small>
                        </div>
                    </div>
                </div>
            </header>

            <main class="admin-page-content">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
