<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Solar Installers Ranked by Consumer Reviews</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --primary: #1f2937;
            --accent: #3ba14c;
            --light-blue: #eef8f0;
            --border: #d9f0e0;
        }
        body {
            font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f7f9ff;
            color: var(--primary);
        }

        .container-custom {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        @media (max-width: 768px) {
            .container-custom {
                padding: 0 1rem;
            }
        }
        .page-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2.5rem 1.5rem 4rem;
        }
        .page-title {
            font-size: clamp(2rem, 4vw, 2.6rem);
            font-weight: 700;
            color: var(--primary);
                font-size: 36px;
    font-weight: 600;
        color: #0f172a;
        }
        .lede {
            color: #475569;
            max-width: 720px;
            font-size: 16px;
        }
        .content-grid {
            display: grid;
            grid-template-columns: 260px 1fr;
            gap: 1.5rem;
            margin-top: 2rem;
            align-items: start;
        }
        .sidebar-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1.5rem;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
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
            max-height: 320px;
            overflow-y: auto;
        }
        .state-list li {
            margin-bottom: 0.35rem;
        }
        .state-list a {
            color: var(--accent);
            text-decoration: none;
                font-weight: 400;
            font-size: 14px;
        }
        .state-list a.active,
        .state-list a:hover {
            color: #0f172a;
        }
        .table-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(15, 23, 42, 0.1);
        }
        .table thead {
            background: var(--light-blue);
        }
        .table thead th {
            border-bottom: none;
            font-size: 0.9rem;
            color: #475569;
        }
        .table tbody td {
            vertical-align: middle;
            border-color: #eef2ff;
            font-size: 14px;
        }
        .expert-dots span {
            display: inline-block;
            width: 16px;
            height: 16px;
            background: #cbd5ff;
            border-radius: 4px;
            margin-right: 4px;
        }
        .expert-dots span.active {
            background: var(--accent);
        }
        .rating-stars {
            color: #fbbf24;
            font-size: 14px;
            margin-right: 6px;
        }
        .btn-quote {
            border-radius: 999px;
            border: 1px solid var(--accent);
            color: var(--accent);
            padding: 0.35rem 1.1rem;
            font-weight: 400;
            font-size: 12px;
        }
        .btn-quote:hover {
            background: var(--accent);
            color: white;
        }
        @media (max-width: 992px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
        }
        
        .main-p{
            font-size: 14px;
        }
        
        .table thead th:first-child,
.table tbody td:first-child {
    padding-left: 1.5rem; /* same as px-4 */
}


.company-logo {
    width: 48px;
    height: 48px;
    min-width: 48px;      /* 🔥 important */
    flex-shrink: 0;       /* 🔥 important */
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    background: #fff;

    display: flex;
    align-items: center;
    justify-content: center;
}

.company-logo img {
    max-width: 80%;
    max-height: 80%;
    object-fit: contain;
}


.company-info {
    line-height: 1.3;
}

.table thead th {
    vertical-align: top;   /* 🔥 important */
}



    </style>
</head>
<body>
    @include('components.frontend.navbar')

    <div class="page-wrapper container-custom">
        <p class="text-uppercase text-muted fw-semibold mb-2 main-p" style="letter-spacing: 1.5px;">Consumer Reviews</p>
        <h1 class="page-title">Top 100 Solar Installers Ranked by Consumer Reviews</h1>
        <p class="lede mt-3">Solar Reviews is the leading Indian website for solar panel reviews and solar panel installation companies. Our independent expert rating keeps things unbiased so you can hire with confidence.</p>

        <div class="content-grid">
            <aside class="sidebar-card">
                <h5>About this list</h5>
                <p>SolarReviews has the most verified homeowner feedback in the industry. No company can pay to alter these scores &mdash; every star you see is earned.</p>
                <!-- <a href="#" class="d-inline-block mt-2 fw-semibold" style="color: var(--accent);">Learn more about our scoring &rarr;</a> -->

                <hr class="my-4">
                <h5>Solar in your state</h5>
                <ul class="state-list">
                    @forelse($states as $state)
                        <li>
                            <a
                                href="{{ route('reviews.top', ['state' => $state->slug]) }}"
                                class="{{ $activeState?->slug === $state->slug ? 'active fw-semibold' : '' }}"
                            >
                                {{ $state->name }}
                            </a>
                        </li>
                    @empty
                        <li class="text-muted">States coming soon.</li>
                    @endforelse
                </ul>
            </aside>

            <section class="table-card">
                <div class="d-flex justify-content-between align-items-center border-bottom px-4 py-3">
                    <div>
                        <strong>Showing:</strong>
                        <span>
                            {{ $activeState?->name ?? 'All states' }}
                        </span>
                    </div>
                    @if($activeState)
                        <a href="{{ route('reviews.top') }}" class="btn btn-sm btn-outline-secondary">Clear filter</a>
                    @endif
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th style="width:30%;">Company</th>
                                <th style="width:25%;">
    SolarReviews expert<br>
    rating
</th>

                                <th style="width:25%;">Consumer rating</th>
                                <th style="width:20%;" class="text-center">View</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($topCompanies as $company)
                            <tr>
                                <td class="fw-semibold">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="company-logo">
                                            <img src="{{ $company['logo'] }}" alt="{{ $company['name'] }} logo" >
                                        </div>
                                        <div>
                                            <a href="{{ route('companies.show', $company['slug']) }}" class="text-decoration-none text-dark fw-semibold" style="font-weight: 600 !important;">
                                                {{ $company['name'] }}
                                            </a>
                                            <div class="text-muted small">
                                                {{ $company['state'] ?? 'Pan India' }}
                                                @if($company['website_host'])
                                                    &middot;
                                                    <a href="{{ $company['website_url'] }}" target="_blank" rel="noopener" class="text-muted text-decoration-none">
                                                        {{ $company['website_host'] }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="expert-dots">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="{{ $i <= 5 ? 'active' : '' }}"></span>
                                        @endfor
                                    </div>
                                    <small class="text-muted d-block mt-1">SolarReviews rating</small>
                                </td>
                                <td>
                                    <span class="rating-stars">★★★★★</span>
                                    <span class="fw-semibold">{{ number_format($company['avg_rating'], 2) }}</span>
                                    <span class="text-muted">({{ number_format($company['review_count']) }} reviews)</span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('companies.show', $company['slug']) }}" class="btn btn-outline-primary btn-quote">View Profile</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-5">
                                    No installer data available yet. Check back soon.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>


        @include('components.frontend.footer')

</body>
</html>
