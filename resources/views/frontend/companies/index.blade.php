@php
    $directoryCanonical = route('companies.index');
    $companyListSchema = $companies->take(10)->values()->map(function ($company, $index) {
        return [
            '@type' => 'ListItem',
            'position' => $index + 1,
            'name' => $company->owner_name ?? $company->name ?? 'Company',
            'url' => route('companies.show', $company->slug),
        ];
    });
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solar Companies Directory - Solar Reviews</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @include('components.frontend.meta-tags', [
        'title' => 'Solar Company Directory India | ' . number_format($totalCompanies) . ' installers reviewed',
        'description' => 'Browse ' . number_format($totalCompanies) . ' verified solar installers, EPC partners and manufacturers. Compare average ratings, review counts and jump into detailed company profiles.',
        'keywords' => 'solar companies India, solar installers directory, EPC reviews, solar ratings',
        'canonical' => $directoryCanonical,
    ])

    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'CollectionPage',
            'name' => 'Solar Company Directory India',
            'url' => $directoryCanonical,
            'mainEntity' => [
                '@type' => 'ItemList',
                'itemListElement' => $companyListSchema,
            ],
        ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
    </script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            color: #1f2937;
        }

        .page-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container-custom {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .directory-hero {
            background: linear-gradient(120deg, #1e7b34, #3fb454);
            color: white;
            padding: 6rem 0 3rem;
        }

        .directory-title {
            font-size: clamp(2rem, 4vw, 2.75rem);
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .directory-subtitle {
            font-size: 1.05rem;
            max-width: 680px;
            color: rgba(255,255,255,0.9);
        }

        .directory-stats {
            margin-top: 1.5rem;
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 14px;
            padding: 1rem 1.5rem;
            backdrop-filter: blur(4px);
        }

        .stat-card span {
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            opacity: 0.85;
        }

        .stat-card strong {
            display: block;
            font-size: 1.65rem;
            font-weight: 700;
        }

        .directory-main {
            flex: 1;
            padding: 3rem 0 4rem;
        }

        .directory-pagination {
            display: flex;
            justify-content: center;
        }

        .directory-pagination .pagination {
            gap: 8px;
            margin: 0;
            flex-wrap: wrap;
        }

        .directory-pagination .page-link {
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            padding: 8px 12px;
            color: #0f172a;
            background: #ffffff;
            box-shadow: 0 1px 0 rgba(15, 23, 42, 0.03);
        }

        .directory-pagination .page-link:focus {
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.18);
        }

        .directory-pagination .page-item.active .page-link {
            background: #1d4ed8;
            border-color: #1d4ed8;
            color: #fff;
        }

        .directory-pagination .page-item.disabled .page-link {
            opacity: 0.6;
        }

        .top-reviews-section {
            padding: 0px 0 1rem;
            background: #f1f5f9;
        }

        .section-label {
            text-transform: uppercase;
            letter-spacing: 0.15em;
            font-size: 14px;
            color: #94a3b8;
            margin-bottom: 0.75rem;
            font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.12em;
        }

        .page-title {
            /*font-size: clamp(2rem, 4vw, 2.5rem);*/
            font-size: 24px;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 0.5rem;
        }
        
        
        .page-title-top{
            margin-top: 5%;
             font-size: 36px;
        }

        .lede {
            color: #475569;
            max-width: 720px;
            line-height: 1.6;
            font-size: 16px;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 280px 1fr;
            grid-template-areas: "sidebar table";
            gap: 2rem;
            margin-top: 2.5rem;
            align-items: start;
        }

        .sidebar-card,
        .table-card {
            background: #fff;
            border-radius: 18px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 20px 60px rgba(15, 23, 42, 0.08);
        }

        .table-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .filters-row {
            display: flex;
            align-items: flex-end;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
        }

        .filter-label {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
            margin: 0;
        }

        .input-with-icon {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-with-icon i {
            position: absolute;
            left: 0.75rem;
            color: #94a3b8;
            font-size: 14px;
            pointer-events: none;
        }

        .filter-input,
        .filter-select {
            border: 1px solid #d1d5db;
            border-radius: 12px;
            padding: 0.5rem 0.75rem;
            font-size: 14px;
            font-weight: 500;
            background: #fff;
            transition: all 0.18s ease;
            outline: none;
        }

        .filter-input {
            padding-left: 2.25rem;
            width: 160px;
        }

        .filter-select {
            width: 140px;
            cursor: pointer;
        }

        .filter-input:focus,
        .filter-select:focus {
            border-color: #3ba14c;
            box-shadow: 0 0 0 3px rgba(59, 161, 76, 0.12);
        }

        .filter-input::placeholder {
            color: #9ca3af;
        }

        .verified-badge {
            color: #1d9bf0;
            font-size: 16px;
            display: inline-flex;
            align-items: center;
            flex-shrink: 0;
        }

        .verified-badge i {
            font-size: 14px;
        }

        .verified-badge:hover {
            color: #1a8cd8;
        }

        @media (max-width: 768px) {
            .table-card-header {
                flex-direction: column;
                align-items: stretch;
            }
            .filters-row {
                justify-content: stretch;
            }
            .filter-group {
                flex: 1;
                min-width: 0;
            }
            .filter-input,
            .filter-select {
                width: 100%;
            }
        }

        .sidebar-card {
            grid-area: sidebar;
            padding: 1.75rem;
        }

        .sidebar-card h5 {
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: #94a3b8;
            margin-bottom: 0.75rem;
        }

        .sidebar-card p {
            color: #475569;
            line-height: 1.6;
            font-size: 16px;
        }

        .state-list {
            list-style: none;
            padding: 0;
            margin: 0;
            max-height: 360px;
            overflow-y: auto;
        }

        .state-list li + li {
            margin-top: 0.35rem;
        }

        .state-list a {
            font-size: 14px;
            color: #0891b2;
            text-decoration: none;
            font-weight: 400;
        }

        .state-list a:hover {
            text-decoration: underline;
        }

        .table-card {
            grid-area: table;
            padding: 1.5rem;
        }

        .table-card .table thead {
            background: #f8fafc;
        }

        .table-card .table th {
            color: #64748b;
            font-weight: 600;
            border-bottom: none;
            font-size:14px;
        }

        .table-card .table td {
            vertical-align: middle;
            border-color: #eef2ff;
        }

        .expert-dots span {
            display: inline-block;
            width: 16px;
            height: 16px;
            border-radius: 6px;
            background: #cbd5f5;
            margin-right: 4px;
        }

        .expert-dots span.active {
            background: #34d399;
        }

        .rating-stars {
            color: #fbbf24;
            font-size: 0.95rem;
            margin-right: 6px;
        }

        .btn-quote {
            border-radius: 999px;
            border: 1px solid #0ea5e9;
            color: #0ea5e9;
            padding: 0.4rem 1.2rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            justify-content: center;
        }

        .btn-quote:hover {
            background: #0ea5e9;
            color: #fff;
        }

        .directory-list-section {
            /*padding-top: 2rem;*/
            padding-bottom: 4rem;
        }

        .table-card-header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .search-input {
            min-width: 220px;
            border-radius: 30px;
            padding: 0.65rem 1.25rem;
            border: 1px solid #d1d5db;
            font-size: 16px;
        }

        .company-table thead {
            background-color: #f8fafc;
        }

        .company-table th {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #6b7280;
        }

        .company-table tbody tr {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .company-table tbody tr:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08);
        }

        .company-name {
            font-weight: 500;
            color: #0f172a;
            font-size: 16px;
        }

        .rating-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            background: #ecfdf5;
            color: #047857;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .view-link {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-weight: 600;
            color: #1d4ed8;
            text-decoration: none;
            font-size: 14px;
        }

        .view-link:hover {
            color: #1e40af;
            text-decoration: underline;
        }

        @media (max-width: 992px) {
            .content-grid {
                grid-template-columns: 1fr;
                grid-template-areas:
                    "sidebar"
                    "table";
            }

            .sidebar-card {
                padding: 1.5rem;
            }

            .table-card {
                padding: 1.25rem;
            }
        }

        @media (max-width: 768px) {
            .directory-hero {
                padding: 4rem 0 2.25rem;
            }

            .directory-stats {
                flex-direction: column;
                gap: 1rem;
            }

            .stat-card {
                width: 100%;
            }

            .table-card-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .search-input {
                width: 100%;
            }
            
            .directory-list-section {
                width: 100%;
                overflow-x: hidden;
            }
        
            .directory-list-section > .container-custom {
                padding-left: 1rem;
                padding-right: 1rem;
                box-sizing: border-box;
            }

        }

        @media (max-width: 576px) {
            .container-custom {
                padding: 0 1rem;
            }

            .directory-hero {
                padding: 3.5rem 0 2rem;
            }

            .table-card {
                padding: 1rem;
            }

            .table-card .table th,
            .table-card .table td {
                font-size: 0.9rem;
            }

            .rating-chip {
                font-size: 0.85rem;
            }
            
           .directory-list-section {
                width: 100%;
                overflow-x: hidden;
            }
        
            .directory-list-section > .container-custom {
                padding-left: 1rem;
                padding-right: 1rem;
                box-sizing: border-box;
            }

        }
        
        
        .text-16{
            font-size: 16px;
        }
        
        
        .search-box {
  position: relative;
  width: 250px;
}

.search-input {
  width: 100%;
  padding: 8px 10px 8px 35px; /* icon ke liye space */
  font-size: 14px;
}

.search-icon {
  position: absolute;
  left: 10px;
  top: 50%;
  transform: translateY(-50%);
  color: #888;
  font-size: 14px;
  pointer-events: none;
}

    </style>
</head>
<body>
<div class="page-wrapper">
    @include('components.frontend.navbar')

    <!--<section class="directory-hero">-->
    <!--    <div class="container-custom">-->
    <!--        <p class="text-uppercase text-white-50 mb-2">Solar Companies</p>-->
    <!--        <h1 class="directory-title">Discover Trusted Solar Companies Across India</h1>-->
    <!--        <p class="directory-subtitle">Browse our curated directory of vetted solar installers, EPCs, and manufacturers. Compare expert review data and jump straight into detailed company profiles.</p>-->

    <!--        <div class="directory-stats">-->
    <!--            <div class="stat-card">-->
    <!--                <span>Total companies</span>-->
    <!--                <strong>{{ number_format($totalCompanies) }}</strong>-->
    <!--            </div>-->
    <!--            <div class="stat-card">-->
    <!--                <span>Average rating</span>-->
    <!--                <strong>-->
    <!--                    {{ number_format($companies->avg('avg_rating'), 1) }}-->
    <!--                    <small style="font-size: 1rem; font-weight: 500;">/ 5</small>-->
    <!--                </strong>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->

    <section class="top-reviews-section">
        <div class="container-custom">
            <!--<div class="section-label">Consumer Reviews</div>-->
            <h2 class="page-title page-title-top">Top Solar Installers Ranked by Reviews</h2>
            <p class="lede">Solar Reviews publishes the largest volume of verified installer feedback. These highlights from our Top Reviews page make it easy to compare expert ratings and homeowner sentiment before you dive into the full directory.</p>

            <div class="content-grid">
                <aside class="sidebar-card">
                    <h5>About this list</h5>
                    <p class="mb-3">Every score below is earned from verified reviewers. No installer can pay to influence these ratings.</p>
                    <a href="{{ route('reviews.top') }}" class="fw-semibold text-decoration-none" style="color:#16a34a; font-size:14px;">View full top reviews →</a>

                    <hr class="my-4">
                    <h5>Solar in your state</h5>
                    
                    <!-- Mobile Dropdown -->
                    <select class="form-select d-lg-none mb-3" id="stateSelect" onchange="filterGlobal()">
                        <option value="">Select a state</option>
                        @foreach($states as $state)
                            <option value="{{ $state->id }}" @selected((string) request('state') === (string) $state->id)>{{ $state->name }}</option>
                        @endforeach
                    </select>

                    <!-- Desktop List -->
                    <ul class="state-list d-none d-lg-block">
                        @forelse($states as $state)
                            <li>
                                <a href="#" onclick="setStateFilter('{{ $state->id }}'); return false;">{{ $state->name }}</a>
                            </li>
                        @empty
                            <li class="text-muted">States coming soon.</li>
                        @endforelse
                    </ul>
                </aside>

               <section class="top-reviews-section directory-list-section">
                    <div class="container-custom">
                        <div class="table-card">
                            <div class="table-card-header">
                                <div>
                                    <div class="section-label mb-1">Directory</div>
                                    <h2 class="page-title mb-1" style="">Company Directory</h2>
                                    <p class="text-muted mb-0 text-16">Click any company name to view the full profile.</p>
                                </div>
                                
                                    <div class="filters-row">
    <div class="filter-group">
        <label class="filter-label">Search</label>
        <div class="input-with-icon">
            <i class="fas fa-search"></i>
            <input 
                type="text" 
                id="companySearchInput"
                class="filter-input" 
                placeholder="Company name"
                oninput="filterGlobal()"
                value="{{ request('q') }}"
            >
        </div>
    </div>

    <div class="filter-group">
        <label class="filter-label">Pincode</label>
        <div class="input-with-icon">
            <i class="fas fa-map-marker-alt"></i>
            <input 
                type="text" 
                id="pincodeInput"
                class="filter-input" 
                placeholder="e.g. 110001"
                maxlength="6"
                oninput="filterGlobal()"
                value="{{ request('pincode') }}"
            >
        </div>
    </div>

    <div class="filter-group">
        <label class="filter-label">Sort</label>
        <select id="companySortSelect" class="filter-select" onchange="applySort()">
            <option value="">Default</option>
            <option value="rating_desc" @selected(request('sort') === 'rating_desc')>Rating ↓</option>
            <option value="rating_asc" @selected(request('sort') === 'rating_asc')>Rating ↑</option>
            <option value="reviews_desc" @selected(request('sort') === 'reviews_desc')>Reviews ↓</option>
            <option value="reviews_asc" @selected(request('sort') === 'reviews_asc')>Reviews ↑</option>
        </select>
    </div>
</div>

                                <!--<input type="text" class="search-input" placeholder="Search companies" oninput="filterCompanies(this.value)">-->
                            </div>

                            <div class="table-responsive">
                                <table class="table company-table align-middle mb-0" id="companiesTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Company</th>
                                        
                                            <th scope="col">Avg Rating</th>
                                            <th scope="col">Reviews</th>
                                            <th scope="col" class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($companies as $company)
                                            <tr class="company-row"
                                                data-name="{{ \Illuminate\Support\Str::lower($company->owner_name ?? $company->name ?? '') }}"
                                                data-state-id="{{ $company->state_id }}"
                                                data-rating="{{ (float) $company->avg_rating }}"
                                                data-reviews="{{ (int) $company->total_reviews }}">
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <a href="{{ route('companies.show', $company->slug) }}" class="company-name text-decoration-none">
                                                            {{ $company->owner_name ?? $company->name ?? 'Company' }}
                                                            @if($company->state?->name)
                                                                <span class="text-muted">({{ $company->state->name }})</span>
                                                            @endif
                                                        </a>
                                                        @if($company->is_verified)
                                                            <span class="verified-badge" title="Verified Company">
                                                                <img src="{{ asset('images/company/verified.png?v=' . time() . '') }}" alt="Verified" width="14" height="14">
                                                            </span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="rating-chip">
                                                        <i class="fas fa-star"></i>
                                                        {{ number_format($company->avg_rating, 1) }}
                                                    </span>
                                                </td>
                                                <td>{{ number_format($company->total_reviews) }}</td>
                                                <td class="text-end">
                                                    <a href="{{ route('companies.show', $company->slug) }}" class="view-link">
                                                        View
                                                        <i class="fas fa-arrow-right"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center py-5 text-muted">No companies found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="directory-pagination mt-4">
                                {{ $companies->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>


    @include('components.frontend.footer')
</div>

<script>
    let filterTimeout = null;

    function buildDirectoryUrl(overrides = {}) {
        const url = new URL(window.location.href);
        const params = new URLSearchParams(url.search);

        Object.entries(overrides).forEach(([key, value]) => {
            if (value === null || value === undefined || String(value).trim() === '') {
                params.delete(key);
            } else {
                params.set(key, String(value));
            }
        });

        params.delete('page');

        url.search = params.toString();
        return url.toString();
    }

    function applySort() {
        const sortValue = document.getElementById('companySortSelect')?.value || '';
        window.location.href = buildDirectoryUrl({ sort: sortValue });
    }

    function setStateFilter(stateId) {
        const stateSelect = document.getElementById('stateSelect');
        if (!stateSelect) return;

        stateSelect.value = String(stateId ?? '');
        window.location.href = buildDirectoryUrl({ state: stateSelect.value });
    }

    function filterGlobal() {
        const searchText = document.getElementById('companySearchInput')?.value || '';
        const stateId = document.getElementById('stateSelect')?.value || '';
        const pincode = document.getElementById('pincodeInput')?.value || '';

        clearTimeout(filterTimeout);
        filterTimeout = setTimeout(() => {
            window.location.href = buildDirectoryUrl({ q: searchText, state: stateId, pincode: pincode });
        }, 350);
    }

    document.addEventListener('DOMContentLoaded', function () {
        const params = new URLSearchParams(window.location.search);

        const stateSelect = document.getElementById('stateSelect');
        if (stateSelect && params.has('state')) {
            stateSelect.value = params.get('state') || '';
        }

        const searchInput = document.getElementById('companySearchInput');
        if (searchInput && params.has('q')) {
            searchInput.value = params.get('q') || '';
        }

        const pincodeInput = document.getElementById('pincodeInput');
        if (pincodeInput && params.has('pincode')) {
            pincodeInput.value = params.get('pincode') || '';
        }

        const sortSelect = document.getElementById('companySortSelect');
        if (sortSelect && params.has('sort')) {
            sortSelect.value = params.get('sort') || '';
        }
    });
</script>
</body>
</html>
