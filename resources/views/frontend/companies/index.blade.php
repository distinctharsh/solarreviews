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

        .top-reviews-section {
            padding: 4rem 0 1rem;
            background: #f1f5f9;
        }

        .section-label {
            text-transform: uppercase;
            letter-spacing: 0.15em;
            font-size: 0.85rem;
            color: #94a3b8;
            margin-bottom: 0.75rem;
        }

        .page-title {
            font-size: clamp(2rem, 4vw, 2.5rem);
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 0.5rem;
        }

        .lede {
            color: #475569;
            max-width: 720px;
            line-height: 1.6;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 2rem;
            margin-top: 2.5rem;
        }

        .sidebar-card,
        .table-card {
            background: #fff;
            border-radius: 18px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 20px 60px rgba(15, 23, 42, 0.08);
        }

        .sidebar-card {
            padding: 1.75rem;
        }

        .sidebar-card h5 {
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: #94a3b8;
            margin-bottom: 0.75rem;
        }

        .sidebar-card p {
            color: #475569;
            line-height: 1.6;
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
            color: #0891b2;
            text-decoration: none;
            font-weight: 600;
        }

        .state-list a:hover {
            text-decoration: underline;
        }

        .table-card {
            padding: 1.5rem;
        }

        .table-card .table thead {
            background: #f8fafc;
        }

        .table-card .table th {
            color: #64748b;
            font-weight: 600;
            border-bottom: none;
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
            padding-top: 2rem;
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
            font-weight: 600;
            color: #0f172a;
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
        }

        .view-link:hover {
            color: #1e40af;
            text-decoration: underline;
        }

        @media (max-width: 992px) {
            .content-grid {
            }

            .lede {
                color: #475569;
                max-width: 720px;
                line-height: 1.6;
            }

            .content-grid {
                display: grid;
                grid-template-columns: 280px 1fr;
                gap: 2rem;
                margin-top: 2.5rem;
            }

            .sidebar-card,
            .table-card {
                background: #fff;
                border-radius: 18px;
                border: 1px solid #e2e8f0;
                box-shadow: 0 20px 60px rgba(15, 23, 42, 0.08);
            }

            .sidebar-card {
                padding: 1.75rem;
            }

            .sidebar-card h5 {
                font-size: 0.9rem;
                text-transform: uppercase;
                letter-spacing: 0.12em;
                color: #94a3b8;
                margin-bottom: 0.75rem;
            .table-responsive {
                border-radius: 14px;
            }
        }
    </style>
</head>
<body>
<div class="page-wrapper">
    @include('components.frontend.navbar')

    <section class="directory-hero">
        <div class="container-custom">
            <p class="text-uppercase text-white-50 mb-2">Solar Companies</p>
            <h1 class="directory-title">Discover Trusted Solar Companies Across India</h1>
            <p class="directory-subtitle">Browse our curated directory of vetted solar installers, EPCs, and manufacturers. Compare expert review data and jump straight into detailed company profiles.</p>

            <div class="directory-stats">
                <div class="stat-card">
                    <span>Total companies</span>
                    <strong>{{ number_format($totalCompanies) }}</strong>
                </div>
                <div class="stat-card">
                    <span>Average rating</span>
                    <strong>
                        {{ number_format($companies->avg('avg_rating'), 1) }}
                        <small style="font-size: 1rem; font-weight: 500;">/ 5</small>
                    </strong>
                </div>
            </div>
        </div>
    </section>

    <section class="top-reviews-section">
        <div class="container-custom">
            <div class="section-label">Consumer Reviews</div>
            <h2 class="page-title">Top Solar Installers Ranked by Reviews</h2>
            <p class="lede">SolarReviews publishes the largest volume of verified installer feedback. These highlights from our Top Reviews page make it easy to compare expert ratings and homeowner sentiment before you dive into the full directory.</p>

            <div class="content-grid">
                <aside class="sidebar-card">
                    <h5>About this list</h5>
                    <p class="mb-3">Every score below is earned from verified reviewers. No installer can pay to influence these ratings.</p>
                    <a href="{{ route('reviews.top') }}" class="fw-semibold text-decoration-none" style="color:#16a34a;">View full top reviews →</a>

                    <hr class="my-4">
                    <h5>Solar in your state</h5>
                    <ul class="state-list">
                        @forelse($states as $state)
                            <li>
                                <a href="{{ route('state.companies', $state->slug) }}">{{ $state->name }}</a>
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
                                    <h2 class="page-title" style="font-size:1.8rem; margin-bottom:0;">Company Directory</h2>
                                    <p class="text-muted mb-0">Click any company name to view the full profile.</p>
                                </div>
                                <input type="text" class="search-input" placeholder="Search companies" oninput="filterCompanies(this.value)">
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
                                            <tr data-name="{{ \Illuminate\Support\Str::lower($company->owner_name ?? $company->name ?? '') }}">
                                                <td>
                                                    <a href="{{ route('companies.show', $company->slug) }}" class="company-name text-decoration-none">
                                                        {{ $company->owner_name ?? $company->name ?? 'Company' }}
                                                    </a>
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
                                                        View profile
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
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>


    @include('components.frontend.footer')
</div>

<script>
    function filterCompanies(query) {
        const rows = document.querySelectorAll('#companiesTable tbody tr');
        const normalized = query.trim().toLowerCase();

        rows.forEach(row => {
            const name = row.getAttribute('data-name');
            row.style.display = name.includes(normalized) ? '' : 'none';
        });
    }
</script>
</body>
</html>
