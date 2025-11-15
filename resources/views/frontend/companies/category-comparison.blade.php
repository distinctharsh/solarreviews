<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Best {{ $category->name }} Companies - Solar Reviews</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary-color: #269c3f;
            --secondary-color: #1e3a8a;
            --accent-color: #3b82f6;
            --text-color: #1f2937;
            --light-bg: #f9fafb;
            --bg-opacity: 0.75;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9fafb;
            color: #1f2937;
            margin: 0;
        }

        .page-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .compare-hero {
            background: linear-gradient(135deg, #239b3c 0%, #85c28e 100%);
            color: white;
            padding: 3.5rem 1.5rem 2.5rem;
        }

        .compare-container {
            max-width: 1140px;
            margin: 0 auto;
        }

        .breadcrumb {
            font-size: 0.875rem;
            margin-bottom: 1rem;
            color: rgba(255,255,255,0.8);
        }

        .breadcrumb a {
            color: rgba(255,255,255,0.9);
            text-decoration: none;
        }

        .compare-hero-title {
            font-size: 2.25rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
        }

        .compare-hero-subtitle {
            font-size: 1rem;
            max-width: 600px;
            color: rgba(255,255,255,0.9);
        }

        .compare-main {
            flex: 1;
            padding: 2.5rem 1.5rem 3.5rem;
        }

        .compare-layout {
            max-width: 1140px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 260px 1fr;
            gap: 2rem;
        }

        .filter-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 12px rgba(15,23,42,0.06);
            border: 1px solid #e5e7eb;
        }

        .filter-title {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #111827;
        }

        .filter-note {
            font-size: 0.85rem;
            color: #6b7280;
        }

        .company-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .company-card {
            background: white;
            border-radius: 12px;
            padding: 1.25rem 1.5rem;
            box-shadow: 0 4px 12px rgba(15,23,42,0.04);
            border: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .company-main {
            display: flex;
            gap: 1rem;
        }

        .company-logo {
            width: 64px;
            height: 64px;
            border-radius: 10px;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .company-logo img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .company-info {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .company-name {
            font-size: 1rem;
            font-weight: 600;
            color: #111827;
        }

        .company-meta {
            font-size: 0.85rem;
            color: #6b7280;
        }

        .rating-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.25rem;
        }

        .stars {
            color: #f59e0b;
            font-size: 0.85rem;
        }

        .rating-text {
            font-size: 0.85rem;
            color: #4b5563;
        }

        .company-actions {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            align-items: flex-end;
        }

        .badge-rank {
            font-size: 0.75rem;
            padding: 0.15rem 0.6rem;
            border-radius: 999px;
            background: #eff6ff;
            color: #269c3f;
            font-weight: 500;
        }

        .btn-outline-primary {
            border-radius: 999px;
            border: 1px solid #269c3f;
            color: #269c3f;
            padding: 0.4rem 0.9rem;
            font-size: 0.8rem;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .btn-outline-primary:hover {
            background: #269c3f;
            color: white;
        }

        .empty-state {
            padding: 2.5rem 1.5rem;
            text-align: center;
            background: white;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 12px rgba(15,23,42,0.04);
        }

        .empty-state h2 {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            font-size: 0.95rem;
            color: #6b7280;
        }

        @media (max-width: 900px) {
            .compare-layout {
                grid-template-columns: 1fr;
            }

            .company-card {
                flex-direction: column;
                gap: 0.75rem;
            }

            .company-actions {
                align-items: flex-start;
            }
        }





        /* Star Section */
.solar-hero {
    position: relative;
    background: url("{{ asset('images/independent-reviews-bg.jpg') }}") no-repeat center center/cover;
    background-color: rgba(0, 55, 95, var(--bg-opacity, 0.85));
    padding: 120px 0 100px;
    color: white;
}

.solar-hero .overlay {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.45);
}

.hero-content {
    position: relative;
    text-align: center;
    z-index: 2;
}

.solar-hero h1 {
    font-size: 2.4rem;
    font-weight: 700;
    margin-bottom: 30px;
}

.zip-box {
    display: flex;
    justify-content: center;
    gap: 0;
    margin-bottom: 40px;
}

.zip-box input {
    padding: 14px 20px;
    font-size: 1.2rem;
    border: none;
    outline: none;
    border-radius: 6px 0 0 6px;
    width: 260px;
}

.zip-box button {
    padding: 14px 26px;
    font-size: 1.2rem;
    background: #ff5a1f;
    color: white;
    border: none;
    border-radius: 0 6px 6px 0;
    cursor: pointer;
    font-weight: 600;
}

.stats-row {
    display: flex;
    justify-content: center;
    gap: 50px;
    flex-wrap: wrap;
}

.stat-box {
    text-align: center;
}

.star {
    font-size: 46px;
    color: #ffcc33;
    display: block;
}

.stat-box h3 {
    margin-top: 6px;
    margin-bottom: 0;
    font-size: 1.6rem;
    font-weight: 700;
}

.stat-box p {
    margin: 0;
    font-size: 1rem;
    opacity: 0.9;
}


    </style>
</head>
<body>
    <div class="page-wrapper">
        @include('components.frontend.navbar')



<!-- Star Section -->
<!-- <section class="solar-hero">
    <div class="overlay"></div>

    <div class="hero-content container-custom">
        <h1>Compare prices and reviews of solar providers near you online</h1>

        <div class="zip-box">
            <input type="text" placeholder="93305">
            <button>START</button>
        </div>

        <div class="stats-row">
            <div class="stat-box">
                <span class="star">★</span>
                <h3>33,992</h3>
                <p>Company reviews</p>
            </div>

            <div class="stat-box">
                <span class="star">★</span>
                <h3>5,322</h3>
                <p>Equipment reviews</p>
            </div>

            <div class="stat-box">
                <span class="star">★</span>
                <h3>1,362</h3>
                <p>Individual panel prices</p>
            </div>

            <div class="stat-box">
                <span class="star">★</span>
                <h3>560</h3>
                <p>Prices of DIY kits</p>
            </div>

            <div class="stat-box">
                <span class="star">★</span>
                <h3>3,721</h3>
                <p>Installed system prices</p>
            </div>
        </div>
    </div>
</section> -->










        <section class="compare-hero">
            <div class="compare-container">
                <div class="breadcrumb">
                    <a href="{{ url('/') }}">Home</a> &raquo; Best {{ $category->name }} Companies
                </div>
                <h1 class="compare-hero-title">Best {{ $category->name }} Companies in India</h1>
                <p class="compare-hero-subtitle">
                    We’ve ranked these companies based on verified customer reviews and overall ratings to help you choose the best {{ strtolower($category->name) }} brands.
                </p>
            </div>
        </section>

        <main class="compare-main">
            <div class="compare-layout">
                <aside class="filter-card">
                    <h3 class="filter-title">About this list</h3>
                    <p class="filter-note">
                        This list shows up to 20 companies with the highest average ratings and most reviews for {{ strtolower($category->name) }}. 
                        Use the state pages to see installers available in your area.
                    </p>
                </aside>

                <section>
                    @if($companies->isEmpty())
                        <div class="empty-state">
                            <h2>No companies found for this category yet.</h2>
                            <p>We’re still collecting reviews for {{ strtolower($category->name) }} providers. Check back soon or explore other categories.</p>
                        </div>
                    @else
                        <div class="company-list">
                            @foreach($companies as $index => $company)
                                <article class="company-card">
                                    <div class="company-main">
                                        <div class="company-logo">
                                            @if(!empty($company->logo))
                                                <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }} logo">
                                            @else
                                                <img src="{{ asset('images/company/cmp.png') }}" alt="Default Company Logo">
                                            @endif
                                        </div>
                                        <div class="company-info">
                                            <div class="company-name">{{ $company->name }}</div>
                                            <div class="company-meta">
                                                @if($company->state)
                                                    {{ $company->state->name }}
                                                @endif
                                            </div>
                                            <div class="rating-row">
                                                <div class="stars">
                                                    @php
                                                        $rating = $company->average_rating ?? 0;
                                                        $full = floor($rating);
                                                    @endphp
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $full)
                                                            <i class="fas fa-star"></i>
                                                        @else
                                                            <i class="far fa-star"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <div class="rating-text">
                                                    {{ number_format($rating, 1) }}
                                                    <span>&middot;</span>
                                                    {{ $company->total_reviews }} {{ $company->total_reviews == 1 ? 'review' : 'reviews' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="company-actions">
                                        <span class="badge-rank">Rank #{{ $index + 1 }}</span>
                                        <a href="{{ route('state.companies', $company->state->slug ?? '') }}" class="btn-outline-primary">
                                            View companies in {{ $company->state->name ?? 'this state' }}
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @endif
                </section>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
