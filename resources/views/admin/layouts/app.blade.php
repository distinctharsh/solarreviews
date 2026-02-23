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
        <aside class="admin-sidebar" id="adminSidebar">
            <div class="sidebar-header d-lg-none">
                <button class="btn-close-sidebar" onclick="toggleSidebar()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="sidebar-brand">
                <div class="brand-logo">
                    <i class="fas fa-solar-panel"></i>
                </div>
                <div class="brand-text">
                    <h2>Solar Reviews</h2>
                    <span>Admin Panel</span>
                </div>
            </div>
            
            <div class="sidebar-search">
                <div class="search-input-wrapper">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search menu..." id="sidebarSearch">
                </div>
            </div>
            
            <nav class="sidebar-nav">
                <div class="nav-section">
                    <div class="nav-section-header">
                        <i class="fas fa-home"></i>
                        <span>Overview</span>
                    </div>
                    <div class="nav-section-items">
                        <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-chart-pie"></i>
                            <span>Dashboard</span>
                            <div class="nav-indicator"></div>
                        </a>
                    </div>
                </div>
                
                <div class="nav-section">
                    <div class="nav-section-header">
                        <i class="fas fa-database"></i>
                        <span>Master Data</span>
                    </div>
                    <div class="nav-section-items">
                        <a href="{{ route('admin.companies.index') }}" class="nav-item {{ request()->routeIs('admin.companies.*') ? 'active' : '' }}">
                            <i class="fas fa-building"></i>
                            <span>Companies</span>
                            <div class="nav-indicator"></div>
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <i class="fas fa-users"></i>
                            <span>Users</span>
                            <div class="nav-indicator"></div>
                        </a>
                    </div>
                </div>
                
                <div class="nav-section">
                    <div class="nav-section-header">
                        <i class="fas fa-star"></i>
                        <span>Content Management</span>
                    </div>
                    <div class="nav-section-items">
                        <a href="{{ route('admin.reviews.index') }}" class="nav-item {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
                            <i class="fas fa-comment-dots"></i>
                            <span>All Reviews</span>
                            <div class="nav-indicator"></div>
                        </a>
                        <a href="{{ route('admin.profile-submissions.index') }}" class="nav-item {{ request()->routeIs('admin.profile-submissions.*') ? 'active' : '' }}">
                            <i class="fas fa-user-check"></i>
                            <span>Profile Submissions</span>
                            <div class="nav-indicator"></div>
                        </a>
                    </div>
                </div>
                
                <div class="nav-section">
                    <div class="nav-section-header">
                        <i class="fas fa-lead"></i>
                        <span>Lead Management</span>
                    </div>
                    <div class="nav-section-items">
                        <a href="{{ route('admin.get-quotes.index') }}" class="nav-item {{ request()->routeIs('admin.get-quotes.*') ? 'active' : '' }}">
                            <i class="fas fa-file-signature"></i>
                            <span>Get Quotes</span>
                            <div class="nav-indicator"></div>
                        </a>
                        <a href="{{ route('admin.company-detail-requests.index') }}" class="nav-item {{ request()->routeIs('admin.company-detail-requests.*') ? 'active' : '' }}">
                            <i class="fas fa-clipboard-list"></i>
                            <span>Company Detail Requests</span>
                            <div class="nav-indicator"></div>
                        </a>
                    </div>
                </div>
                
                <div class="nav-section">
                    <div class="nav-section-header">
                        <i class="fas fa-robot"></i>
                        <span>Chatbot</span>
                    </div>
                    <div class="nav-section-items">
                        <a href="{{ route('admin.chatbot.questions.index') }}" class="nav-item {{ request()->routeIs('admin.chatbot.questions.*') ? 'active' : '' }}">
                            <i class="fas fa-cogs"></i>
                            <span>Questions & Flows</span>
                            <div class="nav-indicator"></div>
                        </a>
                        <a href="{{ route('admin.chatbot.reports.index') }}" class="nav-item {{ request()->routeIs('admin.chatbot.reports.*') ? 'active' : '' }}">
                            <i class="fas fa-comments"></i>
                            <span>Conversation Logs</span>
                            <div class="nav-indicator"></div>
                        </a>
                    </div>
                </div>
            </nav>
            
            <div class="sidebar-footer">
                <div class="footer-user-info">
                    <div class="user-avatar">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="user-details">
                        <p>{{ auth()->user()->name ?? 'Admin' }}</p>
                        <span>{{ auth()->user()->email ?? '' }}</span>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <div class="admin-content-area">
            <header class="admin-topbar">
                <button class="btn-sidebar-toggle d-lg-none" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
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
    <script>
        function toggleSidebar() {
            document.querySelector('.admin-sidebar').classList.toggle('show');
            document.querySelector('.admin-content-area').classList.toggle('blur');
        }

        // Sidebar Search Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('sidebarSearch');
            const navItems = document.querySelectorAll('.nav-item');
            const navSections = document.querySelectorAll('.nav-section');

            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const searchTerm = e.target.value.toLowerCase();
                    
                    navSections.forEach(section => {
                        let hasVisibleItems = false;
                        const sectionItems = section.querySelectorAll('.nav-item');
                        
                        sectionItems.forEach(item => {
                            const text = item.textContent.toLowerCase();
                            if (text.includes(searchTerm)) {
                                item.style.display = 'flex';
                                hasVisibleItems = true;
                            } else {
                                item.style.display = 'none';
                            }
                        });
                        
                        // Show/hide section based on whether it has visible items
                        if (searchTerm === '') {
                            section.style.display = 'block';
                        } else {
                            section.style.display = hasVisibleItems ? 'block' : 'none';
                        }
                    });
                });
            }
        });
    </script>
</body>
</html>
