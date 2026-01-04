<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My reviews | SolarReviews India</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --profile-bg: #f7f5f0;
            --card-border: #e4dfd6;
            --text-dark: #111827;
            --text-muted: #6b7280;
            --accent: #5325c7;
            --accent-light: #ede9fe;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--profile-bg);
            color: var(--text-dark);
        }

        .container-custom {
            max-width: 1120px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .profile-hero {
            padding: 3rem 0 3rem;
            background: #fff;
            border-bottom: 1px solid var(--card-border);
        }

        .profile-card {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .profile-avatar {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            overflow: hidden;
            background: #f1eee6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 600;
            color: var(--text-dark);
            border: 3px solid #f3ede2;
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-meta h1 {
            font-size: 1.75rem;
            margin-bottom: 0.15rem;
        }

        .profile-meta span {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .profile-stats {
            margin-left: auto;
            display: flex;
            gap: 3rem;
        }

        .profile-stat {
            text-align: center;
        }

        .profile-stat strong {
            display: block;
            font-size: 1.5rem;
        }

        .profile-stat a {
            font-size: 0.85rem;
            color: var(--accent);
            text-decoration: none;
        }

        .section-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .section-description {
            font-size: 0.9rem;
            color: var(--accent);
            margin-bottom: 1.5rem;
        }

        .review-card {
            background: #fff;
            border: 1px solid var(--card-border);
            border-radius: 18px;
            padding: 1.75rem;
            box-shadow: 0 20px 40px rgba(17, 24, 39, 0.05);
            margin-bottom: 1.5rem;
        }

        .review-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .review-company {
            font-weight: 600;
            font-size: 1rem;
            color: var(--accent);
        }

        .rating-stars {
            color: #00b67a;
            display: inline-flex;
            gap: 0.15rem;
            margin: 0.5rem 0;
        }

        .rating-stars i {
            font-size: 1rem;
        }

        .review-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0.15rem 0;
        }

        .review-text {
            font-size: 0.95rem;
            color: var(--text-dark);
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .review-meta-tags {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }

        .review-tag {
            background: #f1f5f9;
            color: #475569;
            font-size: 0.8rem;
            padding: 0.3rem 0.75rem;
            border-radius: 999px;
        }

        .review-actions {
            display: flex;
            gap: 1.5rem;
            font-size: 0.9rem;
        }

        .review-actions button,
        .review-actions a {
            background: none;
            border: none;
            padding: 0;
            color: #1f2937;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
        }

        .review-actions button:hover,
        .review-actions a:hover {
            color: var(--accent);
        }

        .draft-banner {
            font-size: 0.85rem;
            color: #92400e;
            background: #fef3c7;
            padding: 0.35rem 0.75rem;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            border: 1px dashed var(--card-border);
            border-radius: 16px;
            background: #fff;
            color: var(--text-muted);
        }

        .modal-backdrop-custom {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.55);
            backdrop-filter: blur(3px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1500;
        }

        .modal-backdrop-custom.is-visible {
            display: flex;
        }

        .edit-modal {
            background: #fff;
            width: min(520px, calc(100% - 2rem));
            border-radius: 24px;
            padding: 2rem;
            box-shadow: 0 30px 70px rgba(15, 23, 42, 0.18);
        }

        .edit-modal h3 {
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        .edit-modal .form-label {
            font-weight: 600;
            font-size: 0.9rem;
            color: #1f2937;
        }

        .edit-modal input,
        .edit-modal select,
        .edit-modal textarea {
            border-radius: 10px;
            border: 1px solid #d1d5db;
            padding: 0.65rem 0.75rem;
        }

        .edit-modal textarea {
            min-height: 140px;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
            margin-top: 1.5rem;
        }

        .btn-pill {
            border-radius: 999px;
            padding: 0.6rem 1.4rem;
            font-weight: 600;
            border: none;
        }

        .btn-neutral {
            background: #f3f4f6;
            color: #111827;
        }

        .btn-primary {
            background: var(--accent);
            color: #fff;
        }

        @media (max-width: 768px) {
            .profile-card {
                flex-direction: column;
                text-align: center;
            }

            .profile-stats {
                margin-left: 0;
                width: 100%;
                justify-content: center;
            }

            .profile-hero {
                padding: 7rem 0 2rem;
            }

            .review-card {
                padding: 1.25rem;
            }
        }


        .tp-review-card {
            width: 100%;
            background: #fff;
            border: 1px solid #e4dfd6;
            border-radius: 18px;
            padding: 1.5rem;
            max-width: 520px;
        }

        .tp-review-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .tp-user {
            display: flex;
            gap: 0.75rem;
        }

        .tp-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            background: #eee;
        }

        .tp-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .tp-name {
            font-weight: 600;
            font-size: 0.95rem;
        }

        .tp-meta {
            font-size: 0.8rem;
            color: #6b7280;
        }

        .tp-date {
            font-size: 0.8rem;
            color: #6b7280;
        }

        .tp-stars {
            color: #00b67a;
            margin: 0.75rem 0;
        }

        .tp-stars i {
            font-size: 0.95rem;
        }

        .tp-title {
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 0.25rem;
        }

        .tp-text {
            font-size: 0.9rem;
            color: #374151;
            line-height: 1.5;
        }

        .tp-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 1.25rem;
        }

        .tp-action {
            background: none;
            border: none;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            display: inline-flex;
            gap: 0.35rem;
            align-items: center;
        }

        .tp-action.delete {
            color: #6b7280;
        }

        .tp-action.finish {
            color: #2563eb;
        }


      .tp-review-center {
            display: flex;
            flex-direction: column;
            align-items: center;
        }





        .company-info {
            margin-top: 1rem;
            padding: 1rem;
            border-top: 1px solid #e4dfd6;
            background-color: #f7f5f0;
        }

        .company-name {
            font-weight: 600;
            font-size: 1rem;
        }

        .company-website {
            font-size: 0.9rem;
            color: #6b7280;
        }

        .company-website a {
            color: #5325c7;
            text-decoration: none;
        }

        .company-website a:hover {
            text-decoration: underline;
        }










        .review-card,
        .tp-review-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .review-card:hover,
        .tp-review-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 25px 55px rgba(17, 24, 39, 0.08);
        }

        .review-media-strip {
            display: flex;
            gap: 0.5rem;
            margin-top: 0.85rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .review-media-thumb {
            border: 1px solid #e5e7eb;
            background: #fff;
            border-radius: 10px;
            padding: 0;
            width: 64px;
            height: 64px;
            overflow: hidden;
            cursor: pointer;
        }

        .review-media-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .review-media-more {
            font-size: 0.85rem;
            color: #6b7280;
            font-weight: 600;
        }

        .review-image-lightbox {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.72);
            backdrop-filter: blur(3px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 2000;
            padding: 1.5rem;
        }

        .review-image-lightbox.is-visible {
            display: flex;
        }

        .review-image-lightbox-inner {
            position: relative;
            max-width: min(980px, 100%);
            max-height: min(80vh, 100%);
        }

        .review-image-lightbox-inner img {
            max-width: 100%;
            max-height: 80vh;
            border-radius: 14px;
            display: block;
            background: #fff;
        }

        .review-image-lightbox-close {
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






        .company-info {
            margin-top: 1.25rem;
            padding: 0.9rem 1rem;
            border-radius: 12px;
            background: #f9fafb;
            border: 1px dashed #e5e7eb;
        }

        .company-name {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.95rem;
        }

        .company-name a {
            color: #5325c7;
            font-weight: 600;
            text-decoration: none;
        }

        .company-name a:hover {
            text-decoration: underline;
        }

        .company-website {
            margin-top: 0.35rem;
            font-size: 0.8rem;
        }



        .badge.bg-warning {
            background: #fef3c7 !important;
            color: #92400e !important;
            font-size: 0.7rem;
            font-weight: 600;
            border-radius: 999px;
            padding: 0.25rem 0.55rem;
        }



        .review-company {
            line-height: 1.4;
        }

        .review-company a {
            color: var(--accent);
            font-weight: 600;
        }

        .review-company a:hover {
            text-decoration: underline;
        }
        .rating-stars,
        .tp-stars {
            letter-spacing: 0.05rem;
        }


        .review-actions button,
        .review-actions a,
        .tp-action {
            padding: 0.25rem 0.4rem;
            border-radius: 6px;
        }

        .review-actions button:hover,
        .review-actions a:hover,
        .tp-action:hover {
            background: #f3f4f6;
        }



        #drafts .tp-review-card {
            border-style: dashed;
            background: linear-gradient(180deg, #ffffff 0%, #f9fafb 100%);
        }


        .section-title {
            letter-spacing: -0.01em;
        }

        .section-description {
            font-weight: 500;
        }


    </style>
</head>
<body>
@include('components.frontend.navbar')

<section class="profile-hero">
    <div class="container-custom">
        <div class="profile-card">
            <div class="profile-avatar">
                @if($normalUser->avatar_url)
                    <img src="{{ $normalUser->avatar_url }}" alt="{{ $normalUser->name ?? 'User' }}">
                @else
                    <span>{{ $avatarInitial }}</span>
                @endif
            </div>
            <div class="profile-meta">
                <h1>{{ $normalUser->name ?? 'Google reviewer' }}</h1>
                <span>{{ $location }}</span>
            </div>
            <div class="profile-stats">
                <div class="profile-stat">
                    <strong>{{ $stats['reviews'] }}</strong>
                    <a href="#published">Reviews</a>
                </div>
                <div class="profile-stat">
                    <strong>{{ $stats['read'] }}</strong>
                    <a href="javascript:void(0)">Read</a>
                </div>
                <div class="profile-stat">
                    <strong>{{ $stats['useful'] }}</strong>
                    <a href="javascript:void(0)">Useful</a>
                </div>
            </div>
        </div>
    </div>
</section>

<main class="py-5">
    <div class="container-custom">
        <section class="mb-5" id="drafts">
            <div class="tp-review-center">
    <div class="section-title">Review drafts</div>
    <div class="section-description">Finish pending reviews before they expire.</div>
            @forelse($draftReviews as $draft)

            @php
            
                $companyName = $draft->company_id ? $draft->company->owner_name : $draft->manual_company_name;
                $companyUrl = $draft->company_id ? $draft->company->website_url : $draft->company_url;
                $companySlug = $draft->company?->slug;
                $companyLink = $companySlug ? route('companies.show', $companySlug) : $companyUrl;



                $draftPayload = [
                    'id' => $draft->id,
                    'company_id' => $draft->company_id,
                    'company_name' => $draft->company->owner_name ?? 'Company',
                    'state_id' => $draft->state_id,
                    'category_id' => $draft->category_id,
                    'rating' => $draft->rating,
                    'review_title' => $draft->review_title,
                    'review_text' => $draft->review_text,
                    'experience_metrics' => $draft->experience_metrics ?? [],
                    'reviewer_state_id' => $draft->reviewer_state_id,
                    'reviewer_city' => $draft->reviewer_city,
                    'system_size_kw' => $draft->system_size_kw,
                    'system_price' => $draft->system_price,
                    'year_installed' => $draft->year_installed,
                    'panel_brand' => $draft->panel_brand,
                    'inverter_brand' => $draft->inverter_brand,
                    'media_terms_accepted' => $draft->media_terms_accepted,
                    'update_url' => route('normal-user.reviews.update', $draft),
                ];
            @endphp
<article class="tp-review-card">
    <div class="tp-review-header">
        <div class="tp-user">
            <div class="tp-avatar">
                <img src="{{ $normalUser->avatar_url ?? 'https://ui-avatars.com/api/?name='.$normalUser->name }}" alt="">
            </div>
            <div>
                <div class="tp-name">{{ $normalUser->name }}</div>
                <div class="tp-meta">
                    {{ $stats['reviews'] }} reviews · {{ $location }}
                </div>
            </div>
        </div>
        <div class="tp-date">
            {{ optional($draft->created_at)->format('F d, Y') }}
        </div>
    </div>


    <div class="tp-stars">
        @for($i = 1; $i <= 5; $i++)
            <i class="fa{{ $i <= $draft->rating ? 's' : 'r' }} fa-star"></i>
        @endfor
    </div>

    <div class="tp-title">
        {{ $draft->review_title ?? 'Untitled review' }}
    </div>

    <div class="tp-text">
        {{ Str::limit(strip_tags($draft->review_text), 180) }}
    </div>

    @php
        $draftMedia = collect($draft->media_paths ?? [])->filter()->values();
        if ($draftMedia->isEmpty() && !empty($draft->primary_media_path)) {
            $draftMedia = collect([$draft->primary_media_path]);
        }
    @endphp
    @if($draftMedia->isNotEmpty())
        <div class="review-media-strip" data-review-media-strip>
            @foreach($draftMedia->take(4) as $media)
                @php
                    $mediaUrl = preg_replace('~(?<!:)/{2,}~', '/', $media);
                @endphp
                <button type="button" class="review-media-thumb" data-review-image="{{ $mediaUrl }}">
                    <img src="{{ $mediaUrl }}" alt="Review image">
                </button>
            @endforeach
            @if($draftMedia->count() > 4)
                <span class="review-media-more">+{{ $draftMedia->count() - 4 }}</span>
            @endif
        </div>
    @endif
    
    
    
    
    <!-- Company and URL Section -->
    @if($draft->company_id && $draft->company)
        <!-- Show company details from companies table -->
        <div class="company-info">
            <div class="company-name">
                <strong>{{ $draft->company->owner_name }}</strong>
            </div>
            @if($draft->company->website_url)
                <div class="company-website text-muted small mt-1">
                    <i class="fas fa-globe me-1"></i>
                    <a href="{{ route('companies.show', $draft->company->slug) }}" class="text-decoration-none">
                        <strong>{{ $draft->company->owner_name }}</strong>
                    </a>
                </div>
            @endif
        </div>
    @elseif($draft->manual_company_name)
        <!-- Show manual company details -->
        <div class="company-info">
            <div class="company-name">
                <strong>{{ $draft->manual_company_name }}</strong>
                <span class="badge bg-warning text-dark ms-2">Pending</span>
            </div>
            @if($draft->company_url)
                <div class="company-website text-muted small mt-1">
                    <i class="fas fa-globe me-1"></i>
                    @if(filter_var($draft->company_url, FILTER_VALIDATE_URL))
                        <a target="_blank" rel="noopener">
                            {{ parse_url($draft->company_url, PHP_URL_HOST) }}
                        </a>
                    @else
                        {{ $draft->company_url }}
                    @endif
                </div>
            @endif
        </div>
    @endif

    <div class="tp-actions">
        <form method="POST" action="{{ route('normal-user.reviews.destroy', $draft) }}">
            @csrf
            @method('DELETE')
            <!--<button type="submit" class="tp-action delete">-->
            <!--    <i class="far fa-trash-alt"></i> Delete-->
            <!--</button>-->
        </form>

        <button class="tp-action finish" data-profile-edit='@json($draftPayload, JSON_HEX_APOS | JSON_HEX_QUOT)'>
            <i class="far fa-edit"></i> Edit
        </button>
    </div>
</article>

            @empty
                <div class="empty-state">
                    <p>No drafts right now. Start a new review from the <a href="{{ route('reviews.write') }}">write review</a> page.</p>
                </div>
            @endforelse

            </div>
        </section>

        <section id="published">
            <div class="section-title">Reviews</div>
            <div class="section-description">Published reviews visible to the community.</div>

            @forelse($publishedReviews as $review)
                @php
                    $companyName = $review->company_id ? $review->company->owner_name : $review->manual_company_name;
                    $companyUrl = $review->company_id ? $review->company->website_url : $review->company_url;
                    $companySlug = $review->company?->slug;
                    $companyLink = $companySlug ? route('companies.show', $companySlug) : $companyUrl;
                @endphp

                <article class="review-card">
                    <div class="review-card-header">
                        <div>
                            <div class="review-company">
                                Review of
                                @if($companyLink)
                                    <a href="{{ $companyLink }}" {{ $companySlug ? '' : 'target=_blank rel=noopener' }}>
                                        {{ $companyName }}
                                    </a>
                                @else
                                    {{ $companyName }}
                                @endif
                                @if(!$review->company_id)
                                    <span class="review-tag ms-2">Pending listing</span>
                                @endif
                                @if($companyUrl)
                                    <div class="company-website text-muted small mt-1">
                                        <i class="fas fa-globe me-1"></i>
                                        @if(strpos($companyUrl, 'http') !== 0)
                                            {{ $companyUrl }}
                                        @else
                                            <a href="{{ $companyLink }}" target="_blank" rel="noopener">
                                                {{ parse_url($companyUrl, PHP_URL_HOST) }}
                                            </a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                            <small class="text-muted">{{ optional($review->review_date ?? $review->created_at)->diffForHumans() }}</small>
                        </div>
                        <div class="text-muted small">{{ optional($review->review_date ?? $review->created_at)->format('F d, Y') }}</div>
                    </div>

                    <div class="rating-stars" aria-label="Rating {{ $review->rating }}/5">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fa{{ $i <= $review->rating ? 's' : 'r' }} fa-star"></i>
                        @endfor
                    </div>

                    <div class="review-title">{{ $review->review_title ?? 'Review' }}</div>
                    <p class="review-text">{{ Str::limit(strip_tags($review->review_text), 420) }}</p>

                    @php
                        $publishedMedia = collect($review->media_paths ?? [])->filter()->values();
                        if ($publishedMedia->isEmpty() && !empty($review->primary_media_path)) {
                            $publishedMedia = collect([$review->primary_media_path]);
                        }
                    @endphp
                    @if($publishedMedia->isNotEmpty())
                        <div class="review-media-strip" data-review-media-strip>
                            @foreach($publishedMedia->take(4) as $media)
                                @php
                                    $mediaUrl = preg_replace('~(?<!:)/{2,}~', '/', $media);
                                @endphp
                                <button type="button" class="review-media-thumb" data-review-image="{{ $mediaUrl }}">
                                    <img src="{{ $mediaUrl }}" alt="Review image">
                                </button>
                            @endforeach
                            @if($publishedMedia->count() > 4)
                                <span class="review-media-more">+{{ $publishedMedia->count() - 4 }}</span>
                            @endif
                        </div>
                    @endif

                    <div class="review-meta-tags">
                        <span class="review-tag">{{ optional($review->review_date ?? $review->created_at)->format('F j, Y') }}</span>
                        <span class="review-tag">{{ $review->source ? Str::title($review->source) : 'Unprompted review' }}</span>
                        @if($review->state?->name)
                            <span class="review-tag">{{ $review->state->name }}</span>
                        @endif
                    </div>

                    @php
                        $reviewPayload = [
                            'id' => $review->id,
                            'company_id' => $review->company_id ?? 0,
                            'manual_company_name' => $review->manual_company_name,
                            'company_url' => $review->company_url,
                            'state_id' => $review->state_id,
                            'category_id' => $review->category_id,
                            'rating' => $review->rating,
                            'review_title' => $review->review_title,
                            'review_text' => $review->review_text,
                            'experience_metrics' => $review->experience_metrics ?? [],
                            'reviewer_state_id' => $review->reviewer_state_id,
                            'reviewer_city' => $review->reviewer_city,
                            'system_size_kw' => $review->system_size_kw,
                            'system_price' => $review->system_price,
                            'year_installed' => $review->year_installed,
                            'panel_brand' => $review->panel_brand,
                            'inverter_brand' => $review->inverter_brand,
                            'media_terms_accepted' => $review->media_terms_accepted,
                            'update_url' => route('normal-user.reviews.update', $review),
                        ];
                    @endphp
                    <div class="review-actions">
                        <button type="button"
                            data-profile-edit='@json($reviewPayload, JSON_HEX_APOS | JSON_HEX_QUOT)'>
                            <i class="far fa-edit"></i> Edit
                        </button>
                        <!--<form method="POST" action="{{ route('normal-user.reviews.destroy', $review) }}" onsubmit="return confirm('Delete this review?')">-->
                        <!--    @csrf-->
                        <!--    @method('DELETE')-->
                        <!--    <button type="submit"><i class="far fa-trash-alt"></i> Delete</button>-->
                        <!--</form>-->
                        <a href="{{ route('companies.show', $review->company?->slug ?? '#') }}" target="_blank"><i class="far fa-share-square"></i> Share</a>
                    </div>
                </article>
            @empty
                <div class="empty-state">
                    <p>No published reviews yet. Start sharing your experience today.</p>
                    <a class="btn btn-primary mt-3" href="{{ route('reviews.write') }}">Write a review</a>
                </div>
            @endforelse
        </section>
    </div>
</main>

@include('components.frontend.chatbot-widget')
@include('components.frontend.footer')

<div id="reviewImageLightbox" class="review-image-lightbox" aria-hidden="true">
    <div class="review-image-lightbox-inner">
        <button type="button" class="review-image-lightbox-close" data-review-image-close>&times;</button>
        <img src="" alt="Review image preview" data-review-image-preview>
    </div>
</div>

<button type="button" id="profileReviewModalTrigger" data-review-modal-trigger="profileReviewModal" style="display: none;"></button>

<x-frontend.review-modal
    modalId="profileReviewModal"
    triggerSelector="#profileReviewModalTrigger"
    :states="$states"
    :categories="collect()"
    :companies="collect()"
    :allow-company-selection="false"
/>

<script>
    (function () {
        const lightbox = document.getElementById('reviewImageLightbox');
        const preview = lightbox ? lightbox.querySelector('[data-review-image-preview]') : null;
        const closeBtn = lightbox ? lightbox.querySelector('[data-review-image-close]') : null;

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
            const thumb = event.target.closest('[data-review-image]');
            if (thumb) {
                event.preventDefault();
                open(thumb.getAttribute('data-review-image'));
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
    document.addEventListener('DOMContentLoaded', () => {
        const modalTrigger = document.getElementById('profileReviewModalTrigger');
        const modal = document.getElementById('profileReviewModal');
        const form = modal ? modal.querySelector('form') : null;
        const defaultAction = form ? form.getAttribute('action') : null;
        const draftKey = 'review_modal_draft_profileReviewModal';
        const DRAFT_VERSION = 1;

        const ensureMethodField = () => {
            if (!form) return null;
            let methodField = form.querySelector('[data-profile-method]');
            if (!methodField) {
                methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.dataset.profileMethod = '1';
                form.appendChild(methodField);
            }
            return methodField;
        };

        const applyEditMode = (config) => {
            if (!form || !config?.updateUrl) return;
            form.setAttribute('action', config.updateUrl);
            const methodField = ensureMethodField();
            if (methodField) {
                methodField.value = 'PUT';
            }
            const headerTitle = modal.querySelector('.modal-header h3');
            if (headerTitle) {
                headerTitle.textContent = 'Edit review';
            }
            form.dataset.profileEditing = '1';
        };

        const resetEditMode = () => {
            if (!form || !defaultAction) return;
            form.setAttribute('action', defaultAction);
            const methodField = form.querySelector('[data-profile-method]');
            if (methodField) {
                methodField.remove();
            }
            const headerTitle = modal.querySelector('.modal-header h3');
            if (headerTitle) {
                headerTitle.textContent = 'Write a Review';
            }
            form.dataset.profileEditing = '';
        };

        const metricsKeyMap = (metrics = {}) => {
            const mapped = {};
            Object.entries(metrics || {}).forEach(([key, value]) => {
                mapped[`metrics[${key}]`] = value;
            });
            return mapped;
        };

        const buildDraftPayload = (payload) => {
            if (!payload) return null;
            const fields = {
                company_id: payload.company_id || '',
                state_id: payload.state_id || '',
                category_id: payload.category_id || '',
                rating: payload.rating || '',
                review_title: payload.review_title || '',
                review_text: payload.review_text || '',
                user_state: payload.reviewer_state_id || '',
                user_city: payload.reviewer_city || '',
                system_size: payload.system_size_kw || '',
                system_price: payload.system_price || '',
                year_installed: payload.year_installed || '',
                panel_brand: payload.panel_brand || '',
                inverter_brand: payload.inverter_brand || '',
                media_terms: payload.media_terms_accepted ? true : false,
            };

            Object.assign(fields, metricsKeyMap(payload.experience_metrics || {}));

            return {
                version: DRAFT_VERSION,
                savedAt: Date.now(),
                fields,
                meta: {
                    manualIdentityVisible: false,
                    systemDetailsVisible: Boolean(payload.system_size_kw || payload.system_price || payload.year_installed || payload.panel_brand || payload.inverter_brand),
                },
                context: {
                    companyId: payload.company_id || '',
                    companyName: payload.company_name || 'this company',
                    stateId: payload.state_id || '',
                    categoryId: payload.category_id || '',
                },
            };
        };

        const setTriggerContext = (payload) => {
            if (!modalTrigger || !payload) return;
            modalTrigger.dataset.companyId = payload.company_id || '';
            modalTrigger.dataset.companyName = payload.company_name || 'this company';
            modalTrigger.dataset.categoryIds = payload.category_id ? String(payload.category_id) : '';
            modalTrigger.dataset.stateId = payload.state_id || '';
            modalTrigger.dataset.stateName = payload.company_state_name || '';
        };

        const editButtons = document.querySelectorAll('[data-profile-edit]');
        editButtons.forEach(button => {
            button.addEventListener('click', (event) => {
                event.preventDefault();
                const payload = button.dataset.profileEdit ? JSON.parse(button.dataset.profileEdit) : null;
                if (!payload) return;

                const draftPayload = buildDraftPayload(payload);
                if (draftPayload) {
                    localStorage.setItem(draftKey, JSON.stringify(draftPayload));
                }

                window.profileReviewEditState = {
                    reviewId: payload.id,
                    updateUrl: payload.update_url,
                };

                setTriggerContext(payload);
                modalTrigger?.click();

                requestAnimationFrame(() => applyEditMode(window.profileReviewEditState));
            });
        });

        if (modal) {
            const observer = new MutationObserver(() => {
                if (modal.style.display === 'none') {
                    resetEditMode();
                    localStorage.removeItem(draftKey);
                    window.profileReviewEditState = null;
                }
            });
            observer.observe(modal, { attributes: true, attributeFilter: ['style'] });
        }
    });
</script>

</body>
</html>
