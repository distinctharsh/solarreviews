@extends('admin.layouts.app')

@section('page_title', 'Dashboard')

@section('content')
<div class="dashboard-container">
    <div class="dashboard-header">
        <h1 class="dashboard-title">Admin Dashboard</h1>
        <p class="dashboard-subtitle">Welcome to Solar Reviews Admin Panel</p>
    </div>

    <div class="dashboard-stats">
        <!-- <a href="{{ route('admin.categories.index') }}" class="stat-card">
            <div class="stat-icon" style="background:#dcfce7; color:#16a34a;">
                <i class="fas fa-layer-group"></i>
            </div>
            <div class="stat-info">
                <div class="stat-info-value">{{ $stats['total_categories'] ?? 0 }}</div>
                <div class="stat-info-title">Categories</div>
            </div>
        </a>

        <a href="{{ route('admin.brands.index') }}" class="stat-card">
            <div class="stat-icon" style="background:#fef3c7; color:#d97706;">
                <i class="fas fa-tags"></i>
            </div>
            <div class="stat-info">
                <div class="stat-info-value">{{ $stats['total_brands'] ?? 0 }}</div>
                <div class="stat-info-title">Brands</div>
            </div>
        </a> -->

        <a href="{{ route('admin.companies.index') }}" class="stat-card">
            <div class="stat-icon" style="background:#dbeafe; color:#2563eb;">
                <i class="fas fa-building"></i>
            </div>
            <div class="stat-info">
                <div class="stat-info-value">{{ $stats['total_companies'] ?? 0 }}</div>
                <div class="stat-info-title">Companies</div>
            </div>
        </a>

        <!-- <a href="{{ route('admin.products.index') }}" class="stat-card">
            <div class="stat-icon" style="background:#ede9fe; color:#7c3aed;">
                <i class="fas fa-box"></i>
            </div>
            <div class="stat-info">
                <div class="stat-info-value">{{ $stats['total_products'] ?? 0 }}</div>
                <div class="stat-info-title">Products</div>
            </div>
        </a> -->

        <a href="{{ route('admin.reviews.index') }}" class="stat-card">
            <div class="stat-icon" style="background:#fce7f3; color:#db2777;">
                <i class="fas fa-star"></i>
            </div>
            <div class="stat-info">
                <div class="stat-info-value">{{ $stats['total_reviews'] ?? 0 }}</div>
                <div class="stat-info-title">Reviews</div>
            </div>
        </a>

        <div class="stat-card">
            <div class="stat-icon" style="background:#fee2e2; color:#dc2626;">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <div class="stat-info-value">{{ $stats['total_users'] ?? 0 }}</div>
                <div class="stat-info-title">Users</div>
            </div>
        </div>
    </div>

    <div class="dashboard-grid">
        <!-- <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-rocket"></i> Quick Actions</h3>
            </div>
            <div class="card-body quick-actions">
                <a href="{{ route('admin.categories.create') }}" class="quick-action-btn">
                    <i class="fas fa-plus"></i>
                    Add Category
                </a>
                <a href="{{ route('admin.brands.create') }}" class="quick-action-btn">
                    <i class="fas fa-plus"></i>
                    Add Brand
                </a>
                <a href="{{ route('admin.companies.create') }}" class="quick-action-btn">
                    <i class="fas fa-plus"></i>
                    Add Company
                </a>
                <a href="{{ route('admin.products.create') }}" class="quick-action-btn">
                    <i class="fas fa-plus"></i>
                    Add Product
                </a>
            </div>
        </div> -->

        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-users"></i> Recent Users</h3>
            </div>
            <div class="card-body">
                @forelse($recentUsers as $user)
                    <div class="list-item">
                        <div class="avatar-placeholder">
                            {{ strtoupper(substr($user['name'], 0, 1)) }}
                        </div>
                        <div class="user-info">
                            <p class="user-name">
                                {{ $user['name'] }}
                                @if($user['is_admin'])
                                    <span class="badge badge-admin">Admin</span>
                                @endif
                                @if($user['user_type'] !== 'regular')
                                    <span class="badge badge-{{ $user['user_type'] }}">{{ ucfirst($user['user_type']) }}</span>
                                @endif
                            </p>
                            <p class="user-meta">{{ $user['email'] }}</p>
                            <p class="user-meta">Joined {{ \Carbon\Carbon::parse($user['created_at'])->diffForHumans() }}</p>
                        </div>
                    </div>
                @empty
                    <div class="list-empty">
                        <i class="fas fa-users"></i>
                        <p>No users found.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- <div class="setup-guide card">
        <div class="card-header">
            <h3><i class="fas fa-info-circle"></i> Setup Guide</h3>
        </div>
        <div class="card-body">
            <div class="setup-steps">
                <div class="setup-step {{ $stats['total_categories'] > 0 ? 'completed' : '' }}">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h4>Add Categories</h4>
                        <p>Create product categories like Inverter, Panel, Battery, EPC</p>
                        <a href="{{ route('admin.categories.index') }}">Manage Categories →</a>
                    </div>
                </div>
                <div class="setup-step {{ $stats['total_brands'] > 0 ? 'completed' : '' }}">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h4>Add Brands</h4>
                        <p>Add brands like Tata Solar, Luminous, Havells, etc.</p>
                        <a href="{{ route('admin.brands.index') }}">Manage Brands →</a>
                    </div>
                </div>
                <div class="setup-step {{ $stats['total_companies'] > 0 ? 'completed' : '' }}">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h4>Add Companies</h4>
                        <p>Add distributors and manufacturers</p>
                        <a href="{{ route('admin.companies.index') }}">Manage Companies →</a>
                    </div>
                </div>
                <div class="setup-step {{ $stats['total_products'] > 0 ? 'completed' : '' }}">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <h4>Add Products</h4>
                        <p>Add products with category, brand, and specifications</p>
                        <a href="{{ route('admin.products.index') }}">Manage Products →</a>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</div>

<style>
.dashboard-container {
    max-width: 1200px;
    margin: 0 auto;
}

.dashboard-header {
    margin-bottom: 2rem;
}

.dashboard-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: #1f2937;
    margin: 0 0 0.25rem;
}

.dashboard-subtitle {
    color: #6b7280;
    margin: 0;
}

.dashboard-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 1rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: #fff;
    border-radius: 12px;
    padding: 1.25rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    text-decoration: none;
    color: inherit;
    transition: all 0.2s;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
}

.stat-info-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1f2937;
}

.stat-info-title {
    font-size: 0.875rem;
    color: #6b7280;
}

.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    overflow: hidden;
}

.card-header {
    padding: 1rem 1.25rem;
    border-bottom: 1px solid #e5e7eb;
}

.card-header h3 {
    margin: 0;
    font-size: 1rem;
    font-weight: 600;
    color: #1f2937;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.card-header h3 i {
    color: #6b7280;
}

.card-body {
    padding: 1rem 1.25rem;
}

.quick-actions {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.75rem;
}

.quick-action-btn {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1rem;
    background: #f3f4f6;
    border-radius: 8px;
    text-decoration: none;
    color: #374151;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s;
}

.quick-action-btn:hover {
    background: #3ba14c;
    color: white;
}

.quick-action-btn i {
    font-size: 0.75rem;
}

.list-item {
    display: flex;
    gap: 0.75rem;
    padding: 0.75rem 0;
    border-bottom: 1px solid #f3f4f6;
}

.list-item:last-child {
    border-bottom: none;
}

.avatar-placeholder {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #3ba14c, #2d7a3a);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.875rem;
}

.user-info {
    flex: 1;
}

.user-name {
    font-weight: 600;
    color: #1f2937;
    margin: 0 0 0.25rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.user-meta {
    font-size: 0.8rem;
    color: #6b7280;
    margin: 0;
}

.badge {
    padding: 0.15rem 0.5rem;
    border-radius: 50px;
    font-size: 0.65rem;
    font-weight: 600;
    text-transform: uppercase;
}

.badge-admin {
    background: #fef3c7;
    color: #92400e;
}

.badge-distributor {
    background: #dbeafe;
    color: #1e40af;
}

.badge-manufacturer {
    background: #dcfce7;
    color: #166534;
}

.list-empty {
    text-align: center;
    padding: 2rem;
    color: #9ca3af;
}

.list-empty i {
    font-size: 2rem;
    margin-bottom: 0.5rem;
}

.setup-guide {
    margin-bottom: 2rem;
}

.setup-steps {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
}

.setup-step {
    display: flex;
    gap: 1rem;
    padding: 1rem;
    background: #f9fafb;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
}

.setup-step.completed {
    background: #f0fdf4;
    border-color: #bbf7d0;
}

.setup-step.completed .step-number {
    background: #16a34a;
}

.step-number {
    width: 32px;
    height: 32px;
    background: #6b7280;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.875rem;
    flex-shrink: 0;
}

.step-content h4 {
    margin: 0 0 0.25rem;
    font-size: 0.9rem;
    font-weight: 600;
    color: #1f2937;
}

.step-content p {
    margin: 0 0 0.5rem;
    font-size: 0.8rem;
    color: #6b7280;
}

.step-content a {
    font-size: 0.8rem;
    color: #3ba14c;
    text-decoration: none;
    font-weight: 500;
}

.step-content a:hover {
    text-decoration: underline;
}
</style>
@endsection
