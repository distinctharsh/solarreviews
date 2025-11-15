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
        }
        .lede {
            color: #475569;
            max-width: 720px;
        }
        .content-grid {
            display: grid;
            grid-template-columns: 260px 1fr;
            gap: 1.5rem;
            margin-top: 2rem;
        }
        .sidebar-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1.5rem;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
        }
        .sidebar-card h5 {
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #94a3b8;
            margin-bottom: 0.75rem;
        }
        .sidebar-card p {
            font-size: 0.95rem;
            color: #475569;
            line-height: 1.5;
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
            font-weight: 500;
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
            font-size: 0.95rem;
            margin-right: 6px;
        }
        .btn-quote {
            border-radius: 999px;
            border: 1px solid var(--accent);
            color: var(--accent);
            padding: 0.35rem 1.1rem;
            font-weight: 600;
            font-size: 0.9rem;
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
    </style>
</head>
<body>
    @include('components.frontend.navbar')

    <div class="page-wrapper">
        @php
            $states = \App\Models\State::select('name', 'slug')->orderBy('name')->get();
        @endphp
        <p class="text-uppercase text-muted fw-semibold mb-2" style="letter-spacing: 1.5px;">Consumer Reviews</p>
        <h1 class="page-title">Top 100 Solar Installers Ranked by Consumer Reviews</h1>
        <p class="lede mt-3">SolarReviews is the leading American website for solar panel reviews and solar panel installation companies. Our independent expert rating keeps things unbiased so you can hire with confidence.</p>

        <div class="content-grid">
            <aside class="sidebar-card">
                <h5>About this list</h5>
                <p>SolarReviews has the most verified homeowner feedback in the industry. No company can pay to alter these scores &mdash; every star you see is earned.</p>
                <a href="#" class="d-inline-block mt-2 fw-semibold" style="color: var(--accent);">Learn more about our scoring &rarr;</a>

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

            <section class="table-card">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th style="width:30%;">Company</th>
                                <th style="width:25%;">SolarReviews expert rating</th>
                                <th style="width:25%;">Consumer rating</th>
                                <th style="width:20%;" class="text-center">Quote</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $companies = [
                                ['name' => 'Affordable Solar Roofing', 'expert' => 5, 'consumer' => '4.92', 'reviews' => 718],
                                ['name' => 'Lumina', 'expert' => 5, 'consumer' => '4.87', 'reviews' => 450],
                                ['name' => 'Sunergy Solutions LLC', 'expert' => 5, 'consumer' => '4.91', 'reviews' => 145],
                                ['name' => 'Green Power Energy', 'expert' => 4, 'consumer' => '4.83', 'reviews' => 404],
                                ['name' => 'SUNation Energy', 'expert' => 4, 'consumer' => '4.82', 'reviews' => 264],
                                ['name' => 'NorthPeak Installers', 'expert' => 4, 'consumer' => '4.79', 'reviews' => 231],
                            ];
                        @endphp
                        @foreach($companies as $company)
                            <tr>
                                <td class="fw-semibold">{{ $company['name'] }}</td>
                                <td>
                                    <div class="expert-dots">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="{{ $i <= $company['expert'] ? 'active' : '' }}"></span>
                                        @endfor
                                    </div>
                                </td>
                                <td>
                                    <span class="rating-stars">★★★★★</span>
                                    <span class="fw-semibold">{{ $company['consumer'] }}</span>
                                    <span class="text-muted">({{ $company['reviews'] }})</span>
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-outline-primary btn-quote">Get Quote</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>


        @include('components.frontend.footer')

</body>
</html>
