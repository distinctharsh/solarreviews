<style>
    .footer {
        background-color: #11411a;
        color: #f3f4f6;
    }

    .footer-links h3 {
        position: relative;
        padding-bottom: 0.75rem;
    }

    .footer-links h3::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 2px;
        background-color: #ffffff;
    }

    .footer-links ul {
        list-style: none;
        padding: 0;
        margin: 0;
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
</style>

<footer class="footer py-5">
    <div class="container-custom">
        <div class="row g-4 mb-4">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="footer-about">
                    <a href="/" class="d-inline-block mb-3">
                        <img src="{{ asset('images/logo2.png') }}" alt="SolarReviews Logo" style="height: 70px;">
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
                    <h3 class="text-white mb-3" style="font-size: 1.125rem;">Quick Links</h3>
                    <ul>
                        <li class="mb-2"><a href="#">How It Works</a></li>
                        <li class="mb-2"><a href="#">Solar Companies</a></li>
                        <li class="mb-2"><a href="#">Reviews</a></li>
                        <li class="mb-2"><a href="#">Blog</a></li>
                        <li class="mb-2"><a href="#">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="footer-links">
                    <h3 class="text-white mb-3" style="font-size: 1.125rem;">Solar Resources</h3>
                    <ul>
                        <li class="mb-2"><a href="#">Solar Guides</a></li>
                        <li class="mb-2"><a href="#">Solar Calculator</a></li>
                        <li class="mb-2"><a href="#">Solar Incentives</a></li>
                        <li class="mb-2"><a href="#">Financing Options</a></li>
                        <li class="mb-2"><a href="#">FAQ</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="footer-links">
                    <h3 class="text-white mb-3" style="font-size: 1.125rem;">Legal</h3>
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
    <div class="border-top border-secondary pt-4">
        <div class="container-custom text-center">
            <p class="mb-0" style="font-size: 0.875rem;">&copy; {{ date('Y') }} SolarReviews. All rights reserved.</p>
        </div>
    </div>
</footer>
