@php
    $updatedDate = optional($ratingSummary['updated_at'] ?? null)?->format('F j, Y');
    $breakdownChunks = collect($ratingBreakdown)->chunk(ceil(max(count($ratingBreakdown), 1) / 2));
    $totalReviews = $ratingSummary['total'] ?? 0;
    $location = collect([$company->city, $company->state])->filter()->implode(', ');

    $companyTitle = $company->name . ' Reviews & Profile | Solar Reviews India';
    $companyDescription = ($company->description ?: 'Compare verified reviews, ratings and expert analysis for ' . $company->name . '.') . ' Explore service type, years in business and rating breakdown.';
    $companyCanonical = route('companies.show', $company->slug);
    $aggregateRating = [
        '@type' => 'AggregateRating',
        'ratingValue' => number_format($ratingSummary['average'], 1),
        'reviewCount' => (int) $ratingSummary['total'],
    ];
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('components.frontend.meta-tags', [
        'title' => $companyTitle,
        'description' => $companyDescription,
        'canonical' => $companyCanonical,
        'type' => 'article',
        'image' => $logoUrl,
    ])

    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            'name' => $company->name,
            'url' => $companyCanonical,
            'image' => $logoUrl,
            'priceRange' => '₹₹₹',
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => $company->city,
                'addressRegion' => $company->state,
                'addressCountry' => 'IN',
            ],
            'aggregateRating' => $aggregateRating,
            'description' => $companyDescription,
        ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --shade-dark: #0a1c15;
            --shade-light: #f7f9fb;
        --ink: #0f172a;
        --muted: #6b7280;
        --accent: #008453;
        --accent-soft: #d5f5e6;
        --border: #e3e8ef;
    }

    .container-custom {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    .company-page {
        background: var(--shade-light);
    }

    .company-hero {
        background: linear-gradient(120deg, #1e7b34, #3fb454);
        color: #fff;
        padding: 4rem 0 3rem;
    }

    .hero-grid {
        display: grid;
        grid-template-columns: minmax(0, 2fr) 320px;
        gap: 2rem;
        align-items: center;
    }

    .updated-pill {
        text-transform: uppercase;
        letter-spacing: 0.15em;
        font-size: 0.72rem;
        color: rgba(255,255,255,0.7);
    }

    .hero-title {
        font-size: clamp(2.1rem, 4vw, 3rem);
        margin: 0.4rem 0 0.8rem;
    }

    .hero-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        color: rgba(255,255,255,0.8);
    }

    .meta-pill {
        padding: 0.35rem 0.9rem;
        border-radius: 999px;
        background: rgba(255,255,255,0.15);
        font-size: 0.78rem;
        letter-spacing: 0.05em;
    }

    .meta-dot {
        opacity: 0.5;
    }

    .rating-summary {
        margin-top: 1.75rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        flex-wrap: wrap;
    }

    .rating-stars i {
        color: #fbcf4b;
        opacity: 0.35;
        font-size: 1.15rem;
    }

    .rating-stars .filled {
        opacity: 1;
    }

    .rating-value span {
        font-size: 3.2rem;
        font-weight: 700;
    }

    .rating-value small {
        display: block;
        color: rgba(255,255,255,0.7);
    }

    .rating-method {
        color: #8df2c5;
        text-decoration: none;
        font-weight: 600;
    }

    .hero-ctas {
        margin-top: 2rem;
        display: flex;
        gap: 0.85rem;
        flex-wrap: wrap;
    }

    .btn-primary,
    .btn-secondary {
        border-radius: 999px;
        padding: 0.9rem 1.6rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 0.4rem;
    }

    .btn-primary {
        background: linear-gradient(130deg, #22c55e, #0ea372);
        color: #fff;
        box-shadow: 0 12px 25px rgba(11, 187, 115, 0.35);
        border: none;
    }

    .btn-secondary {
        border: 1px solid rgba(255,255,255,0.4);
        color: #fff;
        background: transparent;
    }

    .hero-side-card {
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.18);
        border-radius: 24px;
        padding: 1.75rem;
        backdrop-filter: blur(6px);
    }

    .logo-wrapper {
        background: rgba(255,255,255,0.12);
        border-radius: 18px;
        padding: 1rem;
        text-align: center;
        margin-bottom: 1.2rem;
    }

    .logo-wrapper img {
        width: 115px;
        height: 115px;
        object-fit: contain;
    }

    .verified-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        color: #a2f2d1;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .verified-pill i {
        color: #63ffbc;
    }

    .quick-meta {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 0.95rem;
    }

    .quick-meta span {
        font-size: 0.82rem;
        color: rgba(255,255,255,0.58);
    }

    .quick-meta strong {
        font-size: 1.05rem;
    }

    .stats-row {
        margin-top: -55px;
        padding-bottom: 1.5rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1rem;
    }

    .stat-card {
        background: #fff;
        border-radius: 18px;
        padding: 1.3rem;
        border: 1px solid var(--border);
        box-shadow: 0 15px 30px rgba(15,23,42,0.08);
    }

    .stat-card p {
        text-transform: uppercase;
        letter-spacing: 0.09em;
        font-size: 0.74rem;
        color: var(--muted);
        margin-bottom: 0.3rem;
    }

    .stat-card h3 {
        margin: 0;
        font-size: 1.6rem;
        color: var(--ink);
    }

    .company-main {
        padding: 2.5rem 0 3rem;
    }

    .main-grid {
        display: grid;
        grid-template-columns: minmax(0, 2fr) 330px;
        gap: 1.75rem;
        align-items: start;
    }

    .card {
        background: #fff;
        border-radius: 22px;
        border: 1px solid var(--border);
        padding: 1.8rem;
        box-shadow: 0 18px 45px rgba(15,23,42,0.06);
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 1.25rem;
    }

    .eyebrow {
        text-transform: uppercase;
        letter-spacing: 0.1em;
        font-size: 0.72rem;
        color: var(--muted);
        margin-bottom: 0.2rem;
    }

    .badge-light {
        background: var(--accent-soft);
        color: var(--accent);
        padding: 0.35rem 0.85rem;
        border-radius: 999px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .distribution-list {
        display: flex;
        flex-direction: column;
        gap: 0.9rem;
    }

    .distribution-row {
        display: grid;
        grid-template-columns: 70px 1fr 50px;
        gap: 0.7rem;
        align-items: center;
        font-size: 0.92rem;
        color: var(--ink);
    }

    .distribution-bar {
        height: 11px;
        background: #eff3f8;
        border-radius: 999px;
        overflow: hidden;
    }

    .distribution-bar .fill {
        display: block;
        height: 100%;
        border-radius: 999px;
        background: linear-gradient(120deg, #2ac6ff, #1b5fff);
    }

    .expert-card .expert-value {
        font-size: 1.55rem;
        color: var(--accent);
        font-weight: 700;
    }

    .expert-stars i {
        color: #f7c948;
        opacity: 0.35;
        font-size: 1.15rem;
    }

    .expert-stars .filled {
        opacity: 1;
    }

    .expert-body .muted {
        color: var(--muted);
        margin-top: 0.9rem;
    }

    .expert-body .muted a {
        color: #0a7bdc;
        text-decoration: none;
        font-weight: 600;
    }

    .expert-bar {
        display: flex;
        gap: 0.35rem;
        margin-top: 0.9rem;
    }

    .expert-bar .segment {
        flex: 1;
        height: 9px;
        border-radius: 999px;
        background: #e3e7ef;
    }

    .expert-bar .segment.active {
        background: linear-gradient(120deg, #00d8b2, #00a0de);
    }

    .breakdown-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.25rem;
    }

    .metric {
        background: #f9fbfd;
        border-radius: 16px;
        padding: 0.9rem;
    }

    .metric-top {
        display: flex;
        justify-content: space-between;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .metric-bar {
        height: 8px;
        background: #e5ebf3;
        border-radius: 999px;
        margin-top: 0.45rem;
    }

    .metric-bar .fill {
        display: block;
        height: 100%;
        border-radius: 999px;
        background: linear-gradient(120deg, #007aff, #4c1dff);
    }

    .about-text {
        color: var(--muted);
        line-height: 1.6;
        font-size: 0.95rem;
    }

    .about-list,
    .contact-list {
        list-style: none;
        margin: 1.25rem 0 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        gap: 0.9rem;
    }

    .about-list span,
    .contact-list span {
        text-transform: uppercase;
        font-size: 0.78rem;
        letter-spacing: 0.12em;
        color: var(--muted);
    }

    .about-list strong,
    .contact-list strong {
        font-size: 1rem;
        color: var(--ink);
    }

    .contact-list a {
        color: #0a78d1;
        text-decoration: none;
        font-weight: 600;
    }

    .about-list em,
    .contact-list em {
        color: var(--muted);
    }

    .help-card {
        text-align: center;
        background: linear-gradient(120deg, #e3fff2, #f4fffb);
        border: 1px solid #d6f2e5;
    }

    .help-card h3 {
        color: var(--ink);
        margin-bottom: 0.5rem;
    }

    .help-card p {
        color: var(--muted);
        margin-bottom: 1rem;
    }

    .w-100 {
        width: 100%;
    }

    @media (max-width: 1024px) {
        .hero-grid,
        .main-grid {
            grid-template-columns: 1fr;
        }

        .hero-side-card {
            order: -1;
        }
    }

    @media (max-width: 640px) {
            flex-direction: column;
            gap: 0.9rem;
        }

        .distribution-row {
            display: grid;
            grid-template-columns: 70px 1fr 50px;
            gap: 0.7rem;
            align-items: center;
            font-size: 0.92rem;
            color: var(--ink);
        }

        .distribution-bar {
            height: 11px;
            background: #eff3f8;
            border-radius: 999px;
            overflow: hidden;
        }

        .distribution-bar .fill {
            display: block;
            height: 100%;
            border-radius: 999px;
            background: linear-gradient(120deg, #2ac6ff, #1b5fff);
        }

        .expert-card .expert-value {
            font-size: 1.55rem;
            color: var(--accent);
            font-weight: 700;
        }

        .expert-stars i {
            color: #f7c948;
            opacity: 0.35;
            font-size: 1.15rem;
        }

        .expert-stars .filled {
            opacity: 1;
        }

        .expert-body .muted {
            color: var(--muted);
            margin-top: 0.9rem;
        }

        .expert-body .muted a {
            color: #0a7bdc;
            text-decoration: none;
            font-weight: 600;
        }

        .expert-bar {
            display: flex;
            gap: 0.35rem;
            margin-top: 0.9rem;
        }

        .expert-bar .segment {
            flex: 1;
            height: 9px;
            border-radius: 999px;
            background: #e3e7ef;
        }

        .expert-bar .segment.active {
            background: linear-gradient(120deg, #00d8b2, #00a0de);
        }

        .breakdown-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.25rem;
        }

        .metric {
            background: #f9fbfd;
            border-radius: 16px;
            padding: 0.9rem;
        }

        .metric-top {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .metric-bar {
            height: 8px;
            background: #e5ebf3;
            border-radius: 999px;
            margin-top: 0.45rem;
        }

        .metric-bar .fill {
            display: block;
            height: 100%;
            border-radius: 999px;
            background: linear-gradient(120deg, #007aff, #4c1dff);
        }

        .about-text {
            color: var(--muted);
            line-height: 1.6;
            font-size: 0.95rem;
        }

        .about-list,
        .contact-list {
            list-style: none;
            margin: 1.25rem 0 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 0.9rem;
        }

        .about-list span,
        .contact-list span {
            text-transform: uppercase;
            font-size: 0.78rem;
            letter-spacing: 0.12em;
            color: var(--muted);
        }

        .about-list strong,
        .contact-list strong {
            font-size: 1rem;
            color: var(--ink);
        }

        .contact-list a {
            color: #0a78d1;
            text-decoration: none;
            font-weight: 600;
        }

        .about-list em,
        .contact-list em {
            color: var(--muted);
        }

        .help-card {
            text-align: center;
            background: linear-gradient(120deg, #e3fff2, #f4fffb);
            border: 1px solid #d6f2e5;
        }

        .help-card h3 {
            color: var(--ink);
            margin-bottom: 0.5rem;
        }

        .help-card p {
            color: var(--muted);
            margin-bottom: 1rem;
        }

        .w-100 {
            width: 100%;
        }

        @media (max-width: 1024px) {
            .hero-grid,
            .main-grid {
                grid-template-columns: 1fr;
            }

            .hero-side-card {
                order: -1;
            }
        }

        @media (max-width: 640px) {
            .hero-meta {
                flex-direction: column;
                align-items: flex-start;
            }

            .rating-summary {
                flex-direction: column;
                align-items: flex-start;
            }

            .hero-ctas {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="company-page">
        @include('components.frontend.navbar')
        <section class="company-hero">
            <div class="container-custom">
                <div class="hero-grid">
                    <div class="hero-info">
                        <p class="updated-pill">Profile updated {{ $updatedDate ?? 'recently' }}</p>
                        <h1 class="hero-title">{{ $company->name }}</h1>
                        <div class="hero-meta">
                            <span class="meta-pill">{{ $companyTypeLabel }}</span>
                            <span class="meta-dot">•</span>
                            <span>{{ $tenureCopy }}</span>
                            @if($location)
                                <span class="meta-dot">•</span>
                                <span>{{ $location }}</span>
                            @endif
                        </div>

                        <div class="rating-summary">
                            <div class="rating-stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= round($ratingSummary['average']) ? 'filled' : '' }}"></i>
                                @endfor
                            </div>
                            <div class="rating-value">
                                <span>{{ number_format($ratingSummary['average'], 1) }}</span>
                                <small>{{ number_format($ratingSummary['total']) }} verified reviews</small>
                            </div>
                            <a class="rating-method" href="#">How we calculate ratings</a>
                        </div>

                        <div class="hero-ctas">
                            <a href="{{ route('reviews.create') }}" class="btn-primary">Write a review</a>
                            <a href="#rating-breakdown" class="btn-secondary">View rating details</a>
                        </div>
                    </div>

                    <div class="hero-side-card">
                        <div class="logo-wrapper">
                            <img src="{{ $logoUrl }}" alt="{{ $company->name }} logo">
                        </div>
                        <div class="verified-pill">
                            <i class="fas fa-badge-check"></i>
                            Verified SolarReviews partner
                        </div>
                        <ul class="quick-meta">
                            <li>
                                <span>Founded</span>
                                <strong>{{ $company->years_in_business ? (now()->year - $company->years_in_business) . ' yrs ago' : 'N/A' }}</strong>
                            </li>
                            <li>
                                <span>Service type</span>
                                <strong>{{ $companyTypeLabel }}</strong>
                            </li>
                            <li>
                                <span>Last updated</span>
                                <strong>{{ $updatedDate ?? 'Recently' }}</strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="stats-row">
            <div class="container-custom">
                <div class="stats-grid">
                    <article class="stat-card">
                        <p>Average rating</p>
                        <h3>{{ number_format($ratingSummary['average'], 1) }} / 5</h3>
                    </article>
                    <article class="stat-card">
                        <p>Total reviews</p>
                        <h3>{{ number_format($ratingSummary['total']) }}</h3>
                    </article>
                    <article class="stat-card">
                        <p>Expert tier</p>
                        <h3>{{ $expertScore['label'] }}</h3>
                    </article>
                    <article class="stat-card">
                        <p>Years in business</p>
                        <h3>{{ $company->years_in_business ? $company->years_in_business . '+' : '10+' }}</h3>
                    </article>
                </div>
            </div>
        </section>

        <section class="company-main">
            <div class="container-custom">
                <div class="main-grid">
                    <div class="main-left">
                        <article class="card" id="rating-breakdown">
                            <header class="card-header">
                                <div>
                                    <p class="eyebrow">Customer feedback</p>
                                    <h2>Rating distribution</h2>
                                </div>
                                <span class="badge-light">{{ number_format($ratingSummary['total']) }} reviews</span>
                            </header>

                            <div class="distribution-list">
                                @foreach ($ratingDistribution as $stars => $count)
                                    @php
                                        $percent = $totalReviews ? round(($count / $totalReviews) * 100) : 0;
                                    @endphp
                                    <div class="distribution-row">
                                        <span class="stars-label">{{ $stars }} star</span>
                                        <div class="distribution-bar">
                                            <span class="fill" style="width: {{ $percent }}%"></span>
                                        </div>
                                        <span class="count">{{ $count }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </article>

                        <article class="card expert-card">
                            <header class="card-header">
                                <div>
                                    <p class="eyebrow">SolarReviews expert score</p>
                                    <h2>{{ $expertScore['label'] }} tier</h2>
                                </div>
                                <span class="expert-value">{{ $expertScore['value'] }}/100</span>
                            </header>
                            <div class="expert-body">
                                <div class="expert-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= round($expertScore['stars']) ? 'filled' : '' }}"></i>
                                    @endfor
                                </div>
                                <div class="expert-bar">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span class="segment {{ $i <= round($expertScore['stars']) ? 'active' : '' }}"></span>
                                    @endfor
                                </div>
                                <p class="muted">
                                    Scores combine licensing checks, consumer sentiment, workforce practices, pricing transparency, and more.
                                    <a href="#">See methodology</a>
                                </p>
                            </div>
                        </article>

                        <article class="card">
                            <header class="card-header">
                                <div>
                                    <p class="eyebrow">Detailed scoring</p>
                                    <h2>Expert rating breakdown</h2>
                                </div>
                            </header>
                            <div class="breakdown-grid">
                                @foreach ($breakdownChunks as $column)
                                    <div class="breakdown-column">
                                        @foreach ($column as $metric)
                                            <div class="metric">
                                                <div class="metric-top">
                                                    <span>{{ $metric['label'] }}</span>
                                                    <strong>{{ $metric['score'] }}%</strong>
                                                </div>
                                                <div class="metric-bar">
                                                    <span class="fill" style="width: {{ $metric['score'] }}%"></span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </article>
                    </div>

                    <aside class="main-right">
                        <article class="card about-card">
                            <header class="card-header">
                                <div>
                                    <p class="eyebrow">About</p>
                                    <h2>{{ $company->name }}</h2>
                                </div>
                            </header>
                            <p class="about-text">
                                {{ $company->description ?: 'This installer is currently updating their story. Check back soon for more about their services, project approach, and certifications.' }}
                            </p>
                            <ul class="about-list">
                                <li>
                                    <span>Primary service type</span>
                                    <strong>{{ $companyTypeLabel }}</strong>
                                </li>
                                <li>
                                    <span>Years installing solar</span>
                                    <strong>{{ $company->years_in_business ? $company->years_in_business . '+ years' : 'Not disclosed' }}</strong>
                                </li>
                                <li>
                                    <span>Headquarters</span>
                                    <strong>{{ $location ?: 'Not listed' }}</strong>
                                </li>
                            </ul>
                        </article>

                        {{-- Contact & links card temporarily hidden per request --}}
                        {{--
                        <article class="card contact-card">
                            <header class="card-header">
                                <div>
                                    <p class="eyebrow">Contact & links</p>
                                    <h2>Connect with {{ Str::limit($company->name, 26) }}</h2>
                                </div>
                            </header>
                            <ul class="contact-list">
                                <li>
                                    <span>Website</span>
                                    @if($company->website_url)
                                        <a href="{{ $company->website_url }}" target="_blank">Visit site <i class="fas fa-arrow-up-right-from-square"></i></a>
                                    @else
                                        <em>Not shared</em>
                                    @endif
                                </li>
                                <li>
                                    <span>Email</span>
                                    @if($company->email)
                                        <a href="mailto:{{ $company->email }}">{{ $company->email }}</a>
                                    @else
                                        <em>Not shared</em>
                                    @endif
                                </li>
                                <li>
                                    <span>Phone</span>
                                    <strong>{{ $company->phone ?? 'Not shared' }}</strong>
                                </li>
                            </ul>
                            <div class="contact-cta">
                                <a href="{{ route('reviews.create') }}" class="btn-secondary w-100">Share your experience</a>
                            </div>
                        </article>
                        --}}
                    </aside>
                </div>
            </div>
        </section>

        @include('components.frontend.footer')
        @include('components.frontend.chatbot-widget')
    </div>
</body>
</html>

