<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How it works for Customers - Solar Reviews</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8fafc;
            color: #1f2937;
            margin: 0;
        }

        .page-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
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

        .hero {
            background: linear-gradient(120deg, #1f8335, #0b3d23);
            color: #fff;
            padding: 4rem 0;
        }

        .hero h1 {
            font-size: clamp(2rem, 4vw, 2.8rem);
            font-weight: 700;
            margin-bottom: 0.75rem;
        }

        .hero p {
            max-width: 760px;
            color: rgba(255,255,255,0.9);
            margin: 0;
        }

        .content {
            padding: 0 0 4rem;
        }

        .content-card {
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 35px 70px rgba(15,23,42,0.12);
            padding: 3rem 2.5rem;
            margin-top: -3.5rem;
        }

        @media (max-width: 576px) {
            .content-card {
                padding: 2rem 1.25rem;
            }
        }

        .step {
            display: grid;
            grid-template-columns: 44px 1fr;
            gap: 1rem;
            padding: 1.15rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #fdfefe;
        }

        .step + .step {
            margin-top: 1rem;
        }

        .step-number {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            background: rgba(31,131,53,0.12);
            color: #1f8335;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .step h3 {
            font-size: 1.05rem;
            font-weight: 700;
            margin: 0 0 0.35rem;
            color: #0f172a;
        }

        .step p {
            margin: 0;
            color: #4b5563;
            line-height: 1.65;
        }

        .faq-item + .faq-item {
            margin-top: 1rem;
        }

        .faq-item h3 {
            font-size: 1.05rem;
            font-weight: 700;
            margin: 0 0 0.35rem;
            color: #0f172a;
        }

        .faq-item p {
            margin: 0;
            color: #4b5563;
            line-height: 1.7;
        }

        .faq-item ul {
            margin: 0.5rem 0 0;
            padding-left: 1.1rem;
            color: #4b5563;
            line-height: 1.7;
        }

        .faq-accordion .accordion-item {
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
        }

        .faq-accordion .accordion-item + .accordion-item {
            margin-top: 1rem;
        }

        .faq-accordion .accordion-button {
            font-weight: 700;
            color: #0f172a;
            background: #fdfefe;
            padding: 1.1rem 1.1rem;
        }

        .faq-accordion .accordion-button:not(.collapsed) {
            color: #0f172a;
            background: #f8fafc;
            box-shadow: none;
        }

        .faq-accordion .accordion-button:focus {
            box-shadow: 0 0 0 0.25rem rgba(31, 131, 53, 0.15);
        }

        .faq-accordion .accordion-body {
            padding: 1.1rem 1.1rem;
            color: #4b5563 !important;
            line-height: 1.75;
            background: #ffffff;
            visibility: visible;
            opacity: 1;
            position: relative;
            z-index: 1;
        }

        .faq-accordion .accordion-body * {
            color: inherit !important;
            visibility: visible;
            opacity: 1;
        }

        .faq-accordion .accordion-collapse {
            background: #ffffff;
        }

        .faq-accordion .accordion-body p {
            margin-bottom: 0.75rem;
        }

        .faq-accordion .accordion-body p:last-child {
            margin-bottom: 0;
        }

        .faq-accordion .accordion-body ul {
            margin: 0.25rem 0 0.75rem;
            padding-left: 1.15rem;
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        @include('components.frontend.navbar')

        <section class="hero">
            <div class="container-custom">
                <p class="text-uppercase fw-semibold mb-2" style="letter-spacing: 1.5px; opacity: 0.9;">How it works</p>
                <h1>For Customers</h1>
                <p>Find verified reviews, compare EPC companies, and make smarter solar decisions with SolarReviews.in.</p>
            </div>
        </section>

        <section class="content">
            <div class="container-custom">
                <div class="content-card">
                    <div class="accordion faq-accordion" id="howItWorksCustomersFaq">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeadingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseOne" aria-expanded="true" aria-controls="faqCollapseOne">
                                    1. What is Solar Review?
                                </button>
                            </h2>
                            <div id="faqCollapseOne" class="accordion-collapse collapse show" aria-labelledby="faqHeadingOne" data-bs-parent="#howItWorksCustomersFaq">
                                <div class="accordion-body">
                                    <p>SolarReviews.in is a platform where solar customers share honest reviews about their solar installers (EPC companies), products, and overall experience. It helps other users make smarter choices when selecting solar services or products.</p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeadingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseTwo" aria-expanded="false" aria-controls="faqCollapseTwo">
                                    2. How are reviews verified?
                                </button>
                            </h2>
                            <div id="faqCollapseTwo" class="accordion-collapse collapse" aria-labelledby="faqHeadingTwo" data-bs-parent="#howItWorksCustomersFaq">
                                <div class="accordion-body">
                                    <p>Reviews on SolarReviews.in are verified through checks like:</p>
                                    <ul>
                                        <li>Confirming your basic details (name, location, email).</li>
                                        <li>Ensuring each review is tied to a real installation experience.</li>
                                        <li>Using moderation tools and filters to prevent fake or spam reviews.</li>
                                    </ul>
                                    <p>This keeps the platform authentic and trustworthy.</p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeadingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseThree" aria-expanded="false" aria-controls="faqCollapseThree">
                                    3. Why should I trust the reviews here?
                                </button>
                            </h2>
                            <div id="faqCollapseThree" class="accordion-collapse collapse" aria-labelledby="faqHeadingThree" data-bs-parent="#howItWorksCustomersFaq">
                                <div class="accordion-body">
                                    <p>You can trust the reviews because:</p>
                                    <ul>
                                        <li>They come from real solar customers.</li>
                                        <li>Each review goes through verification before publication.</li>
                                        <li>The platform discourages fake or promotional reviews.</li>
                                        <li>All opinions — positive or negative — are allowed as long as they’re honest.</li>
                                    </ul>
                                    <p>This transparency helps you make informed decisions.</p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeadingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseFour" aria-expanded="false" aria-controls="faqCollapseFour">
                                    4. Does SolarReview charge me anything?
                                </button>
                            </h2>
                            <div id="faqCollapseFour" class="accordion-collapse collapse" aria-labelledby="faqHeadingFour" data-bs-parent="#howItWorksCustomersFaq">
                                <div class="accordion-body">
                                    <p>No — SolarReviews.in is free for users. You don’t pay to read reviews, write one, or compare installers. The platform may earn from non-intrusive ads or sponsored listings, but your access to reviews is always free.</p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeadingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseFive" aria-expanded="false" aria-controls="faqCollapseFive">
                                    5. Can I compare different EPC companies?
                                </button>
                            </h2>
                            <div id="faqCollapseFive" class="accordion-collapse collapse" aria-labelledby="faqHeadingFive" data-bs-parent="#howItWorksCustomersFaq">
                                <div class="accordion-body">
                                    <p>Yes! You can easily compare EPC companies based on:</p>
                                    <ul>
                                        <li>User ratings</li>
                                        <li>Detailed reviews</li>
                                        <li>Installation quality</li>
                                        <li>Service experience</li>
                                        <li>Product performance</li>
                                    </ul>
                                    <p>This makes choosing the right installer easier.</p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeadingSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseSix" aria-expanded="false" aria-controls="faqCollapseSix">
                                    6. What if my EPC company is not listed?
                                </button>
                            </h2>
                            <div id="faqCollapseSix" class="accordion-collapse collapse" aria-labelledby="faqHeadingSix" data-bs-parent="#howItWorksCustomersFaq">
                                <div class="accordion-body">
                                    <p>If your installer (EPC company) isn’t listed yet:</p>
                                    <ul>
                                        <li>You may be able to add them when writing your review.</li>
                                        <li>SolarReviews.in can expand its database regularly, so new entries can be added through user contributions or platform updates.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeadingSeven">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseSeven" aria-expanded="false" aria-controls="faqCollapseSeven">
                                    7. Do I get help in choosing the best EPC?
                                </button>
                            </h2>
                            <div id="faqCollapseSeven" class="accordion-collapse collapse" aria-labelledby="faqHeadingSeven" data-bs-parent="#howItWorksCustomersFaq">
                                <div class="accordion-body">
                                    <p>Yes! The platform helps you choose by:</p>
                                    <ul>
                                        <li>Showing top-rated EPCs</li>
                                        <li>Letting you filter by location, rating, and services</li>
                                        <li>Providing real user insights</li>
                                        <li>Offering comparison tools</li>
                                    </ul>
                                    <p>This support makes your solar decision easier.</p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeadingEight">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseEight" aria-expanded="false" aria-controls="faqCollapseEight">
                                    8. Can I upload photos of my installations?
                                </button>
                            </h2>
                            <div id="faqCollapseEight" class="accordion-collapse collapse" aria-labelledby="faqHeadingEight" data-bs-parent="#howItWorksCustomersFaq">
                                <div class="accordion-body">
                                    <p>Absolutely! Users can upload photos of their solar installation (e.g., panels, inverters, meters). This:</p>
                                    <ul>
                                        <li>Makes your review more helpful</li>
                                        <li>Shows real work quality</li>
                                        <li>Helps future buyers see what to expect</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeadingNine">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseNine" aria-expanded="false" aria-controls="faqCollapseNine">
                                    9. Will the EPC see my review?
                                </button>
                            </h2>
                            <div id="faqCollapseNine" class="accordion-collapse collapse" aria-labelledby="faqHeadingNine" data-bs-parent="#howItWorksCustomersFaq">
                                <div class="accordion-body">
                                    <p>Yes — EPC companies can see reviews about them. This allows them to:</p>
                                    <ul>
                                        <li>Respond to feedback</li>
                                        <li>Improve their services</li>
                                        <li>Thank customers for positive reviews</li>
                                    </ul>
                                    <p>However, your contact details stay private unless you choose to share them.</p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeadingTen">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseTen" aria-expanded="false" aria-controls="faqCollapseTen">
                                    10. Can I edit my review?
                                </button>
                            </h2>
                            <div id="faqCollapseTen" class="accordion-collapse collapse" aria-labelledby="faqHeadingTen" data-bs-parent="#howItWorksCustomersFaq">
                                <div class="accordion-body">
                                    <p>Yes — you can edit your review after posting if:</p>
                                    <ul>
                                        <li>You want to update information</li>
                                        <li>You feel something’s incorrect</li>
                                        <li>Your experience changes over time</li>
                                    </ul>
                                    <p>Just log in and manage your reviews easily.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @include('components.frontend.footer')
        @include('components.frontend.chatbot-widget')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </div>
</body>
</html>
