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

        .container-custom {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        @media (max-width: 768px) {
            .container-custom {
                padding: 0 1.25rem;
            }
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





        /* Hero Section */
        .category-hero {
            position: relative;
            background: linear-gradient(135deg, rgba(0, 55, 95, 0.9), rgba(6, 95, 70, 0.9));
            padding: 4.5rem 0 4rem;
            color: #fff;
            overflow: hidden;
        }

        .category-hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background: url("{{ asset('images/independent-reviews-bg.jpg') }}") no-repeat center/cover;
            opacity: 0.25;
        }

        .category-hero .hero-grid {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2.5rem;
            align-items: center;
        }

        .hero-eyebrow {
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-size: 0.9rem;
            color: #bbf7d0;
            margin-bottom: 0.6rem;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .hero-eyebrow span {
            width: 28px;
            height: 2px;
            background: #bbf7d0;
            display: inline-block;
        }

        .category-hero h1 {
            font-size: clamp(2rem, 4vw, 2.8rem);
            margin-bottom: 1.25rem;
            line-height: 1.2;
        }

        .category-hero p {
            color: rgba(255,255,255,0.85);
            margin-bottom: 1.5rem;
            font-size: 1.05rem;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
        }

        .hero-zip {
            display: flex;
            border-radius: 999px;
            background: rgba(255,255,255,0.12);
            padding: 0.35rem;
        }

        .hero-zip input {
            border: none;
            background: transparent;
            color: #fff;
            padding: 0.65rem 1.2rem;
            min-width: 160px;
        }

        .hero-zip input::placeholder {
            color: rgba(255,255,255,0.7);
        }

        .hero-zip button {
            border: none;
            border-radius: 999px;
            padding: 0.65rem 1.5rem;
            background: #f97316;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
        }

        .hero-metrics {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1rem;
            background: rgba(255,255,255,0.08);
            border-radius: 1.25rem;
            padding: 1.5rem;
            backdrop-filter: blur(4px);
        }

        .metric-card h3 {
            margin: 0;
            font-size: 2rem;
        }

        .metric-card span {
            font-size: 0.9rem;
            color: rgba(255,255,255,0.75);
        }

        @media (max-width: 640px) {
            .hero-zip {
                flex-direction: column;
                border-radius: 1rem;
            }
    font-weight: 700;
    color: #1e293b;
}

/* Updated */
.updated-date {
    color: #64748b;
    font-size: 0.95rem;
}

/* Description */
.section-desc {
    max-width: 700px;
    font-size: 1.1rem;
    color: #334155;
    margin: 20px 0 30px;
}

.on-page-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 15px;
}

/* Options Grid */
.options-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 15px;
    max-width: 900px;
}

.opt-btn {
    background: #00b7ff;
    color: white;
    padding: 14px 20px;
    font-size: 1.05rem;
    font-weight: 700;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

/* Zip Calculator */
.zip-calculator {
    display: flex;
    align-items: center;
    gap: 15px;
}

.calc-title {
    color: #ff6700;
    font-size: 1.3rem;
    font-weight: 700;
}

.zip-input {
    padding: 12px 16px;
    font-size: 1.1rem;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    width: 200px;
}

.start-btn {
    padding: 12px 24px;
    background: #ff5a1f;
    border: none;
    color: white;
    border-radius: 6px;
    font-weight: 700;
    cursor: pointer;
}


.section-title {
    font-size: 2.25rem;
    color: #1e293b;
}

.brand-card {
    background: white;
    border: 1px solid #d1d5db;
    padding: 20px;
    border-radius: 10px;
    min-height: 420px;
    transition: all 0.3s ease;
}

.brand-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
}

.tag {
    display: inline-block;
    padding: 4px 12px;
    background: #e2e8f0;
    color: #475569;
    border-radius: 4px;
    font-size: 0.85rem;
    margin-bottom: 10px;
}

.brand-title {
    font-size: 1.25rem;
    color: #1e293b;
    margin-top: 8px;
}

.rating-row {
    display: flex;
    align-items: center;
    gap: 6px;
    margin: 8px 0;
}

.stars {
    color: #fbbf24;
    font-size: 1.3rem;
}

.rating-number {
    color: #1e293b;
    font-weight: 600;
}

.review-count {
    color: #0284c7;
    font-weight: 500;
}

.latest-review strong,
.review-header {
    margin-top: 10px;
    display: block;
    color: #1e293b;
}

.read-more {
    color: #0284c7;
    text-decoration: none;
}

.cost-label,
.cost-title {
    display: block;
    font-size: 0.9rem;
    color: #475569;
    margin-top: 15px;
}

.cost-value {
    font-weight: 600;
    color: #1e293b;
}

.cost-value span,
.cost-watt {
    color: #64748b;
    font-weight: 400;
}

.brand-btn {
    display: block;
    width: 100%;
    margin-top: 20px;
    background: #f97316;
    color: white;
    padding: 12px;
    border-radius: 6px;
    text-align: center;
    font-weight: 600;
    text-decoration: none;
    transition: background 0.3s ease;
}

.brand-btn:hover {
    background: #ea580c;
}

.sort-box {
    display: flex;
    align-items: center;
    gap: 10px;
}

.sort-label {
    font-weight: 600;
}

.sort-select {
    padding: 6px 10px;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
}

.sidebar-box {
    background: white;
    border: 1px solid #d1d5db;
    padding: 20px;
    border-radius: 10px;
}

.sidebar-title {
    font-weight: 600;
    font-size: 1.1rem;
    margin-bottom: 15px;
}

.zip-input {
    width: 100%;
    padding: 8px;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    margin-bottom: 15px;
}

.start-btn {
    width: 100%;
    background: #f97316;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 6px;
    font-weight: 600;
}

.pagination-box {
    display: flex;
    gap: 8px;
}

.page-btn {
    padding: 6px 12px;
    border: none;
    background: #cbd5e1;
    border-radius: 4px;
}

.page-btn.active {
    background: #2563eb;
    color: white;
}

.page-info {
    color: #475569;
    font-size: 0.9rem;
}

    </style>
</head>
<body>
    <div class="page-wrapper">
        @include('components.frontend.navbar')

        <!-- Category Hero -->
        <section class="category-hero">
            <div class="container-custom hero-grid">
                <div>
                    <div class="hero-eyebrow"><span></span> Trusted {{ strtolower($category->name) }} reviews</div>
                    <h1>Discover the best {{ strtolower($category->name) }} companies near you.</h1>
                    <p>
                        Verified customer feedback, expert analysis, and transparent pricing data gathered from across India help you pick the ideal installer.
                    </p>
                    <div class="hero-actions">
                        <div class="hero-zip">
                            <input type="text" placeholder="Enter ZIP">
                            <button type="button">Check availability</button>
                        </div>
                        <small>Over 30k+ reviews analyzed</small>
                    </div>
                </div>
                <div class="hero-metrics">
                    <div class="metric-card">
                        <h3>33,992</h3>
                        <span>Company reviews</span>
                    </div>
                    <div class="metric-card">
                        <h3>5,322</h3>
                        <span>Equipment reviews</span>
                    </div>
                    <div class="metric-card">
                        <h3>1,362</h3>
                        <span>Panel prices tracked</span>
                    </div>
                    <div class="metric-card">
                        <h3>560</h3>
                        <span>DIY kit estimates</span>
                    </div>
                </div>
            </div>
        </section>


        <!-- Solar Review Section -->
        <section class="solar-review-section py-5">
            <div class="container-custom">
        
                <!-- Breadcrumb -->
                <p class="breadcrumb-custom">Home > Solar panel reviews</p>

                <!-- Title -->
                <h1 class="section-title">Best solar panels 2025</h1>

                <p class="updated-date">Updated: April 11, 2023</p>

                <!-- Description -->
                <p class="section-desc">
                    Our expert and consumer reviews of the leading brands of residential solar panels show the 
                    best solar panels to suit your home in 2025
                </p>

                <!-- On this page -->
                <h4 class="on-page-title">On this page:</h4>

                <!-- Buttons Grid -->
                <div class="options-grid">
                    <button class="opt-btn">BEST BY EXPERT REVIEW</button>
                    <button class="opt-btn">BEST BY CONSUMER REVIEW</button>
                    <button class="opt-btn">MOST EFFICIENT</button>
                    <button class="opt-btn">BEST VALUE</button>
                    <button class="opt-btn">US PANEL MANUFACTURERS</button>
                    <button class="opt-btn">TYPES OF MANUFACTURERS</button>
                </div>

              

            </div>
        </section>




<!-- Top Rated Solar Brands Section -->
<section class="solar-section py-5 bg-light border-bottom">
    <div class="container-custom">

        <!-- Header Row -->
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-3">

            <h2 class="fw-bold section-title">
                Best 20 brands of solar panels by consumer reviews
            </h2>

            <!-- Sort Box -->
            <div class="sort-box">
                <label class="sort-label">Sort by:</label>
                <select class="sort-select">
                    <option>Default</option>
                </select>
            </div>

        </div>

        <div class="row">
            
            <!-- LEFT: Cards -->
            <div class="col-lg-9">
                <div class="row g-4">

                    <!-- Card 1 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="brand-card">

                            <span class="tag">Panel</span>

                            <h3 class="brand-title">LG Solar</h3>

                            <div class="rating-row">
                                <span class="stars">⭐⭐⭐⭐⭐</span>
                                <span class="rating-number">4.79</span>
                                <span class="review-count">930 Reviews</span>
                            </div>

                            <strong class="review-header">Latest review</strong>
                            <p class="text-muted m-0">Judith goldsmith , over 1 month</p>
                            <p class="text-muted">Eliza Garcia was my represent…</p>
                            <a href="#" class="read-more">Read more</a>

                            <div class="cost-box">
                                <p class="cost-title">Average cost (5kW system)</p>
                                <p class="cost-value">$15,683 <span>($3.14 per watt)</span></p>
                            </div>

                            <a href="#" class="brand-btn">COST FOR YOUR HOME</a>

                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="brand-card">

                            <span class="tag">Panel</span>

                            <h3 class="brand-title">Panasonic</h3>

                            <div class="rating-row">
                                <span class="stars">⭐⭐⭐⭐⭐</span>
                                <span class="rating-number">4.83</span>
                                <span class="review-count">325 Reviews</span>
                            </div>

                            <strong class="review-header">Latest review</strong>
                            <p class="text-muted m-0">MTED, over 1 month</p>
                            <p class="text-muted">I chose Panasonic solar panels…</p>
                            <a href="#" class="read-more">Read more</a>

                            <div class="cost-box">
                                <p class="cost-title">Average cost (5kW system)</p>
                                <p class="cost-value">$15,893 <span>($3.18 per watt)</span></p>
                            </div>

                            <a href="#" class="brand-btn">COST FOR YOUR HOME</a>

                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="brand-card">

                            <span class="tag">Installer</span>

                            <h3 class="brand-title">Complete Solar, DB...</h3>

                            <div class="rating-row">
                                <span class="stars">⭐⭐⭐⭐✰</span>
                                <span class="rating-number">4.51</span>
                                <span class="review-count">1,278 Reviews</span>
                            </div>

                            <strong class="review-header">Latest review</strong>
                            <p class="text-muted m-0">Steve, over 1 month</p>
                            <p class="text-muted">SUN Power set me up with So…</p>
                            <a href="#" class="read-more">Read more</a>

                            <div class="cost-box">
                                <p class="cost-title">Average cost (5kW system)</p>
                                <p class="cost-value">$16,523 <span>($3.30 per watt)</span></p>
                            </div>

                            <a href="#" class="brand-btn">COST FOR YOUR HOME</a>

                        </div>
                    </div>

                </div>

                <!-- Pagination -->
                <div class="pagination-box mt-4">
                    <button class="page-btn">&lt;</button>
                    <button class="page-btn active">&gt;</button>
                </div>

                <div class="text-center mt-2 page-info">Installer 1 of 20</div>

            </div>

            <!-- RIGHT: Sidebar Box -->
            <div class="col-lg-3">
                <div class="sidebar-box">

                    <h4 class="sidebar-title">Cost & savings calculator</h4>

                    <input type="text" class="zip-input" placeholder="Zip Code">

                    <button class="start-btn">GET STARTED</button>

                </div>
            </div>

        </div>

    </div>
</section>









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
