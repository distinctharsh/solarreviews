@props([
    'categories' => collect(),
    'states' => collect(),
    'companies' => collect(),
    'defaultStateId' => null,
    'defaultStateName' => null,
    'defaultCompanyId' => null,
    'defaultCompanyName' => null,
    'modalId' => 'reviewModal',
    'triggerSelector' => '.btn-review',
    'allowCompanySelection' => false,
])

@php
    $resolvedStateId = $defaultStateId ?? data_get($state ?? null, 'id');
    $resolvedStateName = $defaultStateName ?? data_get($state ?? null, 'name');
    $resolvedCompanyId = $defaultCompanyId ?? null;
    $resolvedCompanyName = $defaultCompanyName ?? null;
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

        /* Company Search Styles */
        .company-search-wrapper {
            position: relative;
        }

        .company-selection-fixed .company-search-input {
            background: var(--surface-muted, #f1f5f9);
            cursor: not-allowed;
            opacity: 0.9;
        }

        .search-input-group {
            position: relative;
            display: flex;
            align-items: center;
        }

        .company-search-input {
            width: 100%;
            padding-right: 40px;
            font-size: 0.95rem;
            border: 2px solid var(--border-light, #e5e7eb);
            transition: all 0.3s ease;
        }

        .company-search-input:focus {
            border-color: var(--primary, #3ba14c);
            box-shadow: 0 0 0 3px rgba(59, 161, 76, 0.1);
        }

        .search-clear-btn {
            position: absolute;
            right: 12px;
            background: none;
            border: none;
            color: var(--text-muted, #6b7280);
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .search-clear-btn:hover {
            color: var(--text-primary, #0f172a);
            background: var(--border-light, #e5e7eb);
        }

        .company-search-results {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: var(--surface, #ffffff);
            border: 1px solid var(--border-light, #e5e7eb);
            border-radius: 12px;
            box-shadow: var(--shadow-lg, 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1));
            max-height: 320px;
            overflow-y: auto;
            z-index: 1050;
            margin-top: 4px;
        }

        .search-results-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 16px;
            border-bottom: 1px solid var(--border-light, #e5e7eb);
            background: var(--background-secondary, #f8fafc);
            border-radius: 12px 12px 0 0;
        }

        .results-count {
            font-size: 0.875rem;
            color: var(--text-muted, #6b7280);
            font-weight: 500;
        }

        .show-all-btn {
            background: var(--primary, #3ba14c);
            color: white;
            border: none;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .show-all-btn:hover {
            background: var(--primary-dark, #2d8f3e);
            transform: translateY(-1px);
        }

        .search-results-list {
            max-height: 240px;
            overflow-y: auto;
        }

        .search-result-item {
            padding: 12px 16px;
            cursor: pointer;
            transition: all 0.2s ease;
            border-bottom: 1px solid var(--border-light, #e5e7eb);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .search-result-item:last-child {
            border-bottom: none;
        }

        .search-result-item:hover {
            background: var(--background-secondary, #f8fafc);
        }

        .search-result-item.selected {
            background: var(--primary-light, #dcfce7);
            border-left: 3px solid var(--primary, #3ba14c);
        }

        .company-info {
            flex: 1;
        }

        .company-name {
            font-weight: 600;
            color: var(--text-primary, #0f172a);
            font-size: 0.95rem;
            margin-bottom: 2px;
        }

        .company-website {
            font-size: 0.8rem;
            color: var(--text-muted, #6b7280);
            text-decoration: none;
        }

        .company-website:hover {
            color: var(--primary, #3ba14c);
        }

        .no-results {
            padding: 20px 16px;
            text-align: center;
            color: var(--text-muted, #6b7280);
            font-size: 0.9rem;
        }

        .search-loading {
            padding: 20px 16px;
            text-align: center;
            color: var(--text-muted, #6b7280);
        }

        .search-loading i {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
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

        .review-text-wrapper {
            position: relative;
        }

        .review-mic-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 38px;
            height: 38px;
            border-radius: 999px;
            border: 2px solid var(--border, #e2e8f0);
            background: var(--surface, #ffffff);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .review-mic-btn:hover {
            border-color: var(--primary, #3ba14c);
        }

        .review-mic-btn.is-recording {
            background: rgba(220, 38, 38, 0.08);
            border-color: #dc2626;
            color: #dc2626;
        }

        .review-mic-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
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

        .metrics-accordion {
            display: grid;
            gap: 0.75rem;
        }

        .metrics-section {
            border: 1px solid rgba(15, 23, 42, 0.12);
            border-radius: 12px;
            background: #ffffff;
            overflow: hidden;
        }

        .metrics-section summary {
            list-style: none;
            cursor: pointer;
            padding: 0.75rem 0.9rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            font-weight: 700;
            color: #0f172a;
            background: #f8fafc;
        }

        .metrics-section summary::-webkit-details-marker {
            display: none;
        }

        .metrics-section summary .metrics-title {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .metrics-section summary .metrics-chevron {
            transition: transform 0.2s ease;
            opacity: 0.75;
        }

        .metrics-section[open] summary .metrics-chevron {
            transform: rotate(180deg);
        }

        .metrics-section .metrics-body {
            padding: 0.85rem 0.9rem;
        }

        .metrics-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0.9rem;
        }

        @media (min-width: 520px) {
            .metrics-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        .metric-select {
            width: 100%;
            padding: 0.65rem 0.85rem;
            border: 2px solid var(--border, #e2e8f0);
            border-radius: 10px;
            font-size: 0.9rem;
            background: #ffffff;
        }

        .metric-select:focus {
            outline: none;
            border-color: var(--primary, #3ba14c);
            box-shadow: 0 0 0 3px rgba(59, 161, 76, 0.1);
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
            width:100%;
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
            <input type="hidden" name="company_url" id="{{ $modalId }}CompanyUrl">
            <input type="hidden" name="manual_company_name" id="{{ $modalId }}ManualCompanyName">
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
                <div class="form-group">
                    <label class="form-label" for="{{ $modalId }}CompanySelect">Select Company *</label>
                    
                    <!-- Company Search Input -->
                    <div class="company-search-wrapper">
                        <div class="search-input-group">
                            <input 
                                type="text" 
                                id="{{ $modalId }}CompanySearch" 
                                class="form-input company-search-input" 
                                placeholder="Search for a company..."
                                autocomplete="off"
                            >
                            <button type="button" class="search-clear-btn" data-search-clear hidden>
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        
                        <!-- Search Results Dropdown -->
                        <div class="company-search-results" data-search-results style="display: none;">
                            <div class="search-results-header" data-results-header>
                                <span class="results-count" data-results-count>0 companies found</span>
                                <button type="button" class="show-all-btn" data-show-all hidden>Show All</button>
                            </div>
                            <div class="search-results-list" data-results-list>
                                <!-- Results will be populated here -->
                            </div>
                        </div>
                    </div>
                    
                    <!-- Hidden Select for Form Submission -->
                    <select id="{{ $modalId }}CompanySelect" class="form-select" data-company-select style="display: none;">
                        <option value="">-- Select Company --</option>
                        @foreach($companies as $companyOption)
                            <option value="{{ $companyOption['id'] ?? $companyOption->id }}" data-company-name="{{ $companyOption['name'] ?? $companyOption->owner_name }}" data-company-url="{{ $companyOption['website_url'] ?? $companyOption->website_url ?? '' }}">{{ $companyOption['name'] ?? $companyOption->owner_name }}</option>
                        @endforeach
                        <option value="other">Other Solar Company</option>
                    </select>
                </div>

                <div class="form-group" id="{{ $modalId }}ManualCompanyGroup" style="display: none;">
                    <label class="form-label" for="{{ $modalId }}ManualCompanyNameInput">Company Name *</label>
                    <input type="text" id="{{ $modalId }}ManualCompanyNameInput" class="form-input" placeholder="Enter company name" maxlength="255">
                    
                    <label class="form-label" for="{{ $modalId }}ManualCompanyUrlInput" style="margin-top: 0.5rem;">Company Website (Optional)</label>
                    <input type="url" id="{{ $modalId }}ManualCompanyUrlInput" class="form-input" placeholder="https://example.com" maxlength="255">
                </div>

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

                 <div class="form-group">
                    <label class="form-label" for="{{ $modalId }}ReviewTitle">Review Title (Optional)</label>
                    <input type="text" id="{{ $modalId }}ReviewTitle" name="review_title" class="form-input" placeholder="Summarize your experience">
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="{{ $modalId }}ReviewText">Your Review *</label>
                    <div class="review-text-wrapper">
                        <textarea id="{{ $modalId }}ReviewText" name="review_text" class="form-textarea" required placeholder="Share details of your experience..."></textarea>
                        <button type="button" class="review-mic-btn" data-review-mic aria-label="Voice input" title="Voice input">
                            <i class="fas fa-microphone"></i>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Tell us more about your experience - rate the following (optional)</label>
                    <div class="metrics-accordion">
                        <details class="metrics-section" open>
                            <summary>
                                <span class="metrics-title">A. Sales &amp; Commercial Experience</span>
                                <i class="fas fa-chevron-down metrics-chevron"></i>
                            </summary>
                            <div class="metrics-body">
                                <div class="metrics-grid">
                                    <div class="rating-field rating-field-sm">
                                        <label class="form-label small mb-1">Sales Process Experience</label>
                                        <div class="metric-stars" data-metric-stars>
                                            @for($i = 1; $i <= 5; $i++)
                                                <button type="button" class="metric-star-btn" data-metric-star data-value="{{ $i }}" aria-label="{{ $i }} stars">
                                                    <i class="far fa-star"></i>
                                                </button>
                                            @endfor
                                            <input type="hidden" name="metrics[sales_process_experience]" data-metric-input>
                                        </div>
                                    </div>
                                    <div class="rating-field rating-field-sm">
                                        <label class="form-label small mb-1">Price Charged vs Price Quoted</label>
                                        <div class="metric-stars" data-metric-stars>
                                            @for($i = 1; $i <= 5; $i++)
                                                <button type="button" class="metric-star-btn" data-metric-star data-value="{{ $i }}" aria-label="{{ $i }} stars">
                                                    <i class="far fa-star"></i>
                                                </button>
                                            @endfor
                                            <input type="hidden" name="metrics[price_charged_vs_quoted]" data-metric-input>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </details>

                        <details class="metrics-section">
                            <summary>
                                <span class="metrics-title">B. Project Execution &amp; Timelines</span>
                                <i class="fas fa-chevron-down metrics-chevron"></i>
                            </summary>
                            <div class="metrics-body">
                                <div class="metrics-grid">
                                    <div class="rating-field rating-field-sm">
                                        <label class="form-label small mb-1">Adherence to Project Schedule</label>
                                        <select class="metric-select" name="metrics[adherence_to_project_schedule]">
                                            <option value="">Select</option>
                                            <option value="on_time">On Time</option>
                                            <option value="0_30_days_delay">0–30 Days Delay</option>
                                            <option value="30_90_days_delay">30–90 Days Delay</option>
                                            <option value="90_plus_days_delay">90+ Days Delay</option>
                                        </select>
                                    </div>
                                    <div class="rating-field rating-field-sm">
                                        <label class="form-label small mb-1">Commissioning Timeliness</label>
                                        <div class="metric-stars" data-metric-stars>
                                            @for($i = 1; $i <= 5; $i++)
                                                <button type="button" class="metric-star-btn" data-metric-star data-value="{{ $i }}" aria-label="{{ $i }} stars">
                                                    <i class="far fa-star"></i>
                                                </button>
                                            @endfor
                                            <input type="hidden" name="metrics[commissioning_timeliness]" data-metric-input>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </details>

                        <details class="metrics-section">
                            <summary>
                                <span class="metrics-title">C. Design &amp; Engineering</span>
                                <i class="fas fa-chevron-down metrics-chevron"></i>
                            </summary>
                            <div class="metrics-body">
                                <div class="metrics-grid">
                                    <div class="rating-field rating-field-sm">
                                        <label class="form-label small mb-1">Smart System Design</label>
                                        <div class="metric-stars" data-metric-stars>
                                            @for($i = 1; $i <= 5; $i++)
                                                <button type="button" class="metric-star-btn" data-metric-star data-value="{{ $i }}" aria-label="{{ $i }} stars">
                                                    <i class="far fa-star"></i>
                                                </button>
                                            @endfor
                                            <input type="hidden" name="metrics[smart_system_design]" data-metric-input>
                                        </div>
                                    </div>
                                    <div class="rating-field rating-field-sm">
                                        <label class="form-label small mb-1">Space Utilisation Efficiency</label>
                                        <div class="metric-stars" data-metric-stars>
                                            @for($i = 1; $i <= 5; $i++)
                                                <button type="button" class="metric-star-btn" data-metric-star data-value="{{ $i }}" aria-label="{{ $i }} stars">
                                                    <i class="far fa-star"></i>
                                                </button>
                                            @endfor
                                            <input type="hidden" name="metrics[space_utilisation_efficiency]" data-metric-input>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </details>

                        <details class="metrics-section">
                            <summary>
                                <span class="metrics-title">D. Installation &amp; Quality</span>
                                <i class="fas fa-chevron-down metrics-chevron"></i>
                            </summary>
                            <div class="metrics-body">
                                <div class="metrics-grid">
                                    <div class="rating-field rating-field-sm">
                                        <label class="form-label small mb-1">Installation Quality &amp; Workmanship</label>
                                        <div class="metric-stars" data-metric-stars>
                                            @for($i = 1; $i <= 5; $i++)
                                                <button type="button" class="metric-star-btn" data-metric-star data-value="{{ $i }}" aria-label="{{ $i }} stars">
                                                    <i class="far fa-star"></i>
                                                </button>
                                            @endfor
                                            <input type="hidden" name="metrics[installation_quality_workmanship]" data-metric-input>
                                        </div>
                                    </div>
                                    <div class="rating-field rating-field-sm">
                                        <label class="form-label small mb-1">Material Quality</label>
                                        <div class="metric-stars" data-metric-stars>
                                            @for($i = 1; $i <= 5; $i++)
                                                <button type="button" class="metric-star-btn" data-metric-star data-value="{{ $i }}" aria-label="{{ $i }} stars">
                                                    <i class="far fa-star"></i>
                                                </button>
                                            @endfor
                                            <input type="hidden" name="metrics[material_quality]" data-metric-input>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </details>

                        <details class="metrics-section">
                            <summary>
                                <span class="metrics-title">E. Performance &amp; Maintenance</span>
                                <i class="fas fa-chevron-down metrics-chevron"></i>
                            </summary>
                            <div class="metrics-body">
                                <div class="metrics-grid">
                                    <div class="rating-field rating-field-sm">
                                        <label class="form-label small mb-1">Plant Generation Performance</label>
                                        <select class="metric-select" name="metrics[plant_generation_performance]">
                                            <option value="">Select</option>
                                            <option value="as_committed">As Committed</option>
                                            <option value="plus_minus_5_percent_variation">±5% Variation</option>
                                            <option value="plus_minus_10_percent_variation">±10% Variation</option>
                                            <option value="plus_minus_20_percent_or_more">±20% or More</option>
                                        </select>
                                    </div>
                                    <div class="rating-field rating-field-sm">
                                        <label class="form-label small mb-1">O&amp;M Schedule Adherence</label>
                                        <select class="metric-select" name="metrics[om_schedule_adherence]">
                                            <option value="">Select</option>
                                            <option value="stable">Stable</option>
                                            <option value="inconsistent">Inconsistent</option>
                                            <option value="not_applicable_unknown">Not Applicable / Unknown</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </details>

                        <details class="metrics-section">
                            <summary>
                                <span class="metrics-title">F. Process &amp; Approvals</span>
                                <i class="fas fa-chevron-down metrics-chevron"></i>
                            </summary>
                            <div class="metrics-body">
                                <div class="metrics-grid">
                                    <div class="rating-field rating-field-sm">
                                        <label class="form-label small mb-1">Documentation Quality &amp; Timeliness</label>
                                        <div class="metric-stars" data-metric-stars>
                                            @for($i = 1; $i <= 5; $i++)
                                                <button type="button" class="metric-star-btn" data-metric-star data-value="{{ $i }}" aria-label="{{ $i }} stars">
                                                    <i class="far fa-star"></i>
                                                </button>
                                            @endfor
                                            <input type="hidden" name="metrics[documentation_quality_timeliness]" data-metric-input>
                                        </div>
                                    </div>
                                    <div class="rating-field rating-field-sm">
                                        <label class="form-label small mb-1">Subsidy Approval Experience</label>
                                        <div class="metric-stars" data-metric-stars>
                                            @for($i = 1; $i <= 5; $i++)
                                                <button type="button" class="metric-star-btn" data-metric-star data-value="{{ $i }}" aria-label="{{ $i }} stars">
                                                    <i class="far fa-star"></i>
                                                </button>
                                            @endfor
                                            <input type="hidden" name="metrics[subsidy_approval_experience]" data-metric-input>
                                        </div>
                                    </div>
                                    <div class="rating-field rating-field-sm">
                                        <label class="form-label small mb-1">Net Metering Process Experience</label>
                                        <div class="metric-stars" data-metric-stars>
                                            @for($i = 1; $i <= 5; $i++)
                                                <button type="button" class="metric-star-btn" data-metric-star data-value="{{ $i }}" aria-label="{{ $i }} stars">
                                                    <i class="far fa-star"></i>
                                                </button>
                                            @endfor
                                            <input type="hidden" name="metrics[net_metering_process_experience]" data-metric-input>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </details>

                        <details class="metrics-section">
                            <summary>
                                <span class="metrics-title">G. Customer Support &amp; Team</span>
                                <i class="fas fa-chevron-down metrics-chevron"></i>
                            </summary>
                            <div class="metrics-body">
                                <div class="metrics-grid">
                                    <div class="rating-field rating-field-sm">
                                        <label class="form-label small mb-1">After-Sales Support</label>
                                        <div class="metric-stars" data-metric-stars>
                                            @for($i = 1; $i <= 5; $i++)
                                                <button type="button" class="metric-star-btn" data-metric-star data-value="{{ $i }}" aria-label="{{ $i }} stars">
                                                    <i class="far fa-star"></i>
                                                </button>
                                            @endfor
                                            <input type="hidden" name="metrics[after_sales_support]" data-metric-input>
                                        </div>
                                    </div>
                                    <div class="rating-field rating-field-sm">
                                        <label class="form-label small mb-1">Team Behaviour &amp; Professionalism</label>
                                        <div class="metric-stars" data-metric-stars>
                                            @for($i = 1; $i <= 5; $i++)
                                                <button type="button" class="metric-star-btn" data-metric-star data-value="{{ $i }}" aria-label="{{ $i }} stars">
                                                    <i class="far fa-star"></i>
                                                </button>
                                            @endfor
                                            <input type="hidden" name="metrics[team_behaviour_professionalism]" data-metric-input>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </details>

                        <details class="metrics-section">
                            <summary>
                                <span class="metrics-title">H. Overall Experience</span>
                                <i class="fas fa-chevron-down metrics-chevron"></i>
                            </summary>
                            <div class="metrics-body">
                                <div class="metrics-grid">
                                    <div class="rating-field rating-field-sm">
                                        <label class="form-label small mb-1">Overall Satisfaction</label>
                                        <div class="metric-stars" data-metric-stars>
                                            @for($i = 1; $i <= 5; $i++)
                                                <button type="button" class="metric-star-btn" data-metric-star data-value="{{ $i }}" aria-label="{{ $i }} stars">
                                                    <i class="far fa-star"></i>
                                                </button>
                                            @endfor
                                            <input type="hidden" name="metrics[overall_satisfaction]" data-metric-input>
                                        </div>
                                    </div>
                                    <div class="rating-field rating-field-sm">
                                        <label class="form-label small mb-1">Would you recommend us to others?</label>
                                        <select class="metric-select" name="metrics[would_recommend]">
                                            <option value="">Select</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </details>
                    </div>
                </div>
                
               

                <div class="form-group">
                    <label class="form-label">Add photos of your system <span>(optional, jpg/png/svg, max 5MB)</span></label>
                    <div class="upload-box" data-upload-box>
                        <p class="mb-2 fw-semibold text-dark">Add or drop a file here</p>
                        <p class="small text-muted mb-3">Images help your review stand out.</p>
                        <input type="file" class="form-control" name="photos[]" accept="image/png,image/jpeg,image/svg+xml" multiple data-photo-input>
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
                        <div class="col-md-6">
                            <label class="form-label">System size (kW)</label>
                            <div class="input-group">
                                <input type="number" step="0.1" min="0" class="form-control" name="system_size" placeholder="e.g., 6.5">
                                <span class="input-group-text">kW</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">System price <span>(optional)</span></label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="number" min="0" class="form-control" name="system_price" placeholder="Total cost">
                            </div>
                        </div>
                        <div class="col-md-6">
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

    <!-- Phone number field - conditionally required -->
                    <div class="my-3" id="phone_number_container">
                        <label class="form-label">
                            Phone Number 
                            @if(empty($reviewProfile['phone']))
                                <span class="text-danger">*</span>
                            @endif
                        </label>
                        <input
                            type="tel"
                            class="form-control"
                            name="phone_number"
                            id="phone_number_input"
                            placeholder="Enter your phone number"
                            {{ empty($reviewProfile['phone']) ? 'required' : '' }}
                            value="{{ $reviewProfile['phone'] ?? '' }}"
                            {{ !empty($reviewProfile['phone']) ? 'readonly' : '' }}
                            pattern="[0-9]{10}"
                            maxlength="10"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10)"
                            title="Please enter a valid 10-digit phone number"
                            data-phone-input
                        >
                        <small class="text-muted d-block mt-1">
                            We'll only use this to verify your identity if needed.
                        </small>
                    </div>


                @if(!$reviewProfile)
                <div class="subtle-card mt-4 subtle-card-main">
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
                    @unless($reviewProfile)
                    
                    @endunless
                    <div class="row g-3 manual-identity" data-manual-identity hidden>
                        <div class="col-md-6">
                            <label class="form-label">Choose a display name *</label>
                            <input
                                type="text"
                                class="form-control {{ $reviewProfile ? 'identity-readonly' : '' }}"
                                name="reviewer_name"
                                placeholder="e.g., Priya M."
                                value="{{ old('reviewer_name', $reviewProfile['name'] ?? (optional(auth()->user())->name ?? '')) }}"
                                {{ $reviewProfile ? 'readonly' : '' }}
                                data-identity-name
                                data-profile-default="{{ $reviewProfile['name'] ?? (optional(auth()->user())->name ?? '') }}"
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
                                    value="{{ old('email', $reviewProfile['email'] ?? (optional(auth()->user())->email ?? '')) }}"
                                    {{ $reviewProfile ? 'readonly' : '' }}
                                    data-identity-email
                                    data-profile-default="{{ $reviewProfile['email'] ?? (optional(auth()->user())->email ?? '') }}"
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
                @else
                    <input type="hidden" name="reviewer_name" value="{{ $reviewProfile['name'] }}">
                    <input type="hidden" name="email" value="{{ $reviewProfile['email'] }}">
                @endif
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn-cancel cancel-btn">Cancel</button> -->
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
            defaultCompanyId: '{{ $resolvedCompanyId ?? '' }}',
            defaultCompanyName: '{{ $resolvedCompanyName ?? '' }}',
            modalId,
        };

        // Debug logs
        console.log('Review Modal Config:', config);
        console.log('Modal Element:', modal);

        // Check for persisted company data from session storage
        const persistedCompanyId = sessionStorage.getItem(`reviewModal_companyId_${modalId}`);
        const persistedCompanyName = sessionStorage.getItem(`reviewModal_companyName_${modalId}`);
        
        if (persistedCompanyId && persistedCompanyName) {
            console.log('Found persisted data:', { persistedCompanyId, persistedCompanyName });
            
            // Apply persisted data after a short delay to ensure DOM is ready
            setTimeout(() => {
                const companyIdInput = document.getElementById(`${modalId}CompanyId`);
                const companyNameDisplay = document.getElementById(`${modalId}CompanyName`);
                const companySearchInput = document.getElementById(`${modalId}CompanySearch`);
                
                if (companyIdInput) companyIdInput.value = persistedCompanyId;
                if (companyNameDisplay) companyNameDisplay.textContent = persistedCompanyName;
                if (companySearchInput) companySearchInput.value = persistedCompanyName;
                
                // Restore company selection UI state
                if (manualCompanySelectionEnabled && persistedCompanyId && persistedCompanyId !== '0') {
                    // Select company in dropdown
                    companySelect.value = persistedCompanyId;
                    // Hide manual input and search results
                    toggleManualCompanyInput(false);
                    const searchResults = document.querySelector('[data-search-results]');
                    if (searchResults) {
                        searchResults.style.display = 'none';
                    }
                    console.log('Restored company selection UI state');
                }
                
                console.log('Applied persisted company data');
            }, 100);
        }

        const form = modal.querySelector('form');
        
        
        const hasConnectedProfile = @json((bool) $reviewProfile);
        const companyIdInput = document.getElementById(`${modalId}CompanyId`);
        const companyNameDisplay = document.getElementById(`${modalId}CompanyName`);
        const companySelect = modal.querySelector('[data-company-select]');
        const manualCompanyGroup = document.getElementById(`${modalId}ManualCompanyGroup`);
        const manualCompanyNameInput = document.getElementById(`${modalId}ManualCompanyNameInput`);
        const manualCompanyUrlInput = document.getElementById(`${modalId}ManualCompanyUrlInput`);
        const stateIdInput = document.getElementById(`${modalId}StateId`);
        const ratingStars = modal.querySelectorAll('[data-review-stars] i');
        const ratingInput = document.getElementById(`${modalId}Rating`);
        
        // Company Search Variables
        const companySearchInput = document.getElementById(`${modalId}CompanySearch`);
        const searchResults = modal.querySelector('[data-search-results]');
        const resultsList = modal.querySelector('[data-results-list]');
        const resultsHeader = modal.querySelector('[data-results-header]');
        const resultsCount = modal.querySelector('[data-results-count]');
        const showAllBtn = modal.querySelector('[data-show-all]');
        const searchClearBtn = modal.querySelector('[data-search-clear]');
        
        // Company Data
        let allCompanies = @json($companies);
        let filteredCompanies = [];
        let searchTimeout = null;
        let selectedIndex = -1;
        
        // Make companies array globally available
        window.allCompanies = allCompanies;
        const metricGroups = modal.querySelectorAll('[data-metric-stars]');
        const categoryInput = document.getElementById(`${modalId}CategoryId`);
        const emailInput = document.querySelector(`[data-review-modal="#${modalId}"] [name="email"]`);
        const reviewTextArea = document.getElementById(`${modalId}ReviewText`);
        const micBtn = modal.querySelector('[data-review-mic]');
        const submitReviewBtn = modal.querySelector('[data-review-submit]');
        const closeBtn = modal.querySelector('.close-btn');
        const cancelBtn = modal.querySelector('.cancel-btn');

        const SpeechRecognitionCtor = window.SpeechRecognition || window.webkitSpeechRecognition;
        let speechRecognition = null;
        let isRecording = false;
        let isStarting = false;
        let pendingRestart = false;
        let baseSpeechText = '';
        const isMobileSpeechEnv = /Android|iPhone|iPad|iPod/i.test(navigator.userAgent || '');

        const updateMicUi = () => {
            if (!micBtn) return;
            micBtn.classList.toggle('is-recording', isRecording);
            const icon = micBtn.querySelector('i');
            if (icon) {
                icon.classList.toggle('fa-microphone', !isRecording);
                icon.classList.toggle('fa-stop', isRecording);
            }
            micBtn.setAttribute('aria-label', isRecording ? 'Stop voice input' : 'Voice input');
            micBtn.setAttribute('title', isRecording ? 'Stop voice input' : 'Voice input');
        };

        const stopRecording = () => {
            pendingRestart = false;
            isStarting = false;
            if (!speechRecognition) {
                isRecording = false;
                updateMicUi();
                return;
            }
            try {
                speechRecognition.abort();
            } catch (error) {
                // ignore
            }
            isRecording = false;
            updateMicUi();
            try {
                speechRecognition.onresult = null;
                speechRecognition.onerror = null;
                speechRecognition.onend = null;
            } catch (error) {
                // ignore
            }
            speechRecognition = null;
        };

        const startRecording = () => {
            if (!SpeechRecognitionCtor || !reviewTextArea) return;
            if (isStarting) return;
            if (isRecording) return;
            isStarting = true;

            if (speechRecognition) {
                try {
                    console.log(speechRecognition);
                    speechRecognition.abort();
                } catch (error) {
                    // ignore
                    console.log(error);
                }
                try {
                    speechRecognition.onresult = null;
                    speechRecognition.onerror = null;
                    speechRecognition.onend = null;
                } catch (error) {
                    // ignore
                }
                speechRecognition = null;
            }

            speechRecognition = new SpeechRecognitionCtor();
            speechRecognition.continuous = !isMobileSpeechEnv;
            speechRecognition.interimResults = true;
            speechRecognition.lang = 'en-IN';

            const normalizeSpeechText = (text) => {
                if (!text) return '';
                let cleaned = String(text)
                    .replace(/\s+/g, ' ')
                    .trim();

                const tokens = cleaned.split(' ');
                if (tokens.length <= 1) return cleaned;

                const collapsed = [];
                let lastToken = null;
                let run = 0;

                for (const token of tokens) {
                    const t = token.trim();
                    if (!t) continue;

                    if (t.toLowerCase() === (lastToken || '').toLowerCase()) {
                        run += 1;
                        if (run <= 2) {
                            collapsed.push(t);
                        }
                    } else {
                        lastToken = t;
                        run = 0;
                        collapsed.push(t);
                    }
                }

                cleaned = collapsed.join(' ').replace(/\s+/g, ' ').trim();
                return cleaned;
            };

            speechRecognition.onresult = (event) => {
                let finalText = '';
                let interimText = '';

                for (let i = 0; i < event.results.length; i++) {
                    const result = event.results[i];
                    const transcript = result[0] && result[0].transcript ? result[0].transcript : '';
                    if (result.isFinal) {
                        finalText += transcript;
                    } else {
                        interimText += transcript;
                    }
                }

                const base = (reviewTextArea.getAttribute('data-speech-base') ?? baseSpeechText ?? '').trimEnd();
                if (!reviewTextArea.hasAttribute('data-speech-base')) {
                    reviewTextArea.setAttribute('data-speech-base', base);
                }

                const combined = (finalText + interimText).trim();
                const safeCombined = normalizeSpeechText(combined);
                reviewTextArea.value = safeCombined
                    ? (base ? `${base} ${safeCombined}` : safeCombined)
                    : base;
                updateSubmitState();
                scheduleDraftSave();
            };

            speechRecognition.onerror = () => {
                stopRecording();
            };

            speechRecognition.onend = () => {
                if (isRecording) {
                    isRecording = false;
                    updateMicUi();
                }
                isStarting = false;
                if (pendingRestart) {
                    pendingRestart = false;
                    setTimeout(() => startRecording(), 150);
                }
            };

            try {
                baseSpeechText = reviewTextArea.value || '';
                speechRecognition.start();
                isRecording = true;
                updateMicUi();
                isStarting = false;
            } catch (error) {
                pendingRestart = true;
                isRecording = false;
                isStarting = false;
                updateMicUi();
            }
        };

        if (micBtn) {
            console.log(micBtn);
            if (!SpeechRecognitionCtor || !reviewTextArea) {
                micBtn.disabled = true;
                micBtn.style.display = 'none';
            } else {
                micBtn.addEventListener('click', () => {
                    if (isRecording) {
                        stopRecording();
                        reviewTextArea.removeAttribute('data-speech-base');
                        return;
                    }
                    reviewTextArea.removeAttribute('data-speech-base');
                    startRecording();
                });

                updateMicUi();
            }
        }
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

        const manualCompanySelectionEnabled = !!companySelect;
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

        const companyUrlInput = document.getElementById(`${modalId}CompanyUrl`);
        const manualCompanyNameHiddenInput = document.getElementById(`${modalId}ManualCompanyName`);

        function setCompanyContext(companyId, companyName, companyUrl = '') {
            const normalizedCompanyId = companyId && companyId !== '0' ? companyId : '0';
            if (companyIdInput) companyIdInput.value = normalizedCompanyId;
            if (companyNameDisplay) companyNameDisplay.textContent = companyName || config.defaultCompanyName || 'this company';
            if (companyUrlInput) companyUrlInput.value = companyUrl || '';
            if (manualCompanyNameHiddenInput) {
                manualCompanyNameHiddenInput.value = normalizedCompanyId === '0'
                    ? (companyName || config.defaultCompanyName || '')
                    : '';
            }
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
            companySelect.required = !!show;
            if (show) {
                companySelect.value = '';
            }
        }

        function toggleManualCompanyInput(show) {
            if (!manualCompanyGroup) return;
            manualCompanyGroup.style.display = show ? 'block' : 'none';
            if (manualCompanyNameInput) {
                manualCompanyNameInput.required = !!show;
                if (!show) {
                    manualCompanyNameInput.value = '';
                    manualCompanyUrlInput.value = '';
                }
            }
        }

        /** When fixed: company is pre-set (e.g. from company page); disable dropdown and search so user cannot change. */
        function setCompanySelectionFixed(fixed) {
            if (!manualCompanySelectionEnabled || !companySelect) return;
            const companySearchInput = document.getElementById(`${modalId}CompanySearch`);
            const wrapper = companySearchInput ? companySearchInput.closest('.company-search-wrapper') : null;
            if (fixed) {
                companySelect.disabled = true;
                if (companySearchInput) {
                    companySearchInput.readOnly = true;
                    companySearchInput.style.pointerEvents = 'none';
                }
                if (wrapper) wrapper.classList.add('company-selection-fixed');
            } else {
                companySelect.disabled = false;
                if (companySearchInput) {
                    companySearchInput.readOnly = false;
                    companySearchInput.style.pointerEvents = '';
                }
                if (wrapper) wrapper.classList.remove('company-selection-fixed');
            }
        }

        function handleCompanySelection() {
            if (!companySelect) return;
            
            const selectedValue = companySelect.value;
            const selectedOption = companySelect.options[companySelect.selectedIndex];
            
            if (selectedValue === 'other') {
                // Show manual input for "Other Solar Company"
                toggleManualCompanyInput(true);
                setCompanyContext('0', 'Other Solar Company', '');
                companySelect.required = false;
            } else if (selectedValue === '') {
                // No selection - hide manual input
                toggleManualCompanyInput(false);
                setCompanyContext('0', 'this company', '');
            } else {
                // Company selected from dropdown
                toggleManualCompanyInput(false);
                const companyName = selectedOption.getAttribute('data-company-name') || '';
                const companyUrl = selectedOption.getAttribute('data-company-url') || '';
                setCompanyContext(selectedValue, companyName, companyUrl);
            }
        }

        // Company Search Functions
        function initializeCompanySearch() {
            if (!companySearchInput) return;
            
            // Focus event - show all companies
            companySearchInput.addEventListener('focus', function() {
                showAllCompanies();
            });
            
            // Input event - search companies
            companySearchInput.addEventListener('input', function(e) {
                const query = e.target.value.trim();
                clearTimeout(searchTimeout);
                
                if (query === '') {
                    showAllCompanies();
                } else {
                    searchTimeout = setTimeout(() => {
                        searchCompanies(query);
                    }, 300); // Debounce search
                }
            });
            
            // Keyboard navigation
            companySearchInput.addEventListener('keydown', function(e) {
                handleSearchKeydown(e);
            });
            
            // Clear button
            if (searchClearBtn) {
                searchClearBtn.addEventListener('click', function() {
                    clearSearch();
                });
            }
            
            // Click outside to close
            document.addEventListener('click', function(e) {
                if (!searchResults.contains(e.target) && e.target !== companySearchInput) {
                    hideSearchResults();
                }
            });
        }

        function searchCompanies(query) {
            const lowercaseQuery = query.toLowerCase();
            filteredCompanies = allCompanies.filter(company => 
                company.name.toLowerCase().includes(lowercaseQuery) ||
                (company.website_url && company.website_url.toLowerCase().includes(lowercaseQuery))
            );
            
            displaySearchResults(filteredCompanies, query);
        }

        function displaySearchResults(companies, query) {
            if (!resultsList) return;
            
            resultsList.innerHTML = '';
            
            if (companies.length === 0) {
                resultsList.innerHTML = `
                    <div class="no-results">
                        <i class="fas fa-search mb-2"></i>
                        <div>No companies found for "${query}"</div>
                        <div class="mt-2">
                            <button type="button" class="show-all-btn" onclick="showAllCompanies()">
                                Show All Companies
                            </button>
                        </div>
                    </div>
                `;
            } else {
                companies.forEach((company, index) => {
                    const resultItem = createSearchResultItem(company, index);
                    resultsList.appendChild(resultItem);
                });
            }
            
            // Update results count
            if (resultsCount) {
                resultsCount.textContent = `${companies.length} compan${companies.length === 1 ? 'y' : 'ies'} found`;
            }
            
            // Show/hide "Show All" button
            if (showAllBtn) {
                const hasMore = companies.length < allCompanies.length;
                showAllBtn.style.display = hasMore ? 'block' : 'none';
                showAllBtn.onclick = () => showAllCompanies();
            }
            
            // Show results
            searchResults.style.display = 'block';
            selectedIndex = -1;
        }

        function createSearchResultItem(company, index) {
            const div = document.createElement('div');
            div.className = 'search-result-item';
            div.setAttribute('data-company-id', company.id);
            div.setAttribute('data-company-name', company.name);
            div.setAttribute('data-company-url', company.website_url || '');
            
            const companyInfo = document.createElement('div');
            companyInfo.className = 'company-info';
            
            const nameDiv = document.createElement('div');
            nameDiv.className = 'company-name';
            nameDiv.textContent = company.name;
            
            companyInfo.appendChild(nameDiv);
            
            if (company.website_url) {
                const websiteLink = document.createElement('a');
                websiteLink.className = 'company-website';
                websiteLink.href = company.website_url;
                websiteLink.target = '_blank';
                websiteLink.rel = 'noopener noreferrer';
                websiteLink.textContent = company.website_url.replace(/^https?:\/\//, '');
                companyInfo.appendChild(websiteLink);
            }
            
            div.appendChild(companyInfo);
            
            // Click event
            div.addEventListener('click', function() {
                selectCompany(company);
            });
            
            // Hover event
            div.addEventListener('mouseenter', function() {
                highlightSearchResult(index);
            });
            
            return div;
        }

        function selectCompany(company) {
            // Update search input
            companySearchInput.value = company.name;
            
            // Update hidden select
            companySelect.value = company.id;
            
            // Set company context
            setCompanyContext(company.id, company.name, company.website_url || '');
            
            // Hide manual input
            toggleManualCompanyInput(false);
            
            // Hide search results
            hideSearchResults();
            
            // Show clear button
            if (searchClearBtn) {
                searchClearBtn.hidden = false;
            }
        }

        function showAllCompanies() {
            displaySearchResults(allCompanies.slice(0, 50), ''); // Show first 50 for performance
            companySearchInput.value = '';
            if (searchClearBtn) {
                searchClearBtn.hidden = true;
            }
        }

        function clearSearch() {
            companySearchInput.value = '';
            hideSearchResults();
            companySearchInput.focus();
            if (searchClearBtn) {
                searchClearBtn.hidden = true;
            }
        }

        function hideSearchResults() {
            if (searchResults) {
                searchResults.style.display = 'none';
            }
            selectedIndex = -1;
        }

        function highlightSearchResult(index) {
            const items = resultsList.querySelectorAll('.search-result-item');
            items.forEach((item, i) => {
                if (i === index) {
                    item.classList.add('selected');
                } else {
                    item.classList.remove('selected');
                }
            });
            selectedIndex = index;
        }

        function handleSearchKeydown(e) {
            const items = resultsList.querySelectorAll('.search-result-item');
            
            switch(e.key) {
                case 'ArrowDown':
                    e.preventDefault();
                    if (selectedIndex < items.length - 1) {
                        highlightSearchResult(selectedIndex + 1);
                        scrollToView(items[selectedIndex + 1]);
                    }
                    break;
                    
                case 'ArrowUp':
                    e.preventDefault();
                    if (selectedIndex > 0) {
                        highlightSearchResult(selectedIndex - 1);
                        scrollToView(items[selectedIndex - 1]);
                    }
                    break;
                    
                case 'Enter':
                    e.preventDefault();
                    if (selectedIndex >= 0 && items[selectedIndex]) {
                        const company = {
                            id: items[selectedIndex].getAttribute('data-company-id'),
                            name: items[selectedIndex].getAttribute('data-company-name'),
                            website_url: items[selectedIndex].getAttribute('data-company-url')
                        };
                        selectCompany(company);
                    }
                    break;
                    
                case 'Escape':
                    hideSearchResults();
                    break;
            }
        }

        function scrollToView(element) {
            if (element && resultsList) {
                const listRect = resultsList.getBoundingClientRect();
                const itemRect = element.getBoundingClientRect();
                
                if (itemRect.bottom > listRect.bottom) {
                    element.scrollIntoView({ block: 'nearest' });
                } else if (itemRect.top < listRect.top) {
                    element.scrollIntoView({ block: 'nearest' });
                }
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
        
        
        function setOtpButtonLoading(loading = true) {
    if (!otpSendBtn) return;

    if (loading) {
        otpSendBtn.disabled = true;
        otpSendBtn.dataset.originalText = otpSendBtn.innerHTML;
        otpSendBtn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Sending...';
    } else {
        otpSendBtn.disabled = false;
        otpSendBtn.innerHTML = otpSendBtn.dataset.originalText || 'Send OTP';
    }
}




      // In your review-modal.blade.js or within <script> tags
        async function sendOtp() {
            if (otpSending) return; // 🛑 duplicate click protection
            otpSending = true;
        
            const email = otpEmailInput ? otpEmailInput.value.trim() : '';
        
            if (!isValidEmail(email)) {
                setOtpStatus('Please enter a valid email address.', 'danger');
                otpSending = false;
                return;
            }
        
            setOtpButtonLoading(true);
            setOtpStatus('Sending verification code...', 'info');
        
            try {
                const response = await fetch(otpRoutes.send, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ email })
                });
        
                const data = await response.json();
        
                if (!response.ok || !data.success) {
                    throw new Error(data.message || 'Failed to send OTP');
                }
        
                lastOtpEmail = email;
                setOtpStatus('OTP sent successfully. Please check your email.', 'success');
            } catch (error) {
                console.error(error);
                setOtpStatus(error.message || 'Could not send OTP. Try again.', 'danger');
            } finally {
                otpSending = false;
                setOtpButtonLoading(false);
            }
        }


        // async function verifyOtp(email, otp) {
        //     try {
        //         const response = await fetch('{{ route("reviews.verify-otp") }}', {
        //             method: 'POST',
        //             headers: {
        //                 'Content-Type': 'application/json',
        //                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        //                 'Accept': 'application/json'
        //             },
        //             body: JSON.stringify({ 
        //                 email: email,
        //                 otp: otp,
        //                 reviewer_name: document.querySelector('input[name="reviewer_name"]')?.value || ''
        //             })
        //         });
        //         return await response.json();
        //     } catch (error) {
        //         console.error('Error verifying OTP:', error);
        //         return { success: false, message: 'Network error. Please try again.' };
        //     }
        // }
        
        
        async function handleVerifyOtp(email, otp) {
            if (otpVerifying) return;
            otpVerifying = true;
        
            setOtpStatus('Verifying code...', 'info');
        
            try {
                const response = await fetch(otpRoutes.verify, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        email: email,
                        otp: otp,
                        reviewer_name: reviewerNameInput?.value || ''
                    })
                });
        
                const data = await response.json();
        
                if (!response.ok || !data.success) {
                    throw new Error(data.message || 'OTP verification failed');
                }
        
                otpVerified = true;
                setOtpStatus('Email verified successfully ✔', 'success');
                updateSubmitState();
        
                // UX polish
                otpInput.disabled = true;
                otpVerifyBtn.disabled = true;
                otpSendBtn.disabled = true;
            } catch (error) {
                console.error(error);
                setOtpStatus(error.message || 'Invalid OTP. Please try again.', 'danger');
                otpVerified = false;
                updateSubmitState();
            } finally {
                otpVerifying = false;
            }
        }


        if (otpSendBtn && !otpSendBtn.disabled) {
            otpSendBtn.addEventListener('click', async () => {
                await sendOtp();   // 🔥 only manual
            });
        }

    if (otpVerifyBtn) {
    otpVerifyBtn.addEventListener('click', async () => {
        const email = otpEmailInput.value.trim();
        const otp = otpInput.value.trim();

        if (!isValidEmail(email)) {
            setOtpStatus('Please enter a valid email address.', 'danger');
            return;
        }

        if (!otp || otp.length !== 6) {
            setOtpStatus('Please enter the 6-digit OTP.', 'danger');
            return;
        }

        await handleVerifyOtp(email, otp);
    });
}


       if (otpEmailInput && !otpEmailInput.readOnly) {
            otpEmailInput.addEventListener('input', () => {
                otpVerified = false;
                clearOtpStatus();
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
                companySelect.value = '';
                toggleManualCompanyInput(false);
                setCompanySelectionFixed(false);
            }
            setCompanyContext('', 'this company', '');
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
            let companyId = dataset.companyId || config.defaultCompanyId || '';
            let companyName = dataset.companyName || config.defaultCompanyName || 'this company';
            const categoryIds = dataset.categoryIds || '';
            const stateId = dataset.stateId || config.defaultStateId || '';
            const stateName = dataset.stateName || config.defaultStateName || 'State';
            const companyUrl = dataset.companyUrl || '';

            // If we have companyId but no companyName, fetch from companies array
            if (companyId && companyId !== '0' && (!companyName || companyName === 'this company')) {
                console.log('Looking for company with ID:', companyId);
                console.log('Available companies:', allCompanies);
                
                const company = allCompanies.find(c => c.id == companyId);
                if (company) {
                    companyName = company.owner_name || company.name;
                    console.log('Found company name from array:', companyName);
                    console.log('Company data:', company);
                } else {
                    console.log('Company not found in array!');
                }
            }

            setCategoryContext(categoryIds);
            setStateDisplay(stateId);

            const hasLinkedCompany = companyId && companyId !== '0';

            if (manualCompanySelectionEnabled) {
                if (hasLinkedCompany) {
                    // Auto-select the company in dropdown
                    companySelect.value = companyId;
                    setCompanyContext(companyId, companyName, companyUrl);
                    
                    // Also set the search input to show selected company
                    const companySearchInput = document.getElementById(`${modalId}CompanySearch`);
                    if (companySearchInput) {
                        companySearchInput.value = companyName;
                        console.log('Set company search input:', companyName);
                    }
                    
                    // Hide manual input and show company is selected
                    toggleManualCompanyInput(false);
                    
                    // Hide search results and show company is selected
                    const searchResults = document.querySelector('[data-search-results]');
                    if (searchResults) {
                        searchResults.style.display = 'none';
                    }
                    setCompanySelectionFixed(true);
                    console.log('Company selected and manual input hidden');
                } else {
                    // Reset to default state
                    companySelect.value = '';
                    const companySearchInput = document.getElementById(`${modalId}CompanySearch`);
                    if (companySearchInput) {
                        companySearchInput.value = '';
                    }
                    setCompanyContext('', 'this company', companyUrl);
                    toggleManualCompanyInput(true);
                    setCompanySelectionFixed(false);
                }
            } else {
                // Set company context if company selection is not enabled
                setCompanyContext(companyId, companyName, companyUrl);
            }

            // Calculate scrollbar width BEFORE hiding overflow
            const scrollbarWidth = window.innerWidth - document.documentElement.clientWidth;
            
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
            document.documentElement.style.overflow = 'hidden';
            document.body.style.paddingRight = scrollbarWidth + 'px';
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

        // Add company selection change event listener
        if (companySelect) {
            companySelect.addEventListener('change', handleCompanySelection);
        }

        // Initialize company search functionality
        initializeCompanySearch();

        // Add manual company input event listeners
        if (manualCompanyNameInput) {
            manualCompanyNameInput.addEventListener('input', function() {
                const companyName = this.value.trim();
                const companyUrl = manualCompanyUrlInput ? manualCompanyUrlInput.value.trim() : '';
                setCompanyContext('0', companyName, companyUrl);
                
                // Update the display name
                if (companyNameDisplay) {
                    companyNameDisplay.textContent = companyName || 'this company';
                }
            });
        }

        if (manualCompanyUrlInput) {
            manualCompanyUrlInput.addEventListener('input', function() {
                const companyName = manualCompanyNameInput ? manualCompanyNameInput.value.trim() : '';
                const companyUrl = this.value.trim();
                setCompanyContext('0', companyName, companyUrl);
            });
        }

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
                .then(async response => {
                    const contentType = response.headers.get('content-type') || '';
                    const payload = contentType.includes('application/json')
                        ? await response.json()
                        : await response.text();

                    if (!response.ok) {
                        const error = new Error('Review submission failed');
                        error.status = response.status;
                        error.payload = payload;
                        throw error;
                    }

                    return payload;
                })
                .then(data => {
                    if (data && data.redirect) {
                        // Store the success message and company name in session storage
                        sessionStorage.setItem('showSuccessMessage', data.message || 'Review submitted successfully!');
                        if (data.company_name) {
                            sessionStorage.setItem('reviewCompanyName', data.company_name);
                        }
                        window.location.href = data.redirect;
                        return;
                    }

                    const fallbackMessage = (data && data.message) ? data.message : 'Failed to submit review. Please try again.';
                    Swal.fire('Error', fallbackMessage, 'error');
                })
                .catch(error => {
                    console.error('Error:', error);

                    const payload = error && error.payload ? error.payload : null;
                    let message = 'Failed to submit review. Please try again.';

                    if (payload && typeof payload === 'object') {
                        if (payload.errors && typeof payload.errors === 'object') {
                            const messages = Object.values(payload.errors).flat().filter(Boolean);
                            if (messages.length) {
                                message = messages.join('<br>');
                            }
                        } else if (payload.message) {
                            message = payload.message;
                        }
                    }

                    Swal.fire({
                        title: 'Error',
                        html: message,
                        icon: 'error'
                    });
                })
                .finally(() => {
                    submitReviewBtn.disabled = false;
                    submitReviewBtn.innerHTML = 'Submit Review';
                });
            });
        }

        function closeModal() {
            if (isRecording) {
                stopRecording();
            }
            modal.style.display = 'none';
            document.body.style.overflow = '';
            document.documentElement.style.overflow = '';
            document.body.style.paddingRight = '';
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
                setCompanyContext(context.companyId, context.companyName, context.companyUrl || '');
                
                // Handle company selection restoration
                if (manualCompanySelectionEnabled && companySelect) {
                    if (context.companyId && context.companyId !== '0') {
                        // Try to find and select the company in dropdown
                        companySelect.value = context.companyId;
                        toggleManualCompanyInput(false);
                    } else if (context.companyName && context.companyName !== 'this company') {
                        // Manual company name was entered
                        companySelect.value = 'other';
                        toggleManualCompanyInput(true);
                        if (manualCompanyNameInput) {
                            manualCompanyNameInput.value = context.companyName;
                        }
                        if (manualCompanyUrlInput && context.companyUrl) {
                            manualCompanyUrlInput.value = context.companyUrl;
                        }
                    } else {
                        // Reset to default
                        companySelect.value = '';
                        toggleManualCompanyInput(false);
                    }
                }
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

    // Global helper: open review modal with a specific company (dropdown pre-selected and disabled)
    (function() {
        function showReviewModal(companyId, companyName) {
            var modalEl = document.querySelector('[data-review-modal]');
            if (!modalEl) return;
            var modalId = modalEl.id;
            if (!companyId) return;
            try {
                sessionStorage.setItem('reviewModal_companyId_' + modalId, companyId);
                sessionStorage.setItem('reviewModal_companyName_' + modalId, companyName || '');
            } catch (e) {}
            if (!companyName && window.allCompanies && window.allCompanies.length) {
                var company = window.allCompanies.find(function(c) { return c.id == companyId; });
                if (company) companyName = company.owner_name || company.name;
            }
            var companyIdInput = document.getElementById(modalId + 'CompanyId');
            var companyNameDisplay = document.getElementById(modalId + 'CompanyName');
            var companySearchInput = document.getElementById(modalId + 'CompanySearch');
            var companySelect = document.getElementById(modalId + 'CompanySelect');
            var companyUrlInput = document.getElementById(modalId + 'CompanyUrl');
            if (companyIdInput) companyIdInput.value = companyId;
            if (companyNameDisplay) companyNameDisplay.textContent = companyName || 'this company';
            if (companySearchInput) companySearchInput.value = companyName || '';
            if (companySelect) {
                companySelect.value = companyId;
                companySelect.disabled = true;
                var opt = companySelect.options[companySelect.selectedIndex];
                var companyUrl = (opt && opt.getAttribute('data-company-url')) ? opt.getAttribute('data-company-url') : '';
                if (companyUrlInput) companyUrlInput.value = companyUrl || '';
            }
            if (companySearchInput) {
                companySearchInput.readOnly = true;
                companySearchInput.style.pointerEvents = 'none';
                var wrapper = companySearchInput.closest('.company-search-wrapper');
                if (wrapper) wrapper.classList.add('company-selection-fixed');
            }
            modalEl.style.display = 'flex';
            document.body.style.overflow = 'hidden';
            var scrollbarWidth = window.innerWidth - document.documentElement.clientWidth;
            document.body.style.paddingRight = scrollbarWidth + 'px';
        }
        window.showReviewModal = showReviewModal;
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.open-review-modal').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var companyId = this.getAttribute('data-company-id');
                    var companyName = this.getAttribute('data-company-name');
                    if (typeof window.showReviewModal === 'function') window.showReviewModal(companyId, companyName);
                });
            });
        });
    })();
</script>
