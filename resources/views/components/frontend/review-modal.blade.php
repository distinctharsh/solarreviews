@props([
    'categories' => collect(),
    'states' => collect(),
    'companies' => collect(),
    'defaultStateId' => null,
    'defaultStateName' => null,
    'modalId' => 'reviewModal',
    'triggerSelector' => '.btn-review',
    'allowCompanySelection' => false,
])

@php
    $resolvedStateId = $defaultStateId ?? data_get($state ?? null, 'id');
    $resolvedStateName = $defaultStateName ?? data_get($state ?? null, 'name');
    $categoryOptions = collect($categories ?? []);
    $reviewProfile = session('review_profile');
@endphp

@once
    <style>
        .modal-overlay {
            display: none;
            position: fixed;
            z-index: 1000;
            inset: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            align-items: flex-start;
            justify-content: center;
            padding: calc(80px + 1rem) 1rem 1.5rem;
            overflow-y: auto;
        }

        .identity-status {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.85rem 1rem;
            border-radius: 10px;
            background: rgba(59, 161, 76, 0.07);
            border: 1px solid rgba(59, 161, 76, 0.25);
            margin-bottom: 1rem;
        }

        .identity-status span {
            font-weight: 600;
            color: var(--text-primary, #0f172a);
        }

        .identity-status button {
            background: transparent;
            border: none;
            color: #2563eb;
            font-weight: 600;
            cursor: pointer;
        }

        .identity-status button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .modal-container {
            background: var(--surface, #ffffff);
            width: 100%;
            max-width: 560px;
            border-radius: 20px;
            box-shadow: var(--shadow-xl, 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1));
            overflow: hidden;
            animation: modalSlideIn 0.3s ease;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-20px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .modal-header {
            background: linear-gradient(135deg, var(--gradient-start, #3ba14c) 0%, var(--gradient-end, #2d8f3e) 100%);
            padding: 1.25rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h3 {
            font-family: 'Outfit', sans-serif;
            color: #fff;
            font-size: 1.25rem;
            font-weight: 700;
            margin: 0;
        }

        .modal-close {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            border: none;
            color: #fff;
            font-size: 1.25rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .modal-close:hover {
            background: rgba(255,255,255,0.3);
            transform: rotate(90deg);
        }

        .modal-body {
            padding: 1.5rem;
            max-height: 65vh;
            overflow-y: auto;
        }

        .modal-body::-webkit-scrollbar {
            width: 6px;
        }

        .modal-body::-webkit-scrollbar-track {
            background: var(--border-light, #f1f5f9);
        }

        .modal-body::-webkit-scrollbar-thumb {
            background: var(--primary-light, #6dc47d);
            border-radius: 3px;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-primary, #0f172a);
            margin-bottom: 0.5rem;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid var(--border, #e2e8f0);
            border-radius: 10px;
            font-size: 0.9rem;
            font-family: inherit;
            transition: all 0.2s ease;
            background: var(--surface, #ffffff);
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--primary, #3ba14c);
            box-shadow: 0 0 0 3px rgba(59, 161, 76, 0.1);
        }

        .form-textarea {
            min-height: 100px;
            resize: vertical;
        }

        .input-group {
            display: flex;
            gap: 0.75rem;
        }

        .input-group .form-input {
            flex: 1;
        }

        .otp-field-group {
            display: flex;
            gap: 0.75rem;
            align-items: center;
        }

        .btn-otp {
            border: none;
            background: rgba(37, 99, 235, 0.12);
            color: #1d4ed8;
            font-weight: 600;
            padding: 0.65rem 1.1rem;
            border-radius: 999px;
            min-width: 130px;
            transition: background 0.2s ease;
        }

        .btn-otp:hover:not(:disabled) {
            background: rgba(37, 99, 235, 0.2);
        }

        .btn-otp:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .btn-outline {
            background: var(--surface, #ffffff);
            color: var(--primary, #3ba14c);
            border: 2px solid var(--primary, #3ba14c);
            padding: 0.75rem 1.25rem;
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .btn-outline:hover {
            background: var(--primary, #3ba14c);
            color: #fff;
        }

        .btn-outline:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .form-hint {
            font-size: 0.75rem;
            color: var(--text-muted, #94a3b8);
            margin-top: 0.35rem;
        }

        .modal-rating-stars {
            display: flex;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .modal-rating-stars i {
            font-size: 1.75rem;
            color: var(--border, #e2e8f0);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .modal-rating-stars i:hover,
        .modal-rating-stars i.active {
            color: var(--accent, #f59e0b);
            transform: scale(1.1);
        }

        .metric-stars {
            display: flex;
            gap: 0.4rem;
            align-items: center;
        }

        .metric-star-btn {
            background: transparent;
            border: none;
            padding: 0;
            cursor: pointer;
            line-height: 1;
        }

        .metric-stars i {
            font-size: 1.4rem;
            color: var(--border, #e2e8f0);
            cursor: pointer;
            transition: transform 0.15s ease, color 0.15s ease;
        }

        .metric-stars i:hover,
        .metric-stars i.active {
            color: var(--accent, #f59e0b);
            transform: scale(1.05);
        }

        .metric-stars input[type="hidden"] {
            display: none;
        }

        .system-toggle {
            width: 100%;
            background: #f1f5f9;
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 12px;
            padding: 0.85rem 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-weight: 600;
            color: #0f172a;
            cursor: pointer;
            transition: background 0.2s ease, border-color 0.2s ease;
        }

        .system-toggle:hover {
            background: #e2e8f0;
            border-color: rgba(15, 23, 42, 0.2);
        }

        .system-toggle span {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .system-toggle i {
            transition: transform 0.2s ease;
        }

        .system-toggle[aria-expanded="true"] .toggle-chevron {
            transform: rotate(180deg);
        }

        .identity-options {
            margin-top: 0.5rem;
            margin-bottom: 1.25rem;
        }

        .identity-option {
            width: 100%;
            border: 1px solid #dadce0;
            border-radius: 999px;
            padding: 0.45rem 0.7rem;
            display: flex;
            align-items: center;
            gap: 0.65rem;
            cursor: pointer;
            background: #fff;
            transition: border-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
            min-height: 56px;
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.08);
        }

        .identity-option:hover {
            border-color: #9aa0a6;
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.12);
            transform: translateY(-1px);
        }

        .identity-option-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 1px solid #dadce0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #fff;
        }

        .identity-option-icon img {
            width: 20px;
            height: 20px;
            object-fit: contain;
        }

        .identity-option-google {
            font-weight: 600;
            color: #1f2937;
        }

        .identity-option-label {
            flex: 1;
            text-align: center;
            font-size: 0.95rem;
        }

        .identity-option.connected {
            border-color: #34a853;
            box-shadow: 0 8px 24px rgba(52, 168, 83, 0.2);
        }

        .identity-option.connected .identity-option-icon {
            border-color: #34a853;
        }

        .identity-option-status {
            font-size: 0.8rem;
            font-weight: 600;
            color: #34a853;
        }

        .identity-option:not(.connected) .identity-option-status {
            display: none;
        }

        .identity-readonly {
            background: #f8fafc;
            cursor: not-allowed;
        }

        .identity-divider {
            position: relative;
            text-align: center;
            margin: 1rem 0;
            color: var(--text-muted, #94a3b8);
            font-size: 0.85rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .identity-divider::before,
        .identity-divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 40%;
            height: 1px;
            background: var(--border, #e2e8f0);
        }

        .identity-divider::before {
            left: 0;
        }

        .identity-divider::after {
            right: 0;
        }

        .draft-notice {
            display: none;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            background: #fef9c3;
            border: 1px solid #fcd34d;
            color: #854d0e;
            font-size: 0.85rem;
            font-weight: 600;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .draft-notice button {
            border: none;
            background: #fb923c;
            color: #fff;
            font-weight: 600;
            border-radius: 999px;
            padding: 0.2rem 0.8rem;
            cursor: pointer;
            font-size: 0.78rem;
        }

        .draft-notice button:hover {
            background: #f97316;
        }

        .identity-divider[hidden] {
            display: none;
        }

        .manual-identity {
            margin-top: 0.5rem;
        }

        .manual-identity-controls {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 1.25rem;
            padding: 0.5rem 0.25rem;
            font-weight: 600;
            color: #1f2937;
        }

        .manual-identity-close {
            border: none;
            background: none;
            color: #ef4444;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            cursor: pointer;
        }

        .manual-identity-close:hover {
            color: #b91c1c;
        }

        .identity-email-toggle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            margin: 0 auto 0;
            padding: 0.35rem 0.75rem;
            border: none;
            background: none;
            color: #2563eb;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: underline;
                width: 100%;
        }

        .identity-email-toggle:hover {
            color: #1e3a8a;
        }

        .modal-footer {
            padding: 1rem 1.5rem;
            background: var(--surface-elevated, #f8fafc);
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
            border-top: 1px solid var(--border-light, #f1f5f9);
        }

        .btn-cancel {
            background: var(--surface, #ffffff);
            color: var(--text-secondary, #475569);
            border: 1px solid var(--border, #e2e8f0);
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-cancel:hover {
            background: var(--surface-elevated, #f8fafc);
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--gradient-start, #3ba14c) 0%, var(--gradient-end, #2d8f3e) 100%);
            color: #fff;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-submit:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 161, 76, 0.35);
        }

        .btn-submit:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .spinner {
            width: 16px;
            height: 16px;
            border: 2px solid transparent;
            border-top-color: currentColor;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
            display: inline-block;
            margin-right: 0.5rem;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }





        .google-btn {
    width: 100%;
    height: 39px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;

    background: #ffffff;
    color: #3c4043;

    border: 1px solid #dadce0;
    border-radius: 999px;

    font-size: 16px;
    font-weight: 500;
    font-family: "Roboto", Arial, sans-serif;

    cursor: pointer;
    transition: background-color 0.2s ease, box-shadow 0.2s ease;
}

.google-btn img {
    width: 20px;
    height: 20px;
}

.google-btn:hover {
    background-color: #f7f8f8;
    box-shadow: 0 1px 2px rgba(60,64,67,.3),
                0 1px 3px rgba(60,64,67,.15);
}

.google-btn:active {
    background-color: #eeeeee;
}

.google-btn:disabled {
    cursor: not-allowed;
    opacity: 0.6;
}

/* Connected state */
.google-btn.connected {
    border-color: #34a853;
    color: #34a853;
    font-weight: 600;
}



.google-btn {
    width: 100%;
    height: 39px;
      max-width: 252px;
    display: flex;
    align-items: center;

    padding: 0 16px;

    background: #ffffff;
    color: #3c4043;

    border: 1px solid #dadce0;
    border-radius: 999px;

    font-size: 16px;
    font-weight: 500;
    font-family: "Roboto", Arial, sans-serif;

    cursor: pointer;
    transition: background-color 0.2s ease, box-shadow 0.2s ease;
}

/* Google logo – LEFT SIDE */
.google-btn img {
    width: 20px;
    height: 20px;
    margin-right: 12px;
}

/* Text center jaisa feel kare */
.google-btn span {
    flex: 1;
    text-align: center;
    margin-right: 20px; /* logo ke balance ke liye */
}

.google-btn:hover {
    background-color: #f7f8f8;
    box-shadow: 0 1px 2px rgba(60,64,67,.3),
                0 1px 3px rgba(60,64,67,.15);
}

.google-btn:active {
    background-color: #eeeeee;
}

.google-btn:disabled {
    cursor: not-allowed;
    opacity: 0.6;
}

/* Connected state */
.google-btn.connected {
    border-color: #34a853;
    color: #34a853;
    font-weight: 600;
}

.google-center {
    display: flex;
    justify-content: center;
}
    </style>
@endonce

@once
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endonce

<div id="{{ $modalId }}" class="modal-overlay" data-review-modal>
    <div class="modal-container">
        <div class="modal-header">
            <h3>Write a Review</h3>
            <button class="modal-close close-btn" type="button">&times;</button>
        </div>
        <form id="{{ $modalId }}Form" method="POST" action="{{ route('reviews.store') }}">
            @csrf
            <input type="hidden" name="company_id" id="{{ $modalId }}CompanyId">
            @if($resolvedStateId)
                <input type="hidden" name="state_id" id="{{ $modalId }}StateId" value="{{ $resolvedStateId }}">
            @else
                <input type="hidden" name="state_id" id="{{ $modalId }}StateId" value="">
            @endif
            <div class="modal-body">
                <div class="draft-notice" data-draft-notice hidden>
                    <span data-draft-message>We restored your review draft.</span>
                    <button type="button" data-draft-clear>Clear draft</button>
                </div>
                @if($allowCompanySelection)
                    <div class="form-group" data-company-select-wrapper style="display: none;">
                        <label class="form-label" for="{{ $modalId }}CompanySelect">Select Company *</label>
                        <select id="{{ $modalId }}CompanySelect" class="form-select" data-company-select {{ $companies->isEmpty() ? 'disabled' : '' }}>
                            <option value="">Select Company</option>
                            @foreach($companies as $companyOption)
                                <option value="{{ $companyOption->id }}">{{ $companyOption->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <input type="hidden" name="category_id" id="{{ $modalId }}CategoryId">
                
                <div class="form-group">
                    <label class="form-label">Rate your experience with <span id="{{ $modalId }}CompanyName">this company</span> *</label>
                    <div class="modal-rating-stars" data-review-stars>
                        @for($i = 1; $i <= 5; $i++)
                            <i class="far fa-star" data-rating="{{ $i }}"></i>
                        @endfor
                        <input type="hidden" name="rating" id="{{ $modalId }}Rating" required>
                    </div>
                </div>

                @php
                    $experienceMetrics = [
                        'Sales process',
                        'Price charged as quoted',
                        'On schedule',
                        'Installation quality',
                        'After sales support',
                    ];
                @endphp
                <div class="form-group">
                    <label class="form-label">Tell us more about your experience - rate the following (optional)</label>
                    <div class="row row-cols-1 row-cols-md-2 g-3 multi-rating">
                        @foreach($experienceMetrics as $metric)
                            @php
                                $metricSlug = \Illuminate\Support\Str::slug($metric, '_');
                            @endphp
                            <div class="col">
                                <div class="rating-field rating-field-sm">
                                    <label class="form-label small mb-1">{{ $metric }}</label>
                                    <div class="metric-stars" data-metric-stars>
                                        @for($i = 1; $i <= 5; $i++)
                                            @php
                                                $metricInputId = $modalId . '-' . $metricSlug . '-rating-' . $i;
                                            @endphp
                                            <button type="button" class="metric-star-btn" data-metric-star data-value="{{ $i }}" aria-label="{{ $i }} stars">
                                                <i class="far fa-star"></i>
                                            </button>
                                        @endfor
                                        <input type="hidden" name="metrics[{{ $metricSlug }}]" data-metric-input>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="{{ $modalId }}ReviewTitle">Review Title (Optional)</label>
                    <input type="text" id="{{ $modalId }}ReviewTitle" name="review_title" class="form-input" placeholder="Summarize your experience">
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="{{ $modalId }}ReviewText">Your Review *</label>
                    <textarea id="{{ $modalId }}ReviewText" name="review_text" class="form-textarea" required placeholder="Share details of your experience..."></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Add photos of your system <span>(optional, jpg/png, max 5MB)</span></label>
                    <div class="upload-box" data-upload-box>
                        <p class="mb-2 fw-semibold text-dark">Add or drop a file here</p>
                        <p class="small text-muted mb-3">Images help your review stand out.</p>
                        <input type="file" class="form-control" name="photos[]" accept="image/png,image/jpeg" multiple data-photo-input>
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" name="media_terms" id="{{ $modalId }}MediaTerms">
                            <label class="form-check-label" for="{{ $modalId }}MediaTerms">I agree to media upload terms</label>
                        </div>
                    </div>
                </div>

                <button type="button" class="system-toggle mt-3" data-system-toggle aria-expanded="false">
                    <span>
                        <i class="fas fa-plus"></i>
                        Add solar system details
                    </span>
                    <i class="fas fa-chevron-down toggle-chevron"></i>
                </button>
                <div class="subtle-card mt-3" data-system-details style="display: none;">
                    <h5 class="fw-semibold mb-3">Your solar system details</h5>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">System size (kW)</label>
                            <div class="input-group">
                                <input type="number" step="0.1" min="0" class="form-control" name="system_size" placeholder="e.g., 6.5">
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
                            <label class="form-label">Year installed</label>
                            <input type="number" class="form-control" name="year_installed" min="2000" max="{{ now()->year }}" value="{{ now()->year }}">
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

                <div class="subtle-card mt-4">
                    <h5 class="fw-semibold mb-3">How should we display your review?</h5>

                    <div
                        class="identity-status {{ $reviewProfile ? '' : 'd-none' }}"
                        data-identity-status
                        @unless($reviewProfile) hidden @endunless
                    >
                        <div>
                            <span data-identity-status-name>{{ $reviewProfile['name'] ?? 'Connected reviewer' }}</span>
                            <p class="mb-0 text-muted small" data-identity-status-email>{{ $reviewProfile['email'] ?? '' }}</p>
                        </div>
                        <!-- <button
                            type="button"
                            data-google-disconnect
                            data-google-disconnect-url="{{ route('reviews.session.logout') }}"
                        >
                            Disconnect
                        </button> -->
                    </div>

                    <div class="identity-options google-center">
                        <button
                            type="button"
                            class="google-btn {{ $reviewProfile ? 'connected' : '' }}"
                            data-google-login
                            data-google-redirect="{{ route('oauth.google.redirect') }}"
                            {{ $reviewProfile ? 'disabled' : '' }}
                        >
                            <img src="{{ asset('images/company/google.svg') }}" alt="Google logo">
                            <span>
                                {{ $reviewProfile ? 'Google connected' : 'Continue with Google' }}
                            </span>
                        </button>
                    </div>



                    <button
                        type="button"
                        class="identity-email-toggle"
                        data-show-manual-identity
                        @if($reviewProfile) hidden @endif
                    >
                        <i class="far fa-envelope"></i>
                        Continue with email
                    </button>
                    @if($reviewProfile)
                        <input type="hidden" name="manual_identity_optional" value="1">
                    @endif
                    <div class="identity-divider" data-manual-divider hidden>or continue manually</div>
                    <div class="manual-identity-controls" data-manual-controls hidden>
                        <span>Continuing with email</span>
                        <!-- <button type="button" class="manual-identity-close" data-hide-manual-identity>
                            <i class="fas fa-times"></i>
                            Cancel
                        </button> -->
                    </div>
                    <!-- Phone number field - always visible -->
                    <div class="row g-3 mt-3">
                        <div class="col-12">
                            <label class="form-label">Phone Number *</label>
                            <input
                                type="tel"
                                class="form-control"
                                name="phone_number"
                                placeholder="Enter your phone number"
                                required
                                pattern="[0-9]{10,15}"
                                title="Please enter a valid phone number (10-15 digits)"
                                data-phone-input
                            >
                            <small class="text-muted d-block mt-1">
                                We'll only use this to verify your identity if needed.
                            </small>
                        </div>
                    </div>
                    <div class="row g-3 manual-identity" data-manual-identity hidden>
                        <div class="col-md-6">
                            <label class="form-label">Choose a display name *</label>
                            <input
                                type="text"
                                class="form-control {{ $reviewProfile ? 'identity-readonly' : '' }}"
                                name="reviewer_name"
                                placeholder="e.g., Priya M."
                                value="{{ old('reviewer_name', $reviewProfile['name'] ?? '') }}"
                                {{ $reviewProfile ? 'readonly' : '' }}
                                data-identity-name
                                data-profile-default="{{ $reviewProfile['name'] ?? '' }}"
                                @unless($reviewProfile) required @endunless
                            >
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Add email address *</label>
                            <div class="otp-email-group" data-otp-email-group>
                                <input
                                    type="email"
                                    class="form-control {{ $reviewProfile ? 'identity-readonly' : '' }}"
                                    name="email"
                                    placeholder="name@email.com"
                                    value="{{ old('email', $reviewProfile['email'] ?? '') }}"
                                    {{ $reviewProfile ? 'readonly' : '' }}
                                    data-identity-email
                                    data-profile-default="{{ $reviewProfile['email'] ?? '' }}"
                                    data-otp-email-input
                                    @unless($reviewProfile) required @endunless
                                >
                                <button
                                    type="button"
                                    class="btn-otp"
                                    data-send-otp-btn
                                    {{ $reviewProfile ? 'disabled' : '' }}
                                >
                                    Send OTP
                                </button>
                            </div>
                            <small class="text-muted d-block mt-1">
                                We only email you about this review.
                                <span class="text-secondary d-block">Testing fallback OTP: <strong>123456</strong></span>
                            </small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Your state *</label>
                            <select class="form-select" name="user_state" @unless($reviewProfile) required @endunless>
                                <option value="" selected disabled>Select state</option>
                                @foreach($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Your city *</label>
                            <input type="text" class="form-control" name="user_city" placeholder="City" @unless($reviewProfile) required @endunless>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Verification code *</label>
                            <div class="otp-field-group" data-otp-wrapper {{ $reviewProfile ? 'hidden' : '' }}>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter 6-digit code"
                                    maxlength="6"
                                    data-otp-input
                                    @unless($reviewProfile) required @endunless
                                >
                                <button type="button" class="btn-otp" data-verify-otp-btn>Verify OTP</button>
                            </div>
                            <small class="text-muted d-block mt-1" data-otp-status hidden>
                                We’ll send a verification code to your email.
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel cancel-btn">Cancel</button>
                <button type="submit" class="btn-submit" data-review-submit>Submit Review</button>
            </div>
        </form>
    </div>
</div>

<script>
    (function () {
        function initReviewModal() {
        const modalId = '{{ $modalId }}';
        const modal = document.getElementById(modalId);
        if (!modal) return;

        const config = {
            triggerSelector: @json($triggerSelector),
            defaultStateId: '{{ $resolvedStateId ?? '' }}',
            defaultStateName: '{{ $resolvedStateName ?? '' }}',
            modalId,
        };

        const form = modal.querySelector('form');
        const hasConnectedProfile = @json((bool) $reviewProfile);
        const companyIdInput = document.getElementById(`${modalId}CompanyId`);
        const companyNameDisplay = document.getElementById(`${modalId}CompanyName`);
        const companySelectWrapper = modal.querySelector('[data-company-select-wrapper]');
        const companySelect = modal.querySelector('[data-company-select]');
        const stateIdInput = document.getElementById(`${modalId}StateId`);
        const ratingStars = modal.querySelectorAll('[data-review-stars] i');
        const ratingInput = document.getElementById(`${modalId}Rating`);
        const metricGroups = modal.querySelectorAll('[data-metric-stars]');
        const categoryInput = document.getElementById(`${modalId}CategoryId`);
        const emailInput = document.querySelector(`[data-review-modal="#${modalId}"] [name="email"]`);
        const submitReviewBtn = modal.querySelector('[data-review-submit]');
        const closeBtn = modal.querySelector('.close-btn');
        const cancelBtn = modal.querySelector('.cancel-btn');
        const systemToggle = modal.querySelector('[data-system-toggle]');
        const systemToggleIcon = systemToggle ? systemToggle.querySelector('span i') : null;
        const systemDetails = modal.querySelector('[data-system-details]');
        const googleLoginBtn = modal.querySelector('[data-google-login]');
        const googleDisconnectBtn = modal.querySelector('[data-google-disconnect]');
        const manualIdentityToggle = modal.querySelector('[data-show-manual-identity]');
        const manualIdentity = modal.querySelector('[data-manual-identity]');
        const manualDivider = modal.querySelector('[data-manual-divider]');
        const manualControls = modal.querySelector('[data-manual-controls]');
        const manualHideBtn = modal.querySelector('[data-hide-manual-identity]');
        const draftNotice = modal.querySelector('[data-draft-notice]');
        const draftMessage = draftNotice ? draftNotice.querySelector('[data-draft-message]') : null;
        const draftClearBtn = draftNotice ? draftNotice.querySelector('[data-draft-clear]') : null;
        const draftStorageKey = `review_modal_draft_${modalId}`;
        const reopenStorageKey = `review_modal_reopen_${modalId}`;
        const DRAFT_VERSION = 1;
        const DRAFT_MAX_AGE = 1000 * 60 * 60 * 12; // 12 hours
        const storageSupported = (() => {
            try {
                const testKey = '__reviewDraftTest__';
                localStorage.setItem(testKey, '1');
                localStorage.removeItem(testKey);
                return true;
            } catch (error) {
                return false;
            }
        })();

        const draftStorage = {
            save(payload) {
                if (!storageSupported || !payload) return;
                localStorage.setItem(draftStorageKey, JSON.stringify(payload));
            },
            load() {
                if (!storageSupported) return null;
                const raw = localStorage.getItem(draftStorageKey);
                if (!raw) return null;
                try {
                    return JSON.parse(raw);
                } catch (error) {
                    localStorage.removeItem(draftStorageKey);
                    return null;
                }
            },
            clear() {
                if (!storageSupported) return;
                localStorage.removeItem(draftStorageKey);
            }
        };

        let draftSaveTimeout = null;
        let draftApplied = false;
        let isApplyingDraft = false;

        const manualCompanySelectionEnabled = !!companySelectWrapper && !!companySelect;
        const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
        const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';

        const triggerSelector = config.triggerSelector && config.triggerSelector !== 'null'
            ? config.triggerSelector
            : '';

        const otpEmailInput = modal.querySelector('[data-otp-email-input]');
        const otpSendBtn = modal.querySelector('[data-send-otp-btn]');
        const otpInput = modal.querySelector('[data-otp-input]');
        const otpVerifyBtn = modal.querySelector('[data-verify-otp-btn]');
        const otpStatus = modal.querySelector('[data-otp-status]');
        const reviewerNameInput = modal.querySelector('[data-identity-name]');
        const profileDefaults = {
            name: reviewerNameInput?.dataset.profileDefault ?? '',
            email: otpEmailInput?.dataset.profileDefault ?? ''
        };

        const triggerCandidates = [
            ...document.querySelectorAll(`[data-review-modal-trigger="${modalId}"]`)
        ];

        if (triggerSelector) {
            triggerCandidates.push(...document.querySelectorAll(triggerSelector));
        }

        const triggers = triggerCandidates.filter((element, index, self) => self.indexOf(element) === index);

        function setCompanyContext(companyId, companyName) {
            if (companyIdInput) companyIdInput.value = companyId || '';
            if (companyNameDisplay) companyNameDisplay.textContent = companyName || 'this company';
        }

        function setCategoryContext(categoryIdsCsv) {
            if (!categoryInput) return;

            const parsedIds = (categoryIdsCsv || '')
                .split(',')
                .map(id => id.trim())
                .filter(Boolean);

            categoryInput.value = parsedIds[0] || '';
        }

        function toggleCompanySelect(show) {
            if (!manualCompanySelectionEnabled) return;
            companySelectWrapper.style.display = show ? 'block' : 'none';
            companySelect.required = !!show;
            if (show) {
                companySelect.value = '';
            }
        }

        function setStateDisplay(stateId) {
            if (stateIdInput) stateIdInput.value = stateId || '';
        }

        function toggleSystemDetails(expanded) {
            if (!systemDetails || !systemToggle) return;

            systemDetails.style.display = expanded ? 'block' : 'none';
            systemToggle.setAttribute('aria-expanded', expanded ? 'true' : 'false');
            if (systemToggleIcon) {
                systemToggleIcon.classList.toggle('fa-plus', !expanded);
                systemToggleIcon.classList.toggle('fa-minus', expanded);
            }
            console.log(`[Review Modal] System details toggled: ${expanded}`);
        }

        if (systemToggle) {
            systemToggle.addEventListener('click', () => {
                const currentlyExpanded = systemToggle.getAttribute('aria-expanded') === 'true';
                toggleSystemDetails(!currentlyExpanded);
            });
        }

        const otpRoutes = {
            send: '{{ route('reviews.send-otp') }}',
            verify: '{{ route('reviews.verify-otp') }}',
        };

        let otpVerified = hasConnectedProfile;
        let otpSending = false;
        let otpVerifying = false;
        let otpAutoSendTimeout = null;
        let lastOtpEmail = '';

        const isValidEmail = (value = '') => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value.trim());

        const shouldRequireOtp = () => !!manualIdentity && !manualIdentity.hidden && !hasConnectedProfile;

        function updateSubmitState() {
            if (!submitReviewBtn) return;
            if (shouldRequireOtp() && !otpVerified) {
                submitReviewBtn.setAttribute('disabled', 'disabled');
            } else {
                submitReviewBtn.removeAttribute('disabled');
            }
        }

        function setOtpStatus(message, intent = 'info') {
            if (!otpStatus) return;
            otpStatus.hidden = false;
            otpStatus.classList.remove('text-success', 'text-danger', 'text-muted');
            const classMap = {
                success: 'text-success',
                danger: 'text-danger',
                info: 'text-muted',
            };
            otpStatus.classList.add(classMap[intent] || 'text-muted');
            otpStatus.textContent = message;
        }

        function clearOtpStatus() {
            if (!otpStatus) return;
            otpStatus.hidden = true;
            otpStatus.classList.remove('text-success', 'text-danger', 'text-muted');
            otpStatus.textContent = '';
        }

        function resetOtpFlow(options = { clearEmail: false }) {
            if (options.clearEmail && otpEmailInput && !otpEmailInput.readOnly) {
                otpEmailInput.value = '';
            }
            if (otpInput) {
                otpInput.value = '';
            }
            otpVerified = hasConnectedProfile;
            lastOtpEmail = options.clearEmail ? '' : lastOtpEmail;
            clearOtpStatus();
            updateSubmitState();
        }

        async function sendOtp(mode = 'manual') {
            if (!otpEmailInput || !otpSendBtn || !shouldRequireOtp() || otpSending) {
                return;
            }

            const emailValue = otpEmailInput.value.trim();
            if (!isValidEmail(emailValue)) {
                setOtpStatus('Please enter a valid email before requesting an OTP.', 'danger');
                return;
            }

            if (mode === 'auto' && emailValue === lastOtpEmail) {
                return;
            }

            otpSending = true;
            const initialText = otpSendBtn.textContent;
            otpSendBtn.textContent = mode === 'manual' ? 'Sending…' : initialText;
            otpSendBtn.setAttribute('disabled', 'disabled');
            setOtpStatus('Sending verification code…', 'info');

            try {
                const response = await fetch(otpRoutes.send, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({ email: emailValue }),
                });

                const data = await response.json().catch(() => ({}));
                if (!response.ok || !data.success) {
                    throw new Error(data.message || 'Unable to send OTP.');
                }

                lastOtpEmail = emailValue;
                setOtpStatus(data.message || 'OTP sent successfully. Use 123456 if email does not arrive.', 'success');
            } catch (error) {
                setOtpStatus(error.message || 'Unable to send OTP. Please try again.', 'danger');
            } finally {
                otpSending = false;
                otpSendBtn.removeAttribute('disabled');
                otpSendBtn.textContent = lastOtpEmail ? 'Resend OTP' : 'Send OTP';
            }
        }

        async function verifyOtp() {
            if (!shouldRequireOtp() || !otpVerifyBtn || otpVerifying) {
                return;
            }
            const emailValue = otpEmailInput ? otpEmailInput.value.trim() : '';
            const otpValue = otpInput ? otpInput.value.trim() : '';

            if (!isValidEmail(emailValue) || otpValue.length !== 6) {
                setOtpStatus('Enter both email and 6-digit code before verifying.', 'danger');
                return;
            }

            otpVerifying = true;
            const initialText = otpVerifyBtn.textContent;
            otpVerifyBtn.textContent = 'Verifying…';
            otpVerifyBtn.setAttribute('disabled', 'disabled');

            try {
                const response = await fetch(otpRoutes.verify, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        email: emailValue,
                        otp: otpValue,
                        reviewer_name: reviewerNameInput ? reviewerNameInput.value : null,
                    }),
                });

                const data = await response.json().catch(() => ({}));
                if (!response.ok || !data.success) {
                    throw new Error(data.message || 'OTP verification failed.');
                }

                otpVerified = true;
                setOtpStatus(data.message || 'OTP verified successfully.', 'success');
            } catch (error) {
                otpVerified = false;
                setOtpStatus(error.message || 'Unable to verify OTP. Please try again.', 'danger');
            } finally {
                otpVerifying = false;
                otpVerifyBtn.textContent = initialText;
                otpVerifyBtn.removeAttribute('disabled');
                updateSubmitState();
            }
        }

        if (otpSendBtn && !otpSendBtn.disabled) {
            otpSendBtn.addEventListener('click', () => sendOtp('manual'));
        }

        if (otpVerifyBtn) {
            otpVerifyBtn.addEventListener('click', verifyOtp);
        }

        if (otpEmailInput && !otpEmailInput.readOnly) {
            otpEmailInput.addEventListener('input', () => {
                otpVerified = false;
                clearOtpStatus();
                if (otpAutoSendTimeout) {
                    clearTimeout(otpAutoSendTimeout);
                }
                if (!isValidEmail(otpEmailInput.value.trim())) {
                    updateSubmitState();
                    return;
                }
                otpAutoSendTimeout = setTimeout(() => sendOtp('auto'), 900);
                updateSubmitState();
            });
        }

        if (otpInput) {
            otpInput.addEventListener('input', () => {
                otpVerified = false;
                updateSubmitState();
            });
        }

        function enforceConnectedProfileState() {
            if (!hasConnectedProfile) return;

            if (reviewerNameInput) {
                reviewerNameInput.value = profileDefaults.name || reviewerNameInput.value || '';
                reviewerNameInput.removeAttribute('required');
            }
            if (otpEmailInput) {
                otpEmailInput.value = profileDefaults.email || otpEmailInput.value || '';
                otpEmailInput.removeAttribute('required');
            }
            if (otpInput) {
                otpInput.value = '';
                otpInput.removeAttribute('required');
            }
            manualIdentity?.setAttribute('hidden', '');
            if (manualIdentity) {
                manualIdentity.hidden = true;
            }
            manualDivider?.setAttribute('hidden', '');
            manualControls?.setAttribute('hidden', '');
            if (manualIdentityToggle) {
                manualIdentityToggle.style.display = 'none';
            }
            if (otpSendBtn) otpSendBtn.disabled = true;
            if (otpVerifyBtn) otpVerifyBtn.disabled = true;
            clearOtpStatus();
            otpVerified = true;
            updateSubmitState();
        }

        function showManualIdentityFields() {
            if (!manualIdentity || hasConnectedProfile) return;

            manualIdentity.hidden = false;
            manualDivider?.removeAttribute('hidden');
            manualControls?.removeAttribute('hidden');
            if (manualIdentityToggle) {
                manualIdentityToggle.style.display = 'none';
            }

            const firstManualInput = manualIdentity.querySelector('input, select, textarea');
            if (firstManualInput) {
                requestAnimationFrame(() => firstManualInput.focus());
            }
            scheduleDraftSave();
            if (!hasConnectedProfile) {
                setOtpStatus('We’ll send a verification code to your email.', 'info');
            }
            updateSubmitState();
        }

        function resetManualIdentity() {
            if (!manualIdentity) return;

            manualIdentity.hidden = true;
            manualDivider?.setAttribute('hidden', '');
            manualControls?.setAttribute('hidden', '');
            if (manualIdentityToggle) {
                manualIdentityToggle.style.display = hasConnectedProfile ? 'none' : '';
            }
            scheduleDraftSave();
            resetOtpFlow();
            updateSubmitState();
        }

        function resetForm() {
            if (form) form.reset();
            if (ratingInput) ratingInput.value = '';
            ratingStars.forEach(star => {
                star.classList.remove('active', 'fas');
                star.classList.add('far');
            });
            metricGroups.forEach(group => {
                const buttons = group.querySelectorAll('[data-metric-star]');
                const hiddenInput = group.querySelector('[data-metric-input]');
                if (hiddenInput) hiddenInput.value = '';

                buttons.forEach(btn => {
                    const starIcon = btn.querySelector('i');
                    if (!starIcon) return;
                    starIcon.classList.remove('active', 'fas');
                    starIcon.classList.add('far');
                });
            });
            otpSent = false;
            otpVerified = false;
            // if (submitReviewBtn) submitReviewBtn.disabled = true;
            toggleSystemDetails(false);

            if (manualCompanySelectionEnabled) {
                toggleCompanySelect(true);
            }
            setCompanyContext('', 'this company');
            if (stateIdInput) stateIdInput.value = '';
            resetManualIdentity();
            enforceConnectedProfileState();
            hideDraftNotice();
            draftApplied = false;
        }

        function openModal(trigger) {
            if (!modal) return;

            resetForm();

            const dataset = trigger ? trigger.dataset : {};
            const companyId = dataset.companyId || '';
            const companyName = dataset.companyName || 'this company';
            const categoryIds = dataset.categoryIds || '';
            const stateId = dataset.stateId || config.defaultStateId || '';
            const stateName = dataset.stateName || config.defaultStateName || 'State';

            setCategoryContext(categoryIds);
            setStateDisplay(stateId);

            if (manualCompanySelectionEnabled) {
                if (companyId) {
                    toggleCompanySelect(false);
                    setCompanyContext(companyId, companyName);
                } else {
                    toggleCompanySelect(true);
                    setCompanyContext('', 'this company');
                }
            } else {
                setCompanyContext(companyId, companyName);
            }

            modal.style.display = 'flex';
            const primaryCategoryId = categoryInput ? categoryInput.value : '';
            restoreDraftIfAvailable({
                expectedContext: {
                    companyId: companyId || '',
                    companyName: companyName || '',
                    stateId: stateId || '',
                    categoryId: primaryCategoryId || '',
                },
            });
            enforceConnectedProfileState();
        }

        triggers.forEach(trigger => {
            trigger.addEventListener('click', function (event) {
                event.preventDefault();
                openModal(trigger);
            });
        });

        if (googleLoginBtn) {
            googleLoginBtn.addEventListener('click', () => {
                persistDraftNow(true);
                try {
                    sessionStorage.setItem(reopenStorageKey, '1');
                } catch (error) {
                    // ignore storage errors
                }

                const redirectUrl = googleLoginBtn.getAttribute('data-google-redirect');
                if (!redirectUrl) return;

                const currentUrl = window.location.href;
                const separator = redirectUrl.includes('?') ? '&' : '?';
                const target = `${redirectUrl}${separator}return_url=${encodeURIComponent(currentUrl)}`;
                window.location.href = target;
            });
        }

        if (googleDisconnectBtn) {
            googleDisconnectBtn.addEventListener('click', () => {
                const disconnectUrl = googleDisconnectBtn.getAttribute('data-google-disconnect-url');
                if (!disconnectUrl || !csrfToken) return;

                googleDisconnectBtn.disabled = true;
                fetch(disconnectUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                })
                    .then(() => window.location.reload())
                    .catch(() => {
                        googleDisconnectBtn.disabled = false;
                        Swal.fire('Error', 'Could not disconnect Google right now.', 'error');
                    });
            });
        }

        ratingStars.forEach(star => {
            star.addEventListener('click', function () {
                const rating = parseInt(this.getAttribute('data-rating'), 10);
                ratingInput.value = rating;

                ratingStars.forEach((s, index) => {
                    if (index < rating) {
                        s.classList.add('active', 'fas');
                        s.classList.remove('far');
                    } else {
                        s.classList.remove('active', 'fas');
                        s.classList.add('far');
                    }
                });
            });
        });

        metricGroups.forEach(group => {
            const buttons = group.querySelectorAll('[data-metric-star]');
            const hiddenInput = group.querySelector('[data-metric-input]');

            buttons.forEach(button => {
                button.addEventListener('click', function () {
                    const value = parseInt(this.getAttribute('data-value'), 10);
                    if (hiddenInput) hiddenInput.value = value;

                    buttons.forEach(btn => {
                        const starIcon = btn.querySelector('i');
                        if (!starIcon) return;

                        if (parseInt(btn.getAttribute('data-value'), 10) <= value) {
                            starIcon.classList.add('active', 'fas');
                            starIcon.classList.remove('far');
                        } else {
                            starIcon.classList.remove('active', 'fas');
                            starIcon.classList.add('far');
                        }
                    });
                    scheduleDraftSave();
                });
            });
        });

        if (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();

                submitReviewBtn.disabled = true;
                submitReviewBtn.innerHTML = '<span class="spinner"></span> Submitting...';

                if (shouldRequireOtp() && !otpVerified) {
                    Swal.fire('Verification needed', 'Please verify the OTP sent to your email before submitting.', 'warning');
                    submitReviewBtn.disabled = false;
                    submitReviewBtn.innerHTML = 'Submit Review';
                    return;
                }

                const formData = new FormData(form);
                if (emailInput && emailInput.value) {
                    formData.set('email', emailInput.value);
                }

                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.redirect) {
                        // Store the success message in the session before redirecting
                        sessionStorage.setItem('showSuccessMessage', data.message);
                        window.location.href = data.redirect;
                    } else {
                        // Redirect to profile reviews page after successful submission
                        sessionStorage.setItem('showSuccessMessage', data.message || 'Review submitted successfully!');
                        window.location.href = '{{ route("normal-user.reviews.index") }}';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error', 'Failed to submit review. Please try again.', 'error');
                    submitReviewBtn.disabled = false;
                    submitReviewBtn.innerHTML = 'Submit Review';
                });
            });
        }

        function closeModal() {
            modal.style.display = 'none';
            resetForm();
        }

        if (closeBtn) closeBtn.addEventListener('click', closeModal);
        if (cancelBtn) cancelBtn.addEventListener('click', closeModal);

        window.addEventListener('click', function (event) {
            if (event.target === modal) {
                closeModal();
            }
        });

        if (manualIdentityToggle) {
            manualIdentityToggle.addEventListener('click', showManualIdentityFields);
        }

        if (manualHideBtn) {
            manualHideBtn.addEventListener('click', () => {
                resetManualIdentity();
                scheduleDraftSave();
            });
        }

        if (draftClearBtn) {
            draftClearBtn.addEventListener('click', () => {
                draftStorage.clear();
                hideDraftNotice();
                resetForm();
            });
        }

        if (form) {
            const handleFormMutation = () => scheduleDraftSave();
            form.addEventListener('input', handleFormMutation);
            form.addEventListener('change', handleFormMutation);
        }

        const shouldReopenModal = (() => {
            try {
                if (sessionStorage.getItem(reopenStorageKey) === '1') {
                    sessionStorage.removeItem(reopenStorageKey);
                    return true;
                }
            } catch (error) {
                // ignore
            }
            return false;
        })();

        if (shouldReopenModal) {
            resetForm();
            enforceConnectedProfileState();
            if (restoreDraftIfAvailable()) {
                modal.style.display = 'flex';
            }
        }

        function collectFormFields() {
            if (!form) return {};
            const data = {};
            const appendValue = (target, name, value) => {
                if (name === '_token') return;
                if (value instanceof File) return;
                if (target[name] === undefined) {
                    target[name] = value;
                } else if (Array.isArray(target[name])) {
                    target[name].push(value);
                } else {
                    target[name] = [target[name], value];
                }
            };

            const formData = new FormData(form);
            formData.forEach((value, key) => appendValue(data, key, value));

            Array.from(form.elements).forEach(element => {
                if (!element.name || element.disabled) return;
                if (element.type === 'file') return;

                if (element.type === 'checkbox') {
                    data[element.name] = element.checked;
                } else if (element.type === 'radio') {
                    if (element.checked) {
                        data[element.name] = element.value;
                    } else if (!(element.name in data)) {
                        data[element.name] = null;
                    }
                }
            });

            return data;
        }

        function hasMeaningfulData(fields) {
            return Object.values(fields).some(value => {
                if (value === null || value === undefined) return false;
                if (typeof value === 'boolean') return value;
                if (Array.isArray(value)) {
                    return value.some(entry => entry !== null && entry !== undefined && String(entry).trim() !== '');
                }
                return String(value).trim() !== '';
            });
        }

        function buildDraftPayload() {
            const fields = collectFormFields();
            if (!hasMeaningfulData(fields)) return null;

            return {
                version: DRAFT_VERSION,
                savedAt: Date.now(),
                fields,
                meta: {
                    manualIdentityVisible: manualIdentity ? !manualIdentity.hidden : false,
                    systemDetailsVisible: systemDetails ? systemDetails.style.display !== 'none' : false,
                },
                context: {
                    companyId: companyIdInput ? companyIdInput.value : '',
                    companyName: companyNameDisplay ? companyNameDisplay.textContent : '',
                    stateId: stateIdInput ? stateIdInput.value : '',
                    categoryId: categoryInput ? categoryInput.value : '',
                }
            };
        }

        function persistDraftNow(force = false) {
            const payload = buildDraftPayload();
            if (payload) {
                draftStorage.save(payload);
                if (force && draftNotice && draftNotice.hidden === true) {
                    showDraftNotice();
                }
            } else if (force) {
                draftStorage.clear();
            }
        }

        function scheduleDraftSave() {
            if (isApplyingDraft) return;
            clearTimeout(draftSaveTimeout);
            draftSaveTimeout = setTimeout(() => {
                const payload = buildDraftPayload();
                if (payload) {
                    draftStorage.save(payload);
                } else {
                    draftStorage.clear();
                    hideDraftNotice();
                }
            }, 600);
        }

        function contextMatches(draftContext = {}, expectedContext = {}) {
            if (!expectedContext) return true;
            const normalized = (value) => {
                if (value === null || value === undefined) return '';
                return String(value).trim();
            };
            const keys = ['companyId', 'companyName', 'stateId', 'categoryId'];
            return keys.every(key => {
                const expected = normalized(expectedContext[key]);
                if (!expected) return true;
                const draftValue = normalized(draftContext[key]);
                return draftValue === expected;
            });
        }

        function restoreDraftIfAvailable(options = {}) {
            const { expectedContext = null } = options;
            if (draftApplied) return false;
            const payload = draftStorage.load();
            if (!payload) return false;

            if (payload.version !== DRAFT_VERSION || (payload.savedAt && Date.now() - payload.savedAt > DRAFT_MAX_AGE)) {
                draftStorage.clear();
                return false;
            }

            if (expectedContext && !contextMatches(payload.context, expectedContext)) {
                return false;
            }

            isApplyingDraft = true;
            if (payload.context) {
                applyDraftContext(payload.context);
            }
            if (payload.fields) {
                applyDraftFields(payload.fields);
            }
            if (payload.meta) {
                applyDraftMeta(payload.meta);
            }
            isApplyingDraft = false;
            draftApplied = true;

            showDraftNotice();
            enforceConnectedProfileState();
            return true;
        }

        function applyDraftContext(context = {}) {
            if (context.companyId || context.companyName) {
                setCompanyContext(context.companyId, context.companyName);
            }
            if (context.stateId) {
                setStateDisplay(context.stateId);
            }
            if (context.categoryId && categoryInput) {
                categoryInput.value = context.categoryId;
            }
        }

        function applyDraftFields(fields = {}) {
            const isControlCollection = (control) => {
                return control instanceof RadioNodeList || control instanceof HTMLCollection || Array.isArray(control);
            };

            Object.entries(fields).forEach(([name, value]) => {
                if (!name) return;
                const control = form?.elements?.namedItem(name);
                if (!control) return;

                const handleSingleControl = (element, val) => {
                    if (!element) return;
                    if (element.type === 'checkbox') {
                        element.checked = Array.isArray(val)
                            ? val.some(item => item === element.value || item === true)
                            : !!val;
                        return;
                    }
                    if (element.type === 'radio') {
                        element.checked = val !== null && val !== undefined && element.value === String(val);
                        return;
                    }
                    if (element.tagName === 'SELECT' && element.multiple && Array.isArray(val)) {
                        Array.from(element.options).forEach(option => {
                            option.selected = val.includes(option.value);
                        });
                        return;
                    }
                    element.value = Array.isArray(val) ? (val[0] ?? '') : (val ?? '');
                };

                if (isControlCollection(control)) {
                    const controls = Array.from(control);
                    controls.forEach(ctrl => handleSingleControl(ctrl, value));
                } else {
                    handleSingleControl(control, value);
                }
            });

            updateSubmitState();
        refreshRatingVisual();
            refreshMetricVisuals();
        }

        function applyDraftMeta(meta = {}) {
            if (meta.manualIdentityVisible && !hasConnectedProfile) {
                showManualIdentityFields();
            }
            if (meta.systemDetailsVisible) {
                toggleSystemDetails(true);
            }
        }

        function refreshRatingVisual() {
            if (!ratingInput) return;
            const currentRating = parseInt(ratingInput.value || '0', 10);
            ratingStars.forEach((star, index) => {
                if (index < currentRating) {
                    star.classList.add('active', 'fas');
                    star.classList.remove('far');
                } else {
                    star.classList.remove('active', 'fas');
                    star.classList.add('far');
                }
            });
        }

        function refreshMetricVisuals() {
            metricGroups.forEach(group => {
                const buttons = group.querySelectorAll('[data-metric-star]');
                const hiddenInput = group.querySelector('[data-metric-input]');
                const value = hiddenInput ? parseInt(hiddenInput.value || '0', 10) : 0;

                buttons.forEach(btn => {
                    const starIcon = btn.querySelector('i');
                    if (!starIcon) return;

                    const btnValue = parseInt(btn.getAttribute('data-value'), 10);
                    if (btnValue <= value) {
                        starIcon.classList.add('active', 'fas');
                        starIcon.classList.remove('far');
                    } else {
                        starIcon.classList.remove('active', 'fas');
                        starIcon.classList.add('far');
                    }
                });
            });
        }

        function showDraftNotice(message = 'We restored your review draft.') {
            if (!draftNotice) return;
            draftNotice.hidden = false;
            draftNotice.style.display = 'flex';
            if (draftMessage) {
                draftMessage.textContent = message;
            }
        }

        function hideDraftNotice() {
            if (!draftNotice) return;
            draftNotice.hidden = true;
            draftNotice.style.display = 'none';
        }

        refreshRatingVisual();
        refreshMetricVisuals();
        enforceConnectedProfileState();

        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initReviewModal, { once: true });
        } else {
            initReviewModal();
        }
    })();
</script>
