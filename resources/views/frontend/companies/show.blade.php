@php
    $updatedDate = optional($ratingSummary['updated_at'] ?? null)?->format('F j, Y');
    $breakdownChunks = collect($ratingBreakdown)->chunk(ceil(max(count($ratingBreakdown), 1) / 2));
    $totalReviews = $ratingSummary['total'] ?? 0;
    $location = is_object($company->state) ? $company->state->name : $company->state;

    $companyTitle = $company->name . ' Reviews & Profile | Solar Reviews India';
    $companyDescription = ($company->description ?: 'Compare verified reviews, ratings and expert analysis for ' . $company->name . '.') . ' Explore service type, years in business and rating breakdown.';
    $companyCanonical = route('companies.show', $company->slug);
    $aggregateRating = [
        '@type' => 'AggregateRating',
        'ratingValue' => number_format($ratingSummary['average'], 1),
        'reviewCount' => (int) $ratingSummary['total'],
    ];
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('components.frontend.meta-tags', [
        'title' => $companyTitle,
        'description' => $companyDescription,
        'canonical' => $companyCanonical,
        'type' => 'article',
        'image' => $logoUrl,
    ])

    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            'name' => $company->name,
            'url' => $companyCanonical,
            'image' => $logoUrl,
            'priceRange' => '₹₹₹',
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => $company->city,
                'addressRegion' => $company->state,
                'addressCountry' => 'IN',
            ],
            'aggregateRating' => $aggregateRating,
            'description' => $companyDescription,
        ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

   <style>
       body { font-family: 'Trustpilot Sans', 'Poppins', sans-serif; background:#f9fafb; color:#111; }
        .layout {
            max-width:1200px; margin:auto; padding:2rem 1rem;
            display:grid; grid-template-columns:minmax(0,1fr) 360px; gap:2rem;
        }
        .right { position:sticky; top:90px; height:fit-content; }
        .card {
            background:#fff; border:1px solid #e5e7eb;
            border-radius:16px; padding:1.5rem; margin-bottom:1.5rem;
        }
        .stars { color:#00b67a; letter-spacing:1px; }
        .bar { height:8px; background:#e5e7eb; border-radius:999px; overflow:hidden; }
        .bar span { display:block; height:100%; background:#00b67a; }
        
        @media(max-width:1024px){
            .layout{grid-template-columns:1fr;}
            .right{position:static; order:-1;}
        }
        
        .container-custom {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .trust-card{
            display:flex;
            justify-content:space-between;
            align-items:center;
            padding:20px;
            max-width:900px;
        }

        .left{
            display:flex;
            gap:16px;
            align-items:flex-start;
        }

        .logo{
            width:64px;
            height:64px;
            border-radius:12px;
            border:1px solid #e5e7eb;
            object-fit:contain;
        }

        .info h1{
            margin:4px 0;
            font-size:26px;
            font-weight:700;
        }

        .claimed{
            font-size:13px;
            color:#00b67a;
            font-weight:600;
        }

        @media(max-width: 768px) {
            .company-details-grid {
                grid-template-columns: 1fr !important;
                row-gap: 30px !important;
                margin-top: 2rem !important;
            }
            
            .review-card {
                min-width: unset !important;
                width: 100% !important;
                margin-right: 0 !important;
                margin-bottom: 1rem !important;
            }
            
            .reviews-scroll {
                display: block !important;
                overflow-x: hidden !important;
                overflow-y: auto !important;
                max-height: 450px !important;
                padding-right: 5px;
            }

            .reviews-nav {
                display: none !important;
            }
            
            .trust-card {
                flex-direction: column;
                align-items: flex-start !important;
                padding: 1rem !important;
            }
            
            .trust-card .left {
                flex-direction: column;
            }
            
            .trust-card .actions {
                width: 100%;
                flex-direction: column;
                margin-top: 1rem;
            }
            
            .trust-card .actions button {
                width: 100%;
            }   

            .container-custom {
                padding: 0 1rem;
            }

            /* Reorder Layout Items */
            main {
                display: contents; 
            }

            .trust-card {
                order: -2; 
            }

            .right {
                order: -1; 
            }
        }

        .rating{
            display:flex;
            align-items:center;
            gap:6px;
            margin-top:6px;
        }

        .reviews{
            font-size:14px;
            color:#111;
        }

        .stars{
            color:#00b67a;
            letter-spacing:1px;
            font-size:16px;
        }

        .score{
            font-size:14px;
            color:#6b7280;
        }

        .actions{
            display:flex;
            gap:12px;
        }

        .btn{
            padding:10px 16px;
            border-radius:999px;
            font-size:14px;
            cursor:pointer;
        }

        .primary{
            background:#1d4ed8;
            color:white;
            border:none;
        }

        .outline{
            border:1px solid #1d4ed8;
            color:#1d4ed8;
            text-decoration:none;
            background:white;
        }

        .styles_card__0_wXo {
            display: flex;
            align-items: center;
            padding: 12px;
            background: #fcfbf3;
        
        }

        .CDS_Card_borderRadius-l__485220 {
            border-radius: 16px;
        }
        .CDS_Card_appearance-default__485220 {
            border: 1px solid #dcd6d1;
        }



        .review-summary-wrapper{
            max-width:720px;
        }

        .review-summary-title{
            font-size:22px;
            font-weight:700;
            display:flex;
            align-items:center;
            gap:6px;
        }

        .ai-badge{
            color:#7c3aed;
        }

        .review-summary-subtext{
            color:#6b7280;
            font-size:14px;
            margin-bottom:12px;
        }

        .review-summary-description{
            font-size:15px;
            line-height:1.6;
            color:#111827;
        }

        .review-summary-description .extra-text{
            display:none;
        }

        .review-summary-description.expanded .extra-text{
            display:inline;
        }

        .review-summary-link{
            background:none;
            border:none;
            padding:0;
            margin-top:6px;
            color:#2563eb;
            font-size:14px;
            cursor:pointer;
        }





        .company-details-grid {
        display: grid;
        grid-template-columns: max-content auto;
        column-gap: 55px;
        row-gap: 72px;
        max-width: 950px;
        margin: 40px auto;
        font-family: system-ui, -apple-system, BlinkMacSystemFont;
        }

        /* LEFT COLUMN */
        .left-title {
        font-size: 26px;
        font-weight: 700;
        margin: 0;
        white-space: nowrap;
        }

        /* RIGHT COLUMN */
        .right-content {
        max-width: 720px;
        }

        .category-row {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 10px;
        }

        .category-tag {
        border: 1px solid #c7c7ff;
        color: #4f46e5;
        font-size: 12px;
        padding: 4px 10px;
        border-radius: 6px;
        text-decoration: none;
        }

        .info-icon {
        font-size: 14px;
        color: #6c6c85;
        }

        .subheading {
        font-size: 14px;
        font-weight: 700;
        margin: 12px 0 6px;
        }

        .description {
        font-size: 15px;
        line-height: 1.6;
        color: #222;
        }

        .see-more {
        color: #4f46e5;
        text-decoration: none;
        font-weight: 600;
        }

        /* CONTACT LIST */
        .contact-list {
        list-style: none;
        padding: 0;
        margin: 0;
        }

        .contact-list li {
        font-size: 15px;
        margin-bottom: 14px;
        }

        .contact-list a {
        color: #111;
        text-decoration: underline;
        }

        /* Remove backdrop completely */
        .modal-backdrop {
            display: none !important;
        }

        /* Ensure modal is interactive */
        .modal {
            z-index: 1080 !important;
            pointer-events: auto !important;
        }

        /* Make sure modal content is clickable */
        .modal-content {
            pointer-events: auto;
        }

        /* Make sure form elements are clickable */
        .modal input,
        .modal select,
        .modal textarea,
        .modal button {
            pointer-events: auto !important;
        }

        .company-review-media-strip {
            display: flex;
            gap: 0.5rem;
            margin-top: 0.75rem;
            flex-wrap: wrap;
        }

        .company-review-media-thumb {
            border: 1px solid #e5e7eb;
            background: #fff;
            border-radius: 10px;
            padding: 0;
            width: 52px;
            height: 52px;
            overflow: hidden;
            cursor: pointer;
        }

        .company-review-media-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .company-review-media-more {
            font-size: 0.8rem;
            color: #6b7280;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
        }

        .company-review-lightbox {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.72);
            backdrop-filter: blur(3px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 2500;
            padding: 1.5rem;
        }

        .company-review-lightbox.is-visible {
            display: flex;
        }

        .company-review-lightbox-inner {
            position: relative;
            max-width: min(980px, 100%);
            max-height: min(80vh, 100%);
        }

        .company-review-lightbox-inner img {
            max-width: 100%;
            max-height: 80vh;
            border-radius: 14px;
            display: block;
            background: #fff;
        }

        .company-review-lightbox-close {
            position: absolute;
            top: -12px;
            right: -12px;
            width: 38px;
            height: 38px;
            border-radius: 999px;
            border: none;
            background: #ffffff;
            color: #111827;
            font-size: 22px;
            line-height: 1;
            cursor: pointer;
            box-shadow: 0 12px 25px rgba(15, 23, 42, 0.25);
        }
        
        
        
        
        /* MAIN WRAPPER */
        #all-reviews-wrapper {
            display: flex;
            gap: 40px;
            max-width: 1300px;
            margin: 40px auto;
        }

        /* LEFT PANEL */
        #all-reviews-left {
            width: 300px;
            position: sticky;
            top: 100px; /* navbar ke hisaab se adjust */
            align-self: flex-start;
        }

        /* RATING SUMMARY */
        #rating-score {
            font-size: 32px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        #rating-star {
            color: #00b67a;
        }

        #total-reviews span {
            font-size: 14px;
            color: #666;
        }

        #rating-bars {
            margin-top: 20px;
        }

        .rating-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
            padding: 6px 8px;
            border-radius: 8px;
        }

        .rating-row.active {
            background: #f3f4f6;
            outline: 1px solid #e5e7eb;
        }

        .rating-row .rating-select {
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .rating-row label {
            width: 50px;
            font-size: 14px;
        }

        .rating-bar {
            flex: 1;
            height: 8px;
            background: #eee;
            border-radius: 4px;
            overflow: hidden;
        }

        .rating-bar span {
            display: block;
            height: 100%;
            background: #111;
        }

        .rating-percent {
            width: 40px;
            font-size: 13px;
            color: #555;
        }

        /* RIGHT PANEL */
        #all-reviews-right {
            flex: 1;
            max-height: calc(100vh - 120px);
            overflow-y: auto;
            padding-right: 10px;
        }

        /* SEARCH + FILTER BAR */
        #reviews-top-bar {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
        }

        #review-search {
            flex: 1;
            padding: 10px 14px;
            border-radius: 20px;
            border: 1px solid #ddd;
        }

        .filter-btn {
            padding: 8px 14px;
            border-radius: 20px;
            border: 1px solid #ddd;
            background: #fff;
            cursor: pointer;
        }

        /* REVIEW CARD */
        .single-review {
            border-bottom: 1px solid #eee;
            padding: 20px 0;
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
        }

        .review-stars {
            color: #00b67a;
            margin: 6px 0;
        }

        .verified {
            font-size: 12px;
            color: #00b67a;
            margin-left: 8px;
        }

        .review-title {
            font-size: 16px;
            margin: 6px 0;
        }

        .review-text {
            font-size: 14px;
            color: #444;
        }
    </style>
</head>
<body>
    <div class="company-page">
        @include('components.frontend.navbar')
        <div class="container-custom">
        <div class="layout">
        <!-- ================= LEFT ================= -->
            <main>


                <section class="trust-card">
                    <div class="left">
                        <img src="{{ $logoUrl }}" class="logo">

                        <div class="info">
                            <span class="claimed">✔ Claimed profile</span>

                            <h1>{{ $company->owner_name }}</h1>
                            
                                        <div class="rating mb-2">
                                            <span class="reviews">
                                                Reviews {{ number_format($ratingSummary['total']) }}
                                            </span>
                            
                                            <span class="stars">
                                                <img src="{{ asset('images/company/stars-5.svg') }}" alt="Rating" style="height:20px;">
                                            </span>
                            
                                            <span class="score">
                                                {{ number_format($ratingSummary['average'],1) }} <i class="fas fa-info-circle" title="Average rating from {{ $ratingSummary['total'] }} reviews"></i>
                                            </span>
                                        </div>

                            @if($company->categories->isNotEmpty())
                                <div class="d-flex flex-wrap gap-2 mt-2">
                                    @foreach($company->categories as $category)
                                        <a href="{{ route('companies.category', $category->slug) }}" class="category-tag">
                                            {{ $category->name }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                            @if(!auth()->check() )
                            <div class="actions d-flex gap-2">
                                <!-- Write a Review Button -->
                                <button type="button" 
                                        class="nav-link fw-medium nav-btn-primary text-white open-review-modal" 
                                        style="background: #29983d; border: none; color:#fff !important;" 
                                        data-company-id="{{ $company->id }}"
                                        data-company-name="{{ $company->name }}">
                                    <i class="fas fa-pen"></i> Write a Review
                                </button>
                                <!-- Get Quote Button -->
                                <button type="button" 
                                class="nav-link fw-medium nav-btn-primary bg-white text-dark btn-get-quote" 
                                style="border: 1px solid #1d4ed8;"
                                data-company-id="{{ $company->id }}"
                                data-company-name="{{ $company->name }}">
                                Get Quote
                            </button>
                        </div>
                        @endif                
                            
                            <!-- Include Review Modal Component -->
                            @component('components.frontend.review-modal', [
                                'company' => $company,
                                'states' => \App\Models\State::where('is_active', true)->get(),
                                'categories' => \App\Models\Category::where('is_active', true)->get(),
                                'modalId' => 'reviewModal'
                            ])@endcomponent

                            @include('components.frontend.get-quote-modal', [
                                'states' => \App\Models\State::where('is_active', true)->orderBy('name')->get(),
                                'defaultStateId' => $company->state_id ?? null,
                                'defaultStateName' => is_object($company->state) ? $company->state->name : $company->state,
                            ])
                        </div>
                    </div>

                </section>


                <hr style="margin: 2rem 0; ">



                <div class="CDS_Card_card__485220 CDS_Card_appearance-default__485220 CDS_Card_borderRadius-l__485220 styles_card__0_wXo" 
                ><span class="styles_trustShieldLogo__WGwe_">
                    <img alt="" src="https://businessunitprofile-cdn.trustpilot.net/businessunitprofile-consumersite/public/trustpilot-shield.svg" width="25" height="30" class="styles_trustShieldImg__z4P_B"><span class="styles_animation__QNRFp"></span></span><p class="CDS_Typography_appearance-default__dd9b51 CDS_Typography_prettyStyle__dd9b51 CDS_Typography_body-m__dd9b51" style="margin-left:10px;">Companies on Solar Reviews aren't allowed to offer incentives or pay to hide reviews.</p></div>



                    <section id="ai-review-summary-section" class="review-summary-wrapper">

                        <h2 id="review-summary-heading" class="review-summary-title mt-4">
                            Review summary <span class="ai-badge">✨</span>
                        </h2>

                        <p id="review-summary-subtitle" class="review-summary-subtext">
                            Based on reviews, created with AI
                        </p>

                        <p id="review-summary-content" class="review-summary-description collapsed">
                            Reviewers overwhelmingly had a great experience with this company.
                            Customers consistently praise the quality of the products, noting they
                            are well-made and meet expectations. Consumers also appreciate the
                            efficient and timely delivery service.

                            <span class="extra-text">
                                People highlight the positive attitude and helpfulness of the staff,
                                especially the delivery drivers. Reviewers often mention specific
                                employees by name and appreciate the overall professionalism.
                            </span>
                        </p>

                        <button
                            id="review-summary-toggle"
                            class="review-summary-link"
                            onclick="toggleReviewSummary()"
                        >
                            See more
                        </button>

                    </section>

                    <!-- Reviews Section -->
                    <section class="" style="margin-top: 2rem;">
                        <div class="reviews-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                            <h3 style="margin: 0;">Based on these reviews  <i class="fas fa-info-circle"></i> </h3>
                            <div class="reviews-nav" style="display: flex; gap: 0.5rem;">
                                <button class="nav-btn prev" aria-label="Previous" style="background: #f3f4f6; border: none; border-radius: 6px; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; cursor: pointer;">‹</button>
                                <button class="nav-btn next" aria-label="Next" style="background: #f3f4f6; border: none; border-radius: 6px; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; cursor: pointer;">›</button>
                            </div>
                        </div>
                        <div class="reviews-scroll" style="display: flex; overflow-x: auto; gap: 1rem; padding-bottom: 1rem; scrollbar-width: none; -ms-overflow-style: none; scroll-behavior: smooth;">
                            @forelse($reviews as $review)
                                <div class="review-card" style="min-width: 300px; flex: 0 0 auto; background: #fff; border: 1px solid #e5e7eb; border-radius: 12px; padding: 1.5rem; margin-right: 1rem;">
                                    <div class="review-top" style="display: flex; gap: 1rem; align-items: center; margin-bottom: 1rem;">
                                        <div class="avatar" style="width: 40px; height: 40px; border-radius: 50%; background: #f3f4f6; display: flex; align-items: center; justify-content: center; font-weight: 600; color: #4b5563;">
                                            {{ $review['avatar'] }}
                                        </div>
                                        <div>
                                            <strong style="display: block; margin-bottom: 0.25rem;">{{ $review['reviewer'] }}</strong>
                                            <div class="stars" style="color: #f59e0b; letter-spacing: 2px;">
                                                @for($i = 1; $i <= 5; $i++)
                                                    {{ $i <= $review['rating'] ? '★' : '☆' }}
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <p class="review-text" style="color: #4b5563; margin-bottom: 1rem; line-height: 1.5; font-size: 0.95rem;">
                                        {{ $review['text'] }}
                                    </p>

                                    @php
                                        $reviewMedia = collect($review['media_paths'] ?? [])->filter()->values();
                                        if ($reviewMedia->isEmpty() && !empty($review['primary_media_path'])) {
                                            $reviewMedia = collect([$review['primary_media_path']]);
                                        }
                                    @endphp
                                    @if($reviewMedia->isNotEmpty())
                                        <div class="company-review-media-strip">
                                            @foreach($reviewMedia->take(3) as $media)
                                                @php
                                                    $mediaUrl = preg_replace('~(?<!:)/{2,}~', '/', $media);
                                                @endphp
                                                <button type="button" class="company-review-media-thumb" data-company-review-image="{{ $mediaUrl }}">
                                                    <img src="{{ $mediaUrl }}" alt="Review image">
                                                </button>
                                            @endforeach
                                            @if($reviewMedia->count() > 3)
                                                <span class="company-review-media-more">+{{ $reviewMedia->count() - 3 }}</span>
                                            @endif
                                        </div>
                                    @endif
                                    <div class="review-footer" style="font-size: 0.85rem; color: #6b7280; display: flex; justify-content: space-between; align-items: center;">
                                        <span>{{ $review['date'] }}</span>
                                    </div>
                                </div>
                            @empty
                                <div class="no-reviews" style="width: 100%; text-align: center; padding: 2rem; color: #6b7280;">
                                    <p>No reviews yet. Be the first to review this company!</p>
                                    <a href="{{ route('reviews.write') }}"
                                    style="display: inline-block; margin-top: 1rem; padding: 0.5rem 1rem; background: #00b67a; color: white; text-decoration: none; border-radius: 6px; font-weight: 500;">
                                        Write a Review
                                    </a>
                                </div>
                            @endforelse
                        </div>
                    </section>


                <section class="company-details-grid">

                <!-- ROW 1 -->
                <h2 class="left-title">Company details</h2>

                <div class="right-content">
                    @if($company->categories->isNotEmpty())
                    <div class="category-row">
                    @foreach($company->categories as $category)
                        <a href="{{ route('companies.category', $category->slug) }}" class="category-tag">
                        {{ $category->name }}
                        </a>
                    @endforeach
                    <span class="info-icon" title="Company categories">ⓘ</span>
                    </div>
                    @endif

                    @if($company->description)
                    <h4 class="subheading">About {{ $company->name }}</h4>
                    <p class="description">
                    {{ Str::limit($company->description, 400) }}
                    @if(strlen($company->description) > 400)
                        <a href="#" class="see-more" onclick="toggleFullDescription(event, this)">See more</a>
                        <span class="full-description" style="display: none;">{{ $company->description }}</span>
                    @endif
                    </p>
                    @endif

                    @if($company->years_in_business)
                    <div class="mt-3">
                    <h4 class="subheading">Years in Business</h4>
                    <p>{{ $company->years_in_business }}+ years of experience</p>
                    </div>
                    @endif
                </div>

                <!-- ROW 2 -->
                <h2 class="left-title">Contact info</h2>

                <ul class="right-content contact-list">
                    @if($company->address || $company->city || $company->state || $company->pincode)
                    <li>📍 
                    @if($company->address){{ $company->address }}, @endif
                    @if($company->city){{ $company->city }}, @endif
                    @if(is_object($company->state)){{ $company->state->name }}, @elseif($company->state){{ $company->state }}, @endif
                    @if($company->pincode){{ $company->pincode }}@endif
                    @if($company->country), {{ $company->country }}@endif
                    </li>
                    @endif
                    
                    @if($company->phone)
                    <li>📞 <a href="tel:{{ $company->phone }}">{{ $company->phone }}</a></li>
                    @endif
                    
                    @if($company->email)
                    <li>✉️ <a href="mailto:{{ $company->email }}">{{ $company->email }}</a></li>
                    @endif
                    
                    @if($company->website)
                    <li>🌐 <a href="{{ $company->website }}" target="_blank" rel="noopener noreferrer">{{ parse_url($company->website, PHP_URL_HOST) }}</a></li>
                    @endif
                    
                    @if($company->gst_number)
                    <li>  <span>GST: {{ $company->gst_number }}</span></li>
                    @endif
                </ul>

                </section>




                
            </main>
            <!-- ================= RIGHT (STICKY) ================= -->
            <aside class="right">
                <section class="card">
                    <div style="text-align:center">
                        <div style="font-size:3rem;font-weight:700">
                            {{ number_format($ratingSummary['average'],1) }}
                        </div>
                        <p style="margin:0">
                            @php
                                $rating = $ratingSummary['average'] ?? 0;
                                $fullStars = floor($rating);
                                $hasHalfStar = ($rating - $fullStars) >= 0.5;
                                $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
                            @endphp
                            @for($i = 1; $i <= $fullStars; $i++)
                                <span style="color: #f59e0b;">★</span>
                            @endfor
                            @if($hasHalfStar)
                                <span style="color: #f59e0b;">★</span><span style="color: #d1d5db; margin-left: -0.6em;">★</span>
                            @endif
                            @for($i = 1; $i <= $emptyStars; $i++)
                                <span style="color: #d1d5db;">★</span>
                            @endfor
                        </p>
                        <small style="color:#6b7280">
                            {{ number_format($ratingSummary['total']) }} reviews
                        </small>
                    </div>
                
                    <div style="margin-top:1rem">
                        @foreach([5,4,3,2,1] as $star)
                            @php
                                $count = $ratingDistribution[$star] ?? 0;
                                $totalReviews = (int) ($ratingSummary['total'] ?? 0);
                                $percent = $totalReviews ? ($count / $totalReviews) * 100 : 0;
                            @endphp
                            <div style="display:grid;grid-template-columns:50px 1fr;gap:.5rem;align-items:center;margin-bottom:.4rem">
                                <span>{{ $star }}★</span>
                                <div class="bar">
                                    <span style="width:{{ $percent }}%"></span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                
                    <p style="margin-top:1rem;font-size:.85rem;color:#6b7280">
                        Profile updated {{ $updatedDate ?? 'recently' }}
                    </p>
                </section>
            
            </aside>



    </div>




    <div id="all-reviews-wrapper">

    <!-- LEFT SIDE (STICKY) -->
    <div id="all-reviews-left">
        <div id="rating-summary">
            <div id="rating-score">
                <span id="rating-star">★</span>
                <span id="rating-value">4.8</span>
            </div>

            <p id="total-reviews">
                All reviews<br>
                <span>{{ number_format($ratingSummary['total'] ?? 0) }} total · <a href="{{ route('reviews.write') }}">Write a review</a></span>
            </p>

            <div id="rating-bars">
                @php
                    $allReviewsTotal = (int) ($ratingSummary['total'] ?? 0);
                @endphp

                <div class="rating-row" data-star="5" style="cursor:pointer;">
                    <input class="rating-select" type="checkbox" aria-label="Filter 5 star reviews" tabindex="-1" />
                    <label>5-star</label>
                    <div class="rating-bar">
                        @php
                            $count5 = (int) ($ratingDistribution[5] ?? 0);
                            $percent5 = $allReviewsTotal > 0 ? (($count5 / $allReviewsTotal) * 100) : 0;
                            $percent5Label = ($percent5 > 0 && $percent5 < 1) ? '<1' : (string) round($percent5);
                        @endphp
                        <span style="width:{{ $percent5 }}%"></span>
                    </div>
                    <span class="rating-percent">{{ $percent5Label }}%</span>
                    <span class="rating-count" style="width:48px;font-size:13px;color:#555">({{ $count5 }})</span>
                </div>

                <div class="rating-row" data-star="4" style="cursor:pointer;">
                    <input class="rating-select" type="checkbox" aria-label="Filter 4 star reviews" tabindex="-1" />
                    <label>4-star</label>
                    <div class="rating-bar">
                        @php
                            $count4 = (int) ($ratingDistribution[4] ?? 0);
                            $percent4 = $allReviewsTotal > 0 ? (($count4 / $allReviewsTotal) * 100) : 0;
                            $percent4Label = ($percent4 > 0 && $percent4 < 1) ? '<1' : (string) round($percent4);
                        @endphp
                        <span style="width:{{ $percent4 }}%"></span>
                    </div>
                    <span class="rating-percent">{{ $percent4Label }}%</span>
                    <span class="rating-count" style="width:48px;font-size:13px;color:#555">({{ $count4 }})</span>
                </div>

                <div class="rating-row" data-star="3" style="cursor:pointer;">
                    <input class="rating-select" type="checkbox" aria-label="Filter 3 star reviews" tabindex="-1" />
                    <label>3-star</label>
                    <div class="rating-bar">
                        @php
                            $count3 = (int) ($ratingDistribution[3] ?? 0);
                            $percent3 = $allReviewsTotal > 0 ? (($count3 / $allReviewsTotal) * 100) : 0;
                            $percent3Label = ($percent3 > 0 && $percent3 < 1) ? '<1' : (string) round($percent3);
                        @endphp
                        <span style="width:{{ $percent3 }}%"></span>
                    </div>
                    <span class="rating-percent">{{ $percent3Label }}%</span>
                    <span class="rating-count" style="width:48px;font-size:13px;color:#555">({{ $count3 }})</span>
                </div>

                <div class="rating-row" data-star="2" style="cursor:pointer;">
                    <input class="rating-select" type="checkbox" aria-label="Filter 2 star reviews" tabindex="-1" />
                    <label>2-star</label>
                    <div class="rating-bar">
                        @php
                            $count2 = (int) ($ratingDistribution[2] ?? 0);
                            $percent2 = $allReviewsTotal > 0 ? (($count2 / $allReviewsTotal) * 100) : 0;
                            $percent2Label = ($percent2 > 0 && $percent2 < 1) ? '<1' : (string) round($percent2);
                        @endphp
                        <span style="width:{{ $percent2 }}%"></span>
                    </div>
                    <span class="rating-percent">{{ $percent2Label }}%</span>
                    <span class="rating-count" style="width:48px;font-size:13px;color:#555">({{ $count2 }})</span>
                </div>

                <div class="rating-row" data-star="1" style="cursor:pointer;">
                    <input class="rating-select" type="checkbox" aria-label="Filter 1 star reviews" tabindex="-1" />
                    <label>1-star</label>
                    <div class="rating-bar">
                        @php
                            $count1 = (int) ($ratingDistribution[1] ?? 0);
                            $percent1 = $allReviewsTotal > 0 ? (($count1 / $allReviewsTotal) * 100) : 0;
                            $percent1Label = ($percent1 > 0 && $percent1 < 1) ? '<1' : (string) round($percent1);
                        @endphp
                        <span style="width:{{ $percent1 }}%"></span>
                    </div>
                    <span class="rating-percent">{{ $percent1Label }}%</span>
                    <span class="rating-count" style="width:48px;font-size:13px;color:#555">({{ $count1 }})</span>
                </div>
            </div>
        </div>
    </div>

    <!-- RIGHT SIDE (SCROLLABLE) -->
    <div id="all-reviews-right">

        <!-- SEARCH + FILTERS -->
        <div id="reviews-top-bar">
            <input
                type="text"
                id="review-search"
                placeholder="Search by keyword..."
            />

            <div id="review-filters">
                <select class="filter-btn" id="reviewDateFilter" style="appearance: auto;">
                    <option value="">All time</option>
                    <option value="30d">Last 30 days</option>
                    <option value="3m">Last 3 months</option>
                    <option value="6m">Last 6 months</option>
                </select>
                <button class="filter-btn" id="reviewMostRecentBtn" type="button">Most recent</button>
            </div>
        </div>

        <div id="active-star-summary" style="margin:10px 0;color:#555;font-size:14px"></div>

        <!-- REVIEWS LIST -->
        <div id="reviews-list">

            @forelse($reviews as $review)
                @php
                    $reviewRating = (int) ($review['rating'] ?? 0);
                    $reviewTitle = (string) ($review['title'] ?? '');
                    $reviewText = (string) ($review['text'] ?? '');
                    $reviewReviewer = (string) ($review['reviewer'] ?? '');
                    $reviewTimestamp = (int) ($review['created_at_timestamp'] ?? 0);
                    $reviewSearch = strtolower(trim(($reviewReviewer . ' ' . $reviewTitle . ' ' . $reviewText)));
                @endphp
                <div class="single-review"
                    data-rating="{{ $reviewRating }}"
                    data-ts="{{ $reviewTimestamp }}"
                    data-search="{{ $reviewSearch }}">
                    <div class="review-header">
                        <strong>{{ $review['reviewer'] ?? 'Anonymous' }}</strong>
                        <span class="review-time">{{ $review['created_at_human'] ?? ($review['date'] ?? '') }}</span>
                    </div>

                    <div class="review-stars">
                        @for($i = 1; $i <= 5; $i++)
                            {{ $i <= $reviewRating ? '★' : '☆' }}
                        @endfor
                        @if(!empty($review['is_featured']))
                            <span class="verified">Verified</span>
                        @endif
                    </div>

                    @if($reviewTitle)
                        <h4 class="review-title">{{ $reviewTitle }}</h4>
                    @endif
                    <p class="review-text">{{ $reviewText }}</p>
                </div>
            @empty
                <div class="single-review">
                    <div class="review-header">
                        <strong>No reviews yet</strong>
                    </div>
                    <p class="review-text">Be the first to review this company.</p>
                </div>
            @endforelse

            <div id="no-matching-reviews" class="single-review" style="display:none">
                <div class="review-header">
                    <strong>No matching reviews</strong>
                </div>
                <p class="review-text">Try removing filters or searching something else.</p>
            </div>

        </div>
    </div>
        </div>

            </div>
            </div>
                @include('components.frontend.footer')
                @include('components.frontend.chatbot-widget')

                <div id="companyReviewImageLightbox" class="company-review-lightbox" aria-hidden="true">
                    <div class="company-review-lightbox-inner">
                        <button type="button" class="company-review-lightbox-close" data-company-review-image-close>&times;</button>
                        <img src="" alt="Review image preview" data-company-review-image-preview>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const scrollContainer = document.querySelector('.reviews-scroll');
                        const prevBtn = document.querySelector('.reviews-nav .prev');
                        const nextBtn = document.querySelector('.reviews-nav .next');
                        
                        if (!scrollContainer || !prevBtn || !nextBtn) return;
                        
                        // Calculate scroll amount based on card width + gap (16px)
                        const card = scrollContainer.querySelector('.review-card');
                        const scrollAmount = card ? (card.offsetWidth + 16) : 320;
                        
                        // Simple scroll function
                        const scrollReviews = (direction) => {
                            const currentScroll = scrollContainer.scrollLeft;
                            scrollContainer.scrollTo({
                                left: currentScroll + (direction * scrollAmount),
                                behavior: 'smooth'
                            });
                        };
                        
                        // Button click handlers with debug logs
                        prevBtn.onclick = function(e) {
                            e.preventDefault();
                        
                            scrollReviews(-1);
                        };
                        
                        nextBtn.onclick = function(e) {
                            e.preventDefault();
                        
                            scrollReviews(1);
                        };
                        
                        // Update button states
                        const updateButtons = () => {
                            const maxScroll = scrollContainer.scrollWidth - scrollContainer.clientWidth;
                            
                            // Show/hide buttons based on scroll position
                            prevBtn.style.opacity = scrollContainer.scrollLeft > 10 ? '1' : '0.5';
                            nextBtn.style.opacity = scrollContainer.scrollLeft < maxScroll - 10 ? '1' : '0.5';
                            
                            // Disable buttons at boundaries
                            prevBtn.disabled = scrollContainer.scrollLeft <= 0;
                            nextBtn.disabled = scrollContainer.scrollLeft >= maxScroll - 1;
                            

                        };
                        
                        // Initial update
                        updateButtons();
                        
                        // Update on scroll and resize
                        scrollContainer.addEventListener('scroll', updateButtons);
                        window.addEventListener('resize', updateButtons);
                        
                        // Initial scroll position
                        scrollContainer.scrollLeft = 0;
                        
                        // Debug info
                    
                    });
                </script>


        <script>
        function toggleReviewSummary() {
            const content = document.getElementById('review-summary-content');
            const toggleBtn = document.getElementById('review-summary-toggle');

            content.classList.toggle('expanded');

            if (content.classList.contains('expanded')) {
                toggleBtn.innerText = 'See less';
            } else {
                toggleBtn.innerText = 'See more';
            }
        }

        function toggleFullDescription(event, element) {
            event.preventDefault();
            const description = element.parentElement;
            const fullText = description.querySelector('.full-description');
            
            if (fullText.style.display === 'none') {
                fullText.style.display = 'inline';
                element.textContent = ' See less';
            } else {
                fullText.style.display = 'none';
                element.textContent = ' See more';
            }
        }
        </script>

        <script>
            (function () {
                const lightbox = document.getElementById('companyReviewImageLightbox');
                const preview = lightbox ? lightbox.querySelector('[data-company-review-image-preview]') : null;
                const closeBtn = lightbox ? lightbox.querySelector('[data-company-review-image-close]') : null;

                const close = () => {
                    if (!lightbox) return;
                    lightbox.classList.remove('is-visible');
                    lightbox.setAttribute('aria-hidden', 'true');
                    if (preview) preview.removeAttribute('src');
                };

                const open = (src) => {
                    if (!lightbox || !preview || !src) return;
                    preview.setAttribute('src', src);
                    lightbox.classList.add('is-visible');
                    lightbox.setAttribute('aria-hidden', 'false');
                };

                document.addEventListener('click', (event) => {
                    const thumb = event.target.closest('[data-company-review-image]');
                    if (thumb) {
                        event.preventDefault();
                        open(thumb.getAttribute('data-company-review-image'));
                        return;
                    }

                    if (event.target === lightbox || event.target === closeBtn) {
                        event.preventDefault();
                        close();
                    }
                });

                document.addEventListener('keydown', (event) => {
                    if (event.key === 'Escape') {
                        close();
                    }
                });
            })();
        </script>

        <script>
            // Global helper to open review modal and set company id
            function showReviewModal(companyId, companyName) {
                const modalEl = document.getElementById('reviewModal');
                const companyIdInput = document.getElementById('modal_company_id');
                if (!companyIdInput) {
                    return;
                }

                // Set hidden input value if present
                const input = modalEl.querySelector('input[name="company_id"]');
                if (input) {
                    input.value = companyId;
                } else {
                    const alt = modalEl.querySelector('[data-company-id-input]');
                    if (alt) alt.value = companyId;
                }

                // Optionally set a display name inside modal
                const nameEl = modalEl.querySelector('.modal-company-name');
                if (nameEl) nameEl.textContent = companyName;

                // Show bootstrap modal
                try {
                    const modal = new bootstrap.Modal(modalEl);
                    modal.show();
                } catch (e) {
                    // Fallback: simple display toggle
                    modalEl.style.display = 'flex';
                    document.body.style.overflow = 'hidden';
                    document.body.style.position = 'fixed';
                }
            }

            // Handle Write a Review button click
            document.addEventListener('DOMContentLoaded', function() {
                const reviewButtons = document.querySelectorAll('.open-review-modal');
                
                reviewButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const companyId = this.getAttribute('data-company-id');
                        const companyName = this.getAttribute('data-company-name');
                        
                        // Use the global showReviewModal function to display the modal
                        if (typeof window.showReviewModal === 'function') {
                            window.showReviewModal(companyId, companyName);
                        } else {
                            console.error('showReviewModal function not found');
                        }
                    });
                });
            });
        </script>

        <script>
            (function () {
                function getAllReviewCards() {
                    return Array.from(document.querySelectorAll('#reviews-list .single-review'));
                }

                function getDateFilterCutoffSeconds() {
                    const select = document.getElementById('reviewDateFilter');
                    const value = (select?.value || '').toString();
                    if (!value) return null;

                    const nowMs = Date.now();
                    let cutoffMs = null;

                    if (value === '30d') {
                        cutoffMs = nowMs - (30 * 24 * 60 * 60 * 1000);
                    } else if (value === '3m') {
                        cutoffMs = nowMs - (90 * 24 * 60 * 60 * 1000);
                    } else if (value === '6m') {
                        cutoffMs = nowMs - (180 * 24 * 60 * 60 * 1000);
                    }

                    return cutoffMs ? Math.floor(cutoffMs / 1000) : null;
                }

                function getActiveStarFilter() {
                    const activeRow = document.querySelector('#rating-bars .rating-row[data-star].active');
                    if (!activeRow) return null;
                    const star = parseInt(activeRow.getAttribute('data-star') || '', 10);
                    return Number.isFinite(star) ? star : null;
                }

                function applyAllReviewsFilterAndSort() {
                    const input = document.getElementById('review-search');
                    const keyword = (input?.value || '').trim().toLowerCase();
                    const activeStar = getActiveStarFilter();
                    const cutoffSeconds = getDateFilterCutoffSeconds();

                    const cards = getAllReviewCards();
                    let visibleCount = 0;
                    cards.forEach(card => {
                        const text = (card.getAttribute('data-search') || '').toLowerCase();
                        const rating = parseInt(card.getAttribute('data-rating') || '0', 10);
                        const ts = parseInt(card.getAttribute('data-ts') || '0', 10);

                        const matchesKeyword = keyword === '' || text.includes(keyword);
                        const matchesStar = activeStar === null || rating === activeStar;
                        const matchesDate = cutoffSeconds === null || ts >= cutoffSeconds;

                        const isVisible = (matchesKeyword && matchesStar && matchesDate);
                        card.style.display = isVisible ? '' : 'none';
                        if (isVisible) {
                            visibleCount += 1;
                        }
                    });

                    const noMatching = document.getElementById('no-matching-reviews');
                    if (noMatching) {
                        noMatching.style.display = visibleCount > 0 ? 'none' : '';
                    }

                    const summary = document.getElementById('active-star-summary');
                    if (summary) {
                        if (activeStar === null) {
                            summary.textContent = '';
                        } else {
                            const activeRow = document.querySelector('#rating-bars .rating-row[data-star].active');
                            const percentEl = activeRow ? activeRow.querySelector('.rating-percent') : null;
                            const countEl = activeRow ? activeRow.querySelector('.rating-count') : null;
                            const percentText = percentEl ? percentEl.textContent.trim() : '';
                            const countText = countEl ? countEl.textContent.trim() : '';
                            summary.textContent = activeStar + '-star selected: ' + percentText + ' ' + countText;
                        }
                    }

                    const btn = document.getElementById('reviewMostRecentBtn');
                    if (btn?.dataset?.active === '1') {
                        applyMostRecentSort();
                    }
                }

                function applyMostRecentSort() {
                    const list = document.getElementById('reviews-list');
                    if (!list) return;

                    const cards = getAllReviewCards().filter(card => card.style.display !== 'none');
                    cards.sort((a, b) => {
                        const aTs = parseInt(a.getAttribute('data-ts') || '0', 10);
                        const bTs = parseInt(b.getAttribute('data-ts') || '0', 10);
                        return bTs - aTs;
                    });

                    cards.forEach(card => list.appendChild(card));
                }

                document.addEventListener('DOMContentLoaded', function () {
                    const searchInput = document.getElementById('review-search');
                    if (searchInput) {
                        searchInput.addEventListener('input', applyAllReviewsFilterAndSort);
                    }

                    const dateFilter = document.getElementById('reviewDateFilter');
                    if (dateFilter) {
                        dateFilter.addEventListener('change', applyAllReviewsFilterAndSort);
                    }

                    const mostRecentBtn = document.getElementById('reviewMostRecentBtn');
                    if (mostRecentBtn) {
                        if (!mostRecentBtn.dataset.active) {
                            mostRecentBtn.dataset.active = '1';
                        }
                        mostRecentBtn.addEventListener('click', function () {
                            mostRecentBtn.dataset.active = mostRecentBtn.dataset.active === '1' ? '0' : '1';
                            applyAllReviewsFilterAndSort();
                        });
                    }

                    const ratingRows = Array.from(document.querySelectorAll('#rating-bars .rating-row[data-star]'));
                    ratingRows.forEach(row => {
                        row.addEventListener('click', function () {
                            const alreadyActive = row.classList.contains('active');
                            ratingRows.forEach(r => r.classList.remove('active'));
                            if (!alreadyActive) row.classList.add('active');

                            ratingRows.forEach(r => {
                                const cb = r.querySelector('input.rating-select');
                                if (cb) cb.checked = r.classList.contains('active');
                            });

                            applyAllReviewsFilterAndSort();
                        });
                    });

                    const allReviewsLabel = document.getElementById('total-reviews');
                    if (allReviewsLabel) {
                        allReviewsLabel.style.cursor = 'pointer';
                        allReviewsLabel.addEventListener('click', function (event) {
                            const link = event.target.closest('a');
                            if (link) return;
                            ratingRows.forEach(r => r.classList.remove('active'));

                            ratingRows.forEach(r => {
                                const cb = r.querySelector('input.rating-select');
                                if (cb) cb.checked = false;
                            });

                            applyAllReviewsFilterAndSort();
                        });
                    }

                    applyAllReviewsFilterAndSort();
                });
            })();
        </script>

</body>
</html>

