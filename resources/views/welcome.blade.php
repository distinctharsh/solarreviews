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
            padding: 0 2rem;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }
        
        .search-btn:hover {
            background-color: var(--secondary-color);
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
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
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

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Find the Best Solar Solutions for Your Home</h1>
            <p>Compare prices, read reviews, and connect with top-rated solar installers in your area.</p>
            <div class="search-bar">
                <input type="text" class="search-input" placeholder="Enter your address or zip code...">
                <button class="search-btn">Get Free Quotes</button>
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
        <div class="container" style="max-width: 1000px; margin: 0 auto; padding: 0 1.5rem;">
            <div class="section-title" style="margin-bottom: 2.5rem; text-align: center;">
                <h2 style="font-size: 2.25rem; color: #1e40af; margin-bottom: 0.75rem; font-weight: 700;">Find Solar Solutions in Your State</h2>
                <p id="selected-state" style="font-size: 1.25rem; color: #1e40af; font-weight: 500; min-height: 1.5rem; margin-bottom: 1.5rem;"></p>
            </div>
            
            <!-- SVG India Map -->
            <div style="background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <svg id="india-map" viewBox="0 0 1000 1000" style="width: 100%; height: auto; display: block; margin: 0 auto;">
                    <!-- India Outline -->
                    <g id="india-outline">
                        <!-- Northern States -->
                        <path id="jammu-kashmir" d="M400,100 L450,120 L460,150 L440,170 L450,200 L470,210 L480,230 L460,250 L480,270 L470,290 L490,310 L480,330 L500,350 L490,370 L510,390 L500,410 L480,400 L460,410 L440,400 L430,420 L410,410 L400,430 L380,420 L370,440 L350,430 L340,450 L320,440 L310,460 L290,450 L280,470 L260,460 L250,440 L230,430 L220,410 L200,400 L190,380 L170,370 L160,350 L140,340 L130,320 L110,310 L100,330 L80,320 L70,300 L90,290 L80,270 L100,260 L90,240 L110,230 L100,210 L120,200 L110,180 L130,170 L120,150 L140,140 L130,120 L150,110 L140,90 L160,80 L170,100 L180,80 L200,90 L210,70 L230,80 L240,60 L260,70 L270,90 L290,80 L300,100 L320,90 L330,70 L350,80 L360,100 Z" 
                            fill="#e6f2ff" stroke="#ffffff" stroke-width="2" 
                            onmouseover="highlightState('jammu-kashmir', 'Jammu & Kashmir')" 
                            onmouseout="resetHighlight('jammu-kashmir')" 
                            onclick="selectState('Jammu & Kashmir')" />
                        
                        <!-- Northern Plains -->
                        <path id="punjab" d="M200,400 L220,390 L240,400 L250,380 L270,390 L280,370 L300,380 L310,360 L330,370 L340,350 L360,360 L370,380 L390,370 L400,390 L420,380 L430,360 L450,370 L460,350 L480,360 L490,340 L510,350 L520,330 L540,340 L550,360 L570,350 L580,370 L600,360 L610,340 L630,350 L640,330 L660,340 L670,320 L690,330 L700,350 L720,340 L730,360 L750,350 L760,370 L740,380 L750,400 L730,410 L740,430 L720,440 L710,460 L690,450 L680,470 L660,460 L650,440 L630,430 L620,410 L600,400 L590,420 L570,410 L560,430 L540,420 L530,400 L510,390 L500,410 L480,400 L460,410 L440,400 L430,420 L410,410 L400,430 L380,420 L370,400 L350,390 L340,410 L320,400 L310,420 L290,410 L280,390 L260,380 L250,400 L230,390 Z" 
                            fill="#b3d9ff" stroke="#ffffff" stroke-width="2"
                            onmouseover="highlightState('punjab', 'Punjab')" 
                            onmouseout="resetHighlight('punjab')" 
                            onclick="selectState('Punjab')" />
                        
                        <!-- Western India -->
                        <path id="rajasthan" d="M100,400 L90,380 L70,370 L60,390 L40,380 L30,360 L10,350 L0,370 L10,390 L0,410 L20,420 L10,440 L30,450 L20,470 L40,480 L30,500 L50,510 L40,530 L60,540 L50,560 L70,570 L60,590 L80,600 L70,620 L90,630 L80,650 L100,660 L90,680 L110,690 L100,710 L120,720 L130,700 L150,710 L160,730 L180,720 L190,700 L210,710 L220,730 L240,720 L250,700 L270,710 L280,690 L300,700 L310,680 L330,690 L340,710 L360,700 L370,720 L390,710 L400,690 L420,700 L430,680 L450,690 L460,670 L480,680 L490,660 L510,670 L520,650 L500,640 L510,620 L490,610 L500,590 L480,580 L490,560 L470,550 L480,530 L460,520 L470,500 L450,490 L440,470 L420,460 L410,440 L390,430 L380,410 L360,400 L350,380 L330,370 L320,350 L300,340 L290,320 L270,310 L260,290 L240,280 L230,300 L210,290 L200,310 L180,300 L170,320 L150,310 L140,330 L120,320 L110,340 L90,330 L80,350 L60,340 L50,360 L30,350 L40,380 L60,390 L70,370 L90,380 L100,400 Z" 
                            fill="#80bfff" stroke="#ffffff" stroke-width="2"
                            onmouseover="highlightState('rajasthan', 'Rajasthan')" 
                            onmouseout="resetHighlight('rajasthan')" 
                            onclick="selectState('Rajasthan')" />
                        
                        <!-- Gujarat -->
                        <path id="gujarat" d="M50,600 L40,580 L20,570 L10,550 L0,570 L10,590 L0,610 L20,620 L10,640 L30,650 L20,670 L40,680 L30,700 L50,710 L40,730 L60,740 L50,760 L70,770 L80,750 L100,760 L110,740 L130,750 L140,770 L160,760 L170,780 L190,770 L200,750 L220,760 L230,740 L250,750 L260,730 L280,740 L290,720 L310,730 L320,750 L340,740 L350,760 L370,750 L380,770 L400,760 L410,740 L430,750 L440,730 L460,740 L470,720 L490,730 L500,710 L480,700 L490,680 L470,670 L460,650 L440,640 L430,620 L410,610 L400,590 L380,580 L370,600 L350,590 L340,610 L320,600 L310,580 L290,570 L280,550 L260,540 L250,520 L230,510 L220,490 L200,480 L190,500 L170,490 L160,510 L140,500 L130,520 L110,510 L100,490 L80,480 L70,500 L50,490 L60,510 L50,530 L70,540 L60,560 L80,570 L70,590 Z" 
                            fill="#4da6ff" stroke="#ffffff" stroke-width="2"
                            onmouseover="highlightState('gujarat', 'Gujarat')" 
                            onmouseout="resetHighlight('gujarat')" 
                            onclick="selectState('Gujarat')" />
                        
                        <!-- Central India -->
                        <path id="madhya-pradesh" d="M400,500 L390,480 L370,470 L360,450 L340,440 L330,460 L310,450 L300,430 L280,420 L270,440 L250,430 L240,410 L220,400 L210,380 L190,370 L180,350 L160,340 L150,360 L130,350 L120,330 L100,320 L90,340 L70,330 L60,350 L80,360 L70,380 L90,390 L80,410 L100,420 L90,440 L110,450 L100,470 L120,480 L130,500 L150,490 L160,470 L180,480 L190,500 L210,490 L220,510 L240,500 L250,480 L270,490 L280,470 L300,480 L310,500 L330,490 L340,470 L360,480 L370,500 L390,490 L400,510 L420,500 L430,520 L450,510 L460,530 L480,520 L490,540 L510,530 L520,550 L500,560 L510,580 L490,590 L500,610 L480,620 L490,640 L470,650 L460,630 L440,640 L430,620 L410,630 L400,610 L380,600 L370,580 L350,570 L340,550 L320,540 L310,520 L290,510 L280,490 L260,480 L250,500 L230,490 L220,470 L200,460 L190,480 L170,470 L160,490 L140,480 L130,500 L150,510 L140,530 L160,540 L150,560 L170,570 L160,590 L180,600 L170,620 L190,630 L180,650 L200,660 L190,680 L210,690 L200,710 L220,720 L230,700 L250,710 L260,690 L280,700 L290,720 L270,730 L280,750 L260,760 L270,780 L250,790 L260,810 L240,820 L250,840 L270,830 L280,850 L300,840 L310,860 L330,850 L340,830 L360,840 L370,820 L390,830 L400,850 L420,840 L430,860 L450,850 L460,830 L480,840 L490,860 L470,870 L480,890 L460,900 L450,880 L430,890 L420,870 L400,880 L390,860 L370,850 L360,830 L340,820 L330,800 L310,790 L300,770 L280,760 L270,740 L250,730 L240,750 L220,740 L210,760 L190,750 L180,770 L160,760 L150,780 L130,770 L120,790 L100,780 L90,800 L70,790 L60,810 L40,800 L30,780 L50,770 L40,750 L60,740 L50,720 L70,710 L60,690 L80,680 L70,660 L90,650 L80,630 L100,620 L90,600 L110,590 L100,570 L120,560 L110,540 L130,530 L120,510 L140,500 L130,480 L150,470 L140,450 L160,440 L150,420 L170,410 L160,390 L180,380 L170,360 L190,350 L180,330 L200,320 L190,300 L210,290 L200,270 L220,260 L230,280 L250,270 L260,290 L280,280 L290,300 L310,290 L320,310 L340,300 L350,320 L370,330 L380,350 L400,360 L410,380 L430,390 L440,410 L460,420 L470,440 L490,450 L500,470 L520,460 L530,480 L550,470 L560,490 L580,480 L590,500 L570,510 L580,530 L560,540 L550,520 L530,530 L520,510 L500,520 L490,500 L470,510 L460,490 L440,500 L430,480 L410,490 L400,510 Z" 
                            fill="#1a8cff" stroke="#ffffff" stroke-width="2"
                            onmouseover="highlightState('madhya-pradesh', 'Madhya Pradesh')" 
                            onmouseout="resetHighlight('madhya-pradesh')" 
                            onclick="selectState('Madhya Pradesh')" />
                        
                        <!-- Eastern India -->
                        <path id="west-bengal" d="M700,600 L690,580 L670,570 L660,550 L640,540 L630,520 L610,510 L600,490 L580,480 L570,500 L550,490 L540,510 L520,500 L510,480 L490,470 L480,450 L460,440 L450,420 L430,410 L420,390 L400,380 L390,360 L370,350 L360,330 L340,320 L330,300 L310,290 L300,310 L280,300 L270,320 L250,310 L240,330 L220,320 L210,300 L190,290 L180,310 L160,300 L150,280 L130,270 L120,290 L100,280 L90,300 L70,290 L60,310 L40,300 L30,320 L50,330 L40,350 L60,360 L50,380 L70,390 L60,410 L80,420 L70,440 L90,450 L80,470 L100,480 L90,500 L110,510 L100,530 L120,540 L110,560 L130,570 L140,550 L160,560 L170,540 L190,550 L200,570 L220,560 L230,540 L250,550 L260,570 L280,560 L290,580 L310,570 L320,590 L340,580 L350,600 L370,590 L380,570 L400,580 L410,600 L430,590 L440,570 L460,580 L470,600 L490,590 L500,610 L520,600 L530,620 L550,610 L560,590 L580,600 L590,620 L610,610 L620,590 L640,600 L650,620 L670,610 L680,630 L700,620 L710,600 L730,610 L740,590 L760,600 L770,620 L790,610 L800,630 L820,640 L830,620 L850,630 L840,610 L860,600 L850,580 L870,570 L860,550 L840,540 L850,520 L830,510 L840,490 L820,480 L830,460 L810,450 L800,430 L780,420 L770,400 L750,390 L740,370 L720,360 L710,380 L690,370 L680,390 L660,380 L650,400 L630,390 L620,410 L600,400 L590,380 L570,370 L560,350 L540,340 L530,320 L510,310 L500,330 L480,320 L470,300 L450,290 L440,310 L420,300 L410,320 L390,310 L380,290 L360,280 L370,260 L350,250 L340,230 L320,220 L310,240 L290,230 L280,250 L260,240 L270,220 L250,210 L240,190 L220,180 L210,200 L190,190 L200,170 L180,160 L190,140 L170,130 L180,110 L160,100 L150,80 L130,70 L120,90 L100,80 L90,100 L70,90 L60,110 L40,100 L50,80 L40,60 L60,50 L70,70 L90,60 L100,80 L120,70 L130,90 L150,80 L160,100 L180,110 L170,130 L190,140 L180,160 L200,170 L190,190 L210,200 L220,180 L240,190 L250,210 L270,220 L260,240 L280,250 L290,230 L310,240 L320,220 L340,230 L350,250 L370,260 L360,280 L380,290 L390,310 L410,320 L420,300 L440,310 L450,290 L470,300 L480,320 L500,330 L510,310 L530,320 L540,340 L560,350 L570,370 L590,380 L600,400 L620,410 L630,390 L650,400 L660,380 L680,390 L690,370 L710,380 L720,360 L740,370 L750,390 L770,400 L780,420 L800,430 L810,450 L830,460 L820,480 L840,490 L830,510 L850,520 L840,540 L860,550 L870,570 L850,580 L860,600 L840,610 L850,630 L830,620 L820,640 L800,630 L790,610 L770,620 L760,600 L740,590 L730,610 L710,600 Z" 
                            fill="#0066cc" stroke="#ffffff" stroke-width="2"
                            onmouseover="highlightState('west-bengal', 'West Bengal')" 
                            onmouseout="resetHighlight('west-bengal')" 
                            onclick="selectState('West Bengal')" />
                        
                        <!-- Southern India -->
                        <path id="karnataka" d="M400,600 L390,620 L370,630 L360,650 L340,660 L350,680 L330,690 L340,710 L320,720 L330,740 L350,750 L340,770 L360,780 L350,800 L370,810 L360,830 L380,840 L370,860 L390,870 L400,890 L420,880 L430,900 L450,890 L460,870 L480,880 L490,900 L510,890 L520,870 L540,880 L550,860 L570,870 L580,890 L600,880 L610,860 L630,870 L640,850 L660,860 L670,880 L690,870 L700,890 L720,880 L730,860 L750,870 L760,850 L780,860 L790,840 L810,850 L800,830 L820,820 L810,800 L790,790 L800,770 L780,760 L790,740 L770,730 L780,710 L760,700 L770,680 L750,670 L740,650 L720,640 L710,620 L690,610 L680,590 L660,580 L650,600 L630,590 L620,570 L600,560 L590,580 L570,570 L560,550 L540,540 L530,520 L510,510 L500,490 L480,480 L470,460 L450,450 L440,430 L420,420 L410,440 L390,430 L380,450 L360,440 L350,420 L330,410 L320,430 L300,420 L290,440 L270,430 L260,450 L240,440 L230,420 L210,410 L200,430 L180,420 L170,440 L150,430 L140,450 L160,460 L150,480 L170,490 L160,510 L180,520 L170,540 L190,550 L180,570 L200,580 L190,600 L210,610 L200,630 L220,640 L210,660 L230,670 L220,690 L240,700 L230,720 L250,730 L240,750 L260,760 L250,780 L270,790 L260,810 L280,820 L270,840 L290,850 L300,830 L320,840 L330,860 L350,850 L360,830 L380,840 L390,860 L410,850 L420,830 L440,840 L450,820 L470,830 L480,850 L500,840 L510,820 L530,830 L540,850 L560,840 L570,860 L590,850 L600,830 L620,840 L630,860 L650,850 L660,830 L680,840 L690,860 L710,850 L720,870 L740,860 L750,880 L730,890 L740,910 L720,920 L710,900 L690,910 L680,930 L660,920 L650,900 L630,910 L620,890 L600,900 L590,880 L570,890 L560,910 L540,900 L530,920 L510,910 L500,930 L480,920 L470,940 L450,930 L440,950 L420,940 L410,920 L390,930 L380,950 L360,940 L350,920 L330,930 L320,950 L300,940 L290,920 L270,930 L260,950 L240,940 L230,960 L210,950 L200,930 L180,940 L170,960 L150,950 L140,930 L120,940 L110,960 L90,950 L80,930 L60,940 L50,920 L30,930 L20,950 L0,940 L10,920 L0,900 L20,890 L10,870 L30,860 L20,840 L40,830 L30,810 L50,800 L40,780 L60,770 L50,750 L70,740 L60,720 L80,710 L70,690 L90,680 L80,660 L100,650 L90,630 L110,620 L100,600 L120,590 L110,570 L130,560 L120,540 L140,530 L130,510 L150,500 L140,480 L160,470 L150,450 L170,440 L160,420 L180,410 L170,390 L190,380 L200,400 L220,410 L230,390 L250,400 L260,420 L280,410 L290,430 L310,420 L320,440 L340,430 L350,450 L370,440 L380,460 L400,450 L410,470 L430,460 L440,440 L460,450 L470,470 L490,460 L500,480 L520,470 L530,450 L550,460 L560,440 L580,450 L590,470 L610,460 L620,440 L640,450 L650,470 L670,460 L680,440 L700,450 L710,430 L730,440 L740,420 L760,430 L770,410 L790,420 L780,440 L800,450 L790,470 L810,480 L800,500 L820,510 L810,530 L830,540 L820,560 L840,570 L830,590 L850,600 L840,620 L860,630 L850,650 L870,660 L860,680 L880,690 L870,710 L890,720 L880,740 L900,750 L890,770 L910,780 L900,800 L920,810 L910,830 L930,840 L920,860 L900,850 L890,830 L870,840 L860,860 L840,850 L830,830 L810,840 L800,860 L780,850 L770,830 L750,840 L740,820 L720,830 L710,850 L690,840 L680,860 L660,850 L650,870 L630,860 L620,880 L600,870 L590,890 L570,880 L560,900 L540,890 L530,870 L510,880 L500,900 L480,890 L470,870 L450,880 L440,900 L420,890 L410,870 L390,880 L380,900 L360,890 L350,870 L330,880 L320,900 L300,890 L290,910 L270,900 L260,880 L240,890 L230,910 L210,900 L200,880 L180,890 L170,910 L150,900 L140,920 L120,910 L110,890 L90,900 L80,880 L60,890 L50,910 L30,900 L40,880 L20,870 L30,850 L10,840 L20,820 L0,810 L10,790 L20,810 L40,800 L50,780 L70,790 L80,810 L100,800 L110,820 L130,810 L140,790 L160,800 L170,780 L190,790 L200,810 L220,800 L230,780 L250,790 L260,810 L280,800 L290,780 L310,790 L320,810 L340,800 L350,780 L370,790 L380,770 L400,780 L410,800 L430,790 L440,770 L460,780 L470,800 L490,790 L500,770 L520,780 L530,800 L550,790 L560,770 L580,780 L590,800 L610,790 L620,770 L640,780 L650,800 L670,790 L680,770 L700,780 L710,800 L730,790 L740,770 L760,780 L770,800 L750,810 L740,830 L760,840 L750,860 L770,870 L760,890 L780,900 L770,920 L790,930 L800,910 L820,920 L830,940 L850,930 L860,910 L880,920 L890,940 L910,930 L900,910 L920,900 L910,880 L930,870 L920,850 L900,860 L890,840 L870,850 L860,830 L840,840 L830,820 L810,830 L800,810 L780,820 L770,800 L750,790 L740,770 L730,790 L710,780 L700,800 L680,790 L670,770 L650,780 L640,800 L620,790 L610,770 L590,780 L580,800 L560,790 L550,770 L530,780 L520,800 L500,790 L490,770 L470,780 L460,800 L440,790 L430,770 L410,780 L400,800 L380,790 L370,770 L350,780 L340,800 L320,790 L310,770 L290,780 L280,800 L260,790 L250,770 L230,780 L220,800 L200,790 L190,770 L170,780 L160,800 L140,790 L130,770 L110,780 L100,800 L80,790 L70,770 L50,780 L40,800 L20,810 L10,790 L0,800 L10,820 L30,830 L20,850 L40,860 L30,880 L50,890 L40,910 L60,920 L50,940 L70,950 L60,970 L80,980 L90,960 L110,970 L120,990 L140,980 L150,960 L170,970 L180,990 L200,980 L210,960 L230,970 L240,950 L260,960 L270,980 L290,970 L300,950 L320,960 L330,940 L350,950 L360,970 L380,960 L390,980 L410,970 L420,990 L440,980 L450,960 L470,970 L480,950 L500,960 L510,980 L530,970 L540,950 L560,960 L570,940 L590,950 L600,970 L620,960 L630,940 L650,950 L660,930 L680,940 L690,920 L710,930 L720,950 L740,940 L750,960 L770,950 L780,930 L800,940 L810,920 L830,930 L840,950 L860,940 L870,960 L890,950 L900,930 L920,940 L910,920 L930,910 L920,890 L940,880 L930,860 L950,850 L940,830 L960,820 L950,800 L970,790 L960,770 L980,760 L970,740 L990,730 L980,710 L1000,700 L990,680 L1010,670 L1000,650 L1020,640 L1010,620 L1030,610 L1020,590 L1040,580 L1030,560 L1050,550 L1040,530 L1060,520 L1050,500 L1070,490 L1060,470 L1080,460 L1070,440 L1050,450 L1040,430 L1020,440 L1010,460 L990,450 L980,430 L960,440 L950,420 L930,430 L920,410 L900,420 L890,400 L870,410 L860,390 L840,400 L830,420 L810,410 L800,430 L780,420 L770,440 L750,430 L740,450 L720,440 L710,420 L690,430 L680,410 L660,420 L650,440 L630,430 L620,450 L600,440 L590,420 L570,430 L560,450 L540,440 L530,460 L510,450 L500,430 L480,440 L470,420 L450,430 L440,450 L420,440 L410,420 L390,430 L380,450 L400,460 L390,480 L410,490 L400,510 L420,520 L410,540 L430,550 L420,570 L440,580 L430,600 L450,610 L440,630 L460,640 L450,660 L470,670 L460,690 L480,700 L470,720 L490,730 L480,750 L500,760 L490,780 L510,790 L500,810 L520,820 L510,840 L490,830 L480,810 L460,820 L450,800 L430,810 L420,790 L400,800 L390,780 L370,790 L360,810 L340,800 L330,780 L310,790 L300,810 L280,800 L270,780 L250,790 L240,810 L220,800 L210,780 L190,790 L180,810 L160,800 L150,780 L130,790 L120,810 L100,800 L90,780 L70,790 L60,810 L40,800 L30,780 L10,790 L0,800 L10,820 L30,830 L20,850 L40,860 L30,880 L50,890 L40,910 L60,920 L50,940 L70,950 L60,970 L80,980 L90,960 L110,970 L120,990 L140,980 L150,960 L170,970 L180,990 L200,980 L210,960 L230,970 L240,950 L260,960 L270,980 L290,970 L300,950 L320,960 L330,940 L350,950 L360,970 L380,960 L390,980 L410,970 L420,990 L440,980 L450,960 L470,970 L480,950 L500,960 L510,980 L530,970 L540,950 L560,960 L570,940 L590,950 L600,970 L620,960 L630,940 L650,950 L660,930 L680,940 L690,920 L710,930 L720,950 L740,940 L750,960 L770,950 L780,930 L800,940 L810,920 L830,930 L840,950 L860,940 L870,960 L890,950 L900,930 L920,940 L910,920 L930,910 L920,890 L940,880 L930,860 L950,850 L940,830 L960,820 L950,800 L970,790 L960,770 L980,760 L970,740 L990,730 L980,710 L1000,700 L990,680 L1010,670 L1000,650 L1020,640 L1010,620 L1030,610 L1020,590 L1040,580 L1030,560 L1050,550 L1040,530 L1060,520 L1050,500 L1070,490 L1060,470 L1080,460 L1070,440 L1050,450 L1040,430 L1020,440 L1010,460 L990,450 L980,430 L960,440 L950,420 L930,430 L920,410 L900,420 L890,400 L870,410 L860,390 L840,400 L830,420 L810,410 L800,430 L780,420 L770,440 L750,430 L740,450 L720,440 L710,420 L690,430 L680,410 L660,420 L650,440 L630,430 L620,450 L600,440 L590,420 L570,430 L560,450 L540,440 L530,460 L510,450 L500,430 L480,440 L470,420 L450,430 L440,450 L420,440 L410,420 L390,430 L380,450 L400,460 L390,480 L410,490 L400,510 L420,520 L410,540 L430,550 L420,570 L440,580 L430,600 L450,610 L440,630 L460,640 L450,660 L470,670 L460,690 L480,700 L470,720 L490,730 L480,750 L500,760 L490,780 L510,790 L500,810 L520,820 L510,840 L490,830 L480,810 L460,820 L450,800 L430,810 L420,790 L400,800 Z" 
                            fill="#004d99" stroke="#ffffff" stroke-width="2"
                            onmouseover="highlightState('karnataka', 'Karnataka')" 
                            onmouseout="resetHighlight('karnataka')" 
                            onclick="selectState('Karnataka')" />
                        
                        <!-- State Names -->
                        <text x="200" y="200" font-size="12" text-anchor="middle" fill="#333">Jammu & Kashmir</text>
                        <text x="300" y="400" font-size="12" text-anchor="middle" fill="#333">Punjab</text>
                        <text x="200" y="500" font-size="12" text-anchor="middle" fill="#333">Rajasthan</text>
                        <text x="100" y="600" font-size="12" text-anchor="middle" fill="#333">Gujarat</text>
                        <text x="400" y="700" font-size="12" text-anchor="middle" fill="#333">Madhya Pradesh</text>
                        <text x="700" y="700" font-size="12" text-anchor="middle" fill="#333">West Bengal</text>
                        <text x="500" y="900" font-size="12" text-anchor="middle" fill="#333">Karnataka</text>
                    </g>
                </svg>
                
                <script>
                    function highlightState(stateId, stateName) {
                        document.getElementById(stateId).style.fill = '#ff6b6b';
                        document.getElementById('selected-state').textContent = 'Selected: ' + stateName;
                    }
                    
                    function resetHighlight(stateId) {
                        const element = document.getElementById(stateId);
                        if (!element.classList.contains('selected-state')) {
                            element.style.fill = '';
                            document.getElementById('selected-state').textContent = '';
                        }
                    }
                    
                    function selectState(stateName) {
                        // Remove previous selection
                        const prevSelected = document.querySelector('.selected-state');
                        if (prevSelected) {
                            prevSelected.classList.remove('selected-state');
                            prevSelected.style.fill = '';
                        }
                        
                        // Add selection to clicked state
                        const stateElement = document.getElementById(stateName.toLowerCase().replace(/\s+/g, '-'));
                        if (stateElement) {
                            stateElement.classList.add('selected-state');
                            stateElement.style.fill = '#ff3b3b';
                        }
                        
                        // Update selected state text
                        const selectedState = document.getElementById('selected-state');
                        selectedState.textContent = 'Selected: ' + stateName;
                        selectedState.style.display = 'block';
                        
                        // Here you can add navigation or other actions when a state is selected
                        console.log('State selected:', stateName);
                        
                        // Example: Scroll to providers section
                        document.getElementById('providers-section').scrollIntoView({ behavior: 'smooth' });
                    }
                </script>
            </div>
                </svg>
                
                <script>
                    function highlightState(stateId, stateName) {
                        document.getElementById(stateId).style.fill = '#ff6b6b';
                        document.getElementById('selected-state').textContent = 'Selected: ' + stateName;
                    }
                    
                    function resetHighlight(stateId) {
                        document.getElementById(stateId).style.fill = '';
                        if (!document.querySelector('.selected-state')) {
                            document.getElementById('selected-state').textContent = '';
                        }
                    }
                    
                    function selectState(stateName) {
                        // Remove previous selection
                        const prevSelected = document.querySelector('.selected-state');
                        if (prevSelected) {
                            prevSelected.classList.remove('selected-state');
                        }
                        
                        // Add selection to clicked state
                        const stateElement = document.getElementById(stateName.toLowerCase().replace(/\s+/g, '-'));
                        if (stateElement) {
                            stateElement.classList.add('selected-state');
                        }
                        
                        // Update selected state text
                        const selectedState = document.getElementById('selected-state');
                        selectedState.textContent = 'Selected: ' + stateName;
                        selectedState.style.display = 'block';
                        
                        // Here you can add navigation or other actions when a state is selected
                        console.log('State selected:', stateName);
                    }
                </script>
            </div>
            
            <!-- Providers Section -->
            <div id="providers-section" style="margin-top: 2rem; text-align: center;">
                <p>Select a state to view solar providers</p>
            </div>
        </div>
        
        <style>
            @keyframes spin {
                to { transform: rotate(360deg); }
            }
            
            .provider-card {
                background: white;
                border-radius: 8px;
                padding: 1.25rem;
                margin-bottom: 1rem;
                box-shadow: 0 2px 4px rgba(0,0,0,0.05);
                border: 1px solid #e5e7eb;
                transition: all 0.2s ease;
            }
            
            .provider-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            }
            
            .provider-rating {
                display: inline-flex;
                align-items: center;
                background: #fffbeb;
                color: #d97706;
                padding: 0.25rem 0.75rem;
                border-radius: 9999px;
                font-size: 0.875rem;
                font-weight: 500;
            }
            
            @media (max-width: 768px) {
                #state-map-section h2 {
                    font-size: 1.75rem !important;
                }
                
                #state-map-section p {
                    font-size: 1rem !important;
                }
            }
        </style>

        <!-- Custom styles for the map -->
        <style>
            @keyframes spin {
                to { transform: rotate(360deg); }
            }
            
            /* Map container */
            #state-map {
                background: #f8f9fa;
                border: 1px solid #e2e8f0;
            }
            
            /* State styling */
            .india-state {
                fill: #3b82f6;
                fill-opacity: 0.7;
                stroke: #ffffff;
                stroke-width: 1;
                transition: all 0.3s ease;
                cursor: pointer;
            }
            
            .india-state:hover {
                fill: #2563eb;
                fill-opacity: 0.9;
                stroke: #ffffff;
                stroke-width: 1.5;
            }
            
            .india-state.selected {
                fill: #1d4ed8;
                fill-opacity: 0.9;
                stroke: #ffffff;
                stroke-width: 2;
            }
            
            /* Map controls */
            .leaflet-control-zoom {
                border: 1px solid #e2e8f0 !important;
                border-radius: 6px !important;
                overflow: hidden;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important;
            }
            
            .leaflet-bar a {
                width: 32px !important;
                height: 32px !important;
                line-height: 32px !important;
                background: white !important;
                border-bottom: 1px solid #e2e8f0 !important;
                color: #4b5563 !important;
                transition: all 0.2s ease;
            }
            
            .leaflet-bar a:hover {
                background: #f8fafc !important;
                color: #1e40af !important;
            }
            
            /* Provider cards */
            .provider-card {
                background: white;
                border-radius: 8px;
                padding: 1.25rem;
                margin-bottom: 1rem;
                box-shadow: 0 2px 4px rgba(0,0,0,0.05);
                border: 1px solid #e5e7eb;
                transition: all 0.2s ease;
            }
            
            .provider-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            }
            
            .provider-rating {
                display: inline-flex;
                align-items: center;
                background: #fffbeb;
                color: #d97706;
                padding: 0.25rem 0.75rem;
                border-radius: 9999px;
                font-size: 0.875rem;
                font-weight: 500;
            }
            
            /* Responsive adjustments */
            @media (max-width: 768px) {
                #state-map {
                    height: 500px !important;
                }
                
                .section-title h2 {
                    font-size: 1.75rem !important;
                }
                
                .section-title p {
                    font-size: 1rem !important;
                }
            }
        </style>
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
