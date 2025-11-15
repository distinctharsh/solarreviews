<style>
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
        height: 60px;
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

<footer class="footer py-5">
    <div class="container-custom">
        <div class="row g-4 mb-4">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="footer-about">
                    <a href="/" class="d-inline-block mb-3">
                        <img src="{{ asset('images/2.png') }}" alt="SolarReviews Logo" class="footer-logo">
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
        <div class="container-custom text-center">
            <p class="mb-0" style="font-size: 0.875rem;">&copy; {{ date('Y') }} SolarReviews. All rights reserved.</p>
        </div>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const footerToggles = document.querySelectorAll('.footer-toggle');
        if (!footerToggles.length) {
            return;
        }

        const mobileQuery = window.matchMedia('(max-width: 575px)');

        const applyFooterState = () => {
            const isMobile = mobileQuery.matches;
            footerToggles.forEach(toggle => {
                const content = toggle.nextElementSibling;
                if (!content) return;

                if (isMobile) {
                    if (!content.dataset.userAdjusted) {
                        content.classList.remove('is-open');
                        toggle.setAttribute('aria-expanded', 'false');
                    }
                } else {
                    content.classList.add('is-open');
                    toggle.setAttribute('aria-expanded', 'true');
                    delete content.dataset.userAdjusted;
                }
            });
        };

        const handleToggleClick = (event) => {
            const toggle = event.currentTarget;
            if (!mobileQuery.matches) {
                return;
            }

            const content = toggle.nextElementSibling;
            if (!content) {
                return;
            }

            const isNowOpen = content.classList.toggle('is-open');
            toggle.setAttribute('aria-expanded', isNowOpen ? 'true' : 'false');
            if (isNowOpen) {
                content.dataset.userAdjusted = 'true';
            } else {
                delete content.dataset.userAdjusted;
            }
        };

        footerToggles.forEach(toggle => {
            toggle.addEventListener('click', handleToggleClick);
        });

        applyFooterState();

        const handleViewportChange = () => {
            footerToggles.forEach(toggle => {
                const content = toggle.nextElementSibling;
                if (content) {
                    delete content.dataset.userAdjusted;
                }
            });
            applyFooterState();
        };

        if (mobileQuery.addEventListener) {
            mobileQuery.addEventListener('change', handleViewportChange);
        } else if (mobileQuery.addListener) {
            mobileQuery.addListener(handleViewportChange);
        }
    });
</script>
