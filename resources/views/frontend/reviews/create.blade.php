<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Submit a Solar Review - SolarReviews</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary-color: #1f7a3d;
            --accent-color: #f4b400;
            --dark-text: #0f172a;
            --muted-text: #64748b;
            --card-border: #e2e8f0;
            --card-shadow: rgba(15, 23, 42, 0.08);
            --bg-soft: #f8fafc;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-soft);
            color: var(--dark-text);
        }

        .container-custom {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        @media (max-width: 768px) {
            .container-custom {
                padding: 0 1.25rem;
            }
        }

        .hero-submit {
            background: linear-gradient(120deg, #103f1f 0%, #1f7a3d 65%, rgba(31, 122, 61, 0.95));
            color: #fff;
            padding: 9rem 0 4rem;
            position: relative;
            overflow: hidden;
        }

        .hero-submit::after {
            content: '';
            position: absolute;
            inset: 0;
            background: url('{{ asset('images/solar-grid.png') }}') center/cover no-repeat;
            opacity: 0.15;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 640px;
        }

        .hero-content h1 {
            font-size: clamp(2rem, 4vw, 2.85rem);
            font-weight: 700;
            line-height: 1.2;
        }

        .hero-content p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.25rem;
        }

        .category-card {
            background: #fff;
            border-radius: 18px;
            padding: 1.5rem;
            border: 1px solid var(--card-border);
            box-shadow: 0 12px 30px var(--card-shadow);
            transition: transform 0.25s ease, border-color 0.25s ease, box-shadow 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .category-card.active,
        .category-card:hover {
            transform: translateY(-6px);
            border-color: var(--primary-color);
            box-shadow: 0 20px 40px rgba(31, 122, 61, 0.15);
        }

        .category-icon {
            font-size: 2.2rem;
            color: var(--primary-color);
            width: 56px;
            height: 56px;
            border-radius: 14px;
            background: rgba(31, 122, 61, 0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .category-card h3 {
            font-size: 1.2rem;
            margin-bottom: 0.35rem;
        }

        .category-card p {
            font-size: 0.95rem;
            color: var(--muted-text);
            margin-bottom: 0.75rem;
        }

        .category-card small {
            font-weight: 600;
            color: var(--primary-color);
        }

        .review-form-wrapper {
            margin-top: 2.5rem;
        }

        .review-form-card {
            background: #fff;
            border-radius: 20px;
            border: 1px solid var(--card-border);
            padding: 2rem;
            box-shadow: 0 20px 45px rgba(15, 23, 42, 0.08);
        }

        .review-form {
            display: none;
            animation: fadeIn 0.35s ease;
        }

        .review-form.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .section-heading {
            font-size: 1.15rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark-text);
        }

        .subtle-card {
            border: 1px dashed #cbd5f5;
            border-radius: 16px;
            padding: 1.25rem;
            background: #f8fafc;
        }

        .rating-stars input {
            display: none;
        }

        .rating-stars label {
            font-size: 1.5rem;
            color: #cbd5f5;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .rating-field {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .rating-field label {
            margin-bottom: 0;
            flex: 1 1 220px;
        }

        .rating-field .rating-stars {
            flex: 0 0 auto;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }

        .rating-stars input:checked ~ label,
        .rating-stars label:hover,
        .rating-stars label:hover ~ label {
            color: #f5c518;
        }

        .multi-rating label {
            font-weight: 500;
            color: var(--muted-text);
        }

        .rating-stars.rating-sm label {
            font-size: 1.2rem;
        }

        .rating-field-sm label {
            flex-basis: 160px;
            font-size: 0.85rem;
            color: var(--muted-text);
        }

        @media (max-width: 576px) {
            .rating-field {
                flex-direction: column;
                align-items: flex-start;
            }

            .rating-field .rating-stars {
                width: 100%;
            }
        }

        .upload-box {
            border: 2px dashed #cbd5f5;
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            background: #f8fafc;
        }

        .upload-box.dragover {
            border-color: var(--primary-color);
            background: rgba(31, 122, 61, 0.05);
        }

        .info-note {
            font-size: 0.9rem;
            color: var(--muted-text);
        }

        .agreement-box {
            border-top: 1px solid #e2e8f0;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
        }

        .otp-actions button {
            min-width: 140px;
        }

        .help-banner {
            border-radius: 16px;
            background: linear-gradient(120deg, #1f7a3d, #38b000);
            color: white;
            padding: 1.5rem;
            margin-top: 2rem;
            display: flex;
            justify-content: space-between;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .help-banner p {
            margin: 0;
        }

        .form-label span {
            font-size: 0.85rem;
            color: var(--muted-text);
            font-weight: 400;
        }
    </style>
</head>
<body>

@include('components.frontend.navbar')

<section class="hero-submit">
    <div class="container-custom">
        <div class="hero-content">
            <p class="text-uppercase fw-semibold mb-2" style="letter-spacing: 2px;">Submit a review</p>
            <h1>Share your real experience to help India pick better solar solutions.</h1>
            <p class="mt-3">Choose the solar product or service you want to review and complete the guided form—no page refreshes, just a smooth experience.</p>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container-custom">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <span class="text-uppercase text-muted fw-medium" style="letter-spacing: 2px;">Select a category</span>
                <h2 class="fw-bold mt-1" style="font-size: 1.9rem;">What would you like to review today?</h2>
            </div>
            <div class="text-muted" style="max-width: 320px; font-size: 0.95rem;">
                Once you pick a category, the detailed review form unfolds right below without reloading the page.
            </div>
        </div>

        <div class="category-grid">
            @foreach($categoryTiles as $index => $tile)
                <div class="category-card" data-category="{{ $tile['slug'] }}">
                    <div class="category-icon">
                        <i class="bi {{ $tile['icon'] }}"></i>
                    </div>
                    <h3>{{ $tile['label'] }}</h3>
                    <p>{{ $tile['description'] }}</p>
                    <small>{{ $tile['cta'] }}</small>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="pb-5">
    <div class="container-custom review-form-wrapper">
        <div class="review-form-card d-none" data-form-card>
            @foreach($categoryTiles as $index => $tile)
                <div class="review-form" data-category="{{ $tile['slug'] }}">
                    @if(!$tile['id'])
                        <div class="subtle-card text-center">
                            <h3 class="fw-semibold">{{ $tile['label'] }} reviews coming soon</h3>
                            <p class="mb-0">We are prepping the submission form for this category. Please check back shortly.</p>
                        </div>
                    @else
                        <form action="{{ route('reviews.store') }}" method="POST" enctype="multipart/form-data" class="review-submit-form" data-category="{{ $tile['slug'] }}">
                            @csrf
                            <input type="hidden" name="category_id" value="{{ $tile['id'] }}">

                            <div class="row g-4">
                                <div class="col-12">
                                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                                        <div>
                                            <p class="text-uppercase text-muted fw-medium mb-1" style="letter-spacing: 2px;">Write a review</p>
                                            <h3 class="h4 mb-0">Tell us about your experience with {{ strtolower($tile['label']) }}</h3>
                                        </div>
                                        <span class="badge bg-light text-dark border">Takes 3-5 mins</span>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="subtle-card">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Company name *</label>
                                                <select class="form-select" name="company_id" required>
                                                    <option value="" disabled selected>Select a company</option>
                                                    @foreach($companies as $company)
                                                        <option value="{{ $company->id }}" data-state="{{ $company->state_id }}">{{ $company->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Office location <span>(if applicable)</span></label>
                                                <input type="text" name="office_location" class="form-control" placeholder="City or neighborhood">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Select state *</label>
                                                <select class="form-select company-state-select" name="state_id" required>
                                                    <option value="" disabled selected>Select state</option>
                                                    @foreach($states as $state)
                                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Select a local office</label>
                                                <select class="form-select local-office-select" name="local_office">
                                                    <option value="" selected>Select office</option>
                                                    @foreach($states as $state)
                                                        @foreach($state->cities as $city)
                                                            <option value="{{ $city->name }}" data-state="{{ $state->id }}">{{ $city->name }}, {{ $state->code }}</option>
                                                        @endforeach
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="rating-field">
                                        <label class="form-label mb-0">Rate your experience with this company *</label>
                                        <div class="rating-stars d-flex flex-row-reverse justify-content-start gap-1">
                                            @for($star = 5; $star >= 1; $star--)
                                                <input type="radio" id="{{ $tile['slug'] }}-rating-{{ $star }}" name="rating" value="{{ $star }}" {{ $star === 5 ? 'required' : '' }}>
                                                <label for="{{ $tile['slug'] }}-rating-{{ $star }}"><i class="fas fa-star"></i></label>
                                            @endfor
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <label class="form-label">Review title <span>(Short summary - optional)</span></label>
                                    <input type="text" class="form-control" name="review_title" placeholder="e.g., Seamless install and great support">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Describe your experience *</label>
                                    <textarea class="form-control" name="review_text" rows="4" placeholder="Share helpful details about communication, performance, timelines, and service." required></textarea>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Tell us more about your experience - rate the following (optional)</label>
                                    <div class="row row-cols-1 row-cols-md-2 g-3 multi-rating">
                                        @php
                                            $experienceMetrics = [
                                                'Sales process',
                                                'Price charged as quoted',
                                                'On schedule',
                                                'Installation quality',
                                                'After sales support'
                                            ];
                                        @endphp
                                        @foreach($experienceMetrics as $metric)
                                            <div class="col">
                                                <div class="rating-field rating-field-sm">
                                                    <label class="form-label small mb-0">{{ $metric }}</label>
                                                    <div class="rating-stars rating-sm d-flex flex-row-reverse justify-content-start gap-1">
                                                        @for($i = 5; $i >= 1; $i--)
                                                            @php
                                                                $metricSlug = Str::slug($metric, '_');
                                                                $inputId = $tile['slug'].'-'.$metricSlug.'-rating-'.$i;
                                                            @endphp
                                                            <input type="radio" id="{{ $inputId }}" name="metrics[{{ $metricSlug }}]" value="{{ $i }}">
                                                            <label for="{{ $inputId }}" title="{{ $i }} stars"><i class="fas fa-star"></i></label>
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="subtle-card">
                                        <h5 class="fw-semibold mb-3">Your solar system details</h5>
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label">System size (kW) *</label>
                                                <div class="input-group">
                                                    <input type="number" step="0.1" min="0" class="form-control" name="system_size" placeholder="e.g., 6.5" required>
                                                    <span class="input-group-text">kW</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">System price <span>(optional)</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text">₹</span>
                                                    <input type="number" min="0" class="form-control" name="system_price" placeholder="Total cost">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Year installed *</label>
                                                <input type="number" class="form-control" name="year_installed" min="2000" max="{{ now()->year }}" value="{{ now()->year }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Panel brand</label>
                                                <input type="text" class="form-control" name="panel_brand" placeholder="e.g., REC, Adani, Waaree">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Inverter brand <span>(optional)</span></label>
                                                <input type="text" class="form-control" name="inverter_brand" placeholder="e.g., Sungrow, Enphase">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label">Your zip code *</label>
                                            <input type="text" name="zip_code" class="form-control" placeholder="e.g., 110001" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Does your price include tax credit or incentives?</label>
                                            <div class="d-flex gap-4 align-items-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="tax_credit" value="yes" id="tax-credit-yes-{{ $tile['slug'] }}">
                                                    <label class="form-check-label" for="tax-credit-yes-{{ $tile['slug'] }}">Yes</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="tax_credit" value="no" id="tax-credit-no-{{ $tile['slug'] }}">
                                                    <label class="form-check-label" for="tax-credit-no-{{ $tile['slug'] }}">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Add photos of your system <span>(optional, jpg/png, max 5MB)</span></label>
                                            <div class="upload-box" data-upload-box>
                                                <p class="mb-2 fw-semibold text-dark">Add or drop a file here</p>
                                                <p class="small text-muted mb-3">Images help your review stand out.</p>
                                                <input type="file" class="form-control" name="photos[]" accept="image/png,image/jpeg" multiple>
                                                <div class="form-check mt-3">
                                                    <input class="form-check-input" type="checkbox" name="media_terms" id="media-terms-{{ $tile['slug'] }}">
                                                    <label class="form-check-label" for="media-terms-{{ $tile['slug'] }}">I agree to media upload terms</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="subtle-card">
                                        <h5 class="fw-semibold mb-3">How should we display your review?</h5>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Choose a display name *</label>
                                                <input type="text" class="form-control" name="reviewer_name" placeholder="e.g., Priya M." required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Add email address *</label>
                                                <input type="email" class="form-control" name="email" placeholder="name@email.com" required data-email-input>
                                                <small class="text-muted">We send the verification code automatically once this field is filled.</small>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Your state *</label>
                                                <select class="form-select" name="user_state" required>
                                                    <option value="" selected disabled>Select state</option>
                                                    @foreach($states as $state)
                                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Your city *</label>
                                                <input type="text" class="form-control" name="user_city" placeholder="City" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">OTP *</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="otp" placeholder="Enter 6-digit code" required data-otp-input>
                                                    <button type="button" class="btn btn-outline-secondary btn-send-otp" data-send-otp-btn>Resend OTP</button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 d-flex align-items-end gap-2 otp-actions">
                                                <button type="button" class="btn btn-outline-primary btn-verify-otp flex-grow-1" data-verify-otp-btn>Verify OTP</button>
                                                <div class="small text-success d-none" data-otp-status aria-live="polite">Verified!</div>
                                            </div>
                                        </div>
                                        <p class="info-note mt-3 mb-0">
                                            We only use your email for verification and anti-spam checks. No marketing emails—ever.
                                        </p>
                                    </div>
                                </div>

                                <div class="col-12 agreement-box">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" required id="agreement-{{ $tile['slug'] }}">
                                        <label class="form-check-label" for="agreement-{{ $tile['slug'] }}">
                                            I confirm I am a customer of this company and this review reflects my genuine experience.
                                        </label>
                                    </div>
                                    <p class="small text-muted">
                                        Please note: You must be a customer of the installer for your review to be posted. All reviews are manually approved before they are visible on SolarReviews.
                                    </p>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-success px-4 py-2" data-submit-btn disabled>
                                        <i class="fas fa-paper-plane me-2"></i>Submit review
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="help-banner mt-4">
            <div>
                <h5 class="fw-semibold mb-2">Need help with your review?</h5>
                <p class="mb-0">Email us at <a href="mailto:reviews@solarreviews.com" class="text-white fw-semibold">reviews@solarreviews.com</a> and we’ll guide you through.</p>
            </div>
            <div>
                <p class="mb-0">Review team availability: Mon–Fri, 9 AM – 6 PM IST</p>
            </div>
        </div>
    </div>
</section>

@include('components.frontend.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const categoryCards = document.querySelectorAll('.category-card');
        const reviewForms = document.querySelectorAll('.review-form');
        const formCard = document.querySelector('[data-form-card]');
        const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
        const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';

        categoryCards.forEach(card => {
            card.addEventListener('click', () => {
                const target = card.dataset.category;

                categoryCards.forEach(c => c.classList.remove('active'));
                card.classList.add('active');

                reviewForms.forEach(form => {
                    form.classList.toggle('active', form.dataset.category === target);
                });

                if (formCard) {
                    formCard.classList.remove('d-none');
                    formCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });

        document.querySelectorAll('[data-upload-box]').forEach(box => {
            box.addEventListener('dragover', e => {
                e.preventDefault();
                box.classList.add('dragover');
            });
            box.addEventListener('dragleave', () => box.classList.remove('dragover'));
            box.addEventListener('drop', e => {
                e.preventDefault();
                box.classList.remove('dragover');
            });
        });

        const isValidEmail = (email) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

        document.querySelectorAll('.review-submit-form').forEach(form => {
            const sendBtn = form.querySelector('[data-send-otp-btn]');
            const verifyBtn = form.querySelector('[data-verify-otp-btn]');
            const emailInput = form.querySelector('[data-email-input]');
            const otpInput = form.querySelector('[data-otp-input]');
            const statusText = form.querySelector('[data-otp-status]');
            const submitBtn = form.querySelector('[data-submit-btn]');

            let emailVerified = false;
            let isSendingOtp = false;
            let autoSendTimer = null;
            let lastOtpEmail = '';

            const setStatus = (message, intent = 'success') => {
                if (!statusText) return;
                statusText.classList.remove('text-success', 'text-danger', 'text-muted');
                statusText.textContent = message;
                statusText.classList.remove('d-none');
                const map = {
                    success: 'text-success',
                    danger: 'text-danger',
                    info: 'text-muted'
                };
                statusText.classList.add(map[intent] || 'text-success');
            };

            const hideStatus = () => {
                if (!statusText) return;
                statusText.classList.add('d-none');
                statusText.textContent = '';
                statusText.classList.remove('text-success', 'text-danger', 'text-muted');
            };

            const updateSubmitState = () => {
                if (submitBtn) {
                    submitBtn.disabled = !emailVerified;
                }
            };

            const resetOtpFlow = (resetOtpValue = false, clearEmailRef = false) => {
                emailVerified = false;
                if (resetOtpValue && otpInput) {
                    otpInput.value = '';
                }
                if (clearEmailRef) {
                    lastOtpEmail = '';
                }
                hideStatus();
                updateSubmitState();
            };

            const sendOtp = async (mode = 'manual') => {
                if (!emailInput) return;
                const emailValue = emailInput.value.trim();

                if (!isValidEmail(emailValue)) {
                    setStatus('Enter a valid email before requesting OTP', 'danger');
                    return;
                }

                if (mode === 'auto' && emailValue === lastOtpEmail) {
                    return;
                }

                if (isSendingOtp) {
                    return;
                }

                isSendingOtp = true;

                if (mode === 'manual' && sendBtn) {
                    sendBtn.disabled = true;
                    sendBtn.textContent = 'Sending…';
                } else if (mode === 'auto') {
                    setStatus('Sending verification code…', 'info');
                }

                try {
                    const response = await fetch(`{{ route('reviews.send-otp') }}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: JSON.stringify({ email: emailValue })
                    });

                    const data = await response.json();

                    if (!response.ok || !data.success) {
                        throw new Error(data.message || 'Failed to send OTP');
                    }

                    lastOtpEmail = emailValue;
                    setStatus(data.message || 'OTP sent successfully', 'success');
                } catch (error) {
                    setStatus(error.message || 'Unable to send OTP. Please try again.', 'danger');
                } finally {
                    isSendingOtp = false;
                    if (sendBtn) {
                        sendBtn.disabled = false;
                        sendBtn.textContent = 'Resend OTP';
                    }
                }
            };

            const verifyOtp = async () => {
                if (!emailInput || !otpInput) return;

                const emailValue = emailInput.value.trim();
                const otpValue = otpInput.value.trim();

                if (!isValidEmail(emailValue) || !otpValue) {
                    setStatus('Enter both email and OTP before verifying', 'danger');
                    return;
                }

                verifyBtn.disabled = true;
                verifyBtn.textContent = 'Verifying…';

                try {
                    const response = await fetch(`{{ route('reviews.verify-otp') }}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: JSON.stringify({ email: emailValue, otp: otpValue })
                    });

                    const data = await response.json();

                    if (!response.ok || !data.success) {
                        throw new Error(data.message || 'OTP verification failed');
                    }

                    emailVerified = true;
                    setStatus(data.message || 'OTP verified successfully.', 'success');
                    updateSubmitState();
                } catch (error) {
                    setStatus(error.message || 'Unable to verify OTP. Please try again.', 'danger');
                } finally {
                    verifyBtn.disabled = false;
                    verifyBtn.textContent = 'Verify OTP';
                }
            };

            if (sendBtn) {
                sendBtn.addEventListener('click', () => sendOtp('manual'));
            }

            if (verifyBtn) {
                verifyBtn.addEventListener('click', verifyOtp);
            }

            if (emailInput) {
                const attemptAutoSend = () => {
                    if (autoSendTimer) {
                        clearTimeout(autoSendTimer);
                        autoSendTimer = null;
                    }
                    sendOtp('auto');
                };

                emailInput.addEventListener('input', () => {
                    resetOtpFlow(true, true);
                    if (autoSendTimer) {
                        clearTimeout(autoSendTimer);
                    }

                    if (!isValidEmail(emailInput.value.trim())) {
                        return;
                    }

                    autoSendTimer = setTimeout(attemptAutoSend, 800);
                });

                emailInput.addEventListener('blur', () => {
                    if (!isValidEmail(emailInput.value.trim())) {
                        return;
                    }
                    attemptAutoSend();
                });
            }

            if (otpInput) {
                otpInput.addEventListener('input', () => {
                    emailVerified = false;
                    updateSubmitState();
                });
            }

            updateSubmitState();
        });

        document.querySelectorAll('.company-state-select').forEach(select => {
            select.addEventListener('change', event => {
                const stateId = event.target.value;
                const form = event.target.closest('form');
                const companySelect = form.querySelector('select[name="company_id"]');
                const officeSelect = form.querySelector('.local-office-select');

                if (companySelect) {
                    Array.from(companySelect.options).forEach(option => {
                        if (!option.value) return;
                        option.hidden = stateId && option.dataset.state !== stateId;
                    });
                    companySelect.selectedIndex = 0;
                }

                if (officeSelect) {
                    Array.from(officeSelect.options).forEach(option => {
                        if (!option.value) return;
                        option.hidden = stateId && option.dataset.state !== stateId;
                    });
                    officeSelect.selectedIndex = 0;
                }
            });
        });
    });
</script>

</body>
</html>
