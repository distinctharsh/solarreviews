@extends('admin.layouts.app')

@section('page_title', $profile->company_name)

@push('styles')
<style>
    .profile-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        padding: 24px;
        font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    .profile-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .card {
        background: #fff;
        border-radius: 16px;
        padding: 20px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
    }

    .card h3 {
        font-size: 16px;
        font-weight: 600;
        color: #0f172a;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-size: 14px;
        color: #475569;
    }

    .info-row span {
        font-weight: 600;
        color: #0f172a;
    }

    .tag-list {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .tag {
        padding: 6px 12px;
        border-radius: 999px;
        background: #f1f5f9;
        font-size: 12px;
        color: #0f172a;
        display: inline-flex;
        gap: 6px;
        align-items: center;
    }

    .role-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 999px;
        font-weight: 600;
        text-transform: capitalize;
    }

    .role-pill.manufacturer {
        background: #eef2ff;
        color: #3730a3;
    }

    .role-pill.distributor {
        background: #fff7ed;
        color: #9a3412;
    }

    .section-title small {
        color: #94a3b8;
        font-weight: 400;
        text-transform: none;
    }

    .metadata {
        font-size: 13px;
        color: #64748b;
        background: #f8fafc;
        border-radius: 12px;
        padding: 12px;
        margin-top: 16px;
        word-break: break-word;
    }

    .back-link {
        text-decoration: none;
        color: #2563eb;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-weight: 600;
    }

    .contact-list li {
        list-style: none;
        padding: 4px 0;
        color: #475569;
        font-size: 14px;
    }
</style>
@endpush

@section('content')
<div class="profile-wrapper">
    <a href="{{ route('admin.company-profiles.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Back to profiles
    </a>

    <div class="card" style="margin-top: 16px;">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:16px;flex-wrap:wrap;">
            <div>
                <h1 style="margin:0;font-size:24px;color:#0f172a;">{{ $profile->company_name }}</h1>
                <p style="margin:4px 0 0;color:#475569;">{{ $profile->city }}, {{ $profile->state }} {{ $profile->country }}</p>
                <p style="margin:2px 0 0;color:#94a3b8;font-size:13px;">Registered {{ $profile->created_at->format('d M Y, h:i A') }}</p>
            </div>
            <div class="role-pill {{ $profile->company_type }}">
                <i class="fas {{ $profile->company_type === 'manufacturer' ? 'fa-industry' : 'fa-toolbox' }}"></i>
                {{ $profile->company_type }}
            </div>
        </div>
    </div>

    <div class="profile-grid">
        <div class="card">
            <h3 class="section-title"><i class="fas fa-briefcase"></i> Business overview</h3>
            <div class="info-row">Legal name <span>{{ $profile->company_name }}</span></div>
            <div class="info-row">Brand <span>{{ $profile->brand_name ?? '—' }}</span></div>
            <div class="info-row">Website <span>
                @if($profile->website)
                    <a href="{{ $profile->website }}" target="_blank">{{ $profile->website }}</a>
                @else — @endif
            </span></div>
            <div class="info-row">Year founded <span>{{ $profile->year_founded ?? '—' }}</span></div>
            <div class="info-row">Team size <span>{{ $profile->employee_count ?? '—' }}</span></div>
            <div class="info-row">Primary goal <span>{{ ucfirst(str_replace('_', ' ', $profile->primary_goal)) }}</span></div>
        </div>

        <div class="card">
            <h3><i class="fas fa-user"></i> Contact</h3>
            <ul class="contact-list">
                <li><strong>Primary user:</strong> {{ $profile->user->name ?? '—' }}</li>
                <li><strong>Email:</strong> {{ $profile->user->email ?? '—' }}</li>
                <li><strong>Phone:</strong> {{ $profile->user->phone ?? '—' }}</li>
                <li><strong>Address:</strong> {{ $profile->address ?? '—' }}, {{ $profile->city }}, {{ $profile->state }}, {{ $profile->country }}</li>
            </ul>
        </div>

        <div class="card">
            <h3><i class="fas fa-gear"></i> Operations</h3>
            <div class="info-row">Production capacity <span>{{ $profile->production_capacity ?? '—' }}</span></div>
            <div class="info-row">Distribution regions <span>{{ $profile->distribution_regions ?? '—' }}</span></div>
            <div class="info-row">Coverage states <span>{{ $profile->coverage_states ?? '—' }}</span></div>
            <div class="info-row">Installs / year <span>{{ $profile->installations_per_year ? number_format($profile->installations_per_year) : '—' }}</span></div>
            <div class="info-row">Certifications <span>{{ $profile->certifications ?? '—' }}</span></div>
            <div class="info-row">Licenses <span>{{ $profile->licenses ?? '—' }}</span></div>
        </div>

        <div class="card">
            <h3><i class="fas fa-tags"></i> Offerings</h3>
            <div class="tag-list">
                @if($profile->company_type === 'manufacturer')
                    @forelse($profile->productLineTypes as $line)
                        <span class="tag"><i class="fas fa-box"></i>{{ $line->name }}</span>
                    @empty
                        <span class="text-slate-400">No product lines provided</span>
                    @endforelse
                @else
                    @forelse($profile->serviceTypes as $service)
                        <span class="tag"><i class="fas fa-screwdriver-wrench"></i>{{ $service->name }}</span>
                    @empty
                        <span class="text-slate-400">No services provided</span>
                    @endforelse
                @endif
            </div>
        </div>
    </div>

    @if(!empty($profile->metadata))
        <div class="card metadata">
            <h3 style="margin-bottom:8px;"><i class="fas fa-database"></i> Raw metadata</h3>
            <pre style="margin:0;white-space:pre-wrap;word-break:break-word;">{{ json_encode($profile->metadata, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
        </div>
    @endif
</div>
@endsection
