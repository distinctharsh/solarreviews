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
        $categorySlug = $category->slug;
        $isPanels = $categorySlug === 'panels';
        $isBatteries = $categorySlug === 'batteries';
        $isInverters = $categorySlug === 'inverters';
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

        @if($isBatteries)
            <section class="why-important-section py-5">
                <div class="container-custom">
                    <h2 class="important-title">What is a solar battery?</h2>
                    <p class="important-text">
                        A solar battery bank stores the excess solar electricity your home doesn't need the moment it is generated.
                        Because panels only work when the sun shines, batteries are what turn solar into a dependable 24×7 power source and are key to a 100% renewable future.
                    </p>
                    <p class="important-text">
                        Energy storage systems today are sold as complete home storage solutions—think Tesla Powerwall or sonnen eco.
                        They bundle the battery bank with management software, battery inverters, chargers, and controls, all tuned for modern lithium-ion chemistry.
                    </p>
                    <h3 class="important-title" style="font-size:1.4rem;">Why is lithium-ion battery technology now so popular?</h3>
                    <ul class="important-list">
                        <li><strong>Higher energy density:</strong> Stores more power per cubic inch than legacy deep-cycle lead acid batteries, making installs easier in tight garages and homes.</li>
                        <li><strong>No vented gases:</strong> Safer indoor installation without separate enclosures, opening the mass-market opportunity.</li>
                        <li><strong>Electronics built for Li-ion:</strong> Modern energy management software and hardware are engineered specifically for lithium chemistry.</li>
                    </ul>
                    <h3 class="important-title" style="font-size:1.4rem;">Are solar batteries worth it?</h3>
                    <p class="important-text">It depends on four questions:</p>
                    <ol class="important-list">
                        <li><strong>Do you have access to 1:1 net metering?</strong> If yes, the grid already acts as your battery unless evening TOU rates are much higher.</li>
                        <li><strong>Do you generate enough excess solar energy?</strong> Batteries only help if your system produces surplus kWh to store.</li>
                        <li><strong>Does your utility use time-of-use pricing?</strong> Charging midday and discharging during expensive evening peaks can double the value of each stored kWh.</li>
                        <li><strong>Are there rebates or tax credits?</strong> 30% federal ITC plus local incentives dramatically improve payback for home storage.</li>
                    </ol>
                </div>
            </section>

            <section class="why-important-section py-5">
                <div class="container-custom">
                    <h2 class="important-title">Energy storage systems</h2>
                    <p class="important-text">
                        Homeowners are now offered full storage systems rather than bare batteries. These all-in-one setups include
                        battery management, inverters, chargers, and smart software so you can control how and when to charge or discharge.
                        They all use lithium-ion cells—flooded lead-acid packs are effectively obsolete for modern home installs.
                    </p>
                    <h3 class="important-title" style="font-size:1.4rem;">AC-coupled vs DC-coupled solar batteries</h3>
                    <p class="important-text">
                        Solar panels make DC power and home appliances consume AC. Hybrid/off-grid systems handle that difference in two ways:
                    </p>
                    <h4 class="on-page-title" style="font-size:1.1rem;">AC-coupled batteries</h4>
                    <p class="important-text">
                        Panels feed DC into a grid-tie inverter first, converting it to AC. The AC can power the home, be exported to the grid,
                        or get routed into an AC battery that internally converts it back to DC for storage. These batteries include electronics to manage all conversions seamlessly.
                    </p>
                    <h4 class="on-page-title" style="font-size:1.1rem;">DC-coupled batteries</h4>
                    <p class="important-text">
                        (For completeness) DC-coupled systems charge batteries directly with DC before a single inverter handles conversion for home loads.
                        They can be more efficient but require specialized hybrid equipment.
                    </p>
                </div>
            </section>

            <!-- <section class="why-important-section py-5">
                <div class="container-custom">
                    <h2 class="important-title">Top battery brands in India 2025</h2>
                    <p class="important-text">
                        Scroll below to the "Best 20" list to see which storage brands consumers trust most this year.
                        Every card summarizes review volume, satisfaction scores, and links into detailed pages so you can read reviews for every battery model we track.
                    </p>
                    <h3 class="important-title" style="font-size:1.4rem;">Reviews on all models of solar batteries</h3>
                    <p class="important-text">
                        Our reviewer community contributes detailed feedback on cycle life, warranty claims, and installer experiences for each product line.
                        Use the filters and rankings to jump into the exact chemistry, capacity, or price band that fits your project.
                    </p>
                </div>
            </section> -->
        @endif

        @if($isInverters)
            <section class="why-important-section py-5">
                <div class="container-custom">
                    <h2 class="important-title">What does an inverter do?</h2>
                    <p class="important-text">
                        Solar inverters are the brains of every PV system. They convert the DC electricity that panels produce into the AC power your home uses,
                        and they constantly track the Maximum Power Point (MPP) so panels operate at the most productive voltage/current pair as conditions change throughout the day.
                    </p>
                    <h3 class="important-title" style="font-size:1.4rem;">Solar inverter technology</h3>
                    <ul class="important-list">
                        <li><strong>String inverter:</strong> Cost-effective and simple for full strings, but least efficient under shading.</li>
                        <li><strong>String inverter + optimizers:</strong> Module-level MPP tracking handles shade better while still feeding a single inverter.</li>
                        <li><strong>Microinverter:</strong> Full AC conversion and MPP tracking per panel. Highest flexibility and monitoring granularity, at a higher cost.</li>
                    </ul>
                    <h3 class="important-title" style="font-size:1.4rem;">System compatibility</h3>
                    <ul class="important-list">
                        <li><strong>Grid-tied:</strong> Standard for most homes, enabling net metering.</li>
                        <li><strong>Hybrid:</strong> Works with batteries by charging/discharging plus grid interaction.</li>
                        <li><strong>Off-grid:</strong> Fully independent setups that require battery backup.</li>
                    </ul>
                </div>
            </section>

            <section class="why-important-section py-5">
                <div class="container-custom">
                    <h2 class="important-title">Types of solar inverter (at a glance)</h2>
                    <p class="important-text">
                        Deciding between technologies? Use this cheat sheet to match inverter styles with project goals:
                    </p>
                    <ul class="important-list">
                        <li><strong>String inverter:</strong> Best for wide-open roofs with identical panel orientations.</li>
                        <li><strong>Optimized string:</strong> Choose when partial shading or mixed module strings are unavoidable.</li>
                        <li><strong>Microinverter:</strong> Ideal for modular growth, complex roofs, or premium monitoring requirements.</li>
                    </ul>
                    <p class="important-text">
                        Below you'll also find rankings for Top 4 inverter brands, top-rated grid-tied models, plus the best hybrid/off-grid inverters based on consumer satisfaction.
                    </p>
                </div>
            </section>
        @endif


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
                {{ $isPanels ? 'Best 20 brands of solar panels by consumer reviews' : 'Best 20 ' . $categoryName . ' brands by consumer reviews' }}
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
            <div class="col-lg-9">
                @if($brandsByReviews->isNotEmpty())
                    <div class="row g-4">
                        @foreach($brandsByReviews as $index => $brand)
                            @php
                                $rating = (float) $brand->avg_rating;
                                $fullStars = floor($rating);
                                $logo = $brand->logo_url ? asset($brand->logo_url) : asset('images/company/cmp.png');
                            @endphp
                            <div class="col-md-6 col-lg-4">
                                <div class="brand-card h-100">
                                    <span class="tag">{{ $categoryName }}</span>
                                    <h3 class="brand-title">{{ $brand->name }}</h3>
                                    <div class="rating-row">
                                        <span class="stars">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="{{ $i <= $fullStars ? 'fas' : 'far' }} fa-star"></i>
                                            @endfor
                                        </span>
                                        <span class="rating-number">{{ number_format($rating, 2) }}</span>
                                        <span class="review-count">{{ $brand->total_reviews }} {{ Str::plural('review', $brand->total_reviews) }}</span>
                                    </div>
                                    <div class="mt-3">
                                        <img src="{{ $logo }}" alt="{{ $brand->name }}" style="max-width:100%; height:56px; object-fit:contain;">
                                    </div>
                                    <div class="mt-4 d-flex justify-content-between align-items-center">
                                        <span class="badge-rank">Rank #{{ $index + 1 }}</span>
                                        <a href="{{ route('companies.compare', $brand->slug) }}" class="read-more">View brand</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <h2>No brands found for this category yet</h2>
                        <p>Add a few brands to the category and they will start appearing here automatically.</p>
                    </div>
                @endif
            </div>

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

        @if($isPanels)
            <h2 class="important-title">Why is it so important to use the best solar panel brands?</h2>
            <p class="important-text">
                A recurring point we make on SolarReviews is that solar panels last a long, long time; 25–30 years to be exact.
                This makes it critical to buy panels with the following qualities:
            </p>
            <ol class="important-list">
                <li>They are the least likely to fail.</li>
                <li>The manufacturer will honor their warranty if there is a fault.</li>
                <li>They’re installed by a local solar company that will still be around to diagnose issues and file warranty claims.</li>
            </ol>
            <p class="important-text">
                That third point is huge in practical terms—and a big reason why chasing the cheapest quote can backfire.
            </p>
        @else
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
        @endif

    </div>
</section>



<!-- Top Rated Solar Brands Section -->
<section class="solar-section py-5 bg-light border-bottom">
    <div class="container-custom">

        <!-- Header Row -->
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-3">

            <h2 class="fw-bold section-title">
                {{ $isPanels ? '10 best solar panel brands by panel efficiency' : '10 best ' . $categoryName . ' brands by efficiency' }}
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
            <div class="col-lg-9">
                @if($topEfficiencyBrands->isNotEmpty())
                    <div class="row g-4">
                        @foreach($topEfficiencyBrands as $index => $brand)
                            @php
                                $logo = $brand->logo_url ? asset($brand->logo_url) : asset('images/company/cmp.png');
                            @endphp
                            <div class="col-md-6 col-lg-4">
                                <div class="brand-card h-100">
                                    <span class="tag">{{ $categoryName }}</span>
                                    <h3 class="brand-title">{{ $brand->brand_name }}</h3>
                                    <p class="mb-2 text-muted">Avg efficiency: <strong>{{ number_format($brand->avg_efficiency, 2) }}%</strong></p>
                                    <p class="mb-1 text-muted">Peak module: <strong>{{ number_format($brand->max_efficiency, 2) }}%</strong></p>
                                    <p class="text-muted">{{ $brand->product_count }} product {{ Str::plural('entry', $brand->product_count) }}</p>
                                    <div class="mt-3">
                                        <img src="{{ $logo }}" alt="{{ $brand->brand_name }}" style="max-width:100%; height:56px; object-fit:contain;">
                                    </div>
                                    <div class="mt-4 d-flex justify-content-between align-items-center">
                                        <span class="badge-rank">Rank #{{ $index + 1 }}</span>
                                        <a href="{{ route('companies.compare', $brand->brand_id) }}" class="read-more">Explore</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <h2>No efficiency data found</h2>
                        <p>Add efficiency values to products in this category to surface rankings here.</p>
                    </div>
                @endif
            </div>
        </div>

    </div>
</section>


     


<section class="why-important-section py-5">
    <div class="container-custom">

        @if($isPanels)
            <h2 class="important-title">What are Tier 1 solar panel manufacturers?</h2>
            <p class="important-text">
                The concept of an elite list of Tier 1 solar panel manufacturers was first used by Bloomberg New Energy in a report on the “bankability” of different brands.
                They chose companies that had been financed on a non-recourse basis by several banks across multiple projects greater than 1.5 MW.
            </p>
            <p class="important-text">
                While Bloomberg’s definition is somewhat useful, it only judges panels based on past performance and doesn’t attempt to predict future reliability.
                Given that solar panels last 25–30 years, we believe more weight should be given to future prospects and financial health.
            </p>
            <h3 class="important-title" style="font-size:1.4rem;">How we define Tier 1 solar panel manufacturers</h3>
            <p class="important-text">
                Our editorial committee uses six criteria—we encourage you to apply them when evaluating any panel brand:
            </p>
            <ol class="important-list">
                <li><strong>Manufacturing quality & integration:</strong> Fewer defects mean fewer warranty claims and stronger long-term viability.</li>
                <li><strong>Scale & marginal cost:</strong> Low-cost producers are more likely to survive market swings and honor warranties.</li>
                <li><strong>Profitability & balance sheet transparency:</strong> We can’t recommend a 25-year warranty if a company’s finances are opaque.</li>
                <li><strong>Cell efficiency roadmap:</strong> Brands that keep pace with efficiency leaders maintain pricing power.</li>
                <li><strong>Value positioning:</strong> Panels are a financial investment, so price versus competitors matters.</li>
                <li><strong>Dealer network strength:</strong> Consumers need proof that the manufacturer supports local installers in the U.S.</li>
            </ol>
        @else
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
        @endif

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
    @include('components.frontend.footer')
</body>
</html>
