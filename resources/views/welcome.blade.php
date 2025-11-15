<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Solar Reviews - Compare & Find Best Solar Solutions</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary-color: #1e40af;
            --secondary-color: #1e3a8a;
            --accent-color: #3b82f6;
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
        .hero {
            position: relative;
            min-height: calc(100vh - 60px);
            display: flex;
            align-items: center;
            overflow: hidden;
            background: #f8f9fa;
        }

        .hero .hero-wrapper {
            position: relative;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 4rem 1.5rem;
            min-height: calc(100vh - 60px);
            display: flex;
            align-items: center;
        }

        .hero::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: url("{{ asset('images/solar-panel.jpg') }}") right center/cover no-repeat;
            z-index: 0;
        }

        .hero .hero-gradient {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1;
            opacity: 0.92;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            flex: 1;
            max-width: 600px;
        }

        .hero-heading {
            font-size: 2.5rem;
            font-weight: 700;
            color: #000;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }

        .hero-subheading {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 1.5rem;
        }

        .hero-features {
            list-style: none;
            padding: 0;
            margin: 0 0 2.5rem 0;
        }

        .hero-features li {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            font-size: 1.1rem;
            color: #374151;
        }

        .checkmark-icon {
            width: 24px;
            height: 24px;
            margin-right: 1rem;
            color: #1e40af;
            flex-shrink: 0;
        }

        .hero-search-container {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .hero-search-input-wrapper {
            position: relative;
            flex: 1;
            max-width: 300px;
        }

        .hero-search-input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .hero-search-input:focus {
            border-color: #1e40af;
        }

        .location-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            font-size: 1.2rem;
        }

        .hero-calculate-btn {
            background: #1e40af;
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
            white-space: nowrap;
        }

        .hero-calculate-btn:hover {
            background: #1e3a8a;
            transform: translateY(-2px);
        }

        @media (max-width: 991px) {
            .hero .hero-wrapper::after {
                opacity: 0.3;
            }
            
            .hero-content {
                max-width: 100%;
            }
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
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid #e2e8f0;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            border-color: #cbd5e1;
            text-decoration: none;
            color: inherit;
        }

        .product-image {
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8fafc;
            padding: 2rem;
            position: relative;
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
            color: #4da8ff;
            font-weight: 600;
            margin-bottom: 0.8rem;
            font-size: 1.1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .hero-btn {
            display: inline-block;
            background-color: #0056d2;
            color: #fff;
            font-weight: 600;
            text-decoration: none;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .hero-btn:hover {
            background-color: #003f9e;
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
            color: #1e73be;
        }

        .solar-btn {
            display: inline-block;
            background-color: #0056d2;
            color: #fff;
            font-weight: 600;
            text-decoration: none;
            padding: 0.9rem 1.8rem;
            border-radius: 8px;
            transition: background 0.3s ease;
        }

        .solar-btn:hover {
            background-color: #003f9e;
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
            background-color: #111827;
            color: #9ca3af;
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
            background-color: var(--accent-color);
        }

        .footer-links ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links a {
            color: #9ca3af;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: white;
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
    </style>
</head>
<body>
    <!-- Navigation -->
    @include('components.frontend.navbar')

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-gradient bg-gradient-to-r from-white to-transparent"></div>
        <div class="hero-wrapper">
            <div class="hero-content">
                <h1 class="hero-heading">See how much it costs to install solar panels for your home</h1>
                <p class="hero-subheading">Based on your:</p>
                <ul class="hero-features">
                    <li>
                        <svg class="checkmark-icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        Location
                    </li>
                    <li>
                        <svg class="checkmark-icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        Electric bill
                    </li>
                    <li>
                        <svg class="checkmark-icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        Prices of the best-rated solar companies near you
                    </li>
                </ul>
                <div class="hero-search-container">
                    <div class="hero-search-input-wrapper">
                        <i class="fas fa-map-marker-alt location-icon"></i>
                        <input type="text" class="hero-search-input" placeholder="93305" value="93305">
                    </div>
                    <button class="hero-calculate-btn">Calculate Now</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Comparison Section -->
    <section class="py-5 bg-white border-top border-bottom">
        <div class="container-custom">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3" style="font-size: 2.25rem; color: #1e293b;">Unbiased & Unfiltered Reviews</h2>
                <p class="text-muted mx-auto" style="max-width: 700px; font-size: 1.1rem;">Compare and find the best solar equipment based on expert analysis and real user reviews</p>
            </div>
            
            <div class="row g-4">
                <div class="col-12 col-md-6 col-lg-4">
                    <a href="{{ url('compare/panels') }}" class="product-card">
                        <div class="product-image">
                            <img src="{{ asset('images/panels.png') }}" alt="Solar Panels" class="img-fluid">
                        </div>
                        <div class="product-content">
                            <h3 class="fw-semibold mb-0" style="font-size: 1.375rem; color: #1e293b;">Solar Panels</h3>
                        </div>
                    </a>
                </div>
                
                <div class="col-12 col-md-6 col-lg-4">
                    <a href="{{ url('compare/batteries') }}" class="product-card">
                        <div class="product-image">
                            <img src="{{ asset('images/batteries.png') }}" alt="Solar Batteries" class="img-fluid">
                        </div>
                        <div class="product-content">
                            <h3 class="fw-semibold mb-0" style="font-size: 1.375rem; color: #1e293b;">Solar Batteries</h3>
                        </div>
                    </a>
                </div>
                
                <div class="col-12 col-md-6 col-lg-4">
                    <a href="{{ url('compare/inverters') }}" class="product-card">
                        <div class="product-image">
                            <img src="{{ asset('images/inverters.png') }}" alt="Solar Inverters" class="img-fluid">
                        </div>
                        <div class="product-content">
                            <h3 class="fw-semibold mb-0" style="font-size: 1.375rem; color: #1e293b;">Solar Inverters</h3>
                        </div>
                    </a>
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
                    <a href="#" class="hero-btn">See Reviews of Companies Near You</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Solar Calculator Section -->
    <section id="solar-calculator" class="py-5 bg-white">
        <div class="container-custom">
            <div class="row align-items-center g-4">
                <div class="col-12 col-lg-6">
                    <div class="solar-image">
                        <img src="{{ asset('images/electric-bill-chart.png') }}" alt="Monthly Electric Bill Chart" class="img-fluid">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="solar-text">
                        <p class="small-heading mb-2">Solar Calculator</p>
                        <h2 class="fw-bold mb-3" style="font-size: 2rem; line-height: 1.3; color: #000;">The most accurate solar panel cost and savings calculator available</h2>
                        <p class="text-muted mb-4" style="font-size: 1rem; line-height: 1.6;">
                            Since 2013, our in-house solar experts and engineers have built one of the most accurate solar calculators available. 
                            Dashboardowners can use our solar calculator tool without inputting any personal information, so they can evaluate 
                            the economics of installing solar panels on their homes.
                        </p>
                        <a href="#" class="solar-btn">Use Our Solar Calculator</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section py-5 text-center text-white">
        <div class="cta-wrapper">
            <div class="container-custom">
                <h2 class="fw-bold mb-3" style="font-size: 2.25rem;">Ready to Go Solar?</h2>
                <p class="mb-4 mx-auto" style="max-width: 600px; opacity: 0.9;">Join thousands of homeowners who are saving money with solar energy.</p>
                <a href="#" class="btn btn-light px-4 py-2 fw-semibold" style="color: var(--primary-color);">Get Free Quotes</a>
            </div>
        </div>
    </section>

    <!-- State Map Section -->
    <section class="py-5">
        <div class="container-custom">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3" style="font-size: 2.25rem; color: #1e40af;">Find Solar Solutions in Your State</h2>
                <p class="text-muted mx-auto" style="max-width: 600px;">Select your state to discover top-rated solar providers and get free quotes tailored to your location.</p>
            </div>
            @include('components.india-map')
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-5 bg-white">
        <div class="container-custom">
            <div class="text-center mb-5">
                <a href="#" class="text-primary fw-medium text-decoration-none mb-2 d-block">See What Others Are Saying About Us</a>
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

    <!-- Footer -->
    <footer class="footer py-5">
        <div class="container-custom">
            <div class="row g-4 mb-4">
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="footer-about">
                        <a href="/" class="d-inline-block mb-3">
                            <img src="{{ asset('images/logo.jpg') }}" alt="SolarReviews Logo" style="height: 70px;">
                        </a>
                        <p class="mb-3">Helping homeowners find the best solar solutions since 2023. Compare, review, and connect with top solar installers in your area.</p>
                        <div class="d-flex gap-2">
                            <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="footer-links">
                        <h3 class="text-white mb-3" style="font-size: 1.125rem;">Quick Links</h3>
                        <ul>
                            <li class="mb-2"><a href="#">How It Works</a></li>
                            <li class="mb-2"><a href="#">Solar Companies</a></li>
                            <li class="mb-2"><a href="#">Reviews</a></li>
                            <li class="mb-2"><a href="#">Blog</a></li>
                            <li class="mb-2"><a href="#">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="footer-links">
                        <h3 class="text-white mb-3" style="font-size: 1.125rem;">Solar Resources</h3>
                        <ul>
                            <li class="mb-2"><a href="#">Solar Guides</a></li>
                            <li class="mb-2"><a href="#">Solar Calculator</a></li>
                            <li class="mb-2"><a href="#">Solar Incentives</a></li>
                            <li class="mb-2"><a href="#">Financing Options</a></li>
                            <li class="mb-2"><a href="#">FAQ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="footer-links">
                        <h3 class="text-white mb-3" style="font-size: 1.125rem;">Legal</h3>
                        <ul>
                            <li class="mb-2"><a href="#">Privacy Policy</a></li>
                            <li class="mb-2"><a href="#">Terms of Service</a></li>
                            <li class="mb-2"><a href="#">Cookie Policy</a></li>
                            <li class="mb-2"><a href="#">Sitemap</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-top border-secondary pt-4">
            <div class="container-custom text-center">
                <p class="mb-0" style="font-size: 0.875rem;">&copy; {{ date('Y') }} SolarReviews. All rights reserved.</p>
            </div>
        </div>
    </footer>

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
    </script>
</body>
</html>
