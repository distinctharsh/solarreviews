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

        .directory-card {
            width: 100%;
            background: #fff;
            border-radius: 18px;
            padding: 2rem;
            box-shadow: 0 20px 60px rgba(15, 23, 42, 0.1);
            border: 1px solid #e5e7eb;
        }

        .directory-card-header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .directory-card-header h2 {
            font-size: 1.35rem;
            font-weight: 600;
            margin: 0;
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

        @media (max-width: 768px) {
            .directory-card {
                padding: 1.5rem;
            }

            .directory-card-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .company-table {
                font-size: 0.92rem;
            }

            .company-table th,
            .company-table td {
                white-space: nowrap;
            }

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

    <main class="directory-main">
        <div class="container-custom">
            <div class="directory-card">
                <div class="directory-card-header">
                    <div>
                        <h2>Company Directory</h2>
                        <p class="text-muted mb-0">Click any company name to view the full profile.</p>
                    </div>
                    <input type="text" class="search-input" placeholder="Search companies" oninput="filterCompanies(this.value)">
                </div>

                <div class="table-responsive">
                    <table class="table company-table align-middle mb-0" id="companiesTable">
                        <thead>
                            <tr>
                                <th scope="col">Company</th>
                                <th scope="col">State</th>
                                <th scope="col">Type</th>
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
                                    <td>{{ $company->state_name ?? '—' }}</td>
                                    <td>{{ \Illuminate\Support\Str::headline($company->company_type ?? 'Installer') }}</td>
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
    </main>

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
