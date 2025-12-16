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
            --hero-content-width: min(560px, calc(100% - 2.5rem));
            --tw-gradient-from-position: ;
            --tw-gradient-via-position: ;
            --tw-gradient-to-position: ;
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
                background: #fff;
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

        /* ------------------------------
           Welcome Hero Section
        ------------------------------ */
        .reviews-hero-clean {
            position: relative;
            padding: clamp(80px, 9vw, 140px) clamp(1rem, 4vw, 2.5rem) clamp(35px, 5vw, 50px);
            text-align: center;
            min-height: min(760px, 100vh);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: transparent;
        }

        .reviews-hero-clean::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: min(1600px, 100vw);
            height: clamp(520px, 62.5vw, 900px);
            background: url('/images/im/6.jpg') center top/contain no-repeat;
            opacity: 1;
            z-index: 1;
            pointer-events: none;
        }

        .reviews-hero-inner {
            position: relative;
            z-index: 2;
            max-width: 900px;
            margin: 0 auto;
            padding: 0 1.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: clamp(520px, 70vh, 640px);
        }

        .reviews-title {
            font-size: 52px;
            font-weight: 400;
            color: #0b1724;
            line-height: 1.2;
            margin-bottom: 0.4rem;
        }

        .reviews-title span {
            display: block;
            color: #1b9d4b;
            font-weight: 600;
            font-size: 44px;
            line-height: 1.1;
        }

        .reviews-subtitle {
            font-size: 14px;
            color: #4b5563;
            margin-bottom: 2.5rem;
        }

        .hero-search-form {
            max-width: var(--hero-content-width);
            width: 100%;
            margin-left: auto;
            margin-right: auto;
            padding: 0.45rem 0.45rem 0.45rem 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.85rem;
            background: #fff;
            border: 1px solid rgba(15, 23, 42, 0.06);
            border-radius: 18px;
            box-shadow: 0 22px 45px rgba(15, 23, 42, 0.1);
        }

        .hero-search-icon {
            width: 52px;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: #111827;
            border-right: 1px solid rgba(15, 23, 42, 0.08);
        }

        .hero-search-input {
            flex: 1;
            border: none;
            background: transparent;
            padding: 0.65rem 0.5rem;
            font-size: 16px;
            color: #0f172a;
        }

        .hero-search-input::placeholder {
            color: #9ca3af;
        }

        .hero-search-button {
            border: none;
            border-radius: 8px;
            padding: 0.85rem 2.6rem;
            background: #24a048;
            color: #fff;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            min-width: 120px;
        }

        .hero-search-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 22px 36px rgba(36, 160, 72, 0.4);
        }

        .hero-search-suggestions {
            max-width: 660px;
            margin: 0rem auto 0;
            background: #fff;
            border: 1px solid rgba(15, 23, 42, 0.06);
            border-radius: 18px;
            box-shadow: 0 25px 60px rgba(15, 23, 42, 0.12);
            padding: 0.5rem 0;
        }

        .hero-search-suggestions[hidden] {
            display: none;
        }

        .hero-suggestions-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.4rem 1.25rem;
            font-size: 0.85rem;
            color: #475569;
            border-bottom: 1px solid rgba(15, 23, 42, 0.05);
        }

        .hero-suggestions-list {
            list-style: none;
            margin: 0;
            padding: 0;
            max-height: 220px;
            overflow-y: auto;
        }

        .hero-suggestion-item {
            padding: 0.25rem 0.9rem;
            display: flex;
            justify-content: normal;
            gap: 10px;
            align-items: center;
            cursor: pointer;
            transition: background 0.15s ease;
        }

        .hero-suggestion-item:hover {
            background: rgba(59, 161, 76, 0.08);
        }

          .hero-suggestion-item:not(:last-child) {
            border-bottom: 1px solid rgba(15, 23, 42, 0.04);
        }

        .hero-suggestion-name {
            /* font-weight: 600;
            color: #0f172a;
            font-size: 0.9rem; */
            font-size: 0.85rem;
            color: #475569;
        }

        .hero-suggestion-meta {
            font-size: 0.85rem;
            color: #6b7280;
            text-align:left;
        }

        .hero-suggestion-icon-2 i {
            font-size: 0.85rem;
            color: #475569;
        }

        .hero-suggestion-pill {
            font-size: 0.8rem;
            font-weight: 600;
            color: #1e293b;
            background: rgba(36, 160, 72, 0.15);
            padding: 0.2rem 0.7rem;
            border-radius: 999px;
            margin-left: 0.75rem;
        }

        .hero-suggestions-empty {
            padding: 1rem 1.25rem;
            text-align: center;
            color: #94a3b8;
            font-size: 0.9rem;
        }

        .hero-pill-wrapper {
            margin-top: clamp(28px, 4vw, 48px);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            padding: 0 1.5rem clamp(20px, 3vw, 35px);
            max-width: 960px;
            margin-left: auto;
            margin-right: auto;
            z-index: 2;
            width: 100%;
        }

        .hero-pill-wrapper::before,
        .hero-pill-wrapper::after {
            content: '';
            flex: 1;
            height: 2px;
            background: #dcdfe4;
            min-width: 90%;
        }

        .hero-pill {
            display: inline-flex;
            align-items: center;
            justify-content: space-between;
            white-space: nowrap;
            padding: 14px 14px;
            background: #ffffff;
            gap:3px;
            border-radius: 999px;
            box-shadow: 0 18px 35px rgba(15, 23, 42, 0.08);
            font-size: 15px;
            font-weight: 500;
            /* width: clamp(260px, 70vw, 440px); */
            border: 2px solid #dcdfe4;
        }

        .hero-pill span {
            color: #0f172a;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .hero-pill a {
            color: #6b3ffe;
            font-weight: 600;
            text-decoration: none;
        }

        .hero-pill a:hover {
            text-decoration: underline;
        }

        @media (max-width: 991.98px) {
            .reviews-title {
                font-size: 42px;
            }

            .reviews-title span {
                font-size: 34px;
            }

            .hero-search-form {
                max-width: 600px;
                padding: 0.5rem 0.5rem 0.5rem 0.8rem;
                gap: 0.6rem;
            }

            .hero-search-icon {
                width: 44px;
                height: 44px;
                font-size: 1rem;
            }

            .hero-search-input {
                font-size: 15px;
            }

            .hero-search-button {
                padding: 0.75rem 2rem;
                font-size: 13px;
                flex-shrink: 0;
            }

            .hero-pill-wrapper {
                gap: 1rem;
                padding: 1.5rem 1rem 2.5rem;
            }
        }

        @media (max-width: 1000px) and (min-width: 761px) {
            .reviews-hero-clean {
                padding: 78px 0 58px;
            }

            .reviews-title {
                font-size: 40px;
            }

            .reviews-title span {
                font-size: 32px;
            }

            .hero-search-form {
                max-width: min(82vw, 620px);
                padding: 0.55rem 0.6rem 0.55rem 0.85rem;
                gap: 0.55rem;
                border-radius: 14px;
                flex-wrap: wrap;
                justify-content: center;
            }

            .hero-search-icon {
                width: 48px;
                height: 48px;
                font-size: 1rem;
                border-right: 1px solid rgba(15, 23, 42, 0.08);
            }

            .hero-search-input {
                font-size: 15px;
            }

            .hero-search-button {
                padding: 0.75rem 2.1rem;
            }

            .hero-search-suggestions {
                max-width: min(82vw, 620px);
            }

            .hero-pill-wrapper {
                padding: 1.2rem 1rem 2rem;
                gap: 1.2rem;
            }

            .hero-pill {
                width: auto;
                min-width: 320px;
                max-width: 100%;
            }
        }

        @media (max-width: 767.98px) {
            .reviews-hero-clean {
                padding: 65px 1rem 35px;
            }

            .reviews-title {
                font-size: 28px;
            }

            .reviews-title span {
                font-size: 24px;
            }

            .hero-search-form {
                max-width: 88vw;
                padding: 0.35rem 0.45rem;
                gap: 0.3rem;
            }

            .hero-search-icon {
                width: 32px;
                height: 32px;
                font-size: 0.85rem;
            }

            .hero-search-input {
                font-size: 13px;
            }

            .hero-search-button {
                font-size: 12px;
                padding: 0.5rem 1.2rem;
            }

            .hero-pill-wrapper {
                flex-direction: column;
                text-align: center;
                gap: 0.65rem;
                padding: 1rem 0 1.3rem;
                margin-top: 1.2rem;
                align-items: center;
            }

            .hero-pill-wrapper::before,
            .hero-pill-wrapper::after {
                display: none;
            }

            .hero-pill {
                width: auto;
                min-width: 0;
                max-width: 100%;
                justify-content: center;
                padding: 10px 16px;
            }
        }

        @media (max-width: 575.98px) {
            .reviews-hero-clean {
                padding: 60px 0 35px;
            }

            .reviews-title {
                font-size: 24px;
            }

            .reviews-title span {
                font-size: 20px;
            }

            .hero-search-form {
                flex-wrap: nowrap;
                flex-direction: row;
                max-width: calc(100% - 1.25rem);
                padding: 0.4rem;
                gap: 0.25rem;
                border-radius: 12px;
            }

            .hero-search-icon {
                width: 32px;
                height: 32px;
                font-size: 0.85rem;
                border-right: 1px solid rgba(15, 23, 42, 0.08);
                border-bottom: none;
                padding-bottom: 0;
                justify-content: center;
            }

            .hero-search-input {
                font-size: 12.5px;
            }

            .hero-search-button {
                min-width: 80px;
                font-size: 11.5px;
                padding: 0.5rem 1rem;
            }

            .hero-search-suggestions {
                width: calc(100% - 1rem);
            }

            .hero-pill-wrapper {
                padding: 0.8rem 0 1.4rem;
            }

            .hero-pill {
                width: auto;
                min-width: 0;
                max-width: 90%;
                padding: 10px 16px;
                gap: 6px;
                font-size: 12px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .hero-pill span,
            .hero-pill a {
                font-size: 12px;
            }
        }


          @media (max-width: 480px) {
            .reviews-title {
                font-size: 18px;
            }
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


            
            .reviews-hero-clean {
                padding: 55px 0 35px;
                text-align: center;
                background-size: cover;
                background-position: center;
            }

            .reviews-hero-inner {
                padding: 0 1rem;
            }

            .reviews-title {
                font-size: 30px;
                font-weight: 500;
                line-height: 1.25;
                margin-bottom: 0.6rem;
            }

            .reviews-title span {
                font-size: 26px;
                font-weight: 700;
                color: #1b9d4b;
            }

            .reviews-subtitle {
                font-size: 14px;
                font-weight: 400;
                margin-bottom: 1.8rem;
                color: #4b5563;
            }

            /* Search Box Fix */
            .hero-search-form {
                padding: 0.55rem 0.55rem 0.55rem 0.75rem;
                gap: 0.45rem;
                border-radius: 18px;
                /* max-width: 60%; */
                box-shadow: 0 12px 28px rgba(15,23,42,0.08);
            }

            .hero-search-icon {
                width: 38px;
                height: 38px;
                font-size: 1rem;
            }

            .hero-search-input {
                font-size: 14px;
                width: 75%;
            }

            .hero-search-button {
                font-size: 13px;
                padding: 0.65rem 1.5rem;
                border-radius: 14px;
            }

            /* Pill Fix (already correct but small improvements) */
            .hero-pill-wrapper {
                margin-top: 1.8rem;
                padding-top: 0.5rem;
            }

            .hero-pill {
                padding: 14px 24px;
                border-radius: 50px;
                font-size: 14px;
                box-shadow: 0 12px 25px rgba(15,23,42,0.10);
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

            .reviews-hero-clean {
                min-height: 70vh; /* Full mobile screen height */
                display: flex;
                align-items: flex-start;  /* or center if you want */
                justify-content: flex-start;
                padding-top: 70px; /* adjust top spacing */
                padding-bottom: 30px;
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
		
		
		
		
		
		

		
		
		
		
        /* Full Hero Wrapper */
        .solarHero-wrap {
            width: 100%;
            min-height: calc(100vh - 80px);
            padding-top: 120px; /* 👈 yaha se control karo kitna upar chahiye */
            background: url('/images/im/bg-m.jpg') center bottom / cover no-repeat;
            background-color: #f5f5f5; 
            display: flex;
            align-items: flex-start; /* 👈 center se upar */
            justify-content: center;
            padding-left: 20px;
            padding-right: 20px;
            position: relative;
        }



        /* Inner content container */
        .solarHero-inner {
            text-align: center;
            max-width: 900px;
            width: 100%;
        }

        .solarHero-content {
            max-width: var(--hero-content-width);
            margin: 0 auto;
            width: 100%;
        }

        /* Title */
        /*.solarHero-title {*/
        /*    font-size: clamp(1.85rem, 3.6vw, 2.9rem);*/
        /*    font-weight: 700;*/
        /*    color: #222;*/
        /*    line-height: 1.1;*/
        /*}*/
        
        
        .solarHero-title {
            font-size: 48px;
            font-weight: 700;
            color: #222;
            line-height: 1.3;
        }

        /*.solarHero-title .solarHero-title-line {*/
        /*    display: block;*/
        /*    white-space: nowrap;*/
        /*}*/

        .solarHero-title .solarHero-title-line.secondary {
            color: #2fa83f;
            /*font-size: clamp(1.7rem, 3.2vw, 2.6rem);*/
        }

        /* Subtitle */
        .solarHero-subtitle {
            margin-top: 10px;
            font-size: clamp(0.85rem, 2.5vw, 1.125rem);
            color: #444;
            font-size: 16px !important;
        }

        /* Search Box */
        .solarHero-searchBox {
            margin: 30px auto 0;
            width: 100%;
            max-width: 600px;
            background: #fff;
            padding: 12px 16px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }
        .solarHero-pillBox {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            display: flex;
            justify-content: center;
            padding: 0 20px;
        }

        .solarHero-pill {
            background: #fff;
            padding: 12px 25px;
            border-radius: 30px;
            border: 1px solid #dcdfe4;  /* ✔ Added border */
            box-shadow: none;           /* ✔ Removed shadow */
            font-size: 14px;
            display: flex;
            gap: 5px;
            position: relative;
            z-index: 2;
            white-space: nowrap; 
        }

        /* Left & Right Lines */
        .solarHero-pillBox::before,
        .solarHero-pillBox::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #dcdfe4;
            margin: auto 0px;
            max-width: 450px;
        }


        .solarHero-pill a {
            color: #4a3aff;
            text-decoration: none;
            font-weight: 600;
        }



        @media (max-width: 600px) {
            .solarHero-pillBox {
                bottom: 260px;  
            }
            
            .solarHero-pillBox::before,
            .solarHero-pillBox::after {
                content: '';
                flex: 1;
                height: 0px;
                background: #dcdfe4;
                margin: auto 0px;
                max-width: 350px;
            }
            
            .solarHero-wrap {
                width: 100%;
                min-height: calc(100vh - 80px);
                padding-top: 40px;
                background: url('/images/im/bg-m.jpg') center center / cover no-repeat;
                background-color: #f5f5f5;
                display: flex;
                align-items: flex-start;
                justify-content: center;
                padding-left: 20px;
                padding-right: 20px;
                position: relative;
            }
        }

        .hero-search-form {
            position: relative;
            z-index: 110;
        }

        .hero-search-suggestions {
            background: #fff;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            z-index: 115;
            position: relative;
            max-width: var(--hero-content-width);
            width: 100%;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.45);
            z-index: 100;
        }

        .hero-search-form{
            margin-top: 30px;
        }



        .stats-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 40px;
            white-space: nowrap;     /* 🔥 prevents wrapping */
            overflow: hidden;
        }

        .stat-box {
            text-align: center;
            flex: 1;
        }

        .stat-value {
            font-weight: 700;
            font-size: clamp(18px, 2.5vw, 28px);
            margin-bottom: 6px;
        }

        .stat-label {
            font-size: 16px;
            color: #4b5563;
            font-weight: 500;
        }

        .yellow {
            color: #f5b400;
        }

        .green {
            color: #28a745;
        }


        .stats-section {
            padding: 70px 0;
            margin: 60px 0;
            background: #fff;
        }

        @media (max-width: 768px) {


            .stats-container {
                display: flex;
                justify-content: space-between;
                gap: 0;
            }


            .stat-box:last-child {
            margin-right: 0;
        }

            .stat-value {
                font-size: 14px;
            }

            .stat-box span{
                font-size: 12px;
            }

            .stats-section {
                margin: -192px 0 -40px 0;
                position: absolute;
                z-index: 2;
                padding: 50px 0;
                width: 100%;
            }
        }


        /* ========================= */
        /* CTA CONTAINER */
        /* ========================= */
        .cta-wrapper {
            position: relative;
            background: #47a458;
            border-radius: 28px;
            padding: 32px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            overflow: hidden;
        }

        /* ========================= */
        /* CONTENT */
        /* ========================= */
        .cta-content h3 {
            margin: 0 0 8px;
            font-size: 22px;
            font-weight: 600;
            color: #fff;
        }

        .cta-content p {
            margin: 0;
            font-size: 16px;
            color: #fff;
        }

        /* ========================= */
        /* BUTTON */
        /* ========================= */
        .cta-action {
            position: relative;
            z-index: 5;
        }

        .cta-btn {
            position: relative;
            z-index: 6;
            background: #fff;
            color: #000;
            border: none;
            padding: 14px 28px;
            border-radius: 30px;
            font-size: 14px;
            cursor: pointer;
            white-space: nowrap;
        }

        /* ========================= */
        /* DECORATIVE BARS */
        /* ========================= */
        .cta-bars {
            position: absolute;
            right: 20px;
            bottom: 0;
            display: flex;
            gap: 10px;
            align-items: flex-end;
            z-index: 1;
        }

        .cta-bars span {
            width: 50px;
            background: #ffc93a;
            border-radius: 10px 10px 0 0;
        }

        .cta-bars span:nth-child(1) { height: 22px; }
        .cta-bars span:nth-child(2) { height: 40px; }
        .cta-bars span:nth-child(3) { height: 60px; }
        .cta-bars span:nth-child(4) { height: 80px; }

        /* ========================= */
        /* RESPONSIVE (MOBILE) */
        /* ========================= */
        @media (max-width: 768px) {
            .cta-wrapper {
                flex-direction: column;
                text-align: center;
                gap: 16px;
            }

            .cta-content {
                order: 1;
            }

            .cta-action {
                order: 2;
                width: 100%;
            }

            .cta-btn {
                margin: 0 auto;
            }

            .cta-bars {
                right: 50%;
                transform: translateX(50%);
                gap: 25px;
            }

            .cta-content h3 {
                margin: 0 0 8px;
                font-weight: 600;
                color: #fff;
                white-space: nowrap;          /* 🔥 ek hi line */
                font-size: clamp(16px, 3.5vw, 22px);  /* 🔥 responsive shrink */
                margin-left: 0;
                margin-right: 0;
            }

            .cta-content p {
                max-width: 85%;          /* 🔥 h3 se kam width */
                margin: 0 auto;          /* center align */
                font-size: 14px;
            }

        }




        /* ================= SECTION ================= */
        .bank-section {
            padding-bottom: 80px;
        }

        /* ================= HEADER ================= */
        .bank-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .bank-header h2 {
            font-size: 24px;
            font-weight: 600;
        }

        .see-more {
            border: 1px solid #4b5cff;
            color: #4b5cff;
            padding: 8px 16px;
            border-radius: 24px;
            text-decoration: none;
            font-size: 14px;
        }

        /* ================= CARDS CONTAINER ================= */
        .bank-cards {
            display: flex;
            gap: 6px;
            overflow-x: auto;              /* 🔥 horizontal scroll */
            scroll-snap-type: x mandatory; /* smooth snap */
            padding-bottom: 10px;
            scroll-behavior: smooth;
        }

        /* 🔥 fallback for old browsers */
        .bank-card {
            margin-right: 20px;
        }

        /* last card ka extra margin hata do */
        .bank-card:last-child {
            margin-right: 0;
        }

        .bank-cards::-webkit-scrollbar {
            display: none;
        }

        /* ================= CARD ================= */
        .bank-card {
            min-width: 280px;              /* 🔥 prevents wrap */
            background: #fff;
            border: 1px solid #e5e5e5;
            border-radius: 18px;
            padding: 20px;
            scroll-snap-align: start;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        .bank-logo {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            border: 1px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
            background: #fff;
            overflow: hidden;
        }

        .bank-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 6px;
        }

        .bank-card h3 {
            margin: 0 0 6px;
            font-size: 18px;
        }

        .domain {
            font-size: 14px;
            color: #666;
            margin-bottom: 12px;
        }

        .site-link {
            display: inline-block;
            font-size: 14px;
            color: #4b5cff;
            text-decoration: none;
            margin-bottom: 12px;
        }

        .site-link:hover {
            text-decoration: underline;
        }

        .rating {
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .rating .stars {
            color: #f5b400;
            font-size: 16px;
        }

        .bank-card.empty-state {
            text-align: center;
            color: #666;
            font-style: italic;
        }

        @media (max-width: 768px) {

            .bank-cards {
                padding-right: 14px;   /* 🔥 small breathing space */
                gap: 14px;
            }

            .bank-card {
                min-width: 85%;       /* 🔥 main card almost full */
                max-width: 85%;
                scroll-snap-align: start;
                margin-right: 14px; /* 🔥 fallback */
            }

            .bank-card:last-child {
                margin-right: 0;
            }

            .bank-header {
                gap: 12px;
            }

            .bank-header h2 {
                font-size: 20px;          /* 🔥 thoda chota */
                line-height: 1.3;
                flex: 1;                  /* 🔥 space le sake */
            }

            .see-more {
                white-space: nowrap;     /* 🔥 wrap band */
                font-size: 13px;         /* 🔥 thoda compact */
                padding: 6px 14px;
                flex-shrink: 0;          /* 🔥 kabhi shrink na ho */
            }
        }





/* ================= SECTION ================= */
.reviews-section {
    padding: 40px 0;
    background: #fff;
}

/* ================= HEADER ================= */
.reviews-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 24px;
}

.reviews-header h2 {
    font-size: 28px;
    font-weight: 600;
    color: #111;
}


/* ================= NAV ARROWS ================= */
.reviews-nav {
    display: flex;
    gap: 10px;
}

.nav-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 1px solid #ddd;
    background: #fff;
    color: #555;
    font-size: 22px;
    cursor: pointer;

    display: flex;
    align-items: center;
    justify-content: center;

    transition: all 0.2s ease;
}

.nav-btn:hover {
    border-color: #4b5cff;
    color: #4b5cff;
}

.nav-btn:disabled {
    opacity: 0.4;
    cursor: not-allowed;
}

/* ================= SCROLL CONTAINER ================= */
.reviews-scroll {
    display: grid;
    grid-auto-flow: column;
    grid-template-rows: repeat(2, auto);
    gap: 24px;

    overflow-x: auto;
    overflow-y: hidden;
    scroll-snap-type: x mandatory;
    padding-bottom: 10px;
}

.reviews-scroll::-webkit-scrollbar {
    display: none;
}

/* ================= CARD ================= */
.review-card {
    width: 330px;
    background: #fff;
    border: 1px solid #e6dcd5;
    border-radius: 22px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;

    scroll-snap-align: start;
}

/* ================= TOP ================= */
.review-top {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 14px;
}

.avatar {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: #eee;
    color: #555;
    font-weight: 600;
    font-size: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.review-top strong {
    display: block;
    font-size: 15px;
    font-weight: 600;
    color: #111;
    margin-bottom: 4px;
}

/* ================= STARS ================= */
.stars {
    display: flex;
    gap: 2px;
    font-size: 14px;
    line-height: 1;
}

.stars span,
.stars {
    color: #00b67a;
}

/* ================= TEXT ================= */
.review-text {
    font-size: 15px;
    line-height: 1.55;
    color: #333;
    margin-bottom: 18px;
}

/* ================= FOOTER ================= */
.review-footer {
    border-top: 1px solid #eee;
    padding-top: 14px;
    font-size: 13px;
}

.review-footer strong {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #111;
    margin-bottom: 4px;
}

.review-footer span {
    display: block;
    color: #666;
    font-size: 12.5px;
    line-height: 1.4;
}

.review-footer a {
    color: #555;
    text-decoration: none;
}

.review-footer a:hover {
    text-decoration: underline;
}


/* ================= COMPANY FOOTER ================= */
.company-info {
    display: flex;
    align-items: center;
    gap: 10px;
}

.company-logo {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    border: 1px solid #ddd;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    flex-shrink: 0;
}

.company-logo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.company-logo span {
    font-weight: 600;
    font-size: 14px;
    color: #666;
}

.company-meta strong {
    font-size: 14px;
    font-weight: 600;
    color: #111;
}

.company-meta span {
    font-size: 12px;
    color: #666;
}


/* ================= RESPONSIVE ================= */
@media (max-width: 768px) {
    .review-card {
        width: 290px;
    }

    .hero-search-suggestions {
        max-width: min(77vw, 292px);
    }

  
}


.hero-search-form:hover {
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
}

.hero-search-suggestions:not([hidden]) ~ .hero-search-form {
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
}




    </style>
</head>
<body style="background-color: #fff;">
    <!-- Navigation -->
    @include('components.frontend.navbar')
    <div class="hero-overlay" data-hero-overlay hidden></div>
	
	
	
	<!-- New Hero Section -->
    <section class="solarHero-wrap">
        <div class="solarHero-inner">
            <div class="solarHero-content">
                <!--<h1 class="solarHero-title">-->
                <!--    <span class="solarHero-title-line">India's most trusted</span>-->
                <!--    <span class="solarHero-title-line secondary">Solar EPC Reviews</span>-->
                <!--</h1>-->
                
                 <h1 class="reviews-title">
                    India's most trusted <br>
                    <span>Solar EPC Reviews</span>
                </h1>

                <p class="solarHero-subtitle">
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
                </form>
                <div class="hero-search-suggestions" data-hero-company-suggestions hidden>
                    <div class="hero-suggestions-header">
                        <span>Suggested searches</span>
                    </div>
                    <ul class="hero-suggestions-list" data-hero-suggestions-list></ul>
                    <div class="hero-suggestions-empty" data-hero-suggestions-empty>No companies found. Try another name.</div>
                </div>
            </div>

            <div class="solarHero-pillBox">
                <div class="solarHero-pill">
                    <span>Installed solar recently?</span>
                    <a href="{{ route('reviews.write') }}">Write a review →</a>
                </div>
            </div>

        </div>
    </section>



    <section class="stats-section" >
        <div class="container-custom"  >
            <div class="stats-container">
                <div class="stat-box">
                    <div class="stat-value yellow">1,500+</div>
                    <span>No. Of listed EPC</span>
                </div>

                <div class="stat-box">
                    <div class="stat-value green">350m+</div>
                    <span>Total Reviews</span>
                </div>

                <div class="stat-box">
                    <div class="stat-value yellow">1,500+</div>
                    <span>Active Users</span>
                </div>
            </div>
        </div>
    </section>

    <div class="container-custom">
        <div class="cta-wrapper mb-4">
            <div class="cta-content">
                <h3>Looking to grow your business?</h3>
                <p>Strengthen your reputation with reviews on Solar Reviews.</p>
            </div>

            <div class="cta-action">
                <button class="cta-btn" onclick="window.location.href='{{ route('login') }}'">Get started</button>
            </div>

            <!-- decorative bars -->
            <div class="cta-bars">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>


        <!-- As Seen In Section -->
    <section class="as-seen-in-section section-spacing " style="padding: 80px 0px; ">
        <div class="container-custom">
            <div class="text-center mb-4">
                <h5 class="fw-semibold text-muted" style="letter-spacing: 1px;">As cited by</h5>
            </div>

            <div class="row justify-content-between align-items-center g-4 text-center">
                <!--<div class="col-6 col-md-3 col-lg-3">-->
                <!--    <img src="/images/usnews.png" alt="US News" class="as-seen-logo">-->
                <!--</div>-->

                <!--<div class="col-6 col-md-3 col-lg-3">-->
                <!--    <img src="/images/cnbc.png" alt="CNBC" class="as-seen-logo">-->
                <!--</div>-->

                <!--<div class="col-6 col-md-3 col-lg-3">-->
                <!--    <img src="/images/npr.png" alt="NPR" class="as-seen-logo">-->
                <!--</div>-->

                <!--<div class="col-6 col-md-3 col-lg-3">-->
                <!--    <img src="/images/cnn.png" alt="CNN" class="as-seen-logo">-->
                <!--</div>-->

                <div class="col-6 col-md-3 col-lg-2">
                    <img src="/images/investopedia.png" alt="Investopedia" class="as-seen-logo">
                </div>

                <div class="col-6 col-md-3 col-lg-2">
                    <img src="/images/nerdwallet.png" alt="NerdWallet" class="as-seen-logo">
                </div>

                <div class="col-6 col-md-3 col-lg-2">
                    <img src="/images/bloomberg.png" alt="Bloomberg" class="as-seen-logo">
                </div>
                
                <div class="col-6 col-md-3 col-lg-2">
                    <img src="/images/npr.png" alt="NPR" class="as-seen-logo">
                </div>
                
                <div class="col-6 col-md-3 col-lg-2">
                    <img src="/images/cbsnews.png" alt="CBS News" class="as-seen-logo">
                </div>
                
               
            </div>
        </div>
    </section>




    <section class="bank-section">
        <div class="container-custom">
            <div class="bank-header">
                <h2>Trending Companies on Solar Reviews</h2>
                <a href="{{ route('companies.index') }}" class="see-more">See more</a>
            </div>

            <div class="bank-cards" id="autoScrollCards">
                @forelse($trendingCompanies ?? [] as $company)
                    <div class="bank-card">
                        <a href="{{ route('companies.show', $company['slug']) }}">
                            <div class="bank-logo">
                                <img src="{{ $company['logo'] }}" alt="{{ $company['name'] }} logo">
                            </div>
                            <h3>{{ $company['name'] }}</h3>

                            @if(!empty($company['website_url']))
                                <a class="site-link" href="{{ $company['website_url'] }}" target="_blank" rel="noopener">
                                    {{ $company['website_host'] ?? $company['website_url'] }}
                                </a>
                            @endif

                            <div class="rating">
                                <span class="stars">
                                    @for ($i = 1; $i <= 5; $i++)
                                        {{ $company['avg_rating'] >= $i ? '★' : '☆' }}
                                    @endfor
                                </span>
                                <span>{{ number_format($company['avg_rating'], 1) }} ({{ number_format($company['review_count']) }})</span>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="bank-card empty-state">
                        No trending companies available right now. Check back soon.
                    </div>
                @endforelse
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
    <!-- <section id="testimonials" class="py-5 bg-white">
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
    </section> -->



    <section class="reviews-section">
        <div class="container-custom">

            <div class="reviews-header">
                <h2>Recent reviews</h2>

                <div class="reviews-nav">
                    <button class="nav-btn prev" aria-label="Previous">
                        ‹
                    </button>
                    <button class="nav-btn next" aria-label="Next">
                        ›
                    </button>
                </div>
            </div>


            <div class="reviews-scroll">
                @foreach($recentReviews ?? [] as $review)
                    <div class="review-card">
                        <div class="review-top">
                            <div class="avatar">{{ $review['avatar'] }}</div>
                            <div>
                                <strong>{{ $review['reviewer'] }}</strong>
                                <div class="stars">
                                    @for ($i = 1; $i <= 5; $i++)
                                        {{ $review['rating'] >= $i ? '★' : '☆' }}
                                    @endfor
                                </div>
                            </div>
                        </div>

                        <p class="review-text">
                            {{ $review['text'] }}
                        </p>

                        <div class="review-footer">
                            <div class="company-info">
                                <div class="company-logo">
                                    <img src="{{ $review['company']['logo'] }}" alt="{{ $review['company']['name'] }} logo">
                                </div>

                                <div class="company-meta">
                                    <strong>
                                        @if(!empty($review['company']['slug']))
                                            <a href="{{ route('companies.show', $review['company']['slug']) }}">
                                                {{ $review['company']['name'] }}
                                            </a>
                                        @else
                                            {{ $review['company']['name'] }}
                                        @endif
                                    </strong>

                                    @if(!empty($review['company']['website_host']))
                                        <span>{{ $review['company']['website_host'] }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
                @if(($recentReviews ?? collect())->isEmpty())
                    <div class="review-card">
                        <div class="review-top">
                            <div class="avatar">SR</div>
                            <div>
                                <strong>No recent reviews yet</strong>
                            </div>
                        </div>
                        <p class="review-text">
                            Be the first to share your experience with a solar installer on Solar Reviews.
                        </p>
                        <div class="review-footer">
                            <strong>Solar Reviews Community</strong>
                            <span><a href="{{ route('reviews.write') }}" class="text-decoration-none">Write a review</a></span>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </section>




    <!-- Experts Section -->
    <!-- <section class="experts-section section-spacing py-5">
        <div class="container-custom">
            <div class="row align-items-center">

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
    </section> -->


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
            // const countLabel = document.querySelector('[data-hero-suggestions-count]');
            const overlay = document.querySelector('[data-hero-overlay]');
            const MAX_RESULTS = 5;
            const curatedSuggestions = [
                'Best Companies in Delhi',
                'Solar installers near you',
                'Search reviews by city or state',
                'Best Solar Companies',
                'Search verified customer reviews',
            ];
            const intentRoutes = [
                {
                    keywords: ['delhi'],
                    url: "{{ url('state/delhi') }}",
                },
                {
                    keywords: ['installer'],
                    url: "{{ route('companies.index') }}",
                },
                {
                    keywords: ['reviews'],
                    url: "{{ route('reviews.top') }}",
                },
                {
                    keywords: ['best', 'solar', 'companies'],
                    url: "{{ route('companies.index') }}",
                },
                {
                    keywords: ['verified', 'customer', 'reviews'],
                    url: "{{ route('reviews.top') }}",
                },
                {
                    keywords: ['city'],
                    url: "{{ route('reviews.top') }}",
                },
                {
                    keywords: ['state'],
                    url: "{{ route('reviews.top') }}",
                },
                {
                    keywords: ['write', 'review'],
                    url: "{{ route('reviews.write') }}",
                },
                {
                    keywords: ['submit', 'review'],
                    url: "{{ route('reviews.write') }}",
                },
                {
                    keywords: ['compare', 'companies'],
                    url: "{{ route('companies.index') }}",
                },
                {
                    keywords: ['find', 'company'],
                    url: "{{ route('companies.index') }}",
                },
                {
                    keywords: ['near', 'me'],
                    url: "{{ route('companies.index') }}",
                },
            ];
            const stateBaseUrl = "{{ url('state') }}/";
            const locationIntents = {
                'delhi': 'delhi',
                'maharashtra': 'maharashtra',
                'mumbai': 'maharashtra',
                'pune': 'maharashtra',
                'karnataka': 'karnataka',
                'bengaluru': 'karnataka',
                'bangalore': 'karnataka',
                'tamil nadu': 'tamil-nadu',
                'tamil-nadu': 'tamil-nadu',
                'kerala': 'kerala',
                'gujarat': 'gujarat',
                'rajasthan': 'rajasthan',
                'punjab': 'punjab',
                'uttar pradesh': 'uttar-pradesh',
                'uttar-pradesh': 'uttar-pradesh',
                'madhya pradesh': 'madhya-pradesh',
                'madhya-pradesh': 'madhya-pradesh',
                'west bengal': 'west-bengal',
                'west-bengal': 'west-bengal',
                'telangana': 'telangana',
                'hyderabad': 'telangana',
                'haryana': 'haryana',
                'odisha': 'odisha',
                'odisa': 'odisha',
                'andhra pradesh': 'andhra-pradesh',
                'andhra-pradesh': 'andhra-pradesh',
            };

            if (!form || !input || !suggestions || !suggestionsList) {
                return;
            }

            function formatCount(value) {
                return value === 1 ? '1 company' : `${value} companies`;
            }

            function toggleOverlay(visible) {
                if (!overlay) return;
                overlay.hidden = !visible;
            }

            function hideSuggestions() {
                suggestions.hidden = true;
                toggleOverlay(false);
                form.style.borderBottomLeftRadius = '';
                form.style.borderBottomRightRadius = '';
            
                input.style.borderBottomLeftRadius = '';
                input.style.borderBottomRightRadius = '';
            }

            function showSuggestions() {
                suggestions.hidden = false;
                toggleOverlay(true);
                console.log("jjj");
                 // 👇 bottom radius remove
                form.style.borderBottomLeftRadius = '0px';
                form.style.borderBottomRightRadius = '0px';
            
                // agar radius input pe hai
                input.style.borderBottomLeftRadius = '0px';
                input.style.borderBottomRightRadius = '0px';
            }

            function goToCompany(company) {
                if (!company?.slug) return;
                window.location.href = `/companies/${company.slug}`;
            }

            function resolveIntent(term) {
                if (!term) {
                    return null;
                }

                const normalized = term.toLowerCase();

                const curatedMatch = curatedSuggestions.find(
                    suggestion => suggestion.toLowerCase() === normalized
                );

                if (curatedMatch) {
                    const exactIntent = intentRoutes.find(intent =>
                        intent.keywords.every(keyword => normalized.includes(keyword))
                    );

                    return exactIntent?.url ?? "{{ route('companies.index') }}";
                }

                for (const intent of intentRoutes) {
                    if (intent.keywords.every(keyword => normalized.includes(keyword))) {
                        return intent.url;
                    }
                }

                for (const [keyword, slug] of Object.entries(locationIntents)) {
                    if (normalized.includes(keyword)) {
                        return `${stateBaseUrl}${slug}`;
                    }
                }

                return null;
            }

            function handleIntentNavigation(term) {
                const intentUrl = resolveIntent(term);
                if (intentUrl) {
                    window.location.href = intentUrl;
                    return true;
                }
                return false;
            }

            function renderCuratedSuggestions() {
                suggestionsList.innerHTML = '';
                curatedSuggestions.forEach(text => {
                    const item = document.createElement('li');
                    item.className = 'hero-suggestion-item';
                   item.innerHTML = `
                        <span class="hero-suggestion-icon-2 mr-5">
                            <i class="fas fa-search"></i>
                        </span>
                        <div class="hero-suggestion-name">${text}</div>
                    `;

                    item.addEventListener('click', () => {
                        if (handleIntentNavigation(text)) {
                            return;
                        }
                        input.value = text;
                        input.dispatchEvent(new Event('input', { bubbles: true }));
                    });
                    suggestionsList.appendChild(item);
                });
                emptyState.style.display = 'none';
                showSuggestions();
            }

            function renderSuggestions(matches) {
                suggestionsList.innerHTML = '';

                if (!input.value.trim()) {
                    renderCuratedSuggestions();
                    return;
                }

                if (!matches.length) {
                    emptyState.style.display = 'block';
                    // countLabel.textContent = '0 results';
                    showSuggestions();
                    return;
                }

                emptyState.style.display = 'none';
                // countLabel.textContent = formatCount(matches.length);

                matches.slice(0, MAX_RESULTS).forEach(company => {
                    const item = document.createElement('li');
                    item.className = 'hero-suggestion-item';
                   item.innerHTML = `
    <span class="hero-suggestion-icon-2 mr-5">
        <i class="fas fa-search"></i>
    </span>
    <div class="hero-suggestion-name">${company.name}</div>
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

            function handleSearchTrigger() {
                const term = input.value.trim();

                if (handleIntentNavigation(term)) {
                    return;
                }

                const matches = filterCompanies(term);
                if (matches.length === 1) {
                    goToCompany(matches[0]);
                    return;
                }

                 if (!matches.length) {
                    window.location.href = "{{ route('companies.index') }}";
                    return;
                }

                renderSuggestions(matches);
            }

            button?.addEventListener('click', () => {
                handleSearchTrigger();
            });

            form.addEventListener('mouseenter', () => {
                const matches = filterCompanies(input.value.trim());
                renderSuggestions(matches);
            });

            function handleHoverExit() {
                requestAnimationFrame(() => {
                    const hoveringForm = form.matches(':hover');
                    const hoveringSuggestions = suggestions.matches(':hover');
                    if (!hoveringForm && !hoveringSuggestions) {
                        hideSuggestions();
                    }
                });
            }

            form.addEventListener('mouseleave', handleHoverExit);
            suggestions.addEventListener('mouseleave', handleHoverExit);

            form.addEventListener('submit', (event) => {
                event.preventDefault();
                handleSearchTrigger();
            });

            overlay?.addEventListener('click', hideSuggestions);

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


   
        document.addEventListener("DOMContentLoaded", function () {
            const container = document.getElementById("autoScrollCards");
            const card = container.querySelector(".bank-card");

            if (!container || !card) return;

            const cardWidth = card.offsetWidth + 20; // 20 = gap
            let autoScroll;

            function startAutoScroll() {
                autoScroll = setInterval(() => {
                    // If reached end → go back to start
                    if (container.scrollLeft + container.clientWidth >= container.scrollWidth - 5) {
                        container.scrollTo({ left: 0, behavior: "smooth" });
                    } else {
                        container.scrollBy({ left: cardWidth, behavior: "smooth" });
                    }
                }, 84000); // 🔥
            }

            function stopAutoScroll() {
                clearInterval(autoScroll);
            }

            // Start auto scroll
            startAutoScroll();

            // Pause on user interaction
            container.addEventListener("mouseenter", stopAutoScroll);
            container.addEventListener("mouseleave", startAutoScroll);
            container.addEventListener("touchstart", stopAutoScroll);
            container.addEventListener("touchend", startAutoScroll);
        });


        document.addEventListener('DOMContentLoaded', function () {
            const container = document.querySelector('.reviews-scroll');
            const prevBtn = document.querySelector('.nav-btn.prev');
            const nextBtn = document.querySelector('.nav-btn.next');

            if (!container) return;

            const scrollAmount = 360; // ek card + gap

            prevBtn.addEventListener('click', () => {
                container.scrollBy({
                    left: -scrollAmount,
                    behavior: 'smooth'
                });
            });

            nextBtn.addEventListener('click', () => {
                container.scrollBy({
                    left: scrollAmount,
                    behavior: 'smooth'
                });
            });
        });

    </script>

    @include('components.frontend.chatbot-widget')
</body>
</html>
