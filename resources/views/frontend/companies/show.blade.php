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
       body { font-family: Inter, sans-serif; background:#f9fafb; color:#111; }
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

   </style>
</head>
<body>
    <div class="company-page">
        @include('components.frontend.navbar')
        <div class="container-custom">
        <div class="layout">
        <!-- ================= LEFT ================= -->
            <main>
                <!-- HEADER -->
                <section class="card">
                    <div style="display:flex; gap:1rem; align-items:flex-start;">
                        <img src="{{ $logoUrl }}" style="width:64px;height:64px;border-radius:12px;border:1px solid #e5e7eb;">
                        <div>
                            <!--<small style="color:#00b67a;font-weight:600;">✔ Claimed profile</small>-->
                            <h1 style="margin:0">{{ $company->owner_name }}</h1>
                            <p style="color:#6b7280;margin:.25rem 0">{{ $companyTypeLabel }} · {{ $location }}</p>
                            
                            <!--{{ dump($location) }}-->

                
                            <div style="display:flex;gap:.5rem;align-items:center">
                                <strong>{{ number_format($ratingSummary['average'],1) }}</strong>
                                <span class="stars">★★★★★</span>
                                <span style="color:#6b7280">
                                    {{ number_format($ratingSummary['total']) }} reviews
                                </span>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- AI SUMMARY -->
                <section class="card">
                    <h3>Review summary ✨</h3>
                    <p style="color:#6b7280;font-size:.9rem">
                        Based on {{ number_format($ratingSummary['total']) }} verified reviews
                    </p>
                    <p>
                        Customers generally report positive experiences with {{ $company->name }},
                        praising service quality, transparency, and overall professionalism.
                    </p>
                </section>
            
                <!-- BREAKDOWN PREVIEW -->
                <section class="card">
                    <h3>Expert rating breakdown</h3>
                
                    @foreach($ratingBreakdown as $metric)
                        <div style="margin-bottom:.75rem">
                            <div style="display:flex;justify-content:space-between;font-size:.9rem">
                                <span>{{ $metric['label'] }}</span>
                                <strong>{{ $metric['score'] }}%</strong>
                            </div>
                            <div class="bar">
                                <span style="width:{{ $metric['score'] }}%"></span>
                            </div>
                        </div>
                    @endforeach
                </section>
            
<!-- Reviews Section -->
<section class="card" style="margin-top: 2rem;">
    <div class="reviews-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h3 style="margin: 0;">Customer Reviews</h3>
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
</body>
</html>

