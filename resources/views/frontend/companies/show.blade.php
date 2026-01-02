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

        .category{
            color:#2563eb;
            font-size:14px;
            text-decoration:none;
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
            <div class="actions">
                <a class="nav-link fw-medium nav-btn-primary primary text-white"  style="color: white !important; background: #29983d;" href="{{ route('login') }}"> <i class="fas fa-pen"></i> Write a Review</a>
                <a class="nav-link fw-medium nav-btn-primary bg-white text-dark" style="border: 1px solid #1d4ed8;" href="{{ $company->website }}" target="_blank">Visit website <i class="fas fa-external-link-alt"></i></a>
            </div>
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
    <li>� <span>GST: {{ $company->gst_number }}</span></li>
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
    </div>
    </div>
        @include('components.frontend.footer')
        @include('components.frontend.chatbot-widget')

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

</body>
</html>

