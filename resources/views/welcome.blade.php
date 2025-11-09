<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Solar Reviews - Compare & Find Best Solar Solutions</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])
    <style>
        :root {
            --primary-color: #1e40af;
            --secondary-color: #1e3a8a;
            --accent-color: #3b82f6;
            --text-color: #1f2937;
            --light-bg: #f9fafb;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            color: var(--text-color);
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        
        /* Navigation */
        .navbar {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }
        
        .nav-links a {
            color: var(--text-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .nav-links a:hover {
            color: var(--primary-color);
        }
        
        .btn {
            display: inline-block;
            padding: 0.5rem 1.5rem;
            border-radius: 0.375rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }
        
        .btn-outline {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            background: transparent;
        }
        
        .btn-outline:hover {
            background-color: var(--primary-color);
            color: white;
        }
        
        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 5rem 1rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }
        
        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }
        
        .hero p {
            font-size: 1.25rem;
            max-width: 600px;
            margin: 0 auto 2.5rem;
            opacity: 0.9;
        }
        
        .search-bar {
            display: flex;
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 50px;
            padding: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .search-input {
            flex: 1;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 50px 0 0 50px;
            font-size: 1rem;
            outline: none;
        }
        
        .search-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.3s ease;
            white-space: nowrap;
            font-size: 1rem;
        }
        
        .search-btn:hover {
            background-color: var(--secondary-color);
        }
        
        /* Products Section */
        .products-section {
            padding: 5rem 0;
            background-color: #f8fafc;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        
        .section-header {
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .section-header h2 {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }
        
        .section-header p {
            color: #6b7280;
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            padding: 0 1rem;
        }
        
        .product-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .product-image {
            height: 200px;
            overflow: hidden;
        }
        
        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .product-card:hover .product-image img {
            transform: scale(1.05);
        }
        
        .product-content {
            padding: 1.5rem;
        }
        
        .product-content h3 {
            font-size: 1.5rem;
            color: #1e293b;
            margin: 0 0 1rem 0;
        }
        
        .product-content p {
            color: #64748b;
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }
        
        .product-btn {
            display: inline-block;
            background-color: var(--primary-color);
            color: white;
            padding: 0.6rem 1.5rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }
        
        .product-btn:hover {
            background-color: var(--secondary-color);
        }
        
        @media (max-width: 768px) {
            .products-grid {
                grid-template-columns: 1fr;
                max-width: 500px;
                margin: 0 auto;
            }
            
            .section-header h2 {
                font-size: 2rem;
            }
        }
        
        /* Categories Section */
        .section {
            padding: 5rem 1rem;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .section-title h2 {
            font-size: 2.25rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        
        .section-title p {
            color: #4b5563;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .category-card {
            background: white;
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .category-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }
        
        .category-content {
            padding: 1.5rem;
        }
        
        .category-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-color);
        }
        
        .category-desc {
            color: #6b7280;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }
        
        /* Testimonials */
        .testimonials {
            background-color: #f3f4f6;
        }
        
        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .testimonial-card {
            background: white;
            border-radius: 0.5rem;
            padding: 2rem;
            box-shadow: var(--card-shadow);
        }
        
        .testimonial-text {
            font-style: italic;
            margin-bottom: 1.5rem;
            color: #4b5563;
        }
        
        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .author-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .author-info h4 {
            margin: 0;
            color: var(--text-color);
        }
        
        .author-info p {
            margin: 0.25rem 0 0;
            color: #6b7280;
            font-size: 0.9rem;
        }
        
        /* CTA Section */
        .cta {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            text-align: center;
            padding: 4rem 1rem;
        }
        
        .cta h2 {
            font-size: 2.25rem;
            margin-bottom: 1.5rem;
        }
        
        .cta p {
            max-width: 600px;
            margin: 0 auto 2rem;
            opacity: 0.9;
        }
        
        /* Footer */
        .footer {
            background-color: #111827;
            color: #9ca3af;
            padding: 4rem 1rem 2rem;
        }
        
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }
        
        .footer-logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 1rem;
            display: inline-block;
        }
        
        .footer-about p {
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }
        
        .social-links {
            display: flex;
            gap: 1rem;
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
        }
        
        .footer-links h3 {
            color: white;
            font-size: 1.125rem;
            margin-bottom: 1.5rem;
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
        
        .footer-links li {
            margin-bottom: 0.75rem;
        }
        
        .footer-links a {
            color: #9ca3af;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .footer-links a:hover {
            color: white;
        }
        
        .footer-bottom {
            max-width: 1200px;
            margin: 0 auto;
            padding-top: 2rem;
            border-top: 1px solid #374151;
            text-align: center;
            font-size: 0.875rem;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .hero h1 {
                font-size: 2.25rem;
            }
            
            .search-bar {
                flex-direction: column;
                background: transparent;
                gap: 1rem;
                padding: 0;
            }
            
            .search-input {
                border-radius: 50px;
                padding: 0.75rem 1.5rem;
                width: 100%;
                box-sizing: border-box;
            }
            
            .search-btn {
                width: 100%;
                padding: 0.75rem;
            }
            
            .section {
                padding: 3rem 1rem;
            }
        }
        .btn-primary {
            background-color: var(--secondary-color);
            color: white;
        }
        .btn-primary:hover {
            background-color: #2c5282;
            transform: translateY(-2px);
        }
        .features {
            padding: 4rem 0;
        }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        .feature-card {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            padding: 2rem;
            transition: all 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0,0,0,0.1);
        }
        .icon-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(49, 130, 206, 0.1);
            margin-bottom: 1.5rem;
        }
        .icon-circle svg {
            width: 30px;
            height: 30px;
            color: var(--secondary-color);
        }
        .section-title {
            text-align: center;
            margin-bottom: 3rem;
        }
        .section-title h2 {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        .section-title p {
            color: #4a5568;
            max-width: 600px;
            margin: 0 auto;
        }



        .hero {
            position: relative;
            height: calc(100vh - 80px);
            min-height: 500px;
            background: url("{{ asset('images/solar-panel.jpg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            color: white;
            padding: 0 5%;
            margin: 0;
            box-sizing: border-box;
            overflow-x: hidden;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0.4) 100%);
            z-index: 1;
        }
        
        .hero-content {
            max-width: 600px;
            width: 100%;
            position: relative;
            z-index: 2;
            padding: 2.5rem;
            background: linear-gradient(90deg, rgba(0, 0, 0, 0.85) 0%, rgba(0, 0, 0, 0.7) 100%);
            border-radius: 0 15px 15px 0;
            backdrop-filter: blur(5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            text-align: left;
            margin-left: -5%;
            min-height: 60%;
            max-height: 80%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow: visible;
            box-sizing: border-box;
        }
        
        .hero h1 {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 1.2rem;
            line-height: 1.2;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        /* Ensure no horizontal scroll */
        html, body {
            max-width: 100%;
            overflow-x: hidden;
        }
        
        .hero p {
            font-size: 1.25rem;
            margin-bottom: 2.5rem;
            max-width: 700px;
            margin: 0 0 2rem 0;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }
        
        .search-bar {
            display: flex;
            max-width: 700px;
            margin: 0 auto;
            background: white;
            border-radius: 50px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        
        .search-input {
            flex: 1;
            padding: 1.2rem 2rem;
            border: none;
            font-size: 1.1rem;
            outline: none;
            background: rgba(255, 255, 255, 0.95);
        }
        
        .search-btn {
            background: #3b82f6;
            color: white;
            border: none;
            padding: 0 2.5rem;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .search-btn:hover {
            background: #2563eb;
        }
        
        @media (max-width: 768px) {
            .hero {
                height: auto;
                padding: 6rem 1rem;
            }
            
            .hero h1 {
                font-size: 2.2rem;
            }
            
            .search-bar {
                flex-direction: column;
                border-radius: 12px;
            }
            
            .search-input,
            .search-btn {
                width: 100%;
                padding: 1rem;
                border-radius: 0;
            }
            
            .search-btn {
                border-radius: 0 0 12px 12px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="/" class="logo">
                <i class="fas fa-solar-panel"></i>
                SolarReviews
            </a>
            <div class="nav-links">
                <a href="/">Home</a>
                <a href="/reviews">Reviews</a>
                <a href="/solar-companies">Companies</a>
                <a href="/learn">Learn</a>
                <a href="/about">About Us</a>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-outline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary">Sign up</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>
    
    <section class="hero">
        <div class="hero-content">
            <h1>Find the Best Solar Solutions for Your Home</h1>
            <p>Compare prices, read reviews, and connect with top-rated solar installers in your area. Save up to 30% on your energy bills with our trusted partners.</p>
            <div class="search-bar">
                <input type="text" class="search-input" placeholder="Enter your zip code">
                <button class="search-btn">Calculate Now</button>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="products-section">
        <div class="container">
            <div class="section-header">
                <h2>Unbiased & Unfiltered Reviews</h2>
                <p>Find expert reviews of the solar equipment you need</p>
            </div>
            
            <div class="products-grid">
                <!-- Panel Card -->
                <div class="product-card">
                    <div class="product-image">
                        <img src="{{ asset('images/panels.png') }}" alt="Solar Panels">
                    </div>
                    <div class="product-content">
                        <h3>Solar Panels</h3>
                        <p>Compare efficiency, prices, and reviews of solar panels from top manufacturers.</p>
                        <a href="#" class="product-btn">Compare Now</a>
                    </div>
                </div>
                
                <!-- Battery Card -->
                <div class="product-card">
                    <div class="product-image">
                        <img src="{{ asset('images/batteries.png') }}" alt="Solar Batteries">
                    </div>
                    <div class="product-content">
                        <h3>Solar Batteries</h3>
                        <p>Compare battery capacity, lifespan, and user ratings for the best energy storage.</p>
                        <a href="#" class="product-btn">Compare Now</a>
                    </div>
                </div>
                
                <!-- Inverter Card -->
                <div class="product-card">
                    <div class="product-image">
                        <img src="{{ asset('images/inverters.png') }}" alt="Solar Inverters">
                    </div>
                    <div class="product-content">
                        <h3>Solar Inverters</h3>
                        <p>Compare performance and reliability of inverters from leading brands.</p>
                        <a href="#" class="product-btn">Compare Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="section">
        <div class="section-title">
            <h2>Popular Solar Categories</h2>
            <p>Browse through our top categories to find the perfect solar solution</p>
        </div>
        <div class="categories-grid">
            <div class="category-card">
                <img src="/images/first.png" alt="Residential Solar" class="category-img">
                <div class="category-content">
                    <h3 class="category-title">Residential Solar</h3>
                    <p class="category-desc">Solar solutions for your home to reduce electricity bills and carbon footprint.</p>
                    <a href="/categories/residential" class="btn btn-outline">Explore</a>
                </div>
            </div>
            <div class="category-card">
                <img src="/images/second.png" alt="Commercial Solar" class="category-img">
                <div class="category-content">
                    <h3 class="category-title">Commercial Solar</h3>
                    <p class="category-desc">Cost-effective solar solutions for businesses of all sizes.</p>
                    <a href="/categories/commercial" class="btn btn-outline">Explore</a>
                </div>
            </div>
            <div class="category-card">
                <img src="/images/third.png" alt="Solar Panels" class="category-img">
                <div class="category-content">
                    <h3 class="category-title">Solar Panels</h3>
                    <p class="category-desc">Compare the best solar panels from top manufacturers.</p>
                    <a href="/categories/panels" class="btn btn-outline">Explore</a>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="section" style="background-color: #f3f4f6;">
        <div class="section-title">
            <h2>How It Works</h2>
            <p>Get started with solar in just a few simple steps</p>
        </div>
        <div class="categories-grid">
            <div class="category-card">
                <div class="icon-circle" style="margin: 1.5rem auto;">
                    <i class="fas fa-search" style="font-size: 1.5rem;"></i>
                </div>
                <div class="category-content">
                    <h3 class="category-title">1. Compare Quotes</h3>
                    <p class="category-desc">Get multiple quotes from verified solar installers in your area.</p>
                </div>
            </div>
            <div class="category-card">
                <div class="icon-circle" style="margin: 1.5rem auto; background-color: rgba(59, 130, 246, 0.1);">
                    <i class="fas fa-solar-panel" style="font-size: 1.5rem; color: var(--primary-color);"></i>
                </div>
                <div class="category-content">
                    <h3 class="category-title">2. Choose Installer</h3>
                    <p class="category-desc">Select the best solar solution based on reviews and pricing.</p>
                </div>
            </div>
            <div class="category-card">
                <div class="icon-circle" style="margin: 1.5rem auto; background-color: rgba(16, 185, 129, 0.1);">
                    <i class="fas fa-bolt" style="font-size: 1.5rem; color: #10b981;"></i>
                </div>
                <div class="category-content">
                    <h3 class="category-title">3. Go Solar</h3>
                    <p class="category-desc">Enjoy clean, renewable energy and lower electricity bills.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="section testimonials">
        <div class="section-title">
            <h2>What Our Users Say</h2>
            <p>Read reviews from homeowners who went solar with us</p>
        </div>
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="testimonial-text">
                    "SolarReviews helped me find the perfect solar solution for my home. I'm saving over 70% on my electricity bills!"
                </div>
                <div class="testimonial-author">
                    <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Sarah J." class="author-img">
                    <div class="author-info">
                        <h4>Sarah J.</h4>
                        <p>Homeowner, California</p>
                    </div>
                </div>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-text">
                    "The process was so simple. I compared multiple installers and found the best deal in my area. Highly recommended!"
                </div>
                <div class="testimonial-author">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Michael T." class="author-img">
                    <div class="author-info">
                        <h4>Michael T.</h4>
                        <p>Business Owner, Texas</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <h2>Ready to Go Solar?</h2>
        <p>Join thousands of homeowners who are saving money with solar energy.</p>
        <a href="/get-quotes" class="btn btn-primary" style="background-color: white; color: var(--primary-color);">Get Free Quotes</a>
    </section>

    <!-- State Map Section -->
    <section class="section" id="state-map-section" style="padding: 4rem 0; background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);">
        <div class="container">
            <div class="section-title" style="margin-bottom: 2.5rem; text-align: center;">
                <h2 style="font-size: 2.25rem; color: #1e40af; margin-bottom: 1rem; font-weight: 700;">Find Solar Solutions in Your State</h2>
                <p style="color: #4b5563; max-width: 600px; margin: 0 auto;">Select your state to discover top-rated solar providers and get free quotes tailored to your location.</p>
            </div>
            
            <!-- India Map Component -->
            @include('components.india-map')
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-about">
                <a href="/" class="footer-logo">SolarReviews</a>
                <p>Helping homeowners find the best solar solutions since 2023. Compare, review, and connect with top solar installers in your area.</p>
                <div class="social-links">
                    <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="footer-links">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="/about">About Us</a></li>
                    <li><a href="/how-it-works">How It Works</a></li>
                    <li><a href="/solar-companies">Solar Companies</a></li>
                    <li><a href="/reviews">Reviews</a></li>
                    <li><a href="/blog">Blog</a></li>
                    <li><a href="/contact">Contact Us</a></li>
                </ul>
            </div>
            <div class="footer-links">
                <h3>Solar Resources</h3>
                <ul>
                    <li><a href="/solar-guides">Solar Guides</a></li>
                    <li><a href="/solar-calculator">Solar Calculator</a></li>
                    <li><a href="/solar-incentives">Solar Incentives</a></li>
                    <li><a href="/solar-financing">Financing Options</a></li>
                    <li><a href="/faq">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-links">
                <h3>Legal</h3>
                <ul>
                    <li><a href="/privacy-policy">Privacy Policy</a></li>
                    <li><a href="/terms-of-service">Terms of Service</a></li>
                    <li><a href="/cookie-policy">Cookie Policy</a></li>
                    <li><a href="/sitemap">Sitemap</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} SolarReviews. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Simple smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Mobile menu toggle functionality would go here
    </script>
</body>
</html>
