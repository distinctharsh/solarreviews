<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Top Solar Companies in {{ $state['name'] }} - Solar Reviews</title>
    <!-- Bootstrap & Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #1e40af;
            --secondary-color: #0f172a;
            --accent-color: #3b82f6;
            --text-color: #1f2937;
            --light-bg: #f5f7fb;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--light-bg);
            color: var(--text-color);
        }

        .container-custom {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }
        @media (max-width: 768px) {
            .container-custom {
                padding: 0 1rem;
            }
        }

        .page-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1.5rem 1.5rem 2.5rem;
            display: grid;
            grid-template-columns: 240px 1fr;
            gap: 1.25rem;
            align-items: flex-start;
        }

        /* Left Sidebar */
        .sidebar {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 1.25rem 1.15rem;
            position: sticky;
            top: 80px;
        }

        .sidebar h3 {
            font-size: 1rem;
            font-weight: 600;
            color: var(--secondary-color);
            margin-bottom: 0.85rem;
        }

        .sidebar ul {
            list-style: none;
            margin-bottom: 1.5rem;
        }

        .sidebar ul li + li {
            margin-top: 0.35rem;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #389c48;
            font-size: 0.95rem;
            transition: color 0.2s ease;
        }

        .sidebar ul li a:hover {
            color: #2563eb;
        }

        .calculator {
            margin-top: 1.5rem;
            padding-top: 1.25rem;
            border-top: 1px solid #edf2f7;
        }

        .calculator h3 {
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .calculator input {
            width: 100%;
            padding: 0.65rem 0.85rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            margin-bottom: 0.65rem;
            font-size: 0.95rem;
        }

        .calculator button {
            width: 100%;
            background: #389c48;
            color: #fff;
            border: none;
            padding: 0.75rem 0;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .calculator button:hover {
            background: #257239;
        }

        /* Right Content */
        .content {
            width: 100%;
        }

        .header {
            margin-bottom: 1.25rem;
        }

        .header h1 {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--secondary-color);
        }

        .header p {
            color: #475569;
            margin-top: 0.4rem;
        }

        .company-profile-card {
            background: #fff;
            border: 1px solid #dbe4f3;
            border-radius: 12px;
            padding: 1.1rem;
            margin-bottom: 1.15rem;
            box-shadow: 0 8px 18px rgba(15, 23, 42, 0.05);
        }

        .company-main {
            display: flex;
            gap: 1.1rem;
        }

        .company-logo-card {
            width: 80px;
            min-width: 80px;
            height: 80px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8fafc;
            padding: 0.6rem;
        }

        .company-logo-card img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .company-info {
            flex: 1;
        }

        .company-title-row {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .company-name {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.35rem;
            color: var(--secondary-color);
        }

        .company-rating {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            flex-wrap: wrap;
            color: #475569;
        }

        .company-rating .stars i {
            color: #f6ad02;
            font-size: 1rem;
        }

        .company-rating .rating-number {
            font-weight: 600;
            color: #0f172a;
        }

        .company-rating .review-count {
            color: #64748b;
            font-size: 0.95rem;
        }

        .btn-quote {
            background: #1f7ef2;
            color: #fff;
            border: none;
            padding: 0.45rem 1rem;
            border-radius: 999px;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .btn-quote:hover {
            background: #1661c0;
        }

        .btn-review {
            background: #389c48;
            color: #fff;
            border: none;
            padding: 0.45rem 1rem;
            border-radius: 999px;
            font-weight: 600;
            font-size: 0.82rem;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .btn-review:hover {
            background: #256c36;
        }

        .company-description-card {
            margin-top: 0.65rem;
            background: #f7fbff;
            border: 1px solid #dbeafe;
            border-radius: 10px;
            padding: 0.75rem 0.85rem;
        }

        .company-description-card h4 {
            font-size: 0.95rem;
            margin-bottom: 0.35rem;
            color: #0f172a;
        }

        .company-description-card p {
            color: #475569;
            margin-bottom: 0.2rem;
            line-height: 1.45;
        }

        .link-button {
            background: none;
            border: none;
            color: #1f7ef2;
            font-weight: 600;
            cursor: pointer;
            padding: 0;
        }

        .expert-score-card {
            margin-top: 0.9rem;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 0.6rem 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.65rem;
            font-size: 0.9rem;
        }

        .score-dots span {
            width: 16px;
            height: 16px;
            border-radius: 4px;
            background: #dbeafe;
            display: inline-block;
        }

        .score-dots span.active {
            background: #2563eb;
        }

        .tier-badge {
            background: #10b981;
            color: #fff;
            padding: 0.15rem 0.65rem;
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        details.rating-panel {
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #fff;
            margin-top: 0.6rem;
            overflow: hidden;
        }

        details.rating-panel summary {
            list-style: none;
            cursor: pointer;
            padding: 0.75rem 0.95rem;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        details.rating-panel summary::-webkit-details-marker {
            display: none;
        }

        details.rating-panel summary::after {
            content: '+';
            font-size: 1.2rem;
            color: #94a3b8;
        }

        details.rating-panel[open] summary::after {
            content: '\2212';
        }

        .panel-body {
            border-top: 1px solid #e2e8f0;
            padding: 0.6rem 0.95rem 0.85rem;
        }

        .metric-list {
            list-style: none;
            margin: 0.4rem 0 0;
            padding: 0;
        }

        .metric-item {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.25rem 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .metric-item:last-child {
            border-bottom: none;
        }

        .metric-score {
            width: 48px;
            height: 36px;
            border-radius: 8px;
            background: #ecfdf5;
            color: #047857;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .metric-label {
            color: #1e293b;
            font-weight: 500;
        }

        .negatives-row {
            margin-top: 0.65rem;
            color: #475569;
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
        }

        .services-list {
            list-style: none;
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem;
            padding: 0;
        }

        .services-list li {
            background: #f1f5f9;
            border-radius: 999px;
            padding: 0.25rem 0.6rem;
            font-size: 0.8rem;
            color: #475569;
        }

        .latest-review-text {
            color: #475569;
            line-height: 1.6;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .page-wrapper {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: static;
            }

            .company-main {
                flex-direction: column;
            }

            .company-logo-card {
                width: 90px;
                height: 90px;
            }
        }

        @media (max-width: 640px) {
            .company-title-row {
                flex-direction: column;
            }

            .btn-quote {
                align-self: flex-start;
            }
        }

        /* Custom Modal Styles */
        .custom-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
        }

        .custom-modal-content {
            background-color: #fff;
            margin: 5% auto;
            width: 90%;
            max-width: 600px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .custom-modal-header {
            padding: 15px 20px;
            background: #389c48;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .custom-modal-header h3 {
            margin: 0;
            font-size: 18px;
        }

        .close-btn {
            font-size: 24px;
            cursor: pointer;
            color: white;
        }

        .custom-modal-body {
            padding: 20px;
            max-height: 70vh;
            overflow-y: auto;
        }

        .custom-modal-footer {
            padding: 15px 20px;
            background: #f8f9fa;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }

        .input-group {
            display: flex;
            gap: 10px;
            margin-bottom: 5px;
        }

        .input-group input {
            flex: 1;
        }

        button {
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        #sendOtpBtn,
        #verifyOtpBtn {
            background-color: #f0f0f0;
            color: #333;
        }

        #sendOtpBtn:hover,
        #verifyOtpBtn:hover {
            background-color: #e0e0e0;
        }

        .cancel-btn {
            background-color: #f0f0f0;
            color: #333;
        }

        .cancel-btn:hover {
            background-color: #e0e0e0;
        }

        .submit-btn {
            background-color: #389c48;
            color: white;
        }

        .submit-btn:hover {
            background-color: #2980b9;
        }

        .submit-btn:disabled {
            background-color: #bdc3c7;
            cursor: not-allowed;
        }

        /* Rating Stars */
        .rating-stars {
            font-size: 24px;
            color: #ddd;
            cursor: pointer;
            margin: 10px 0;
        }

        .rating-stars i {
            margin-right: 5px;
        }

        .rating-stars .fas {
            color: #f1c40f;
        }

        .otp-status {
            margin-top: 5px;
            font-size: 13px;
        }

        .otp-status.success {
            color: #27ae60;
        }

        .otp-status.error {
            color: #e74c3c;
        }
    </style>
</head>
<body>

@include('components.frontend.navbar')

<div class="page-wrapper">
    <!-- Sidebar -->
    <div class="sidebar">
        <h3>Solar in your state </h3>
        <ul>
            @foreach($states as $s)
                <li><a href="{{ url('state/'.$s['slug']) }}">{{ $s['name'] }}</a></li>
            @endforeach
        </ul>

        <div class="calculator">
            <h3>Try our Solar Calculator in your state</h3>
            <input type="text" class="state-calculator-input" placeholder="Enter your PIN code" maxlength="6" inputmode="numeric">
            <button class="state-calculator-btn" type="button">Calculate Now</button>
        </div>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="header">
            <h1>Top Solar Companies in {{ $state['name'] }}</h1>
            <p>Compare verified solar installation companies in {{ $state['name'] }} with customer reviews and ratings.</p>
        </div>

        @php
            $dummyCompanies = [
                [
                    'name' => 'Sunergy Solutions LLC',
                    'logo' => asset('images/company/cmp.png'),
                    'rating' => 4.91,
                    'reviews' => 145,
                    'description' => 'Thank you for taking the time to learn more about Sunergy Solutions! We are ranked as the #1 installer for all of New England with years of know-how…',
                    'latest_review' => 'Fantastic crew and clean install. System performing better than projections.'
                ],
                [
                    'name' => 'BrightPath Solar Pros',
                    'logo' => asset('images/company/cmp.png'),
                    'rating' => 4.78,
                    'reviews' => 212,
                    'description' => 'BrightPath focuses on premium hardware paired with concierge installation support for every homeowner.',
                    'latest_review' => 'Sales team was transparent and the install was done in only two days.'
                ],
                [
                    'name' => 'EcoBeam Installers',
                    'logo' => asset('images/company/cmp.png'),
                    'rating' => 4.65,
                    'reviews' => 189,
                    'description' => 'EcoBeam has delivered over 12,000 rooftop systems nationwide and offers lifetime monitoring.',
                    'latest_review' => 'Monitoring app is excellent and the crew cleaned up perfectly.'
                ],
                [
                    'name' => 'HelioPrime Energy',
                    'logo' => asset('images/company/cmp.png'),
                    'rating' => 4.59,
                    'reviews' => 98,
                    'description' => 'Specialists in hybrid solar + battery packages for homes that want unstoppable backup.',
                    'latest_review' => 'Battery backup kicked in during the first storm and worked flawlessly.'
                ],
                [
                    'name' => 'NorthStar Renewables',
                    'logo' => asset('images/company/cmp.png'),
                    'rating' => 4.83,
                    'reviews' => 167,
                    'description' => 'NorthStar blends premium panels with affordable financing tailored for families.',
                    'latest_review' => 'Financing was easy and the project manager kept us informed daily.'
                ],
                [
                    'name' => 'Summit Skyline Solar',
                    'logo' => asset('images/company/cmp.png'),
                    'rating' => 4.72,
                    'reviews' => 134,
                    'description' => 'Summit Skyline provides white-glove solar installs plus optional EV charger upgrades.',
                    'latest_review' => 'Loved the attention to detail. EV charger add-on is super handy.'
                ],
                [
                    'name' => 'Evergreen Grid Co.',
                    'logo' => asset('images/company/cmp.png'),
                    'rating' => 4.58,
                    'reviews' => 121,
                    'description' => 'Evergreen Grid brings 15 years of craftsmanship with NABCEP-certified crews.',
                    'latest_review' => 'Crew was respectful and the workmanship is tidy and professional.'
                ],
            ];
        @endphp

        @foreach($dummyCompanies as $company)
            @php
                $rating = $company['rating'];
                $fullStars = floor($rating);
                $hasHalfStar = $rating - $fullStars >= 0.5;
                $reviewCount = $company['reviews'];
            @endphp
            <article class="company-profile-card">
                <div class="company-main">
                    <div class="company-logo-card">
                        <img src="{{ $company['logo'] }}" alt="{{ $company['name'] }} logo">
                    </div>
                    <div class="company-info">
                        <div class="company-title-row">
                            <div>
                                <div class="company-name">{{ $company['name'] }}</div>
                                <div class="company-rating">
                                    <span class="stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="{{ $i <= $fullStars ? 'fas fa-star' : ($i == $fullStars + 1 && $hasHalfStar ? 'fas fa-star-half-alt' : 'far fa-star') }}"></i>
                                        @endfor
                                    </span>
                                    <span class="rating-number">{{ number_format($rating, 2) }}</span>
                                    <span class="review-count">({{ $reviewCount }} {{ $reviewCount == 1 ? 'review' : 'reviews' }})</span>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <button class="btn-quote">Get Quote</button>
                                <button type="button" class="btn-review">Write a Review</button>
                            </div>
                        </div>

                        <div class="company-description-card">
                            <h4>Company Description</h4>
                            <p>{{ $company['description'] }}</p>
                            <button class="link-button">Learn more</button>
                        </div>

                        <div class="expert-score-card">
                            <strong>SolarReviews Expert Rating Score:</strong>
                            <div class="score-dots">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="{{ $i <= 4 ? 'active' : '' }}"></span>
                                @endfor
                            </div>
                            <span class="tier-badge">Elite</span>
                        </div>

                        <details class="rating-panel">
                            <summary>Rating breakdown</summary>
                            <div class="panel-body">
                                <strong>Positives:</strong>
                                <ul class="metric-list">
                                    @foreach([
                                        ['score' => '9 / 10', 'label' => 'Time in business'],
                                        ['score' => '5 / 5', 'label' => 'Employee satisfaction and safety record'],
                                        ['score' => '7 / 10', 'label' => 'Competitiveness of loan options'],
                                        ['score' => '10 / 10', 'label' => 'Litigation and background'],
                                        ['score' => '10 / 10', 'label' => 'Verification of licenses and insurance'],
                                        ['score' => '10 / 10', 'label' => 'Profitability of installer'],
                                        ['score' => '4 / 5', 'label' => 'Consumer reviews performance'],
                                        ['score' => '5 / 5', 'label' => 'Transparency of pricing and sales process'],
                                        ['score' => '5 / 5', 'label' => 'Company size and location'],
                                        ['score' => '10 / 10', 'label' => 'Quality of brands sold'],
                                        ['score' => '4 / 5', 'label' => 'Vertical integration'],
                                        ['score' => '5 / 5', 'label' => 'Reliability of consumer reviews'],
                                        ['score' => '4 / 5', 'label' => 'Transparency about reputation'],
                                        ['score' => '3 / 5', 'label' => 'Sustainable pricing of systems'],
                                    ] as $metric)
                                        <li class="metric-item">
                                            <div class="metric-score">{{ $metric['score'] }}</div>
                                            <div class="metric-label">{{ $metric['label'] }}</div>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="negatives-row">
                                    <strong>Negatives:</strong>
                                    <span>Learn more about how we rate solar installers</span>
                                </div>
                            </div>
                        </details>

                        <details class="rating-panel">
                            <summary>Services offered</summary>
                            <div class="panel-body">
                                <ul class="services-list">
                                    @foreach($company->services ?? ['Solar installation', 'Battery backup', 'Maintenance'] as $service)
                                        <li>{{ $service }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </details>

                        <details class="rating-panel">
                            <summary>Latest Good Review</summary>
                            <div class="panel-body">
                                <p class="latest-review-text">
                                    {{ $company['latest_review'] }}
                                </p>
                            </div>
                        </details>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
</div>

<!-- Review Modal -->
<div id="reviewModal" class="custom-modal">
    <div class="custom-modal-content">
        <div class="custom-modal-header">
            <h3>Write a Review</h3>
            <span class="close-btn">&times;</span>
        </div>
        <form id="reviewForm" method="POST" action="{{ route('reviews.store') }}">
            @csrf
            <input type="hidden" name="company_id" id="companyId">
            <div class="custom-modal-body">
                <div class="form-group">
                    <label for="state">State *</label>
                    {{-- Fix state to current page state --}}
                    <input type="hidden" name="state_id" value="{{ $state['id'] ?? ($state->id ?? '') }}">
                    <select id="state" disabled>
                        <option value="">
                            {{ $state['name'] ?? ($state->name ?? 'State') }}
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="category">Select Category *</label>
                    <select id="category" name="category_id" required>
                        <option value="">Select Category</option>
                        @if(isset($categories))
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" data-category-id="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Rate your experience with <span id="companyNameInModal"></span> *</label>
                    <div class="rating-stars">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="far fa-star" data-rating="{{ $i }}"></i>
                        @endfor
                        <input type="hidden" name="rating" id="rating" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="reviewTitle">Review Title (Optional)</label>
                    <input type="text" id="reviewTitle" name="review_title" placeholder="Summarize your experience">
                </div>
                
                <div class="form-group">
                    <label for="reviewText">Your Review *</label>
                    <textarea id="reviewText" name="review_text" rows="3" required></textarea>
                </div>
                
                <div class="form-group">
                    <label for="reviewerName">Your Name *</label>
                    <input type="text" id="reviewerName" name="reviewer_name" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address *</label>
                    <div class="input-group">
                        <input type="email" id="email" name="email" required>
                        <button type="button" id="sendOtpBtn">Send OTP</button>
                    </div>
                    <small>We'll send a verification code to this email</small>
                </div>
                
                <div class="form-group" id="otpField" style="display: none;">
                    <label for="otp">Enter OTP *</label>
                    <div class="input-group">
                        <input type="text" id="otp" name="otp" maxlength="6" placeholder="Enter 6-digit OTP">
                        <button type="button" id="verifyOtpBtn">Verify</button>
                    </div>
                    <div class="otp-status" id="otpStatus"></div>
                </div>
            </div>
            <div class="custom-modal-footer">
                <button type="button" class="cancel-btn">Close</button>
                <button type="submit" class="submit-btn" id="submitReviewBtn" disabled>Submit Review</button>
            </div>
        </form>
    </div>
</div>

<!-- SweetAlert2 for alerts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Existing JavaScript

    const slugifyState = (text) => text
        .toLowerCase()
        .trim()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/^-+|-+$/g, '');

    function setupPincodeRedirect(inputSelector, buttonSelector) {
        const input = document.querySelector(inputSelector);
        const button = document.querySelector(buttonSelector);

        if (!input || !button) return;

        const originalText = button.textContent;

        button.addEventListener('click', async () => {
            const pincode = input.value.trim();

            if (!/^\d{6}$/.test(pincode)) {
                alert('Please enter a valid 6-digit pincode.');
                input.focus();
                return;
            }

            button.disabled = true;
            button.textContent = 'Checking...';

            try {
                const response = await fetch(`https://api.postalpincode.in/pincode/${pincode}`);

                if (!response.ok) {
                    throw new Error('Failed to fetch state details');
                }

                const data = await response.json();
                const apiResult = Array.isArray(data) ? data[0] : null;
                const postOffice = apiResult?.PostOffice?.[0];

                if (apiResult?.Status === 'Success' && postOffice?.State) {
                    const stateSlug = slugifyState(postOffice.State);
                    window.location.href = `/state/${stateSlug}`;
                    return;
                }

                alert('Could not find the state for this pincode. Please try another one.');
            } catch (error) {
                console.error('Failed to fetch state for pincode:', error);
                alert('Something went wrong while fetching the state. Please try again later.');
            } finally {
                button.disabled = false;
                button.textContent = originalText;
            }
        });
    }

    // Review Modal Functionality
    document.addEventListener('DOMContentLoaded', function() {
        setupPincodeRedirect('.state-calculator-input', '.state-calculator-btn');

        // Initialize all DOM elements
        const reviewModal = document.getElementById('reviewModal');
        const writeReviewBtns = document.querySelectorAll('.write-review-btn');
        const closeBtn = document.querySelector('.close-btn');
        const cancelBtn = document.querySelector('.cancel-btn');
        const companyNameInModal = document.getElementById('companyNameInModal');
        const companyIdInput = document.getElementById('companyId');
        const ratingStars = document.querySelectorAll('.rating-stars i');
        const ratingInput = document.getElementById('rating');
        const emailInput = document.getElementById('email');
        const categorySelect = document.getElementById('category');
        const otpField = document.getElementById('otpField');
        const otpInput = document.getElementById('otp');
        const sendOtpBtn = document.getElementById('sendOtpBtn');
        const verifyOtpBtn = document.getElementById('verifyOtpBtn');
        const otpStatus = document.getElementById('otpStatus');
        const submitReviewBtn = document.getElementById('submitReviewBtn');
        
        // Initialize state variables
        let otpSent = false;
        let otpVerified = false;
        
        // Make sure ratingInput is properly initialized
        if (!ratingInput) {
            console.error('Rating input not found!');
        }
        
        // Cache original category options for filtering
        let originalCategoryOptions = [];
        if (categorySelect) {
            originalCategoryOptions = Array.from(categorySelect.options).map(option => ({
                value: option.value,
                text: option.text,
                categoryId: option.getAttribute('data-category-id')
            }));
        }

        function filterCategoriesForCompany(categoryIdsCsv) {
            if (!categorySelect || originalCategoryOptions.length === 0) return;

            const categoryIds = (categoryIdsCsv || '')
                .split(',')
                .map(id => id.trim())
                .filter(id => id !== '');

            // Clear current options
            categorySelect.innerHTML = '';

            // Add placeholder
            const placeholder = document.createElement('option');
            placeholder.value = '';
            placeholder.textContent = 'Select Category';
            categorySelect.appendChild(placeholder);

            let optionsToShow = [];

            // If company has specific categories, filter; otherwise show none
            if (categoryIds.length) {
                optionsToShow = originalCategoryOptions.filter(opt =>
                    opt.categoryId && categoryIds.includes(String(opt.categoryId))
                );
            } else {
                optionsToShow = [];
            }

            // Enable/disable select based on availability
            categorySelect.disabled = optionsToShow.length === 0;

            optionsToShow.forEach(opt => {
                const option = document.createElement('option');
                option.value = opt.value;
                option.textContent = opt.text;
                if (opt.categoryId) {
                    option.setAttribute('data-category-id', opt.categoryId);
                }
                categorySelect.appendChild(option);
            });
        }

        // Open review modal with company data
        writeReviewBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const companyId = this.getAttribute('data-company-id');
                const companyName = this.getAttribute('data-company-name');
                const companyCategoryIds = this.getAttribute('data-category-ids');
                
                companyIdInput.value = companyId;
                companyNameInModal.textContent = companyName;

                // Filter categories for this company
                filterCategoriesForCompany(companyCategoryIds);
                
                // Reset form
                resetReviewForm();
                
                // Show modal
                reviewModal.style.display = 'flex';
            });
        });
        
        // Handle star rating
        ratingStars.forEach(star => {
            star.addEventListener('click', function() {
                const rating = parseInt(this.getAttribute('data-rating'));
                ratingInput.value = rating;
                
                // Update star display
                ratingStars.forEach((s, index) => {
                    if (index < rating) {
                        s.classList.add('active');
                        s.classList.add('fas');
                        s.classList.remove('far');
                    } else {
                        s.classList.remove('active');
                        s.classList.add('far');
                        s.classList.remove('fas');
                    }
                });
            });
        });
        
        // Send OTP
        sendOtpBtn.addEventListener('click', function() {
            const email = emailInput.value.trim();
            
            if (!email) {
                showAlert('Error', 'Please enter your email address', 'error');
                return;
            }
            
            // Show loading state
            const originalText = sendOtpBtn.innerHTML;
            sendOtpBtn.disabled = true;
            sendOtpBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...';
            
            // Make AJAX call to send OTP
            fetch('{{ route("reviews.send-otp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ email: email })
            })
            .then(response => response.json())
            .then(data => {
                console.log('OTP Response:', data);
                
                if (data.success) {
                    // In development, show OTP in console
                    if (data.otp) {
                        console.log('Your OTP for testing:', data.otp);
                        showAlert('OTP Sent', `OTP sent to ${email}. Check console for OTP (for testing).`, 'success');
                    } else {
                        showAlert('OTP Sent', 'We have sent a 6-digit OTP to your email address.', 'success');
                    }
                    
                    // Show OTP field
                    otpField.style.display = 'block';
                    otpSent = true;
                    
                    // Focus OTP input
                    otpInput.focus();
                } else {
                    throw new Error(data.message || 'Failed to send OTP');
                }
            })
            .catch(error => {
                console.error('Error sending OTP:', error);
                showAlert('Error', error.message || 'Failed to send OTP. Please try again.', 'error');
            })
            .finally(() => {
                // Reset button state
                sendOtpBtn.disabled = false;
                sendOtpBtn.innerHTML = 'Resend OTP';
            });
        });
        
        // Handle OTP verification
        if (verifyOtpBtn && otpInput && otpStatus) {
            verifyOtpBtn.addEventListener('click', function() {
                const otp = otpInput.value.trim();
                const email = emailInput ? emailInput.value.trim() : '';
                
                if (!otp || otp.length !== 6) {
                    showAlert('Error', 'Please enter a valid 6-digit OTP', 'error');
                    return;
                }

                // Show loading state
                const originalText = verifyOtpBtn.innerHTML;
                verifyOtpBtn.disabled = true;
                verifyOtpBtn.innerHTML = 'Verifying...';

                // Make API call to verify OTP
                fetch('{{ route("reviews.verify-otp") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        email: email,
                        otp: otp
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('OTP Verification Response:', data);
                    
                    if (data.success) {
                        otpVerified = true;
                        if (submitReviewBtn) submitReviewBtn.disabled = false;
                        otpStatus.textContent = 'OTP verified successfully!';
                        otpStatus.className = 'otp-status success';
                        verifyOtpBtn.innerHTML = 'Verified';
                        verifyOtpBtn.disabled = true;
                        
                        // Show success message
                        showAlert('Success', 'OTP verified successfully!', 'success');
                    } else {
                        throw new Error(data.message || 'Failed to verify OTP');
                    }
                })
                .catch(error => {
                    console.error('Error verifying OTP:', error);
                    otpStatus.textContent = error.message || 'Failed to verify OTP. Please try again.';
                    otpStatus.className = 'otp-status error';
                    verifyOtpBtn.disabled = false;
                    verifyOtpBtn.innerHTML = originalText;
                    
                    // Show error message
                    showAlert('Error', error.message || 'Failed to verify OTP. Please try again.', 'error');
                });
            });
        }

        // Form submission
        const reviewForm = document.getElementById('reviewForm');
        if (reviewForm) {
            reviewForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                if (!otpVerified) {
                    showAlert('Error', 'Please verify your email with OTP first', 'error');
                    return;
                }
                
                // Show loading state
                submitReviewBtn.disabled = true;
                submitReviewBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submitting...';
                
                // Get form data
                const formData = new FormData(this);
                
                // Convert FormData to JSON
                const formObject = {};
                formData.forEach((value, key) => {
                    formObject[key] = value;
                });
                
                // Add email if not already in form
                if (emailInput && emailInput.value) {
                    formObject['email'] = emailInput.value;
                }
                
                // Debug: Log the data being sent
                console.log('Submitting form data:', formObject);
                
                // Submit form via AJAX
                fetch(this.action, {
                    method: 'POST',
                    body: JSON.stringify(formObject),
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showAlert('Success', 'Thank you for your review! It will be visible after approval.', 'success');
                        reviewModal.style.display = 'none';
                        // Reload the page to see the updated reviews
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    } else {
                        throw new Error(data.message || 'Failed to submit review');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('Error', error.message || 'Failed to submit review. Please try again.', 'error');
                    submitReviewBtn.disabled = false;
                    submitReviewBtn.innerHTML = 'Submit Review';
                });
            });
        }

        // Close modal when clicking the close button
        closeBtn.addEventListener('click', function() {
            reviewModal.style.display = 'none';
            resetReviewForm();
        });

        // Close modal when clicking the cancel button
        cancelBtn.addEventListener('click', function() {
            reviewModal.style.display = 'none';
            resetReviewForm();
        });

        // Close modal when clicking outside the modal content
        window.addEventListener('click', function(event) {
            if (event.target === reviewModal) {
                reviewModal.style.display = 'none';
                resetReviewForm();
            }
        });
    });

    // Handle OTP verification - Moved inside DOMContentLoaded to ensure proper scoping

        // Helper function to reset the review form
        function resetReviewForm() {
            const form = document.getElementById('reviewForm');
            const ratingInput = document.getElementById('rating');
            
            if (form) form.reset();
            if (ratingInput) ratingInput.value = '';
            
            // Reset OTP state
            otpSent = false;
            otpVerified = false;
            
            // Reset OTP UI
            if (otpField) otpField.style.display = 'none';
            if (otpStatus) {
                otpStatus.textContent = '';
                otpStatus.className = 'otp-status';
            }
            
            // Reset buttons
            if (submitReviewBtn) submitReviewBtn.disabled = true;
            if (verifyOtpBtn) {
                verifyOtpBtn.disabled = false;
                verifyOtpBtn.innerHTML = 'Verify';
                verifyOtpBtn.className = '';
            }
            if (sendOtpBtn) sendOtpBtn.innerHTML = 'Send OTP';

            // Reset stars
            const stars = document.querySelectorAll('.rating-stars i');
            if (stars && stars.length > 0) {
                stars.forEach(star => {
                    if (star) {
                        star.classList.remove('fas');
                        star.classList.add('far');
                    }
                });
            }
}

// Helper function to show alerts
function showAlert(title, text, icon) {
    Swal.fire({
        title: title,
        text: text,
        icon: icon,
        confirmButtonText: 'OK'
    });
}
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @include('components.frontend.footer')
</body>
</html>
