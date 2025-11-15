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
            --primary-color: #3ba14c;
            --secondary-color: #1f6d30;
            --accent-color: #3ba14c;
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
            flex-wrap: wrap;
            margin-top: 0.35rem;
        }

        .rating-row .stars {
            color: #f59e0b;
            font-size: 1rem;
            letter-spacing: 1px;
        }

        .rating-row .rating-number,
        .rating-row .review-count,
        .rating-text {
            font-size: 0.9rem;
            color: #4b5563;
        }

        .brand-card .text-muted {
            font-size: 0.92rem;
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
            background: rgba(59, 161, 76, 0.12);
            color: var(--primary-color);
            font-weight: 500;
        }

        .btn-outline-primary {
            border-radius: 999px;
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
            padding: 0.4rem 0.9rem;
            font-size: 0.8rem;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .btn-outline-primary:hover {
            background: var(--primary-color);
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
            background: var(--primary-color);
            color: #fff;
            font-weight: 600;
            cursor: pointer;
        }

        .hero-zip button:hover {
            background: var(--primary-color-hover);
            color: white;
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
        background: var(--primary-color);
        color: white;
        padding: 14px 20px;
        font-size: 1.05rem;
        font-weight: 600;
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
        color: var(--primary-color);
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
        background: var(--primary-color);
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
        display: flex;
        flex-direction: column;
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
        color: var(--primary-color);
        font-weight: 500;
    }

    .latest-review strong,
    .review-header {
        margin-top: 10px;
        display: block;
        color: #1e293b;
    }

    .read-more {
        color: var(--primary-color);
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
        margin-top: auto;
        background: var(--primary-color);
        color: white;
        padding: 12px;
        border-radius: 6px;
        text-align: center;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.3s ease;
    }

    .brand-btn:hover {
        background: #2f7f3d;
    }

        .sort-box {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            background: #fff;
            border: 1px solid #dbe2f1;
            border-radius: 999px;
            padding: 0.5rem 1rem;
            box-shadow: 0 6px 14px rgba(15, 23, 42, 0.08);
        }

        .sort-label {
            font-weight: 600;
            font-size: 0.9rem;
            color: #475569;
            margin: 0;
        }

        .sort-control {
            position: relative;
        }

        .sort-button {
            border: none;
            background: transparent;
            font-weight: 600;
            font-size: 0.95rem;
            color: #1e293b;
            padding-right: 1.4rem;
            cursor: pointer;
        }

        .sort-button:focus-visible {
            outline: none;
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.35);
            border-radius: 0.75rem;
        }

        .sort-control::after {
            content: '\25BE';
            position: absolute;
            right: 0.65rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 0.85rem;
            color: #475569;
            pointer-events: none;
        }

        .sort-menu {
            position: absolute;
            right: 0;
            margin-top: 0.5rem;
            background: #fff;
            border: 1px solid #dbe2f1;
            border-radius: 0.75rem;
            box-shadow: 0 20px 35px rgba(15, 23, 42, 0.15);
            min-width: 220px;
            padding: 0.35rem;
            list-style: none;
            display: none;
            z-index: 5;
        }

        .sort-menu li button {
            width: 100%;
            border: none;
            background: transparent;
            text-align: left;
            padding: 0.55rem 0.75rem;
            border-radius: 0.55rem;
            font-size: 0.92rem;
            color: #1e293b;
            font-weight: 500;
            cursor: pointer;
        }

        .sort-menu li button:hover,
        .sort-menu li button.active {
            background: rgba(59, 161, 76, 0.12);
            color: var(--primary-color);
        }

        .sort-control.open .sort-menu {
            display: block;
        }

        @media (max-width: 576px) {
            .sort-box {
                width: 100%;
                justify-content: space-between;
            }

            .sort-select {
                width: auto;
            }
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
    background: var(--primary-color);
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



.why-important-section {
    background: #ffffff;
    color: #334155; /* Subtle slate */
}

.important-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: #1e293b; /* Dark navy like screenshot */
    margin-bottom: 20px;
}

.important-text {
    font-size: 1.05rem;
    line-height: 1.7;
    color: #475569;
    max-width: 850px;
}

.important-list {
    margin-top: 20px;
    margin-bottom: 20px;
    padding-left: 22px;
    color: #475569;
    font-size: 1.05rem;
    line-height: 1.7;
    max-width: 870px;
}

.important-list li {
    margin-bottom: 12px;
}


    </style>
</head>
<body>
    @php
        $categoryName = $category->name;
        $categoryNameLower = strtolower($categoryName);
    @endphp
    <div class="page-wrapper">
        @include('components.frontend.navbar')

        <!-- Category Hero -->
        <section class="category-hero">
            <div class="container-custom hero-grid">
                <div>
                    <div class="hero-eyebrow"><span></span> Trusted {{ $categoryNameLower }} reviews</div>
                    <h1>Discover the best {{ $categoryNameLower }} companies near you.</h1>
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
                        <span>{{ $categoryName }} prices tracked</span>
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
                <p class="breadcrumb-custom">Home > {{ $categoryName }} reviews</p>

                <!-- Title -->
                <h1 class="section-title">Best {{ $categoryName }} of 2025</h1>

                <p class="updated-date">Updated: November 15, 2025</p>

                <!-- Description -->
                <p class="section-desc">
                    Our expert and consumer reviews of the leading brands of residential {{ $categoryNameLower }} highlight the 
                    best {{ $categoryNameLower }} to suit your home in 2025
                </p>

                <!-- On this page -->
                <h4 class="on-page-title">On this page:</h4>

                <!-- Buttons Grid -->
                <div class="options-grid">
                    <button class="opt-btn">BEST BY EXPERT REVIEW</button>
                    <button class="opt-btn">BEST BY CONSUMER REVIEW</button>
                    <button class="opt-btn">MOST EFFICIENT</button>
                    <button class="opt-btn">BEST VALUE</button>
                    <button class="opt-btn">US {{ strtoupper($categoryName) }} MANUFACTURERS</button>
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
                Best 20 {{ $categoryName }} brands by consumer reviews
            </h2>

            <!-- Sort Box -->
            <div class="sort-box">
                <label class="sort-label mb-0">Sort by:</label>
                <div class="sort-control" data-sort-control>
                    <button type="button" class="sort-button" data-sort-trigger>Default</button>
                    <ul class="sort-menu" data-sort-menu>
                        @foreach([
                            'Default',
                            'Best Rated',
                            'Most Reviewed',
                            'Most Efficient',
                            'Most Popular',
                            'Best By Expert Review',
                            'Best By Consumer Review'
                        ] as $option)
                            <li>
                                <button type="button" data-sort-value="{{ $option }}" class="{{ $loop->first ? 'active' : '' }}">{{ $option }}</button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>

        <div class="row">
            
            <!-- LEFT: Cards -->
            <div class="col-lg-9">
                <div class="row g-4">

                    <!-- Card 1 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="brand-card">

                            <span class="tag">{{ $categoryName }}</span>

                            <h3 class="brand-title">LG Solar</h3>

                            <div class="rating-row">
                                <span class="stars">⭐⭐⭐⭐⭐</span>
                                <span class="rating-number">4.79</span>
                                <span class="review-count">930 Reviews</span>
                            </div>

                            <strong class="review-header">Latest review</strong>
                            <p class="text-muted m-0">Judith goldsmith , over 1 month</p>
                            <p class="text-muted">Eliza Garcia represent…</p>
                            <a href="#" class="read-more">Read more</a>

                            <a href="#" class="brand-btn">COST FOR YOUR HOME</a>

                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="brand-card">

                            <span class="tag">{{ $categoryName }}</span>

                            <h3 class="brand-title">Panasonic</h3>

                            <div class="rating-row">
                                <span class="stars">⭐⭐⭐⭐⭐</span>
                                <span class="rating-number">4.83</span>
                                <span class="review-count">325 Reviews</span>
                            </div>

                            <strong class="review-header">Latest review</strong>
                            <p class="text-muted m-0">MTED, over 1 month</p>
                            <p class="text-muted">I chose Panasonic {{ $categoryNameLower }}…</p>
                            <a href="#" class="read-more">Read more</a>

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

                            <a href="#" class="brand-btn">COST FOR YOUR HOME</a>

                        </div>
                    </div>

                </div>

                <!-- Pagination -->
                <div class="pagination-box mt-4">
                    <button class="page-btn">&lt;</button>
                    <button class="page-btn active">&gt;</button>
                </div>


            </div>

            <!-- RIGHT: Sidebar Box -->
            <div class="col-lg-3">
                <div class="sidebar-box">

                    <h4 class="sidebar-title">Calculator</h4>

                    <input type="text" class="zip-input" placeholder="Zip Code">

                    <button class="start-btn">GET STARTED</button>

                </div>
            </div>

        </div>

    </div>
</section>







<section class="why-important-section py-5">
    <div class="container-custom">

        <h2 class="important-title">
            Why is it so important to use the best {{ $categoryNameLower }} brands?
        </h2>

        <p class="important-text">
            A recurring point we make on SolarReviews is that {{ $categoryNameLower }} last a long, long time; 
            25-30 years to be exact. This makes it important to buy {{ $categoryNameLower }} with the following qualities:
        </p>

        <ol class="important-list">
            <li>They are the least likely to fail.</li>
            <li>The manufacturer will honor their warranty if there is a fault.</li>
            <li>
                Installed by a local solar company who will still be in business if there is a fault — and will 
                do the testing necessary to lodge a successful warranty claim with the manufacturer.
            </li>
        </ol>

        <p class="important-text">
            This third point is very important in practical terms, and a good reason why it is not always wise 
            to buy solar from the cheapest company.
        </p>

    </div>
</section>



<!-- Top Rated Solar Brands Section -->
<section class="solar-section py-5 bg-light border-bottom">
    <div class="container-custom">

        <!-- Header Row -->
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-3">

            <h2 class="fw-bold section-title">
                10 best {{ $categoryName }} brands by efficiency
            </h2>

            <!-- Sort Box -->
            <div class="sort-box">
                <label class="sort-label mb-0">Sort by:</label>
                <div class="sort-control" data-sort-control>
                    <button type="button" class="sort-button" data-sort-trigger>Default</button>
                    <ul class="sort-menu" data-sort-menu>
                        @foreach([
                            'Default',
                            'Best Rated',
                            'Most Reviewed',
                            'Most Efficient',
                            'Most Popular',
                            'Best By Expert Review',
                            'Best By Consumer Review'
                        ] as $option)
                            <li>
                                <button type="button" data-sort-value="{{ $option }}" class="{{ $loop->first ? 'active' : '' }}">{{ $option }}</button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>

        <div class="row">
            
            <!-- LEFT: Cards -->
            <div class="col-lg-9">
                <div class="row g-4">

                    <!-- Card 1 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="brand-card">

                            <span class="tag">{{ $categoryName }}</span>

                            <h3 class="brand-title">REC Group</h3>

                            <div class="rating-row">
                                <span class="stars">⭐⭐⭐⭐⭐</span>
                                <span class="rating-number">4.56</span>
                                <span class="review-count">930 Reviews</span>
                            </div>

                            <strong class="review-header">Latest review</strong>
                            <p class="text-muted m-0">Wayne, over 1 month</p>
                            <p class="text-muted">REC Group is a company that…</p>
                            <a href="#" class="read-more">Read more</a>

                            <a href="#" class="brand-btn">COST FOR YOUR HOME</a>

                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="brand-card">

                            <span class="tag">{{ $categoryName }}</span>

                            <h3 class="brand-title">Panasonic</h3>

                            <div class="rating-row">
                                <span class="stars">⭐⭐⭐⭐⭐</span>
                                <span class="rating-number">4.83</span>
                                <span class="review-count">325 Reviews</span>
                            </div>

                            <strong class="review-header">Latest review</strong>
                            <p class="text-muted m-0">MTED, over 1 month</p>
                            <p class="text-muted">I chose Panasonic {{ $categoryNameLower }}…</p>
                            <a href="#" class="read-more">Read more</a>

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

                            <a href="#" class="brand-btn">COST FOR YOUR HOME</a>

                        </div>
                    </div>

                </div>

                <!-- Pagination -->
                <div class="pagination-box mt-4">
                    <button class="page-btn">&lt;</button>
                    <button class="page-btn active">&gt;</button>
                </div>


            </div>

           

        </div>

    </div>
</section>


     


<section class="why-important-section py-5">
    <div class="container-custom">

        <h2 class="important-title">
            What are Tier 1 {{ $categoryNameLower }} manufacturers?
        </h2>

        <p class="important-text">
            The concept of an elite list of Tier 1 {{ $categoryNameLower }} manufacturers was first used by Bloomberg New Energy 
            in a report on the “bankability” of different {{ $categoryNameLower }} brands.
        </p>

        <p class="important-text">
            They chose brands that had been financed on a non-recourse basis by several banks, over several different 
            projects greater than 1.5 megawatts in size.
        </p>

        <p class="important-text">
            While Bloomberg’s definition of Tier 1 is somewhat useful, in our view it’s insufficient as a guide for 
            consumers. It only judges the {{ $categoryNameLower }} based on past performance, and doesn’t attempt to predict the 
            future reliability of each manufacturer.
        </p>

        <p class="important-text">
            Given that {{ $categoryNameLower }} last 25–30 years, we think much more weight should be given to the future prospects 
            of the brand, as well as the manufacturer’s future economic viability.
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
                    @if($companies->isNotEmpty())
                        <div class="company-list">
                            @foreach($companies as $index => $company)
                                @php
                                    $rating = $company->average_rating ?? 0;
                                    $full = floor($rating);
                                @endphp
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
                    @else
                        <div class="company-list">
                            @foreach([
                                ['name' => 'SunPeak Energy Co.', 'state' => 'California', 'rating' => 4.8, 'reviews' => 214],
                                ['name' => 'GreenVolt Solar', 'state' => 'Texas', 'rating' => 4.6, 'reviews' => 189],
                                ['name' => 'BrightSky Installers', 'state' => 'Florida', 'rating' => 4.9, 'reviews' => 321],
                                ['name' => 'EcoRay Power', 'state' => 'Arizona', 'rating' => 4.7, 'reviews' => 167],
                                ['name' => 'HelioSense Renewables', 'state' => 'Colorado', 'rating' => 4.5, 'reviews' => 142],
                                ['name' => 'PeakGrid Solar Works', 'state' => 'New York', 'rating' => 4.4, 'reviews' => 118],
                            ] as $index => $demo)
                                @php
                                    $rating = $demo['rating'];
                                    $full = floor($rating);
                                @endphp
                                <article class="company-card">
                                    <div class="company-main">
                                        <div class="company-logo">
                                            <img src="{{ asset('images/company/cmp.png') }}" alt="Default Company Logo">
                                        </div>
                                        <div class="company-info">
                                            <div class="company-name">{{ $demo['name'] }}</div>
                                            <div class="company-meta">{{ $demo['state'] }}</div>
                                            <div class="rating-row">
                                                <div class="stars">
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
                                                    {{ $demo['reviews'] }} {{ $demo['reviews'] == 1 ? 'review' : 'reviews' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="company-actions">
                                        <span class="badge-rank">Rank #{{ $index + 1 }}</span>
                                        <a href="#" class="btn-outline-primary">
                                            View companies in {{ $demo['state'] }}
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
    <script>
        document.querySelectorAll('[data-sort-control]').forEach(control => {
            const trigger = control.querySelector('[data-sort-trigger]');
            const menu = control.querySelector('[data-sort-menu]');

            trigger.addEventListener('click', () => {
                control.classList.toggle('open');
            });

            menu.querySelectorAll('button[data-sort-value]').forEach(optionBtn => {
                optionBtn.addEventListener('click', () => {
                    menu.querySelectorAll('button').forEach(btn => btn.classList.remove('active'));
                    optionBtn.classList.add('active');
                    trigger.textContent = optionBtn.dataset.sortValue;
                    control.classList.remove('open');
                });
            });

            document.addEventListener('click', (e) => {
                if (!control.contains(e.target)) {
                    control.classList.remove('open');
                }
            });
        });
    </script>
</body>
</html>
