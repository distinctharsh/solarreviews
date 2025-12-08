<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Top Solar Companies in {{ $state['name'] }} - Solar Reviews</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap & Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #3ba14c;
            --primary-dark: #2d7a3a;
            --primary-light: #6dc47d;
            --secondary: #0f172a;
            --accent: #f59e0b;
            --accent-light: #fcd34d;
            --surface: #ffffff;
            --surface-elevated: #f8fafc;
            --border: #e2e8f0;
            --border-light: #f1f5f9;
            --text-primary: #0f172a;
            --text-secondary: #475569;
            --text-muted: #94a3b8;
            --success: #3ba14c;
            --warning: #f59e0b;
            --error: #ef4444;
            --gradient-start: #3ba14c;
            --gradient-end: #2d8f3e;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', system-ui, -apple-system, sans-serif;
            background: linear-gradient(180deg, #f0fdf4 0%, #f8fafc 100%);
            color: var(--text-primary);
            min-height: 100vh;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%);
            padding: 3rem 0;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.5;
        }

        .hero-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
            position: relative;
            z-index: 1;
        }

        @media (max-width: 768px) {
            .hero-content {
                padding: 0 1.25rem;
            }
        }

        .container-custom {
            max-width: 1200px;
            margin: 0 auto;
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        @media (max-width: 768px) {
            .container-custom {
                padding-left: 1.25rem;
                padding-right: 1.25rem;
            }
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            color: white;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 1rem;
            border: 1px solid rgba(255,255,255,0.2);
        }

        .hero-badge i {
            color: var(--accent-light);
        }

        .hero-title {
            font-family: 'Outfit', sans-serif;
            font-size: 2.75rem;
            font-weight: 800;
            color: white;
            margin-bottom: 0.75rem;
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.125rem;
            color: rgba(255,255,255,0.9);
            max-width: 600px;
        }

        .hero-stats {
            display: flex;
            gap: 2.5rem;
            margin-top: 2rem;
        }

        .hero-stat {
            text-align: left;
        }

        .hero-stat-value {
            font-family: 'Outfit', sans-serif;
            font-size: 1.75rem;
            font-weight: 700;
            color: white;
        }

        .hero-stat-label {
            font-size: 0.875rem;
            color: rgba(255,255,255,0.75);
        }

        /* Main Layout */
        .main-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1.5rem 4rem;
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 2rem;
            align-items: start;
        }

        @media (max-width: 768px) {
            .main-wrapper {
                padding-left: 1.25rem;
                padding-right: 1.25rem;
            }
        }

        /* Sidebar */
        .sidebar {
            position: sticky;
            top: 100px;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .sidebar-card {
            background: var(--surface);
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-light);
        }

        .sidebar-title {
            font-family: 'Outfit', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .sidebar-title i {
            color: var(--primary);
            font-size: 1.125rem;
        }

        .state-list {
            list-style: none;
            max-height: 320px;
            overflow-y: auto;
            padding-right: 0.5rem;
        }

        .state-list::-webkit-scrollbar {
            width: 4px;
        }

        .state-list::-webkit-scrollbar-track {
            background: var(--border-light);
            border-radius: 4px;
        }

        .state-list::-webkit-scrollbar-thumb {
            background: var(--primary-light);
            border-radius: 4px;
        }

        .state-list li {
            margin-bottom: 0.25rem;
        }

        .state-list a {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 0.75rem;
            text-decoration: none;
            color: var(--text-secondary);
            font-size: 0.9rem;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .state-list a::before {
            content: '';
            width: 6px;
            height: 6px;
            background: var(--primary-light);
            border-radius: 50%;
            transition: all 0.2s ease;
        }

        .state-list a:hover {
            background: linear-gradient(135deg, rgba(59, 161, 76, 0.08) 0%, rgba(45, 143, 62, 0.08) 100%);
            color: var(--primary-dark);
        }

        .state-list a:hover::before {
            background: var(--primary);
            transform: scale(1.5);
        }

        /* Calculator Card */
        .calculator-card {
            background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%);
            border-radius: 16px;
            padding: 1.5rem;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .calculator-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        }

        .calculator-card .sidebar-title {
            color: white;
        }

        .calculator-card .sidebar-title i {
            color: var(--accent-light);
        }

        .calculator-input {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid rgba(255,255,255,0.2);
            border-radius: 10px;
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            color: white;
            font-size: 0.95rem;
            margin-bottom: 0.75rem;
            transition: all 0.2s ease;
        }

        .calculator-input::placeholder {
            color: rgba(255,255,255,0.6);
        }

        .calculator-input:focus {
            outline: none;
            border-color: rgba(255,255,255,0.5);
            background: rgba(255,255,255,0.15);
        }

        .calculator-btn {
            width: 100%;
            padding: 0.875rem;
            background: white;
            color: var(--primary-dark);
            border: none;
            border-radius: 10px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .calculator-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        /* Content Area */
        .content-area {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        /* Company Card - Compact Design */
        .company-card {
            background: var(--surface);
            border-radius: 12px;
            padding: 1rem 1.25rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            transition: all 0.25s ease;
            position: relative;
        }

        .company-card:hover {
            box-shadow: var(--shadow-md);
            border-color: var(--primary-light);
        }

        .company-header {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .company-logo {
            width: 56px;
            height: 56px;
            min-width: 56px;
            border-radius: 10px;
            background: #f8fafc;
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem;
        }

        .company-logo img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .company-details {
            flex: 1;
            min-width: 0;
        }

        .company-top-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 0.75rem;
        }

        .company-info {
            flex: 1;
            min-width: 0;
        }

        .company-name {
            font-family: 'Outfit', sans-serif;
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.25rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .company-name:hover {
            color: var(--primary-dark);
        }

        .company-rating-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .stars-container {
            display: flex;
            gap: 1px;
        }

        .stars-container i {
            color: var(--accent);
            font-size: 0.8rem;
        }

        .rating-score {
            font-family: 'Outfit', sans-serif;
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .review-count {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            flex-shrink: 0;
        }

        .btn-primary-action {
            background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%);
            color: white;
            border: none;
            padding: 0.45rem 0.9rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }

        .btn-primary-action:hover {
            box-shadow: 0 2px 8px rgba(59, 161, 76, 0.3);
        }

        .btn-secondary-action {
            background: var(--surface);
            color: var(--primary);
            border: 1.5px solid var(--primary);
            padding: 0.4rem 0.85rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }

        .btn-secondary-action:hover {
            background: var(--primary);
            color: white;
        }

        /* Company Meta Row */
        .company-meta {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-top: 0.75rem;
            padding-top: 0.75rem;
            border-top: 1px solid var(--border-light);
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.75rem;
            color: var(--text-secondary);
        }

        .meta-item i {
            color: var(--primary);
            font-size: 0.7rem;
        }

        .meta-badge {
            background: linear-gradient(135deg, var(--success) 0%, #2d7a3a 100%);
            color: white;
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .company-desc {
            font-size: 0.8rem;
            color: var(--text-secondary);
            line-height: 1.5;
            margin-top: 0.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .view-details-link {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            color: var(--primary);
            font-size: 0.75rem;
            font-weight: 600;
            text-decoration: none;
            margin-top: 0.5rem;
        }

        .view-details-link:hover {
            text-decoration: underline;
        }

        /* Quick Stats */
        .quick-stats {
            display: flex;
            gap: 0.5rem;
            margin-top: 0.75rem;
            flex-wrap: wrap;
        }

        .stat-chip {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            background: var(--surface-elevated);
            padding: 0.3rem 0.6rem;
            border-radius: 4px;
            font-size: 0.7rem;
            color: var(--text-secondary);
        }

        .stat-chip i {
            color: var(--primary);
            font-size: 0.65rem;
        }


        /* Responsive */
        @media (max-width: 1024px) {
            .main-wrapper {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: static;
                flex-direction: row;
                flex-wrap: wrap;
            }

            .sidebar-card {
                flex: 1;
                min-width: 280px;
            }

            .hero-title {
                font-size: 2rem;
            }

            .hero-stats {
                gap: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 2rem 0;
            }

            .hero-title {
                font-size: 1.75rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .hero-stats {
                flex-wrap: wrap;
                gap: 1rem;
            }

            .company-card {
                padding: 0.875rem 1rem;
            }

            .company-top-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }

            .company-name {
                white-space: normal;
            }

            .action-buttons {
                width: 100%;
            }

            .action-buttons button {
                flex: 1;
                justify-content: center;
            }

            .company-meta {
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .sidebar {
                flex-direction: column;
            }

            .sidebar-card {
                min-width: 100%;
            }
        }

        /* Review Modal Styles */
        .modal-overlay {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .modal-container {
            background: var(--surface);
            width: 100%;
            max-width: 560px;
            border-radius: 20px;
            box-shadow: var(--shadow-xl);
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
            background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%);
            padding: 1.25rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h3 {
            font-family: 'Outfit', sans-serif;
            color: white;
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
            color: white;
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
            background: var(--border-light);
        }

        .modal-body::-webkit-scrollbar-thumb {
            background: var(--primary-light);
            border-radius: 3px;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid var(--border);
            border-radius: 10px;
            font-size: 0.9rem;
            font-family: inherit;
            transition: all 0.2s ease;
            background: var(--surface);
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--primary);
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

        .btn-outline {
            background: var(--surface);
            color: var(--primary);
            border: 2px solid var(--primary);
            padding: 0.75rem 1.25rem;
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .btn-outline:hover {
            background: var(--primary);
            color: white;
        }

        .btn-outline:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .form-hint {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-top: 0.35rem;
        }

        /* Rating Stars in Modal */
        .modal-rating-stars {
            display: flex;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .modal-rating-stars i {
            font-size: 1.75rem;
            color: var(--border);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .modal-rating-stars i:hover,
        .modal-rating-stars i.active {
            color: var(--accent);
            transform: scale(1.1);
        }

        .otp-status {
            margin-top: 0.5rem;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .otp-status.success {
            color: var(--success);
        }

        .otp-status.error {
            color: var(--error);
        }

        .modal-footer {
            padding: 1rem 1.5rem;
            background: var(--surface-elevated);
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
            border-top: 1px solid var(--border-light);
        }

        .btn-cancel {
            background: var(--surface);
            color: var(--text-secondary);
            border: 1px solid var(--border);
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-cancel:hover {
            background: var(--surface-elevated);
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%);
            color: white;
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

        /* Loading spinner */
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
    </style>
</head>
<body>

@include('components.frontend.navbar')

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <div class="hero-badge">
            <i class="fas fa-solar-panel"></i>
            <span>Verified Solar Installers</span>
        </div>
        <h1 class="hero-title">Top Solar Companies in {{ $state['name'] }}</h1>
        <p class="hero-subtitle">Compare verified solar installation companies with real customer reviews and expert ratings to find your perfect match.</p>
        
        <div class="hero-stats">
            <div class="hero-stat">
                <div class="hero-stat-value">7+</div>
                <div class="hero-stat-label">Verified Companies</div>
            </div>
            <div class="hero-stat">
                <div class="hero-stat-value">1,066+</div>
                <div class="hero-stat-label">Customer Reviews</div>
            </div>
            <div class="hero-stat">
                <div class="hero-stat-value">4.7</div>
                <div class="hero-stat-label">Average Rating</div>
            </div>
        </div>
    </div>
</section>

<div class="main-wrapper">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-card">
            <h3 class="sidebar-title">
                <i class="fas fa-map-marker-alt"></i>
                Solar in Your State
            </h3>
            <ul class="state-list">
                @foreach($states as $s)
                    <li><a href="{{ url('state/'.$s['slug']) }}">{{ $s['name'] }}</a></li>
                @endforeach
            </ul>
        </div>

        <div class="calculator-card">
            <h3 class="sidebar-title">
                <i class="fas fa-calculator"></i>
                Solar Calculator
            </h3>
            <input type="text" class="calculator-input state-calculator-input" placeholder="Enter your PIN code" maxlength="6" inputmode="numeric">
            <button class="calculator-btn state-calculator-btn" type="button">
                <i class="fas fa-bolt"></i>
                Calculate Now
            </button>
        </div>
    </aside>

    <!-- Content -->
    <main class="content-area">
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
            <article class="company-card">
                <div class="company-header">
                    <div class="company-logo">
                        <img src="{{ $company['logo'] }}" alt="{{ $company['name'] }} logo">
                    </div>
                    <div class="company-details">
                        <div class="company-top-row">
                            <div class="company-info">
                                <h2 class="company-name">{{ $company['name'] }}</h2>
                                <div class="company-rating-row">
                                    <div class="stars-container">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="{{ $i <= $fullStars ? 'fas fa-star' : ($i == $fullStars + 1 && $hasHalfStar ? 'fas fa-star-half-alt' : 'far fa-star') }}"></i>
                                        @endfor
                                    </div>
                                    <span class="rating-score">{{ number_format($rating, 2) }}</span>
                                    <span class="review-count">({{ $reviewCount }})</span>
                                </div>
                            </div>
                            <div class="action-buttons">
                                <button type="button" class="btn-secondary-action btn-review">
                                    <i class="fas fa-pen"></i>
                                    Review
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="company-meta">
                    <span class="meta-badge">Elite</span>
                    <span class="meta-item"><i class="fas fa-check-circle"></i> Verified</span>
                    <span class="meta-item"><i class="fas fa-shield-alt"></i> Licensed</span>
                    <span class="meta-item"><i class="fas fa-clock"></i> 10+ Years</span>
                </div>
                
                <p class="company-desc">{{ $company['description'] }}</p>
                
                <a href="#" class="view-details-link">
                    View Details <i class="fas fa-chevron-right"></i>
                </a>
            </article>
        @endforeach
    </main>
</div>

<!-- Review Modal -->
<div id="reviewModal" class="modal-overlay">
    <div class="modal-container">
        <div class="modal-header">
            <h3>Write a Review</h3>
            <button class="modal-close close-btn">&times;</button>
        </div>
        <form id="reviewForm" method="POST" action="{{ route('reviews.store') }}">
            @csrf
            <input type="hidden" name="company_id" id="companyId">
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">State</label>
                    <input type="hidden" name="state_id" value="{{ $state['id'] ?? ($state->id ?? '') }}">
                    <select class="form-select" disabled>
                        <option>{{ $state['name'] ?? ($state->name ?? 'State') }}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="category">Select Category *</label>
                    <select id="category" name="category_id" class="form-select" required>
                        <option value="">Select Category</option>
                        @if(isset($categories))
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" data-category-id="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Rate your experience with <span id="companyNameInModal"></span> *</label>
                    <div class="modal-rating-stars">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="far fa-star" data-rating="{{ $i }}"></i>
                        @endfor
                        <input type="hidden" name="rating" id="rating" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="reviewTitle">Review Title (Optional)</label>
                    <input type="text" id="reviewTitle" name="review_title" class="form-input" placeholder="Summarize your experience">
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="reviewText">Your Review *</label>
                    <textarea id="reviewText" name="review_text" class="form-textarea" required placeholder="Share details of your experience..."></textarea>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="reviewerName">Your Name *</label>
                    <input type="text" id="reviewerName" name="reviewer_name" class="form-input" required placeholder="Enter your name">
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="email">Email Address *</label>
                    <div class="input-group">
                        <input type="email" id="email" name="email" class="form-input" required placeholder="your@email.com">
                        <button type="button" id="sendOtpBtn" class="btn-outline">Send OTP</button>
                    </div>
                    <p class="form-hint">We'll send a verification code to this email</p>
                </div>
                
                <div class="form-group" id="otpField" style="display: none;">
                    <label class="form-label" for="otp">Enter OTP *</label>
                    <div class="input-group">
                        <input type="text" id="otp" name="otp" class="form-input" maxlength="6" placeholder="Enter 6-digit OTP">
                        <button type="button" id="verifyOtpBtn" class="btn-outline">Verify</button>
                    </div>
                    <div class="otp-status" id="otpStatus"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel cancel-btn">Cancel</button>
                <button type="submit" class="btn-submit" id="submitReviewBtn" disabled>Submit Review</button>
            </div>
        </form>
    </div>
</div>

<!-- SweetAlert2 for alerts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const slugifyState = (text) => text
        .toLowerCase()
        .trim()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/^-+|-+$/g, '');

    function setupPincodeRedirect(inputSelector, buttonSelector) {
        const input = document.querySelector(inputSelector);
        const button = document.querySelector(buttonSelector);

        if (!input || !button) return;

        const originalText = button.innerHTML;

        button.addEventListener('click', async () => {
            const pincode = input.value.trim();

            if (!/^\d{6}$/.test(pincode)) {
                Swal.fire('Invalid PIN', 'Please enter a valid 6-digit pincode.', 'warning');
                input.focus();
                return;
            }

            button.disabled = true;
            button.innerHTML = '<span class="spinner"></span> Checking...';

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

                Swal.fire('Not Found', 'Could not find the state for this pincode. Please try another one.', 'info');
            } catch (error) {
                console.error('Failed to fetch state for pincode:', error);
                Swal.fire('Error', 'Something went wrong while fetching the state. Please try again later.', 'error');
            } finally {
                button.disabled = false;
                button.innerHTML = originalText;
            }
        });
    }

    // Review Modal Functionality
    document.addEventListener('DOMContentLoaded', function() {
        setupPincodeRedirect('.state-calculator-input', '.state-calculator-btn');

        // Initialize all DOM elements
        const reviewModal = document.getElementById('reviewModal');
        const writeReviewBtns = document.querySelectorAll('.btn-review');
        const closeBtn = document.querySelector('.close-btn');
        const cancelBtn = document.querySelector('.cancel-btn');
        const companyNameInModal = document.getElementById('companyNameInModal');
        const companyIdInput = document.getElementById('companyId');
        const ratingStars = document.querySelectorAll('.modal-rating-stars i');
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

            categorySelect.innerHTML = '';

            const placeholder = document.createElement('option');
            placeholder.value = '';
            placeholder.textContent = 'Select Category';
            categorySelect.appendChild(placeholder);

            let optionsToShow = [];

            if (categoryIds.length) {
                optionsToShow = originalCategoryOptions.filter(opt =>
                    opt.categoryId && categoryIds.includes(String(opt.categoryId))
                );
            }

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
                const card = this.closest('.company-card');
                const companyName = card.querySelector('.company-name').textContent;
                const companyId = this.getAttribute('data-company-id') || '';
                const companyCategoryIds = this.getAttribute('data-category-ids') || '';
                
                companyIdInput.value = companyId;
                companyNameInModal.textContent = companyName;

                filterCategoriesForCompany(companyCategoryIds);
                resetReviewForm();
                
                reviewModal.style.display = 'flex';
            });
        });
        
        // Handle star rating
        ratingStars.forEach(star => {
            star.addEventListener('click', function() {
                const rating = parseInt(this.getAttribute('data-rating'));
                ratingInput.value = rating;
                
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
                Swal.fire('Error', 'Please enter your email address', 'error');
                return;
            }
            
            const originalText = sendOtpBtn.innerHTML;
            sendOtpBtn.disabled = true;
            sendOtpBtn.innerHTML = '<span class="spinner"></span> Sending...';
            
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
                if (data.success) {
                    if (data.otp) {
                        console.log('Your OTP for testing:', data.otp);
                        Swal.fire('OTP Sent', `OTP sent to ${email}. Check console for OTP (testing).`, 'success');
                    } else {
                        Swal.fire('OTP Sent', 'We have sent a 6-digit OTP to your email address.', 'success');
                    }
                    
                    otpField.style.display = 'block';
                    otpSent = true;
                    otpInput.focus();
                } else {
                    throw new Error(data.message || 'Failed to send OTP');
                }
            })
            .catch(error => {
                console.error('Error sending OTP:', error);
                Swal.fire('Error', error.message || 'Failed to send OTP. Please try again.', 'error');
            })
            .finally(() => {
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
                    Swal.fire('Error', 'Please enter a valid 6-digit OTP', 'error');
                    return;
                }

                const originalText = verifyOtpBtn.innerHTML;
                verifyOtpBtn.disabled = true;
                verifyOtpBtn.innerHTML = '<span class="spinner"></span>';

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
                    if (data.success) {
                        otpVerified = true;
                        if (submitReviewBtn) submitReviewBtn.disabled = false;
                        otpStatus.textContent = 'OTP verified successfully!';
                        otpStatus.className = 'otp-status success';
                        verifyOtpBtn.innerHTML = '<i class="fas fa-check"></i> Verified';
                        verifyOtpBtn.disabled = true;
                        verifyOtpBtn.style.background = 'var(--success)';
                        verifyOtpBtn.style.color = 'white';
                        verifyOtpBtn.style.borderColor = 'var(--success)';
                        
                        Swal.fire('Success', 'OTP verified successfully!', 'success');
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
                    
                    Swal.fire('Error', error.message || 'Failed to verify OTP. Please try again.', 'error');
                });
            });
        }

        // Form submission
        const reviewForm = document.getElementById('reviewForm');
        if (reviewForm) {
            reviewForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                if (!otpVerified) {
                    Swal.fire('Error', 'Please verify your email with OTP first', 'error');
                    return;
                }
                
                submitReviewBtn.disabled = true;
                submitReviewBtn.innerHTML = '<span class="spinner"></span> Submitting...';
                
                const formData = new FormData(this);
                const formObject = {};
                formData.forEach((value, key) => {
                    formObject[key] = value;
                });
                
                if (emailInput && emailInput.value) {
                    formObject['email'] = emailInput.value;
                }
                
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
                        Swal.fire('Success', 'Thank you for your review! It will be visible after approval.', 'success');
                        reviewModal.style.display = 'none';
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    } else {
                        throw new Error(data.message || 'Failed to submit review');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error', error.message || 'Failed to submit review. Please try again.', 'error');
                    submitReviewBtn.disabled = false;
                    submitReviewBtn.innerHTML = 'Submit Review';
                });
            });
        }

        // Close modal handlers
        closeBtn.addEventListener('click', function() {
            reviewModal.style.display = 'none';
            resetReviewForm();
        });

        cancelBtn.addEventListener('click', function() {
            reviewModal.style.display = 'none';
            resetReviewForm();
        });

        window.addEventListener('click', function(event) {
            if (event.target === reviewModal) {
                reviewModal.style.display = 'none';
                resetReviewForm();
            }
        });

        // Reset form helper
        function resetReviewForm() {
            const form = document.getElementById('reviewForm');
            
            if (form) form.reset();
            if (ratingInput) ratingInput.value = '';
            
            otpSent = false;
            otpVerified = false;
            
            if (otpField) otpField.style.display = 'none';
            if (otpStatus) {
                otpStatus.textContent = '';
                otpStatus.className = 'otp-status';
            }
            
            if (submitReviewBtn) submitReviewBtn.disabled = true;
            if (verifyOtpBtn) {
                verifyOtpBtn.disabled = false;
                verifyOtpBtn.innerHTML = 'Verify';
                verifyOtpBtn.style.background = '';
                verifyOtpBtn.style.color = '';
                verifyOtpBtn.style.borderColor = '';
            }
            if (sendOtpBtn) sendOtpBtn.innerHTML = 'Send OTP';

            const stars = document.querySelectorAll('.modal-rating-stars i');
            stars.forEach(star => {
                star.classList.remove('fas', 'active');
                star.classList.add('far');
            });
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@include('components.frontend.footer')
</body>
</html>
