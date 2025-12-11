<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @include('components.frontend.meta-tags', [
        'title' => 'Solar Reviews India | Compare Solar Installers, Products & Services',
        'description' => 'Discover verified solar installers, EPC partners, equipment brands and unbiased reviews in India. Compare ratings, read expert insights and find the right solar solution.',
        'keywords' => 'solar reviews India, solar installer ratings, solar companies comparison, EPC, solar panels',
        'canonical' => url('/'),
        'image' => asset('favicon.svg'),
    ])

    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'Solar Reviews India',
            'url' => url('/'),
            'logo' => asset('favicon.svg'),
            'sameAs' => [
                'https://www.facebook.com/',
                'https://www.instagram.com/',
                'https://www.linkedin.com/',
            ],
        ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
    </script>

    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => 'Solar Reviews India',
            'url' => url('/'),
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => route('companies.index', ['q' => '{search_term_string}']),
                'query-input' => 'required name=search_term_string',
            ],
        ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
    </script>

    <style>
        :root {
            --primary-color: #3ba14c;
            --secondary-color: #1e3a8a;
            --accent-color: #3b82f6;
            --tw-gradient-from-position: ;
            --tw-gradient-via-position: ;
            --tw-gradient-to-position: ;
        }

        .hero-search-suggestions {
            max-width: 720px;
            margin: 1rem auto 0;
            background: #fff;
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 12px;
            box-shadow: 0 18px 30px rgba(15, 23, 42, 0.12);
            padding: 0.5rem 0;
        }

        .hero-search-suggestions[hidden] {
            display: none;
        }

        .hero-suggestions-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.35rem 1.25rem;
            font-size: 0.85rem;
            color: #475569;
            border-bottom: 1px solid rgba(15, 23, 42, 0.05);
        }

        .hero-suggestions-list {
            list-style: none;
            margin: 0;
            padding: 0;
            max-height: 320px;
            overflow-y: auto;
        }

        .hero-suggestion-item {
            padding: 0.85rem 1.25rem;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background 0.15s ease;
        }

        .hero-suggestion-item:not(:last-child) {
            border-bottom: 1px solid rgba(15, 23, 42, 0.04);
        }

        .hero-suggestion-item:hover {
            background: rgba(59, 161, 76, 0.06);
        }

        .hero-suggestion-name {
            font-weight: 600;
            color: #0f172a;
        }

        .hero-suggestion-meta {
            font-size: 0.85rem;
            color: #64748b;
        }

        .hero-suggestions-empty {
            padding: 1rem 1.25rem;
            text-align: center;
            color: #94a3b8;
            font-size: 0.9rem;
        }

        .hero-suggestion-pill {
            font-size: 0.75rem;
            font-weight: 600;
            color: #1e293b;
            background: rgba(36, 160, 72, 0.12);
            padding: 0.2rem 0.65rem;
            border-radius: 999px;
            margin-left: 0.75rem;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9fafb;
            color: #1f2937;
        }

        .container-custom {
            max-width: 1200px;
            margin: 0 auto;
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        @media (max-width: 768px) {
            .container-custom {
                padding-left: 1.25rem;
                padding-right: 1.25rem;
            }
        }

        /* Hero Section */
        .checkmark-icon {
            width: 24px;
            height: 24px;
            margin-right: 1rem;
            color: var(--primary-color);
            flex-shrink: 0;
        }

        .reviews-hero {
            position: relative;
            min-height: 500px;
            overflow: hidden;
        }

        .reviews-hero::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('{{ asset("images/couple-on-computer.jpg") }}') center/cover no-repeat;
            z-index: 0;
        }

        .reviews-hero .hero-gradient {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1;
            opacity: 0.95;
        }

        .reviews-hero .hero-wrapper {
            position: relative;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 6rem 1.5rem;
            min-height: 500px;
            z-index: 2;
        }

        .reviews-hero .container-custom {
            position: relative;
            z-index: 2;
            padding-left: 0;
            padding-right: 0;
        }

        @media (max-width: 768px) {
            .hero .hero-wrapper {
                padding: 3rem 1.25rem;
                min-height: auto;
            }
            
            .hero-heading {
                font-size: 1.8rem;
            }
            
            .hero-subheading {
                font-size: 1.1rem;
            }
            
            .hero-features li {
                font-size: 1rem;
            }
            
            .hero-search-container {
                flex-direction: column;
                gap: 1rem;
            }
            
            .hero-search-input-wrapper {
                max-width: 100%;
            }
            
            .hero-calculate-btn {
                width: 100%;
            }
            
            .reviews-hero .hero-wrapper {
                padding: 4rem 1.25rem;
            }
            
            .reviews-hero .hero-wrapper::after,
            .reviews-hero .overlay {
                left: 1.25rem;
                right: 1.25rem;
            }
        }

        /* Product Cards */
        .product-card {
            height: 100%;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            height: 180px; /* Fixed height for all cards */
            border: 1px solid #e2e8f0;
            text-decoration: none;
            color: inherit;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            border-color: #cbd5e1;
            text-decoration: none;
            color: inherit;
        }

        .product-image {
            flex: 1;
            min-height: 100px;
            max-height: 120px;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem;
        }

        .product-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-color);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .product-card:hover .product-image::before {
            opacity: 1;
        }

        .product-image img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            transition: transform 0.5s ease;
            mix-blend-mode: multiply;
        }

        .product-card:hover .product-image img {
            transform: scale(1.08);
        }

        .product-content {
            padding: 1.75rem;
            flex-grow: 1;
            border-top: 1px solid #f1f5f9;
        }

        .product-card h3 {
            margin: 0;
            font-size: 1rem;
            color: #1e293b;
            font-weight: 600;
            line-height: 1.3;
        }

        /* Section Header */
        .section-header h2 {
            position: relative;
            display: inline-block;
        }

        .section-header h2::after {
            content: '';
            position: absolute;
            width: 60px;
            height: 3px;
            background: var(--primary-color);
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
        }

        .reviews-hero .hero-content {
            position: relative;
            z-index: 2;
            flex: 1;
            max-width: 600px;
        }

        /* CTA Section */
        .cta-section {
            position: relative;
        }

        .cta-wrapper {
            position: relative;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 5rem 1.5rem;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        }

        .cta-section .container-custom {
            padding-left: 0;
            padding-right: 0;
        }

        @media (max-width: 768px) {
            .cta-wrapper {
                padding: 4rem 1.25rem;
            }
        }

        .small-heading {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 0.8rem;
            font-size: 1.1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .hero-btn {
            display: inline-block;
            background-color: var(--primary-color);
            color: #fff;
            font-weight: 600;
            text-decoration: none;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .hero-btn:hover {
            background-color: var(--primary-color);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            color: #fff;
        }

        /* Solar Section */
        .solar-image img {
            width: 100%;
            max-width: 500px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }

        .solar-text .small-heading {
            color: var(--primary-color);
        }

        .solar-btn {
            display: inline-block;
            background-color: var(--primary-color);
            color: #fff;
            font-weight: 600;
            text-decoration: none;
            padding: 0.9rem 1.8rem;
            border-radius: 8px;
            transition: background 0.3s ease;
        }

        .solar-btn:hover {
            background-color: var(--primary-color);
            color: #fff;
        }

        /* Testimonial Cards */
        .testimonial-card {
            background-color: rgb(241 248 254);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
            display: flex;
            flex-direction: column;
            height: 100%;
            min-height: 350px;
            position: relative;
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
        }

        .testimonial-card .stars {
            color: #ffb400;
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        .google-logo {
            width: 28px;
            height: 28px;
            margin: 0 auto;
            position: absolute;
            bottom: 1.5rem;
            left: 50%;
            transform: translateX(-50%);
        }

        /* Footer */
        .footer {
            background-color: #11411a;
            color: #f3f4f6;
        }

        .footer-links h3 {
            position: relative;
            padding-bottom: 0.75rem;
        }

        .footer-links h3::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 2px;
            background-color: #ffffff;
        }

        .footer-links ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links a {
            color: #ffffff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: #dbeafe;
        }

        .footer .border-top {
            border-color: #ffffff !important;
        }

        .social-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #374151;
            color: white;
            transition: background-color 0.3s ease;
        }

        .social-link:hover {
            background-color: var(--accent-color);
            color: white;
        }

        .as-seen-in-section {
            background: #ffffff;
            padding-top: 60px;
            padding-bottom: 60px;
        }

        .as-seen-logo {
            max-height: 45px;
            object-fit: contain;
            opacity: 0.9;
            transition: 0.3s;
        }

        .as-seen-logo:hover {
            opacity: 1;
            transform: scale(1.05);
        }

        .experts-section {
            background: linear-gradient(to bottom, #eef5fc 0%, #ffffff 100%);
        }

        .experts-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            justify-items: center;
        }

        .expert-img {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            object-fit: cover;
            transition: 0.3s ease;
        }

        .expert-img:hover {
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .experts-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .expert-img {
                width: 120px;
                height: 120px;
            }
        }

        .latest-articles .article-image img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 12px;
        }

        .article-card {
            text-decoration: none;
            color: #0f172a; /* dark blue text */
            display: block;
            transition: 0.3s ease;
        }

        .article-card:hover {
            transform: translateY(-4px);
        }

        .article-title {
            font-size: 1.2rem;
            line-height: 1.4;
        }

        @media (max-width: 768px) {
            .latest-articles .article-image img {
                height: 180px;
            }

            .article-title {
                font-size: 1.05rem;
            }
        }

        /* ===========================================
        HERO SECTION – FINAL EXACT MATCH
        =========================================== */

        .reviews-hero-clean {
            padding: 3rem 1.5rem 2rem;
            text-align: center;
            min-height: 55vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
        }


        /* Hero Inner Wrapper */
        .reviews-hero-inner {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
        }


        .reviews-hero-clean {
            position: relative;
            padding: 120px 0 120px;
            background: url('{{ asset('images/im/5.jpg') }}') center/cover no-repeat;
            overflow: hidden;
            min-height: 60vh;
        }

        .reviews-hero-clean::before,
        .reviews-hero-clean::after {
            display: none;
        }

        .reviews-hero-inner {
            position: relative;
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
            z-index: 1;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.35rem 0.85rem;
            border-radius: 999px;
            background: rgba(46, 139, 70, 0.1);
            border: 1px solid rgba(46, 139, 70, 0.25);
            font-weight: 600;
            color: #2E8B46;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 1.25rem;
        }

        .reviews-title {
            font-size: clamp(3.25rem, 4.5vw, 52px);
            font-weight: 400;
            color: #0f172a;
            line-height: 1.15;
            margin-bottom: 0.6rem;
        }

        .reviews-title span {
            display: block;
            font-size: clamp(2.75rem, 4vw, 44px);
            color: #1b9d4b;
            font-weight: 600;
            line-height: 1.1;
        }

        .reviews-subtitle {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.78);
            margin-bottom: 2.5rem;
        }

        .hero-search-form {
            max-width: 720px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            background: #fff;
            padding: 0.4rem 0.4rem 0.4rem 0.75rem;
            box-shadow: 0 25px 55px rgba(15, 23, 42, 0.15);
            border: 1px solid rgba(15, 23, 42, 0.08);
            gap: 0.85rem;
            border-radius: 8px;
        }

        .hero-search-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: #0f172a;
            border-right: 2px solid gray;
        }

        .hero-search-input {
            flex: 1;
            border: none;
            background: transparent;
            padding: 0.75rem 0.5rem;
            font-size: 1rem;
            outline: none;
            color: #0f172a;
        }

        .hero-search-button {
            border: none;
            border-radius: 8px;
            padding: 0.85rem 2.4rem;
            background: #24a048;
            color: #fff;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 18px 28px rgba(36, 160, 72, 0.35);
        }

        .hero-search-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 30px rgba(31, 154, 71, 0.45);
        }

        .hero-pill-wrapper {
            margin-top: 4rem;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1.5rem;
    position: relative;
        }

.hero-pill-wrapper::before,
.hero-pill-wrapper::after {
    content: "";
    flex: 1;
    height: 2px;
    background: #d4d4d4; /* Grey line – same as screenshot */
}

/* Pill */
.hero-pill {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 26px;
    background: #ffffff;
    border-radius: 9999px;
    border: 1px solid #d4d4d4;
    box-shadow: 0 6px 12px rgba(0,0,0,0.08); /* softer shadow like screenshot */
    font-size: 17px;
    font-weight: 500;
}

      
/* Inside text */
.hero-pill span {
    color: #000;
}

/* Link */
.hero-pill a {
    color: #6b3ffe;     /* SAME purple color as shown */
    text-decoration: none;
    font-weight: 600;
}

.hero-pill a:hover {
    text-decoration: underline;
}

        /* Hero Subtitle */
        .reviews-subtitle {
            font-size: 1.1rem;
            color: #4B5563;
            margin-top: 0.5rem;
            margin-bottom: 2.5rem;
            line-height: 1.6;
        }

        .reviews-submit-card {
            max-width: 760px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
            border: 1px solid #e2e8f0;
            text-align: left;
        }

        .reviews-submit-card .eyebrow {
            font-size: 0.85rem;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: #94a3b8;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .reviews-submit-card .eyebrow::before {
            content: '';
            width: 28px;
            height: 1px;
            background: #d6e1f5;
        }

        .reviews-submit-card h3 {
            font-size: 2rem;
            color: #0f172a;
            margin-top: 1rem;
            margin-bottom: 0.75rem;
        }

        .reviews-submit-card p {
            color: #475569;
            margin-bottom: 1.5rem;
            font-size: 1rem;
        }

        .reviews-submit-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
        }

        .reviews-submit-actions .submit-btn {
            background: var(--primary-color);
            color: #fff;
            padding: 0.85rem 1.75rem;
            border-radius: 999px;
            font-weight: 600;
            border: none;
            text-decoration: none;
            box-shadow: 0 12px 30px rgba(59, 161, 76, 0.2);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .reviews-submit-actions .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 34px rgba(59, 161, 76, 0.28);
        }

        .reviews-submit-actions .info-pill {
            color: #475569;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .reviews-submit-actions .info-pill i {
            color: var(--primary-color);
        }

        /* ===========================================
        POPULAR CATEGORIES SECTION (Screenshot Match)
        =========================================== */

        .epc-review-section {
            background: #f8fafb;
        }

        .epc-card {
            height: 100%;
            background: #fff;
            border-radius: 18px;
            padding: 2.25rem;
            color: #0f172a;
            border: 1px solid #e2e8f0;
            box-shadow: 0 15px 35px rgba(15, 23, 42, 0.08);
        }

        .epc-card h3 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .epc-card p {
            color: #475569;
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .epc-card .epc-list {
            list-style: none;
            padding: 0;
            margin: 0 0 1.5rem 0;
        }

        .epc-card .epc-list li {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
            font-weight: 500;
            color: #1f2937;
        }

        .epc-card .epc-list li i {
            color: var(--primary-color);
        }

        .epc-card .epc-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: var(--primary-color);
            color: #fff;
            padding: 0.8rem 1.5rem;
            border-radius: 999px;
            text-decoration: none;
            font-weight: 600;
            transition: transform 0.2s ease;
        }

        .epc-card .epc-btn:hover {
            transform: translateY(-2px);
        }

        .review-ticker {
            background: #fff;
            border-radius: 18px;
            padding: 2rem;
            min-height: 420px;
            color: #0f172a;
            border: 1px solid #e2e8f0;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08);
        }

        .review-ticker .ticker-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .ticker-header strong {
            font-size: 1.2rem;
        }

        .ticker-window {
            position: relative;
            overflow: hidden;
            height: clamp(320px, 46vh, 480px);
        }

        .ticker-list {
            list-style: none;
            padding: 0;
            margin: 0;
            animation: tickerMove 18s linear infinite;
        }

        .ticker-item {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 1rem 1.25rem;
            margin-bottom: 1rem;
        }

        .ticker-item .name {
            font-weight: 600;
            color: #0f172a;
        }

        .ticker-item .company {
            font-size: 0.9rem;
            color: #64748b;
        }

        .ticker-item .stars {
            color: var(--primary-color);
            margin-bottom: 0.4rem;
        }

        @keyframes tickerMove {
            0% { transform: translateY(0); }
            100% { transform: translateY(-50%); }
        }

        .ticker-window:hover .ticker-list {
            animation-play-state: paused;
        }

        .map-viewport {
            padding: 3rem 0 4rem;
            background: linear-gradient(180deg, #f1fff6 0%, #ffffff 100%);
        }

        .map-viewport .container-custom {
            max-width: 1100px;
        }

        .map-viewport .map-container {
            padding: 1rem;
            border-radius: 18px;
            border: 1px solid rgba(59,161,76,0.15);
            background: #fff;
            box-shadow: 0 25px 50px rgba(59, 161, 76, 0.12);
        }

        .state-map-container svg {
            width: 100%;
            height: auto;
            max-height: 520px;
        }

        /* ==============================================
        RESPONSIVE STYLES
        ============================================== */

        /* Tablets and below */
        @media (max-width: 991.98px) {
            .reviews-title {
                font-size: 1.75rem;
            }
            
            .reviews-subtitle {
                font-size: 1rem;
                margin: 0.5rem auto 1.5rem;
            }
            
            .product-image {
                height: 150px;
            }
        }

        /* Mobile devices */
        @media (max-width: 767.98px) {
            .reviews-hero-clean {
                min-height: 50vh;
                max-height: none;
                padding: 1rem;
            }
            
            .products-comparison {
                min-height: auto;
                max-height: none;
                padding: 2rem 0;
            }
            
            .reviews-search-box {
                flex-direction: column;
                padding: 0.75rem;
                gap: 0.75rem;
            }
            
            .search-icon {
                border-right: none;
                border-bottom: 1px solid #e2e8f0;
                width: 100%;
                padding: 0.5rem 0;
                margin-bottom: 0.5rem;
            }
            
            .search-input-wrapper,
            .search-input,
            .search-btn {
                width: 100%;
            }

            .search-input-wrapper {
                min-height: 48px;
            }

            .search-input {
                min-height: 48px;
                height: auto;
                padding: 0.65rem 0.9rem;
                line-height: 1.3;
                font-size: clamp(0.9rem, 3.8vw, 1rem);
            }

            .search-placeholder {
                font-size: clamp(0.85rem, 3.4vw, 0.95rem);
                padding: 0.65rem 0.9rem;
                line-height: 1.35;
            }

            .search-input::placeholder {
                font-size: clamp(0.85rem, 3.4vw, 0.95rem);
            }
            
            .search-btn {
                margin-top: 0.25rem;
            }
        }

        /* MOBILE RESPONSIVE */
        @media (max-width: 760px) {

            .reviews-title {
                font-size: 2.5rem;
            }
            
            .reviews-title span {
                font-size: 2.25rem;
            }

            .reviews-search-box {
                flex-direction: column;
                gap: 0.8rem;
                padding: 1rem;
            }

            .search-icon {
                border-right: none;
                border-bottom: 1px solid #ddd;
                width: 100%;
                padding-bottom: 0.6rem;
                text-align: center;
            }

            .search-input-wrapper {
                width: 100%;
            }

            .search-input {
                width: 100%;
                min-height: 48px;
                height: auto;
                padding: 0.65rem 0.9rem;
                line-height: 1.3;
                font-size: clamp(0.9rem, 3.8vw, 1rem);
            }

            .search-placeholder {
                font-size: clamp(0.85rem, 3.4vw, 0.95rem);
                padding: 0.65rem 0.9rem;
                line-height: 1.35;
            }

            .search-input::placeholder {
                font-size: clamp(0.85rem, 3.4vw, 0.95rem);
            }

            .search-btn {
                width: 100%;
                height: 45px;
            }
        }





         .reviews-search-box {
            max-width: 750px;
            margin: 0 auto;
            background: #ffffff;
            display: flex;
            align-items: center;
            padding: 0.9rem;
            border-radius: 12px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            border: 1px solid #eee;
        }

        /* Search Icon */
        .search-icon {
            padding: 0 1rem;
            font-size: 1.2rem;
            color: #111;
            border-right: 1px solid #e2e8f0;
        }

        /* Search Input Field */

        .search-input-wrapper {
            flex: 1;
            position: relative;
            width: 100%;
        }

        .search-input {
            flex: 1;
            width: 100%;
            border: none;
            padding: 0.9rem 1rem;
            font-size: 1rem;
            outline: none;
            background: transparent;
            min-height: 52px;
            line-height: 1.4;
        }

        .search-input::placeholder {
            color: transparent;
        }

        .search-placeholder {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            padding: 0.9rem 1rem;
            color: #475569;
            font-size: clamp(0.95rem, 2.5vw, 1rem);
            line-height: 1.4;
            pointer-events: none;
            white-space: normal;
            transition: opacity 0.2s ease;
        }

        .search-input:focus + .search-placeholder,
        .search-input:not(:placeholder-shown) + .search-placeholder {
            opacity: 0;
        }

        .search-btn {
            background: #2E8B46;
            color: white;
            border: none;
            padding: 0.7rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .search-btn:hover {
            background: #36a353;
            transform: translateY(-1px);
        }

    </style>
</head>
<body>
    <!-- Navigation -->
    @include('components.frontend.navbar')

    <!-- Hero Section -->
    <section class="reviews-hero-clean">
        <div class="reviews-hero-inner">
            <h1 class="reviews-title">
                India's most trusted
                <span>Solar EPC Reviews</span>
            </h1>
            <p class="reviews-subtitle">
                Discover, read, and write reviews
            </p>

            <form class="hero-search-form" data-hero-company-form>
                <span class="hero-search-icon"><i class="fas fa-search"></i></span>
                <input
                    type="text"
                    class="hero-search-input"
                    name="q"
                    placeholder="Search Company"
                    aria-label="Search Company"
                    data-hero-company-input
                >
                <button type="button" class="hero-search-button" data-hero-company-button>Search</button>
            </form>

            <div class="hero-search-suggestions" data-hero-company-suggestions hidden>
                <div class="hero-suggestions-header">
                    <span>Top matches</span>
                    <span class="suggestion-count" data-hero-suggestions-count>0 results</span>
                </div>
                <ul class="hero-suggestions-list" data-hero-suggestions-list></ul>
                <div class="hero-suggestions-empty" data-hero-suggestions-empty>No companies found. Try another name.</div>
            </div>

            <div class="hero-pill-wrapper">
                <div class="hero-pill">
                    <span>Installed solar recently?</span>
                    <a href="{{ route('reviews.write') }}">Write a review →</a>
                </div>
            </div>
        </div>
    </section>


        <!-- As Seen In Section -->
    <section class="as-seen-in-section section-spacing py-5">
        <div class="container-custom">
            <div class="text-center mb-4">
                <h5 class="fw-semibold text-muted" style="letter-spacing: 1px;">As cited by</h5>
            </div>

            <div class="row justify-content-center align-items-center g-4 text-center">
                <div class="col-6 col-md-3 col-lg-3">
                    <img src="/images/usnews.png" alt="US News" class="as-seen-logo">
                </div>

                <div class="col-6 col-md-3 col-lg-3">
                    <img src="/images/cnbc.png" alt="CNBC" class="as-seen-logo">
                </div>

                <div class="col-6 col-md-3 col-lg-3">
                    <img src="/images/npr.png" alt="NPR" class="as-seen-logo">
                </div>

                <div class="col-6 col-md-3 col-lg-3">
                    <img src="/images/cnn.png" alt="CNN" class="as-seen-logo">
                </div>

                <div class="col-6 col-md-3 col-lg-3">
                    <img src="/images/investopedia.png" alt="Investopedia" class="as-seen-logo">
                </div>

                <div class="col-6 col-md-3 col-lg-3">
                    <img src="/images/nerdwallet.png" alt="NerdWallet" class="as-seen-logo">
                </div>

                <div class="col-6 col-md-3 col-lg-3">
                    <img src="/images/bloomberg.png" alt="Bloomberg" class="as-seen-logo">
                </div>

                <div class="col-6 col-md-3 col-lg-3">
                    <img src="/images/cbsnews.png" alt="CBS News" class="as-seen-logo">
                </div>
            </div>
        </div>
    </section>


    <!-- Reviews Hero Section -->
    <section class="reviews-hero">
        <div class="hero-gradient bg-gradient-to-r from-slate-900 to-transparent"></div>
        <div class="hero-wrapper">
            <div class="container-custom">
                <div class="hero-content">
                    <p class="small-heading mb-2">Real People, Real Reviews</p>
                    <h1 class="text-white fw-bold mb-4" style="font-size: 2.3rem; line-height: 1.3;">Unbiased consumer reviews of almost all solar companies in India</h1>
                    <p class="text-white mb-4" style="font-size: 1rem; line-height: 1.6; opacity: 0.9;">
                        SolarReviews has both an extensive collection of unbiased consumer reviews of U.S. solar companies and an expert ranking system 
                        to help you identify the best solar panel installation companies in your area.
                    </p>
                    <a href="{{ url('compare/companies') }}" class="hero-btn" rel="noopener">See Reviews of Companies Near You</a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section
    <section class="cta-section py-5 text-center text-white">
        <div class="cta-wrapper">
            <div class="container-custom">
                <h2 class="fw-bold mb-3" style="font-size: 2.25rem;">Ready to Go Solar?</h2>
                <p class="mb-4 mx-auto" style="max-width: 600px; opacity: 0.9;">Join thousands of homeowners who are saving money with solar energy.</p>
                <a href="#" class="btn btn-light px-4 py-2 fw-semibold" style="color: var(--primary-color);">Get Free Quotes</a>
            </div>
        </div>
    </section> -->

    <!-- State Map Section -->
    <section class="map-viewport">
        <div class="container-custom">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3" style="font-size: 2.25rem; color: var(--primary-color);">Find Solar Solutions in Your State</h2>
                <p class="text-muted mx-auto" style="max-width: 600px;">Select your state to discover top-rated solar providers and get free quotes tailored to your location.</p>
            </div>
            @include('components.india-map')
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-5 bg-white">
        <div class="container-custom">
            <div class="text-center mb-5">
                <a href="#" class="fw-medium text-decoration-none mb-2 d-block" style="color: var(--primary-color);">See What Others Are Saying About Us</a>
                <h2 class="fw-bold mb-0" style="font-size: 2rem; color: #000;">See What Others Are Saying About Us</h2>
            </div>

            <div class="row g-4">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="testimonial-card">
                        <h3 class="fw-semibold mb-2" style="font-size: 1.2rem;">Kunal Verma</h3>
                        <div class="stars">★★★★★</div>
                        <p class="mb-4" style="font-size: 0.95rem; color: #333; line-height: 1.6; flex-grow: 1;">
                            "Calculator was easy to use and very accurate. I had solar installed a couple of years ago. 
                            I wanted to check what the calculator would give as a recommendation and forecast compared to my actual experience. 
                            My actual experience was well within the ranges given. GREAT TOOL."
                        </p>
                        <img src="{{ asset('images/google.svg') }}" alt="Google" class="google-logo">
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="testimonial-card">
                        <h3 class="fw-semibold mb-2" style="font-size: 1.2rem;">Dipankar Mishara</h3>
                        <div class="stars">★★★★★</div>
                        <p class="mb-4" style="font-size: 0.95rem; color: #333; line-height: 1.6; flex-grow: 1;">
                            "Very responsive and helpful. Got a friendly phone call right away after filling out online 
                            estimate to gather additional information. Knowledgeable and friendly. Can't ask for more."
                        </p>
                        <img src="{{ asset('images/google.svg') }}" alt="Google" class="google-logo">
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="testimonial-card">
                        <h3 class="fw-semibold mb-2" style="font-size: 1.2rem;">Sunita Verma</h3>
                        <div class="stars">★★★★★</div>
                        <p class="mb-4" style="font-size: 0.95rem; color: #333; line-height: 1.6; flex-grow: 1;">
                            "Very helpful with information about cost, effectiveness and options for various solar panel installations. 
                            Very quick to reach out to me and explain things clearly so I understood exactly what my obligations would be 
                            and what I should expect from the system."
                        </p>
                        <img src="{{ asset('images/google.svg') }}" alt="Google" class="google-logo">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Experts Section -->
    <section class="experts-section section-spacing py-5">
        <div class="container-custom">
            <div class="row align-items-center">

                <!-- Left Content -->
                <div class="col-12 col-lg-6 mb-4 mb-lg-0">
                    <h6 class="fw-semibold mb-3" style="color: var(--primary-color);">Our Experts</h6>
                    <h2 class="fw-bold mb-4" style="font-size: 2.5rem; line-height: 1.3;">
                        The best solar journalists in the industry
                    </h2>
                    <p class="text-muted" style="font-size: 1.1rem;">
                        Both Andrew Sendy, President of SolarReviews, and Lachlan Fleet, CEO of SolarReviews,
                        have founded solar companies that are among the largest in their respective markets today.
                        This expertise continues through the SolarReviews editorial team, which has a combined
                        total of more than 50 years of solar industry experience.
                    </p>

                    <a href="#" class="fw-semibold mt-4 d-inline-block" style="font-size: 1.1rem; color: var(--primary-color);">
                        See more of our dedicated team →
                    </a>
                </div>

                <!-- Right Side Images -->
                <div class="col-12 col-lg-6">
                    <div class="experts-grid">
                        <img src="/images/expert1.jpg" class="expert-img" alt="">
                        <img src="/images/expert2.jpg" class="expert-img" alt="">
                        <img src="/images/expert3.jpg" class="expert-img" alt="">
                        <img src="/images/expert4.jpg" class="expert-img" alt="">
                        <img src="/images/expert5.jpg" class="expert-img" alt="">
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section class="latest-articles section-spacing py-5">
        <div class="container-custom">

            <h3 class="fw-bold mb-4" style="font-size: 1.75rem;">Latest articles</h3>

            <div class="row g-4">

            <!-- Article 1 -->
            <div class="col-md-4">
                <a href="#" class="article-card">
                    <div class="article-image">
                        <img src="/images/article1.jpg" alt="" class="img-fluid">
                    </div>
                    <h4 class="fw-semibold mt-3 article-title">
                        Are Solar Panels Worth It in 2026 and Beyond? Rising Electricity Prices Say Yes
                    </h4>
                </a>
            </div>

            <!-- Article 2 -->
            <div class="col-md-4">
                <a href="#" class="article-card">
                    <div class="article-image">
                        <img src="/images/article2.jpg" alt="" class="img-fluid">
                    </div>
                    <h4 class="fw-semibold mt-3 article-title">
                        Expert review of Voltaic Solar Roof Tiles
                    </h4>
                </a>
            </div>

            <!-- Article 3 -->
            <div class="col-md-4">
                <a href="#" class="article-card">
                    <div class="article-image">
                        <img src="/images/article3.jpg" alt="" class="img-fluid">
                    </div>
                    <h4 class="fw-semibold mt-3 article-title">
                        The 30% Solar Tax Credit Is Ending in 2025: Are Solar Panels Still Worth It?
                    </h4>
                </a>
            </div>

            </div>
        </div>
    </section>


    @include('components.frontend.footer')

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const offsetTop = target.offsetTop - 60; // Account for fixed navbar
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Duplicate ticker items to keep the marquee filled
        document.querySelectorAll('.ticker-list').forEach(list => {
            const items = Array.from(list.children);
            items.forEach(item => list.appendChild(item.cloneNode(true)));
        });

        (function setupHeroCompanySearch() {
            const companies = @json($companies ?? []);
            const form = document.querySelector('[data-hero-company-form]');
            const input = document.querySelector('[data-hero-company-input]');
            const button = document.querySelector('[data-hero-company-button]');
            const suggestions = document.querySelector('[data-hero-company-suggestions]');
            const suggestionsList = document.querySelector('[data-hero-suggestions-list]');
            const emptyState = document.querySelector('[data-hero-suggestions-empty]');
            const countLabel = document.querySelector('[data-hero-suggestions-count]');
            const MAX_RESULTS = 8;

            if (!form || !input || !suggestions || !suggestionsList) {
                return;
            }

            function formatCount(value) {
                return value === 1 ? '1 company' : `${value} companies`;
            }

            function hideSuggestions() {
                suggestions.hidden = true;
            }

            function showSuggestions() {
                suggestions.hidden = false;
            }

            function goToCompany(company) {
                if (!company?.slug) return;
                window.location.href = `/companies/${company.slug}`;
            }

            function renderSuggestions(matches) {
                suggestionsList.innerHTML = '';

                if (!matches.length) {
                    emptyState.style.display = 'block';
                    countLabel.textContent = '0 results';
                    showSuggestions();
                    return;
                }

                emptyState.style.display = 'none';
                countLabel.textContent = formatCount(matches.length);

                matches.slice(0, MAX_RESULTS).forEach(company => {
                    const item = document.createElement('li');
                    item.className = 'hero-suggestion-item';
                    item.innerHTML = `
                        <div>
                            <div class="hero-suggestion-name">${company.name}</div>
                            <div class="hero-suggestion-meta">${company.state_name ?? 'State unavailable'}</div>
                        </div>
                        <span class="hero-suggestion-pill">View</span>
                    `;
                    item.addEventListener('click', () => goToCompany(company));
                    suggestionsList.appendChild(item);
                });

                showSuggestions();
            }

            function filterCompanies(term) {
                if (!term) {
                    return [...companies];
                }

                const normalized = term.toLowerCase();
                return companies.filter(company =>
                    (company.name || '').toLowerCase().includes(normalized)
                );
            }

            input.addEventListener('input', (event) => {
                const matches = filterCompanies(event.target.value.trim());
                renderSuggestions(matches);
            });

            input.addEventListener('focus', () => {
                const matches = filterCompanies(input.value.trim());
                renderSuggestions(matches);
            });

            button?.addEventListener('click', () => {
                const matches = filterCompanies(input.value.trim());
                renderSuggestions(matches);
                if (matches.length === 1) {
                    goToCompany(matches[0]);
                }
            });

            form.addEventListener('submit', (event) => {
                event.preventDefault();
            });

            document.addEventListener('click', (event) => {
                if (!suggestions.contains(event.target) && !form.contains(event.target)) {
                    hideSuggestions();
                }
            });
        })();

        const heroPincodeInput = document.querySelector('.hero-search-input');
        const heroCalculateBtn = document.querySelector('.hero-calculate-btn');

        const slugify = (text) => text
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');

        if (heroPincodeInput && heroCalculateBtn) {
            const originalBtnText = heroCalculateBtn.textContent;

            heroCalculateBtn.addEventListener('click', async () => {
                const pincode = heroPincodeInput.value.trim();

                if (!/^\d{6}$/.test(pincode)) {
                    alert('Please enter a valid 6-digit pincode.');
                    heroPincodeInput.focus();
                    return;
                }

                heroCalculateBtn.disabled = true;
                heroCalculateBtn.textContent = 'Checking...';

                try {
                    const response = await fetch(`https://api.postalpincode.in/pincode/${pincode}`);

                    if (!response.ok) {
                        throw new Error('Failed to fetch state details');
                    }

                    const data = await response.json();
                    const apiResult = Array.isArray(data) ? data[0] : null;
                    const postOffice = apiResult?.PostOffice?.[0];

                    if (apiResult?.Status === 'Success' && postOffice?.State) {
                        const stateSlug = slugify(postOffice.State);
                        window.location.href = `/state/${stateSlug}`;
                        return;
                    }

                    alert('Could not find the state for this pincode. Please try another one.');
                } catch (error) {
                    console.error('Failed to fetch state for pincode:', error);
                    alert('Something went wrong while fetching the state. Please try again later.');
                } finally {
                    heroCalculateBtn.disabled = false;
                    heroCalculateBtn.textContent = originalBtnText;
                }
            });
        }
    </script>

    @include('components.frontend.chatbot-widget')
</body>
</html>
