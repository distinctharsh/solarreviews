<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

      <!-- Welcome Page CSS -->
  
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @include('components.frontend.meta-tags', [
        'title' => 'Solar Reviews India | Compare Solar Installers, Products & Services',
        'description' => 'Discover verified solar installers, EPC partners, equipment brands and unbiased reviews in India. Compare ratings, read expert insights and find the right solar solution.',
        'keywords' => 'solar reviews India, solar installer ratings, solar companies comparison, EPC, solar panels',
        'canonical' => url('/'),
        'image' => asset('favicon.svg'),
    ])


    <style>

         /* Products Section */
        .products-section {
            padding: 4rem 0;
            background-color: #ffffff;
            border-top: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .project-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }
        
        .section-header {
            text-align: center;
            margin-bottom: 3.5rem;
        }
        
        .section-header h2 {
            font-size: 2.25rem;
            color: #1e293b;
            margin-bottom: 0.75rem;
            font-weight: 700;
            position: relative;
            display: inline-block;
        }
        
        .section-header h2:after {
            content: '';
            position: absolute;
            width: 60px;
            height: 3px;
            background: var(--primary-color);
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
        }
        
        .section-header p {
            color: #64748b;
            font-size: 1.1rem;
            max-width: 700px;
            margin: 1rem auto 0;
            line-height: 1.7;
        }
        
        .products-grid {
            display: grid;
            gap: 2.5rem;
            padding: 0 0.5rem;
            grid-template-columns: repeat(3, 1fr);
        }
        
        .product-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
            border: 1px solid #e2e8f0;
        }
        
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            border-color: #cbd5e1;
        }
        
        .product-image {
            height: 200px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8fafc;
            padding: 2rem;
            position: relative;
        }
        
        .product-image:before {
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
        
        .product-card:hover .product-image:before {
            opacity: 1;
        }
        
        .product-image img {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
            transition: transform 0.5s ease;
            mix-blend-mode: multiply;
        }
        
        .product-card:hover .product-image img {
            transform: scale(1.08);
        }
        
        .product-content {
            padding: 1.75rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            border-top: 1px solid #f1f5f9;
        }
        
        .product-content h3 {
            font-size: 1.375rem;
            color: #1e293b;
            margin: 0 0 1rem 0;
            font-weight: 600;
        }
        
        .product-content p {
            color: #64748b;
            margin-bottom: 1.75rem;
            line-height: 1.7;
            flex-grow: 1;
            font-size: 0.975rem;
        }
        
        .product-btn {
            display: inline-block;
            background-color: var(--primary-color);
            color: white;
            padding: 0.7rem 1.75rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            text-align: center;
            margin-top: auto;
            align-self: flex-start;
            font-size: 0.95rem;
            border: 1px solid transparent;
        }
        
        .product-btn:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                max-width: 500px;
                margin: 0 auto;
            }
            
            .section-header h2 {
                font-size: 2rem;
            }
        

            /* Tablet */
@media (max-width: 992px) {
    .products-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* Mobile */
@media (max-width: 576px) {
    .products-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .project-container {
        padding: 0 1rem;
        margin-bottom: 60px;
    }

    .product-image {
        height: 160px;
        padding: 1.5rem;
    }

    .product-content {
        padding: 1.25rem;
    }

    .product-content h3 {
        font-size: 1.1rem;
    }
}
    </style>
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
</head>
<body style="background-color: #fff;">
    <!-- Navigation -->
    @include('components.frontend.navbar')
    <div class="hero-overlay" data-hero-overlay hidden></div>
	
	<!-- New Hero Section -->
    <section class="solarHero-wrap">
        <div class="solarHero-inner">
            <div class="solarHero-content">
                
                 <h1 class="reviews-title">
                    India's most trusted <br>
                    <span>Solar EPC Reviews</span>
                </h1>

                <p class="solarHero-subtitle">
                    Discover, read, and write reviews
                </p>

                <form class="hero-search-form" data-hero-company-form action="/compare/companies" method="GET">
                    <span class="hero-search-icon"><i class="fas fa-search"></i></span>
                    <input
                        type="text"
                        class="hero-search-input"
                        name="q"
                        placeholder="Search company or type pin code"
                        aria-label="Search company or type pin code"
                        data-hero-company-input
                    >
                </form>
                <!-- <div class="hero-search-suggestions" data-hero-company-suggestions hidden>
                    <div class="hero-suggestions-header">
                        <span>Suggested searches</span>
                    </div>
                    <ul class="hero-suggestions-list" data-hero-suggestions-list></ul>
                    <div class="hero-suggestions-empty" data-hero-suggestions-empty>No companies found. Try another name.</div>
                </div> -->
            </div>


          <div class="project-container" style="margin-top: 4rem;">

            <div class="products-grid">
                <!-- Panel Card -->
                <div class="product-card product-card-review" data-review-modal-trigger="welcomeReviewModal">
                    <div class="product-image product-image-review">
                        <img src="{{ asset('images/panels.png') }}" alt="Solar Panels">
                    </div>
                    <div class="product-content product-content-review">
                        <h3>Write a review</h3>
                    </div>
                </div>

                <!-- Battery Card -->
                <div class="product-card product-card-enquiry btn-get-enquiry" id="getEnquiryCard">
                    <div class="product-image product-image-enquiry">
                        <img src="{{ asset('images/batteries.png') }}" alt="Solar Batteries">
                    </div>
                    <div class="product-content product-content-enquiry">
                        <h3>New Enquiry</h3>
                    </div>
                </div>

                <!-- Inverter Card -->
                <div class="product-card product-card-solution" id="getSolarCard">
                    <div class="product-image product-image-solution">
                        <img src="{{ asset('images/inverters.png') }}" alt="Solar Inverters">
                    </div>
                    <div class="product-content product-content-solution">
                        <h3>Get Solution</h3>
                    </div>
                </div>
            </div>
        </div>

            

            <!-- <div class="solarHero-pillBox">
                <div class="solarHero-pill">
                    <span>Installed solar recently?</span>
                    <a href="{{ route('reviews.write') }}">Write a review →</a>
                </div>
            </div> -->

        </div>
    </section>
    
    <!-- <section class="stats-section" >
        <div class="container-custom"  >
            <div class="stats-container">
                <div class="stat-box">
                    <div class="stat-value yellow">{{ number_format($stats['listed_epc'] ?? 0) }}</div>
                    <span>No. Of listed EPC</span>
                </div>

                <div class="stat-box">
                    <div class="stat-value green">{{ number_format($stats['total_reviews'] ?? 0) }}</div>
                    <span>Total Reviews</span>
                </div>

                <div class="stat-box">
                    <div class="stat-value yellow">{{ number_format($stats['active_users'] ?? 0) }}</div>
                    <span>Active Users</span>
                </div>
            </div>
        </div>
    </section> -->

    <div class="container-custom">
        <div class="cta-wrapper" style="margin-top: 80px;">
            <div class="cta-content">
                <h3>Looking to grow your business?</h3>
                <p>Strengthen your reputation with reviews on Solar Reviews.</p>
            </div>

            @if(!auth()->check() && !session('normal_user_id'))
            <div class="cta-action">
                <button class="nav-btn-primary" onclick="window.location.href='{{ route('login') }}'">Get started</button>
            </div>
            @endif

            <!-- decorative bars -->
            <div class="cta-bars">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>

    <section class="bank-section notranslate" translate="no" >
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
                                <a class="site-link" target="_blank" rel="noopener">
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
                    <h1 class="text-white  mb-3" style="font-size: 2.3rem; line-height: 1.3; font-weight:600;">Unbiased consumer reviews of almost all solar companies in India</h1>
                    <p class="text-white mb-3" style="font-size: 16px; line-height: 1.6; opacity: 0.9;">
                        SolarReviews has both an extensive collection of unbiased consumer reviews of global companies and an expert ranking system 
                        to help you identify the best solar panel installation companies in your area.
                    </p>
                    <a href="{{ url('compare/companies') }}" class="hero-btn" rel="noopener">See Reviews of Companies Near You</a>
                </div>
            </div>
        </div>
    </section>

    <!-- State Map Section -->
    <section class="map-viewport">
        <div class="container-custom">
            <div class="text-center mb-5">
                <h2 class=" mb-2" style="font-size: 2.3rem; line-height: 1.3; color: var(--primary-color); font-weight:600;">Find Solar Solutions in Your State</h2>
                <p class="text-muted mx-auto" style="max-width: 600px; font-size:16px;">Select your state to discover top-rated solar providers and get free quotes tailored to your location.</p>
            </div>
            @include('components.india-map')
        </div>
    </section>

    <section class="reviews-section notranslate" translate="no">
        <div class="container-custom">

            <div class="reviews-header ">
                <h2 class="heading-3 mb-3">Recent reviews</h2>

                <div class="reviews-nav mb-3">
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
                            <span><button type="button" class="btn btn-link text-decoration-none p-0" data-review-modal-trigger="welcomeReviewModal">Write a review</button></span>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </section>

    @include('components.frontend.footer')

    <!-- Get Enquiry Modal -->
    @include('components.frontend.get-enquiry-modal')
    @include('components.frontend.get-solution-modal')

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <!-- Ensure enquiry modal button works -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add click listener for enquiry button as fallback
            const enquiryBtn = document.getElementById('getEnquiryCard');
            if (enquiryBtn) {
                enquiryBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const modal = document.getElementById('enquiryModal');
                    if (modal) {
                        modal.classList.add('active');
                        modal.setAttribute('aria-hidden', 'false');
                        document.body.style.overflow = 'hidden';
                        
                        // Initialize location fields when modal opens
                        setTimeout(() => {
                            const locationRoot = document.querySelector('[data-location-fields][data-location-prefix="enquiry"]');
                            if (locationRoot) {
                                const stateSelect = locationRoot.querySelector('#enquiry_state_id');
                                const citySelect = locationRoot.querySelector('#enquiry_city');
                                
                                if (stateSelect && citySelect) {
                                    // Remove existing event listener to avoid duplicates
                                    const newStateSelect = stateSelect.cloneNode(true);
                                    stateSelect.parentNode.replaceChild(newStateSelect, stateSelect);
                                    
                                    // Add event listener for state change
                                    newStateSelect.addEventListener('change', async () => {
                                        // Clear city and pincode
                                        citySelect.innerHTML = '<option value="">Select City</option>';
                                        
                                        if (newStateSelect.value) {
                                            try {
                                                const res = await fetch(`/locations/states/${newStateSelect.value}/cities`);
                                                const json = await res.json();
                                                const cities = (json && json.data) ? json.data : [];
                                                
                                                cities.forEach(item => {
                                                    const opt = document.createElement('option');
                                                    opt.value = item.name;
                                                    opt.textContent = item.name;
                                                    opt.dataset.id = item.id;
                                                    citySelect.appendChild(opt);
                                                });
                                            } catch (error) {
                                                console.error('Error loading cities:', error);
                                            }
                                        }
                                    });
                                }
                            }
                        }, 100);
                    }
                });
            }
        });
    </script>
    
    <script>
        new Swiper('.as-seen-swiper', {
            slidesPerView: 5,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.as-seen-next',
                prevEl: '.as-seen-prev',
            },
            breakpoints: {
                0: {
                    slidesPerView: 2.2,
                    spaceBetween: 16,
                },
                576: {
                    slidesPerView: 3,
                },
                768: {
                    slidesPerView: 4,
                },
                992: {
                    slidesPerView: 5,
                },
            },
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const href = this.getAttribute('href');
                // Skip if href is just "#" or empty
                if (!href || href === '#') return;
                
                const target = document.querySelector(href);
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

        // Basic search functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchForm = document.querySelector('[data-hero-company-form]');
            const searchInput = document.querySelector('[data-hero-company-input]');
            
            if (searchForm && searchInput) {
                searchForm.addEventListener('submit', function(e) {
                    const searchTerm = searchInput.value.trim();
                    
                    if (/^\d{6}$/.test(searchTerm)) {
                        e.preventDefault(); 
                        window.location.href = `{{ route('companies.index') }}?pincode=${encodeURIComponent(searchTerm)}`;
                    }
                });
            }
        });

        // (function setupHeroCompanySearch() {
        //     const companies = @json($companies ?? []);
        //     const form = document.querySelector('[data-hero-company-form]');
        //     const input = document.querySelector('[data-hero-company-input]');
        //     const button = document.querySelector('[data-hero-company-button]');
        //     const suggestions = document.querySelector('[data-hero-company-suggestions]');
        //     const suggestionsList = document.querySelector('[data-hero-suggestions-list]');
        //     const emptyState = document.querySelector('[data-hero-suggestions-empty]');
        //     // const countLabel = document.querySelector('[data-hero-suggestions-count]');
        //     const overlay = document.querySelector('[data-hero-overlay]');
        //     const MAX_RESULTS = 5;
        //     const curatedSuggestions = [
        //         'Best Companies in Delhi',
        //         'Solar installers near you',
        //         'Search reviews by city or state',
        //         'Best Solar Companies',
        //         'Search verified customer reviews',
        //     ];
        //     const intentRoutes = [
        //         {
        //             keywords: ['delhi'],
        //             url: "{{ url('state/delhi') }}",
        //         },
        //         {
        //             keywords: ['installer'],
        //             url: "{{ route('companies.index') }}",
        //         },
        //         {
        //             keywords: ['reviews'],
        //             url: "{{ route('reviews.top') }}",
        //         },
        //         {
        //             keywords: ['best', 'solar', 'companies'],
        //             url: "{{ route('companies.index') }}",
        //         },
        //         {
        //             keywords: ['verified', 'customer', 'reviews'],
        //             url: "{{ route('reviews.top') }}",
        //         },
        //         {
        //             keywords: ['city'],
        //             url: "{{ route('reviews.top') }}",
        //         },
        //         {
        //             keywords: ['state'],
        //             url: "{{ route('reviews.top') }}",
        //         },
        //         {
        //             keywords: ['write', 'review'],
        //             url: "{{ route('reviews.write') }}",
        //         },
        //         {
        //             keywords: ['submit', 'review'],
        //             url: "{{ route('reviews.write') }}",
        //         },
        //         {
        //             keywords: ['compare', 'companies'],
        //             url: "{{ route('companies.index') }}",
        //         },
        //         {
        //             keywords: ['find', 'company'],
        //             url: "{{ route('companies.index') }}",
        //         },
        //         {
        //             keywords: ['near', 'me'],
        //             url: "{{ route('companies.index') }}",
        //         },
        //     ];
        //     const stateBaseUrl = "{{ url('state') }}/";
        //     const locationIntents = {
        //         'delhi': 'delhi',
        //         'maharashtra': 'maharashtra',
        //         'mumbai': 'maharashtra',
        //         'pune': 'maharashtra',
        //         'karnataka': 'karnataka',
        //         'bengaluru': 'karnataka',
        //         'bangalore': 'karnataka',
        //         'tamil nadu': 'tamil-nadu',
        //         'tamil-nadu': 'tamil-nadu',
        //         'kerala': 'kerala',
        //         'gujarat': 'gujarat',
        //         'rajasthan': 'rajasthan',
        //         'punjab': 'punjab',
        //         'uttar pradesh': 'uttar-pradesh',
        //         'uttar-pradesh': 'uttar-pradesh',
        //         'madhya pradesh': 'madhya-pradesh',
        //         'madhya-pradesh': 'madhya-pradesh',
        //         'west bengal': 'west-bengal',
        //         'west-bengal': 'west-bengal',
        //         'telangana': 'telangana',
        //         'hyderabad': 'telangana',
        //         'haryana': 'haryana',
        //         'odisha': 'odisha',
        //         'odisa': 'odisha',
        //         'andhra pradesh': 'andhra-pradesh',
        //         'andhra-pradesh': 'andhra-pradesh',
        //     };

        //     if (!form || !input || !suggestions || !suggestionsList) {
        //         return;
        //     }

        //     function formatCount(value) {
        //         return value === 1 ? '1 company' : `${value} companies`;
        //     }

        //     function toggleOverlay(visible) {
        //         if (!overlay) return;
        //         overlay.hidden = !visible;
        //     }

        //     function hideSuggestions() {
        //         suggestions.hidden = true;
        //         toggleOverlay(false);
        //         form.style.borderBottomLeftRadius = '';
        //         form.style.borderBottomRightRadius = '';
            
        //         input.style.borderBottomLeftRadius = '';
        //         input.style.borderBottomRightRadius = '';
        //     }

        //     function showSuggestions() {
        //         suggestions.hidden = false;
        //         toggleOverlay(true);
        //         console.log("jjj");
        //          // 👇 bottom radius remove
        //         form.style.borderBottomLeftRadius = '0px';
        //         form.style.borderBottomRightRadius = '0px';
            
        //         // agar radius input pe hai
        //         input.style.borderBottomLeftRadius = '0px';
        //         input.style.borderBottomRightRadius = '0px';
        //     }

        //     function goToCompany(company) {
        //         if (!company?.slug) return;
        //         window.location.href = `/companies/${company.slug}`;
        //     }

        //     function resolveIntent(term) {
        //         if (!term) {
        //             return null;
        //         }

        //         const normalized = term.toLowerCase();

        //         const curatedMatch = curatedSuggestions.find(
        //             suggestion => suggestion.toLowerCase() === normalized
        //         );

        //         if (curatedMatch) {
        //             const exactIntent = intentRoutes.find(intent =>
        //                 intent.keywords.every(keyword => normalized.includes(keyword))
        //             );

        //             return exactIntent?.url ?? "{{ route('companies.index') }}";
        //         }

        //         for (const intent of intentRoutes) {
        //             if (intent.keywords.every(keyword => normalized.includes(keyword))) {
        //                 return intent.url;
        //             }
        //         }

        //         for (const [keyword, slug] of Object.entries(locationIntents)) {
        //             if (normalized.includes(keyword)) {
        //                 return `${stateBaseUrl}${slug}`;
        //             }
        //         }

        //         return null;
        //     }

        //     function handleIntentNavigation(term) {
        //         const intentUrl = resolveIntent(term);
        //         if (intentUrl) {
        //             window.location.href = intentUrl;
        //             return true;
        //         }
        //         return false;
        //     }

        //     function renderCuratedSuggestions() {
        //         suggestionsList.innerHTML = '';
        //         curatedSuggestions.forEach(text => {
        //             const item = document.createElement('li');
        //             item.className = 'hero-suggestion-item';
        //            item.innerHTML = `
        //                 <span class="hero-suggestion-icon-2 mr-5">
        //                     <i class="fas fa-search"></i>
        //                 </span>
        //                 <div class="hero-suggestion-name">${text}</div>
        //             `;

        //             item.addEventListener('click', () => {
        //                 if (handleIntentNavigation(text)) {
        //                     return;
        //                 }
        //                 input.value = text;
        //                 input.dispatchEvent(new Event('input', { bubbles: true }));
        //             });
        //             suggestionsList.appendChild(item);
        //         });
        //         emptyState.style.display = 'none';
        //         showSuggestions();
        //     }

        //     function renderSuggestions(matches) {
        //         suggestionsList.innerHTML = '';

        //         if (!input.value.trim()) {
        //             renderCuratedSuggestions();
        //             return;
        //         }

        //         if (!matches.length) {
        //             emptyState.style.display = 'block';
        //             // countLabel.textContent = '0 results';
        //             showSuggestions();
        //             return;
        //         }

        //         emptyState.style.display = 'none';
        //         // countLabel.textContent = formatCount(matches.length);

        //         matches.slice(0, MAX_RESULTS).forEach(company => {
        //             const item = document.createElement('li');
        //             item.className = 'hero-suggestion-item';
        //            item.innerHTML = `
        //                 <span class="hero-suggestion-icon-2 mr-5">
        //                     <i class="fas fa-search"></i>
        //                 </span>
        //                 <div class="hero-suggestion-name">${company.name}</div>
        //             `;

        //             item.addEventListener('click', () => goToCompany(company));
        //             suggestionsList.appendChild(item);
        //         });

        //         showSuggestions();
        //     }

        //     function filterCompanies(term) {
        //         if (!term) {
        //             return [...companies];
        //         }

        //         const normalized = term.toLowerCase();
        //         return companies.filter(company =>
        //             (company.name || '').toLowerCase().includes(normalized)
        //         );
        //     }

        //     input.addEventListener('input', (event) => {
        //         const matches = filterCompanies(event.target.value.trim());
        //         renderSuggestions(matches);
        //     });

        //     input.addEventListener('focus', () => {
        //         const matches = filterCompanies(input.value.trim());
        //         renderSuggestions(matches);
        //     });

        //     function handleSearchTrigger() {
        //         const term = input.value.trim();

        //         if (handleIntentNavigation(term)) {
        //             return;
        //         }

        //         // Check if input is a pincode (6 digits)
        //         if (/^\d{6}$/.test(term)) {
        //             window.location.href = `{{ route('companies.index') }}?pincode=${encodeURIComponent(term)}`;
        //             return;
        //         }

        //         const matches = filterCompanies(term);
        //         if (matches.length === 1) {
        //             goToCompany(matches[0]);
        //             return;
        //         }

        //          if (!matches.length) {
        //             window.location.href = "{{ route('companies.index') }}";
        //             return;
        //         }

        //         renderSuggestions(matches);
        //     }

        //     button?.addEventListener('click', () => {
        //         handleSearchTrigger();
        //     });

        //     form.addEventListener('mouseenter', () => {
        //         const matches = filterCompanies(input.value.trim());
        //         renderSuggestions(matches);
        //     });

        //     function handleHoverExit() {
        //         requestAnimationFrame(() => {
        //             const hoveringForm = form.matches(':hover');
        //             const hoveringSuggestions = suggestions.matches(':hover');
        //             if (!hoveringForm && !hoveringSuggestions) {
        //                 hideSuggestions();
        //             }
        //         });
        //     }

        //     form.addEventListener('mouseleave', handleHoverExit);
        //     suggestions.addEventListener('mouseleave', handleHoverExit);

        //     form.addEventListener('submit', (event) => {
        //         event.preventDefault();
        //         handleSearchTrigger();
        //     });

        //     overlay?.addEventListener('click', hideSuggestions);

        //     document.addEventListener('click', (event) => {
        //         if (!suggestions.contains(event.target) && !form.contains(event.target)) {
        //             hideSuggestions();
        //         }
        //     });
        // })(); 

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

            function updateNavButtons() {
                // Left end
                prevBtn.disabled = container.scrollLeft <= 0;

                // Right end (small tolerance for floating point)
                nextBtn.disabled = container.scrollLeft + container.clientWidth >= container.scrollWidth - 1;
            }

            // Initial button state
            updateNavButtons();

            // Update buttons on scroll
            container.addEventListener('scroll', updateNavButtons);

            prevBtn.addEventListener('click', () => {
                container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
                // Scroll ke thoda delay ke baad update
                setTimeout(updateNavButtons, 300);
            });

            nextBtn.addEventListener('click', () => {
                container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
                setTimeout(updateNavButtons, 300);
            });

            // Location Access for Get Solar Card
            const getSolarCard = document.getElementById('getSolarCard');
            if (getSolarCard) {
                getSolarCard.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    if ('geolocation' in navigator) {
                        console.log('Requesting location access...');
                        
                        navigator.geolocation.getCurrentPosition(
                            function(position) {
                                const latitude = position.coords.latitude;
                                const longitude = position.coords.longitude;
                                const accuracy = position.coords.accuracy;
                                
                                console.log('=== LOCATION DATA ===');
                                console.log('Latitude:', latitude);
                                console.log('Longitude:', longitude);
                                console.log('Accuracy:', accuracy + ' meters');
                                
                                // Get address using reverse geocoding (using geocode.xyz API to avoid CORS)
                                fetch(`https://geocode.xyz/${latitude},${longitude}?json=1`)
                                    .then(response => response.json())
                                    .then(data => {
                                        console.log('=== ADDRESS DATA ===');
                                        console.log('Full Address:', data.standard?.addresst || 'Not available');
                                        console.log('City:', data.standard?.city || data.standard?.town || 'Not available');
                                        console.log('State:', data.standard?.statename || 'Not available');
                                        console.log('Pincode:', data.standard?.postal?.code || 'Not available');
                                        console.log('Country:', data.standard?.countryname || 'Not available');
                                        
                                        // Show success message to user
                                        // alert(`Location detected!\nCity: ${data.standard?.city || data.standard?.town || 'Unknown'}\nPincode: ${data.standard?.postal?.code || 'Not available'}`);
                                    })
                                    .catch(error => {
                                        console.error('Error getting address:', error);
                                        // Fallback: Show coordinates only
                                        // alert(`Location detected!\nLatitude: ${latitude}\nLongitude: ${longitude}\nAccuracy: ${accuracy} meters`);
                                    });
                            },
                            function(error) {
                                // console.error('Location access denied:', error);
                                let errorMessage = 'Location access denied. ';
                                
                                switch(error.code) {
                                    case error.PERMISSION_DENIED:
                                        errorMessage += 'Please allow location access in your browser settings.';
                                        break;
                                    case error.POSITION_UNAVAILABLE:
                                        errorMessage += 'Location information is unavailable.';
                                        break;
                                    case error.TIMEOUT:
                                        errorMessage += 'Location request timed out.';
                                        break;
                                }
                                
                                // alert(errorMessage);
                            },
                            {
                                enableHighAccuracy: true,
                                timeout: 10000,
                                maximumAge: 0
                            }
                        );
                    } else {
                        console.error('Geolocation is not supported by this browser.');
                        alert('Location access is not supported by your browser.');
                    }
                });
            }
        });

    </script>

    <!-- Review Modal Component -->
    <button type="button" id="welcomeReviewModalTrigger" data-review-modal-trigger="welcomeReviewModal" style="display: none;"></button>
    
    <x-frontend.review-modal
        modalId="welcomeReviewModal"
        triggerSelector="#welcomeReviewModalTrigger"
        :states="$states ?? collect()"
        :categories="collect()"
        :companies="$allCompanies ?? collect()"
        :allow-company-selection="true"
    />

    @include('components.frontend.chatbot-widget')
</body>
</html>
