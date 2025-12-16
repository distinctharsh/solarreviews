<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Share Your Experience | SolarReviews India</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary: #3ba14c;
            --muted: #64748b;
            --dark: #0f172a;
            --soft-yellow: #fdecb2;
            --search-shadow: 0 24px 45px rgba(15, 23, 42, 0.12);
            --write-hero-width: min(580px, calc(100% - 2.5rem));
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #fff;
            color: var(--dark);
            min-height: 100vh;
        }

        .write-review-page {
            position: relative;
            min-height: 100vh;
            background: url('{{ asset('images/rb.jpg') }}') center/cover no-repeat fixed, #fdfbf5;
        }

        .write-review-page::before {
            content: '';
            position: fixed;
            top: 72px;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #f3c623, #f8d648);
            z-index: 100;
        }

        .hero-area {
            padding: 7rem 1.5rem 4rem;
            text-align: center;
        }

        .hero-area .container-custom {
            max-width: var(--write-hero-width);
            margin: 0 auto;
        }

        .hero-area h1 {
            font-size: clamp(2rem, 4vw, 3.1rem);
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--dark);
        }

        .hero-area p {
            font-size: 1.1rem;
            color: var(--muted);
            margin-bottom: 2.5rem;
        }

        .write-search-form {
            max-width: var(--write-hero-width);
            margin: 0 auto;
            background: #fff;
            border-radius: 18px;
            padding: 0.35rem 0.35rem 0.35rem 0.95rem;
            box-shadow: var(--search-shadow);
            border: 1px solid rgba(15, 23, 42, 0.08);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .write-search-form .icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            /* background: rgba(15,23,42,0.05); */
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: var(--dark);
        }

        .write-search-form input {
            flex: 1;
            border: none;
            outline: none;
            background: transparent;
            font-size: 1rem;
            color: var(--dark);
            padding: 0.9rem 0;
        }

        .write-search-form input::placeholder {
            color: #94a3b8;
        }

        .write-search-form button {
            border: none;
            background: #f8d648;
            color: #1e293b;
            font-weight: 600;
            padding: 0.85rem 1.75rem;
            border-radius: 12px;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .write-search-form button:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 25px rgba(248, 214, 72, 0.35);
        }

        .company-suggestions {
            max-width: var(--write-hero-width);
            margin: 1rem auto 0;
            margin-top: 0;
            background: #fff;
            border-radius: 0 0 18px 18px;
            border: 1px solid rgba(15, 23, 42, 0.08);
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.08);
            padding: 0.4rem 0;
        }

        .company-suggestions[hidden] {
            display: none;
        }

        .suggestions-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.35rem 1.25rem;
            font-size: 0.85rem;
            color: #475569;
            border-bottom: 1px solid rgba(15, 23, 42, 0.05);
        }

        .suggestions-list {
            list-style: none;
            margin: 0;
            padding: 0;
            max-height: 320px;
            overflow-y: auto;
        }

        .suggestion-item {
            padding: 0.85rem 1.25rem;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background 0.15s ease;
        }

        .suggestion-item:not(:last-child) {
            border-bottom: 1px solid rgba(15, 23, 42, 0.04);
        }

        .suggestion-item:hover {
            background: rgba(59, 161, 76, 0.06);
        }

        .suggestion-name {
            font-weight: 600;
            color: #0f172a;
        }

        .suggestion-meta {
            font-size: 0.85rem;
            color: #64748b;
        }

        .suggestions-empty {
            padding: 1rem 1.25rem;
            text-align: center;
            color: #94a3b8;
            font-size: 0.9rem;
        }

        .suggestion-pill {
            font-size: 0.75rem;
            font-weight: 600;
            color: #1e293b;
            background: rgba(248, 214, 72, 0.45);
            padding: 0.15rem 0.65rem;
            border-radius: 999px;
            margin-left: 0.75rem;
        }

        .add-company-card {
            margin-top: 4rem;
            background: #fff;
            border-radius: 24px;
            padding: 2.5rem 1.5rem;
            max-width: var(--write-hero-width);
            margin-left: auto;
            margin-right: auto;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08);
            border: 1px solid rgba(15, 23, 42, 0.06);
        }

        .add-company-card h4 {
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .add-company-card p {
            color: var(--muted);
            margin-bottom: 1.25rem;
        }

        .add-company-card .btn-primary {
            background: var(--primary);
            border: none;
            padding: 0.85rem 1.8rem;
            border-radius: 999px;
            font-weight: 600;
            box-shadow: 0 18px 30px rgba(59, 161, 76, 0.25);
        }

        @media (max-width: 768px) {
            .hero-area {
                padding-top: 5.5rem;
            }

            .write-search-form {
                flex-direction: column;
                padding: 0.45rem;
            }

            .write-search-form .icon {
                width: 52px;
                height: 52px;
            }

            .write-search-form button {
                width: 100%;
            }

         
            .write-search-form input {
                font-size: 14px;
                width: 75%;
            }

        }

        .trustpilot-empty {
    text-align: center;
    padding: 60px 20px;
    background: transparent;
    box-shadow: none;
    border: none;
}

.trustpilot-empty h4 {
    font-size: 1.6rem;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 10px;
}

.trustpilot-empty p {
    font-size: clamp(0.85rem, 2vw, 1rem);
    color: #666;
    margin: 0 auto 25px;
    white-space: nowrap;
    display: inline-block;
    
        text-align: center;
    display: flex;
    justify-content: center;
}

@media (max-width: 576px) {
    .trustpilot-empty p {
        white-space: normal;
        display: block;
    }
}

.trustpilot-empty .add-btn {
    display: inline-block;
    background: #fff;
    border: 1px solid #d0d7de;
    padding: 10px 28px;
    border-radius: 100px;
    font-size: 1rem;
    font-weight: 500;
    color: #1a1a1a;
    transition: 0.2s ease;
}

.trustpilot-empty .add-btn:hover {
    background: #f5f5f5;
}

.container-custom p{
    font-size: 18px
}


  @media (max-width: 768px) {
    .write-search-form{
        flex-wrap: nowrap;
        flex-direction: row;
    }
  }
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  .footer {
        background-color: #11411a;
        color: #f3f4f6;
    }

    .footer-about,
    .footer-links {
        height: 100%;
        display: flex;
        flex-direction: column;
        gap: 0.85rem;
    }

    .footer-links {
        gap: 1rem;
    }

    .footer-toggle {
        width: 100%;
        background: none;
        border: none;
        color: #ffffff;
        font-size: 1.125rem;
        font-weight: 600;
        padding: 0;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        position: relative;
    }

    .footer-toggle::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -0.35rem;
        width: 50px;
        height: 2px;
        background-color: #ffffff;
    }

    .footer-toggle .toggle-icon {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: 1px solid rgba(255, 255, 255, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
        transition: transform 0.2s ease;
    }

    .footer-links ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-collapse {
        margin-top: 1rem;
        transition: all 0.2s ease;
    }

    .footer-collapse:not(.is-open) {
        display: none;
    }

    .footer-links a {
        color: #ffffff;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .footer-links a:hover {
        color: #dbeafe;
    }

    .footer .border-top {
        border-color: #ffffff !important;
    }

    .social-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #374151;
        color: white;
        transition: background-color 0.3s ease;
    }

    .social-link:hover {
        background-color: #2563eb;
    }

    .footer-logo {
        height: 81px;
        width: auto;
        margin: 0;
        display: block;
    }

    @media (max-width: 575px) {
        .footer {
            text-align: center;
        }

        .footer-about .d-flex {
            justify-content: center;
        }

        .footer-about {
            align-items: center;
        }

        .footer-about a {
            display: inline-flex;
            justify-content: center;
        }

        .footer-toggle {
            text-align: left;
            padding: 0.75rem 0;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        .footer-toggle::after {
            display: none;
        }

        .footer-toggle .toggle-icon {
            display: inline-flex;
        }

        .footer-collapse {
            text-align: left;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        }
    }

    @media (min-width: 576px) {
        .footer-toggle {
            cursor: default;
        }

        .footer-toggle .toggle-icon {
            display: none;
        }
    }
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
    </style>
</head>
<body>
    @include('components.frontend.navbar')

    <main class="write-review-page">
        <section class="hero-area">
            <div class="container-custom">
                <span style="font-size: 44px; font-weight: 600;">Share your experience</span>
                <p>Help others make the right choice.</p>

                <form class="write-search-form" data-company-search-form>
                    <div class="icon">
                        <i class="fas fa-search" aria-hidden="true"></i>
                    </div>
                    <input  type="text" name="company" placeholder="Find a company to review" aria-label="Find a company to review" data-company-search-input autocomplete="off">
                  
                </form>

                <div class="company-suggestions" data-company-suggestions hidden>
                    <div class="suggestions-header">
                        <span>Select a company to review</span>
                        <span class="suggestion-count" data-suggestions-count>0 results</span>
                    </div>
                    <ul class="suggestions-list" data-suggestions-list></ul>
                    <div class="suggestions-empty" data-suggestions-empty>No companies found. Try another name.</div>
                </div>

            </div>
        </section>
    <div class="add-company-card trustpilot-empty">
        <h4>Can't find a company?</h4>
        <p>It might not be listed on Solar Reviews yet. Add it and be the first to write a review.</p>
        <a href="#" class="add-btn">Add company</a>
    </div>














<div class="container-custom">
    



<footer class="footer py-5">
    <div class="container">
        <div class="row g-4 mb-4" style="padding-left: 176px;">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="footer-about">
                    <a href="/" class="d-inline-block mb-3">
                        <img src="{{ asset('images/abc.png') }}" alt="SolarReviews Logo" class="footer-logo">
                    </a>
                    <p class="mb-3">Helping homeowners find the best solar solutions since 2023. Compare, review, and connect with top solar installers in your area.</p>
                    <div class="d-flex gap-2">
                        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="footer-links">
                    <button class="footer-toggle" type="button" aria-expanded="true">
                        <span>Quick Links</span>
                        <span class="toggle-icon"><i class="fas fa-chevron-down"></i></span>
                    </button>
                    <div class="footer-collapse is-open">
                        <ul>
                            <li class="mb-2"><a href="#">How It Works</a></li>
                            <li class="mb-2"><a href="#">Solar Companies</a></li>
                            <li class="mb-2"><a href="#">Reviews</a></li>
                            <li class="mb-2"><a href="#">Blog</a></li>
                            <li class="mb-2"><a href="#">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="footer-links">
                    <button class="footer-toggle" type="button" aria-expanded="true">
                        <span>Solar Resources</span>
                        <span class="toggle-icon"><i class="fas fa-chevron-down"></i></span>
                    </button>
                    <div class="footer-collapse is-open">
                        <ul>
                            <li class="mb-2"><a href="#">Solar Guides</a></li>
                            <li class="mb-2"><a href="#">Solar Calculator</a></li>
                            <li class="mb-2"><a href="#">Solar Incentives</a></li>
                            <li class="mb-2"><a href="#">Financing Options</a></li>
                            <li class="mb-2"><a href="#">FAQ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="footer-links">
                    <button class="footer-toggle" type="button" aria-expanded="true">
                        <span>Legal</span>
                        <span class="toggle-icon"><i class="fas fa-chevron-down"></i></span>
                    </button>
                    <div class="footer-collapse is-open">
                        <ul>
                            <li class="mb-2"><a href="#">Privacy Policy</a></li>
                            <li class="mb-2"><a href="#">Terms of Service</a></li>
                            <li class="mb-2"><a href="#">Cookie Policy</a></li>
                            <li class="mb-2"><a href="#">Sitemap</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="border-top border-secondary pt-4">
        <div class="container text-center">
            <p class="mb-0" style="font-size: 0.875rem;">&copy; {{ date('Y') }} SolarReviews. All rights reserved.</p>
        </div>
    </div>
</footer>

</div>



























    </main>

    <button type="button" id="landingReviewModalTrigger" data-review-modal-trigger="landingReviewModal" style="display: none;"></button>

     
     
    <x-frontend.review-modal
        modalId="landingReviewModal"
        triggerSelector="#landingReviewModalTrigger"
        :states="$states ?? collect()"
        :categories="collect()"
        :allow-company-selection="false"
    />

    @include('components.frontend.chatbot-widget')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const companies = @json($companies ?? []);
            const form = document.querySelector('[data-company-search-form]');
            const input = document.querySelector('[data-company-search-input]');
            const searchBtn = document.querySelector('[data-company-search-button]');
            const suggestions = document.querySelector('[data-company-suggestions]');
            const suggestionsList = document.querySelector('[data-suggestions-list]');
            const emptyState = document.querySelector('[data-suggestions-empty]');
            const countLabel = document.querySelector('[data-suggestions-count]');
            const hiddenTrigger = document.getElementById('landingReviewModalTrigger');
            const MAX_RESULTS = companies.length;

            if (!form || !input || !suggestions || !suggestionsList || !hiddenTrigger) {
                return;
            }

            form.addEventListener('submit', (event) => event.preventDefault());

            function formatCount(value) {
                return value === 1 ? '1 company' : `${value} companies`;
            }

            function hideSuggestions() {
                suggestions.hidden = true;
                 // radius wapas normal
    form.style.borderBottomLeftRadius = '';
    form.style.borderBottomRightRadius = '';
            }

            function showSuggestions() {
                suggestions.hidden = false;
                 form.style.borderBottomLeftRadius = '0px';
    form.style.borderBottomRightRadius = '0px';
            }

            function renderSuggestions(matches) {
                suggestionsList.innerHTML = '';

                if (!matches.length) {
                    emptyState.style.display = 'block';
                    countLabel.textContent = '0 results';
                    showSuggestions();
                    return;
                }

                emptyState.style.display = 'none';
                countLabel.textContent = formatCount(matches.length);

                matches.forEach(company => {
                    const item = document.createElement('li');
                    item.className = 'suggestion-item';
                    item.innerHTML = `
                        <div>
                            <div class="suggestion-name">${company.name}</div>
                            <div class="suggestion-meta">${company.state_name ?? 'State unavailable'}</div>
                        </div>
                        <span class="suggestion-pill">Select</span>
                    `;
                    item.addEventListener('click', () => openReviewModal(company));
                    suggestionsList.appendChild(item);
                });

                showSuggestions();
            }

            function filterCompanies(term) {
                if (!term) {
                    return [...companies];
                }

                const normalized = term.toLowerCase();
                return companies.filter(company =>
                    company.name.toLowerCase().includes(normalized)
                );
            }

            function openReviewModal(company) {
                hideSuggestions();
                input.value = company.name;

                hiddenTrigger.dataset.companyId = company.id ?? '';
                hiddenTrigger.dataset.companyName = company.name ?? '';
                hiddenTrigger.dataset.stateId = company.state_id ?? '';
                hiddenTrigger.dataset.stateName = company.state_name ?? '';
                hiddenTrigger.dataset.categoryIds = (company.category_ids || []).join(',');

                hiddenTrigger.click();
            }

            input.addEventListener('input', (event) => {
                const matches = filterCompanies(event.target.value.trim());
                renderSuggestions(matches);
            });

            input.addEventListener('focus', () => {
                const matches = filterCompanies(input.value.trim());
                renderSuggestions(matches);
            });

            searchBtn?.addEventListener('click', () => {
                const matches = filterCompanies(input.value.trim());
                renderSuggestions(matches);
            });

            document.addEventListener('click', (event) => {
                if (!suggestions.contains(event.target) && !form.contains(event.target)) {
                    hideSuggestions();
                }
            });
        });
    </script>
</body>
</html>
