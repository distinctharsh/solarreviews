@extends('admin.layouts.app')

@section('page_title', 'Company Profiles')

@push('styles')
<style>
    .profiles-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    .profiles-header {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        gap: 10px;
    }

    .profiles-header h1 {
        font-size: 24px;
        font-weight: 600;
        color: #1f2937;
        margin: 0;
    }

    .profiles-table-wrapper {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
        overflow: hidden;
        border: 1px solid #e2e8f0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        background: #f8fafc;
    }

    th, td {
        text-align: left;
        padding: 14px 18px;
        font-size: 14px;
        color: #1f2937;
    }

    th {
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 0.05em;
        color: #475569;
        border-bottom: 1px solid #e2e8f0;
        background: #f8fafc;
    }

    tbody tr:not(:last-child) td {
        border-bottom: 1px solid #f1f5f9;
    }

    tbody tr:hover {
        background: #fefce8;
    }

    .profile-role {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
        text-transform: capitalize;
    }

    .profile-role.manufacturer {
        background: #eef2ff;
        color: #3730a3;
    }

    .profile-role.distributor {
        background: #fff7ed;
        color: #9a3412;
    }

    .tag-pill {
        display: inline-flex;
        align-items: center;
        padding: 4px 10px;
        background: #f1f5f9;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 500;
        color: #475569;
        margin: 2px;
    }

    .tag-pill i {
        margin-right: 4px;
        color: #0ea5e9;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #64748b;
    }

    .empty-state h3 {
        font-size: 20px;
        margin-bottom: 8px;
    }

    .actions a {
        text-decoration: none;
        color: #2563eb;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .pagination {
        display: flex;
        justify-content: flex-end;
        margin-top: 16px;
    }
</style>
@endpush

@section('content')
<div class="profiles-container">
    <div class="profiles-header">
        <h1>Company Profiles</h1>
        <p class="text-sm text-slate-500">These profiles are generated from the public registration flow.</p>
    </div>

    @if($profiles->count() === 0)
        <div class="profiles-table-wrapper">
            <div class="empty-state">
                <h3>No profiles yet</h3>
                <p>Once users register as manufacturers or distributors, their company data will show up here.</p>
            </div>
        </div>
    @else
        <div class="profiles-table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Company</th>
                        <th>Role</th>
                        <th>Primary goal</th>
                        <th>Offerings</th>
                        <th>Registered</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($profiles as $profile)
                        @php
                            $isManufacturer = $profile->company_type === 'manufacturer';
                            $offerings = $isManufacturer
                                ? $profile->productLineTypes->pluck('name')->take(3)
                                : $profile->serviceTypes->pluck('name')->take(3);
                        @endphp
                        <tr>
                            <td>
                                <div class="font-semibold text-slate-800">{{ $profile->company_name }}</div>
                                <div class="text-sm text-slate-500">
                                    {{ $profile->city }}, {{ $profile->state }} {{ $profile->country }}
                                </div>
                                <div class="text-xs text-slate-400">User: {{ $profile->user->name ?? 'N/A' }} ({{ $profile->user->email ?? '—' }})</div>
                            </td>
                            <td>
                                <span class="profile-role {{ $profile->company_type }}">
                                    <i class="fas {{ $isManufacturer ? 'fa-industry' : 'fa-toolbox' }}"></i>
                                    {{ $profile->company_type }}
                                </span>
                            </td>
                            <td>{{ ucfirst(str_replace('_', ' ', $profile->primary_goal)) }}</td>
                            <td>
                                @forelse($offerings as $offering)
                                    <span class="tag-pill">
                                        <i class="fas {{ $isManufacturer ? 'fa-boxes-stacked' : 'fa-hands-helping' }}"></i>
                                        {{ $offering }}
                                    </span>
                                @empty
                                    <span class="text-slate-400">No selections yet</span>
                                @endforelse
                                @if(($isManufacturer ? $profile->productLineTypes : $profile->serviceTypes)->count() > 3)
                                    <span class="text-xs text-slate-500">+ more</span>
                                @endif
                            </td>
                            <td>{{ $profile->created_at->format('d M Y') }}</td>
                            <td class="actions">
                                <a href="{{ route('admin.company-profiles.show', $profile) }}">
                                    View
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination">
            {{ $profiles->links() }}
        </div>
    @endif
</div>
@endsection
