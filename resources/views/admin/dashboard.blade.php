@extends('admin.layouts.app')

@push('styles')
<style>
    .dashboard-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .dashboard-title {
        font-size: 24px;
        font-weight: 600;
        color: #2d3748;
        margin: 0;
    }

    .btn-primary {
        background-color: #2563eb;
        color: #fff;
        padding: 8px 16px;
        border-radius: 4px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        border: none;
        display: inline-flex;
        align-items: center;
        cursor: pointer;
    }

    .btn-primary svg {
        margin-right: 6px;
        width: 16px;
        height: 16px;
    }

    .btn-primary:hover {
        background-color: #1d4ed8;
    }

    .dashboard-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 16px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: #ffffff;
        border-radius: 8px;
        padding: 16px 18px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
    }

    .stat-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
    }

    .stat-icon svg {
        width: 22px;
        height: 22px;
    }

    .stat-info-title {
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 4px;
    }

    .stat-info-value {
        font-size: 22px;
        font-weight: 600;
        color: #111827;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }

    .card {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .card-header {
        padding: 12px 16px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-header h3 {
        margin: 0;
        font-size: 16px;
        font-weight: 600;
        color: #111827;
    }

    .card-header a {
        font-size: 12px;
        color: #2563eb;
        text-decoration: none;
    }

    .card-body {
        padding: 0;
    }

    .list-item {
        padding: 12px 16px;
        border-top: 1px solid #e5e7eb;
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }

    .list-item:first-child {
        border-top: none;
    }

    .list-item:hover {
        background-color: #f9fafb;
    }

    .stars {
        display: flex;
        gap: 2px;
        margin-right: 4px;
    }

    .star-icon {
        width: 16px;
        height: 16px;
        color: #d1d5db;
    }

    .star-icon.filled {
        color: #fbbf24;
    }

    .review-main,
    .company-main,
    .user-main {
        flex: 1;
        min-width: 0;
    }

    .review-title,
    .company-name,
    .user-name {
        font-size: 14px;
        font-weight: 600;
        color: #111827;
        margin: 0 0 4px 0;
    }

    .review-meta,
    .user-meta,
    .company-meta {
        font-size: 12px;
        color: #6b7280;
        margin-bottom: 4px;
    }

    .review-text {
        font-size: 13px;
        color: #4b5563;
        margin: 0;
    }

    .badge-admin {
        display: inline-block;
        padding: 2px 8px;
        border-radius: 999px;
        background: #fef3c7;
        color: #92400e;
        font-size: 11px;
        margin-left: 4px;
    }

    .avatar,
    .avatar-placeholder {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e5e7eb;
        flex-shrink: 0;
    }

    .avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .avatar svg,
    .avatar-placeholder svg {
        width: 22px;
        height: 22px;
        color: #9ca3af;
    }

    .list-empty {
        padding: 20px 16px;
        text-align: center;
        font-size: 13px;
        color: #6b7280;
    }

    .card-footer {
        padding: 10px 16px;
        border-top: 1px solid #e5e7eb;
        text-align: right;
    }

    .card-footer a {
        font-size: 12px;
        color: #2563eb;
        text-decoration: none;
    }

    .action-link {
        color: #6b7280;
        text-decoration: none;
        font-size: 13px;
        display: inline-flex;
        align-items: center;
    }

    .action-link svg {
        width: 16px;
        height: 16px;
    }

    @media (max-width: 768px) {
        .dashboard-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
    }
</style>
@endpush

@section('content')
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1 class="dashboard-title">Admin Dashboard</h1>
            <a href="{{ route('admin.companies.create') }}" class="btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Company
            </a>
        </div>

        <div class="dashboard-stats">
            <a href="{{ route('admin.companies.index') }}" style="text-decoration:none; color:inherit;">
                <div class="stat-card">
                    <div class="stat-icon" style="background:#e0ecff; color:#1d4ed8;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m4 0h4m-4-4h4m-4-4h4m-4-4h4" />
                        </svg>
                    </div>
                    <div>
                        <div class="stat-info-title">Total Companies</div>
                        <div class="stat-info-value">{{ $stats['total_companies'] ?? 0 }}</div>
                    </div>
                </div>
            </a>

            <div class="stat-card">
                <div class="stat-icon" style="background:#fee2e2; color:#b91c1c;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div>
                    <div class="stat-info-title">Total Users</div>
                    <div class="stat-info-value">{{ $stats['total_users'] ?? 0 }}</div>
                </div>
            </div>
        </div>

        <div class="dashboard-grid">
            <div class="card">
                <div class="card-header">
                    <h3>Recent Reviews</h3>
                    <a href="{{ route('admin.reviews.index') }}">View All</a>
                </div>
                <div class="card-body">
                    @forelse($recentReviews as $review)
                        <div class="list-item">
                            <div class="stars">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="star-icon {{ $i <= $review['rating'] ? 'filled' : '' }}" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </div>
                            <div class="review-main">
                                <p class="review-title">
                                    {{ $review['reviewer_name'] }}
                                    <span class="review-meta">&middot; {{ \Carbon\Carbon::parse($review['created_at'])->diffForHumans() }}</span>
                                </p>
                                <p class="review-text">{{ Str::limit($review['review_text'], 100) }}</p>
                                <div class="review-meta">
                                    @if($review['company'])
                                        <a href="{{ route('admin.companies.edit', $review['company']['id']) }}" style="color:#2563eb; text-decoration:none;">
                                            {{ $review['company']['name'] }}
                                        </a>
                                    @endif
                                    @if(!empty($review['category']))
                                        <span style="margin:0 4px;">&middot;</span>
                                        <span>{{ $review['category']['name'] }}</span>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <a href="{{ route('admin.reviews.edit', $review['id']) }}" class="action-link">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="list-empty">No reviews found.</div>
                    @endforelse
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>Top Companies</h3>
                </div>
                <div class="card-body">
                    @forelse($topCompanies as $company)
                        <div class="list-item">
                            <div class="avatar">
                                @if($company['logo'])
                                    <img src="{{ $company['logo'] }}" alt="{{ $company['name'] }}">
                                @else
                                    <svg viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                @endif
                            </div>
                            <div class="company-main">
                                <p class="company-name">
                                    <a href="{{ route('admin.companies.edit', $company['id']) }}" style="color:inherit; text-decoration:none;">
                                        {{ $company['name'] }}
                                    </a>
                                </p>
                                <div class="company-meta">
                                    <span>Rating: </span>
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="star-icon {{ $i <= $company['reviews_avg_rating'] ? 'filled' : '' }}" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                    <span> ({{ $company['reviews_count'] }})</span>
                                </div>
                            </div>
                            <div>
                                <a href="{{ route('admin.companies.edit', $company['id']) }}" class="action-link">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="list-empty">No companies found.</div>
                    @endforelse
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.companies.index') }}">View all companies</a>
                </div>
            </div>
        </div>

        <div class="dashboard-grid">
            <div class="card">
                <div class="card-header">
                    <h3>Recent Users</h3>
                </div>
                <div class="card-body">
                    @forelse($recentUsers as $user)
                        <div class="list-item">
                            <div class="avatar-placeholder">
                                <svg viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="user-main">
                                <p class="user-name">
                                    {{ $user['name'] }}
                                    @if($user['is_admin'])
                                        <span class="badge-admin">Admin</span>
                                    @endif
                                </p>
                                <p class="user-meta">{{ $user['email'] }}</p>
                                <p class="user-meta">Joined {{ \Carbon\Carbon::parse($user['created_at'])->diffForHumans() }}</p>
                            </div>
                            <div>
                                <a href="#" class="action-link">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="list-empty">No users found.</div>
                    @endforelse
                </div>
                <div class="card-footer">
                    <a href="#">View all users</a>
                </div>
            </div>
        </div>
    </div>
@endsection
