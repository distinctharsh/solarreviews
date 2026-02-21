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
    <link rel="stylesheet" href="{{ asset('css/design-system.css') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
    @include('components.frontend.navbar')

    <main class="write-review-page">
        <section class="hero-area">
            {{-- <div class="container-custom"> --}}
                <h1 class="reviews-title">
                  
                   <span >Share your experience</span>
              </h1>

                <p>Help others make the right choice.</p>

                <form class="hero-search-form" data-company-search-form>
                    <span class="hero-search-icon">
                        <i class="fas fa-search" aria-hidden="true"></i>
                    </span>
                    <input
                        type="text"
                        class="hero-search-input"
                        name="company"
                        placeholder="Find a company to review"
                        aria-label="Find a company to review"
                        data-company-search-input
                        autocomplete="off"
                    >
                    <!-- <button type="button" class="hero-search-button" data-company-search-button>
                        Search
                    </button> -->
                </form>

                <div class="company-suggestions hero-search-suggestions" data-company-suggestions hidden>
                    <div class="suggestions-header">
                        <span>Select a company to review</span>
                        <span class="suggestion-count" data-suggestions-count>0 results</span>
                    </div>
                    <ul class="suggestions-list" data-suggestions-list></ul>
                    <div class="suggestions-empty" data-suggestions-empty>No companies found. Try another name.</div>
                </div>

            {{-- </div> --}}
        </section>
    <div class="add-company-card trustpilot-empty">
        <h2>Can't find a company?</h2>
        <p>It might not be listed on Solar Reviews yet. Add it and be the first to write a review.</p>
        <a href="#" class="add-btn" data-add-company-btn>Add company</a>
    </div>

    </main>
    
    <div class="add-company-modal" data-add-company-modal hidden aria-hidden="true">
        <div class="add-company-modal__dialog">
            <h3>Add a company</h3>
            <p>Paste the company's website link so we can create a new listing for your review.</p>
            <form data-add-company-form>
                <input
                    type="text"
                    class="add-company-modal__input"
                    placeholder="https://example-solar.com"
                    data-add-company-input
                    autocomplete="off"
                >
                <div class="add-company-modal__error" data-add-company-error>Please enter a valid website URL.</div>
                <div class="add-company-modal__actions">
                    <button type="button" class="btn-secondary" data-add-company-close>Cancel</button>
                    <button type="submit" class="btn-primary">Continue</button>
                </div>
                <div style="text-align: center; margin-top: 1rem;">
                    <a href="#" data-continue-without-url style="color: #2563eb; font-size: 0.9rem; text-decoration: none; font-weight: 500;">
                        Continue without company URL
                    </a>
                </div>
            </form>
        </div>
    </div>
    


            @include('components.frontend.footer')



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
            const addCompanyBtn = document.querySelector('[data-add-company-btn]');
            const addCompanyModal = document.querySelector('[data-add-company-modal]');
            const addCompanyForm = document.querySelector('[data-add-company-form]');
            const addCompanyInput = document.querySelector('[data-add-company-input]');
            const addCompanyError = document.querySelector('[data-add-company-error]');
            const addCompanyClose = document.querySelector('[data-add-company-close]');

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

            function ensureAbsoluteUrl(rawValue) {
                if (!rawValue) return '';
                let value = rawValue.trim();
                if (!value) return '';
                if (!/^https?:\/\//i.test(value)) {
                    value = `https://${value}`;
                }
                return value;
            }

            function isValidHttpUrl(value) {
                try {
                    const parsed = new URL(value);
                    return ['http:', 'https:'].includes(parsed.protocol);
                } catch (error) {
                    return false;
                }
            }

            function formatCompanyNameFromUrl(urlValue) {
                try {
                    const parsed = new URL(urlValue);
                    let host = parsed.hostname.replace(/^www\./i, '');
                    const hostParts = host.split('.');
                    if (hostParts.length > 2) {
                        host = hostParts.slice(0, -1).join(' ');
                    } else {
                        host = hostParts[0];
                    }
                    const cleaned = host.replace(/[-_]/g, ' ').trim();
                    if (!cleaned) return 'New solar installer';
                    return cleaned.replace(/\b\w/g, (char) => char.toUpperCase());
                } catch (error) {
                    return 'New solar installer';
                }
            }

            function showAddCompanyModal() {
                if (!addCompanyModal) return;
                addCompanyModal.hidden = false;
                addCompanyModal.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
                if (addCompanyInput) {
                    addCompanyInput.value = '';
                    setTimeout(() => addCompanyInput.focus(), 50);
                }
                if (addCompanyError) {
                    addCompanyError.classList.remove('is-visible');
                }
            }

            function hideAddCompanyModal() {
                if (!addCompanyModal) return;
                addCompanyModal.hidden = true;
                addCompanyModal.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
                if (addCompanyInput) {
                    addCompanyInput.value = '';
                }
                if (addCompanyError) {
                    addCompanyError.classList.remove('is-visible');
                }
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
                const normalized = term.toLowerCase();
                return companies.filter(company =>
                    company.name.toLowerCase().includes(normalized)
                );
            }

            function updateSuggestions(rawTerm) {
                const term = rawTerm.trim();

                if (!term) {
                    hideSuggestions();
                    return;
                }

                const matches = filterCompanies(term);
                renderSuggestions(matches);
            }

            function openReviewModal(company) {
                hideSuggestions();
                input.value = company.name;

                hiddenTrigger.dataset.companyId = company.id ?? '';
                hiddenTrigger.dataset.companyName = company.name ?? '';
                hiddenTrigger.dataset.stateId = company.state_id ?? '';
                hiddenTrigger.dataset.stateName = company.state_name ?? '';
                hiddenTrigger.dataset.categoryIds = (company.category_ids || []).join(',');
                hiddenTrigger.dataset.companyUrl = '';

                hiddenTrigger.click();
            }

            function openManualCompanyReview(urlValue) {
                const derivedName = urlValue ? formatCompanyNameFromUrl(urlValue) : 'Other Solar Company';
                hiddenTrigger.dataset.companyId = '0';
                hiddenTrigger.dataset.companyName = derivedName;
                hiddenTrigger.dataset.stateId = '';
                hiddenTrigger.dataset.stateName = '';
                hiddenTrigger.dataset.categoryIds = '';
                hiddenTrigger.dataset.companyUrl = urlValue;

                hiddenTrigger.click();
            }

            input.addEventListener('input', (event) => {
                updateSuggestions(event.target.value);
            });

            input.addEventListener('focus', () => {
                if (input.value.trim()) {
                    updateSuggestions(input.value);
                }
            });

            searchBtn?.addEventListener('click', () => {
                updateSuggestions(input.value);
            });

            document.addEventListener('click', (event) => {
                if (!suggestions.contains(event.target) && !form.contains(event.target)) {
                    hideSuggestions();
                }
            });

            addCompanyBtn?.addEventListener('click', (event) => {
                event.preventDefault();
                showAddCompanyModal();
            });

            addCompanyClose?.addEventListener('click', (event) => {
                event.preventDefault();
                hideAddCompanyModal();
            });

            addCompanyModal?.addEventListener('click', (event) => {
                if (event.target === addCompanyModal) {
                    hideAddCompanyModal();
                }
            });

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape' && addCompanyModal && !addCompanyModal.hidden) {
                    hideAddCompanyModal();
                }
            });

            addCompanyForm?.addEventListener('submit', (event) => {
                event.preventDefault();
                if (!addCompanyInput) return;
                const normalizedUrl = ensureAbsoluteUrl(addCompanyInput.value);
                if (!normalizedUrl || !isValidHttpUrl(normalizedUrl)) {
                    addCompanyError?.classList.add('is-visible');
                    return;
                }
                addCompanyError?.classList.remove('is-visible');
                hideAddCompanyModal();
                openManualCompanyReview(normalizedUrl);
            });

            // Continue without URL handler
            const continueWithoutUrlBtn = document.querySelector('[data-continue-without-url]');
            continueWithoutUrlBtn?.addEventListener('click', (event) => {
                event.preventDefault();
                hideAddCompanyModal();
                openManualCompanyReview(''); // Pass empty URL
            });
        });
    </script>
</body>
</html>
