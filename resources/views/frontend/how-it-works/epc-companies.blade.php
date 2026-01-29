<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How it works for EPC Companies - Solar Reviews</title>
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
            background: linear-gradient(120deg, #1e3a8a, #0b2a5b);
            color: #fff;
            padding: 4rem 0;
        }

        .hero h1 {
            font-size: clamp(2rem, 4vw, 2.8rem);
            font-weight: 700;
            margin-bottom: 0.75rem;
        }

        .hero p {
            max-width: 780px;
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
            box-shadow: 0 0 0 0.25rem rgba(30, 58, 138, 0.15);
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
                <h1>For EPC Companies</h1>
                <p>Build trust, showcase your work, and convert more leads by maintaining a strong presence with transparent, verified customer feedback.</p>
            </div>
        </section>

        <section class="content">
            <div class="container-custom">
                <div class="content-card">
                    <div class="accordion faq-accordion" id="howItWorksEpcFaq">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="epcFaqHeadingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#epcFaqCollapseOne" aria-expanded="true" aria-controls="epcFaqCollapseOne">
                                    1. Why should my EPC business be on SolaReviews?
                                </button>
                            </h2>
                            <div id="epcFaqCollapseOne" class="accordion-collapse collapse show" aria-labelledby="epcFaqHeadingOne" data-bs-parent="#howItWorksEpcFaq">
                                <div class="accordion-body">
                                    <p>Being on SolaReviews.in boosts your online reputation by showing real customer feedback, increases visibility to potential solar buyers, and helps you stand out from competitors. Reviews build trust and lead customers to choose your services.</p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="epcFaqHeadingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#epcFaqCollapseTwo" aria-expanded="false" aria-controls="epcFaqCollapseTwo">
                                    2. Is creating an EPC profile free?
                                </button>
                            </h2>
                            <div id="epcFaqCollapseTwo" class="accordion-collapse collapse" aria-labelledby="epcFaqHeadingTwo" data-bs-parent="#howItWorksEpcFaq">
                                <div class="accordion-body">
                                    <p>Yes — creating and listing your EPC business profile on SolaReviews.in is free. You only pay for optional premium features (if any) that increase visibility or marketing reach.</p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="epcFaqHeadingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#epcFaqCollapseThree" aria-expanded="false" aria-controls="epcFaqCollapseThree">
                                    3. How do I claim my EPC profile?
                                </button>
                            </h2>
                            <div id="epcFaqCollapseThree" class="accordion-collapse collapse" aria-labelledby="epcFaqHeadingThree" data-bs-parent="#howItWorksEpcFaq">
                                <div class="accordion-body">
                                    <p>To claim your EPC profile:</p>
                                    <ul>
                                        <li>Search for your business on SolarReviews.in.</li>
                                        <li>Click “Claim this Profile.”</li>
                                        <li>Verify ownership through email or business documents.</li>
                                        <li>Once confirmed, you can manage and update your profile.</li>
                                    </ul>
                                    <p>This ensures only you control your business listing.</p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="epcFaqHeadingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#epcFaqCollapseFour" aria-expanded="false" aria-controls="epcFaqCollapseFour">
                                    4. Can I respond to customer reviews?
                                </button>
                            </h2>
                            <div id="epcFaqCollapseFour" class="accordion-collapse collapse" aria-labelledby="epcFaqHeadingFour" data-bs-parent="#howItWorksEpcFaq">
                                <div class="accordion-body">
                                    <p>Yes — once you’ve claimed your EPC profile, you can respond publicly to customer reviews. This lets you:</p>
                                    <ul>
                                        <li>Thank satisfied customers</li>
                                        <li>Address concerns professionally</li>
                                        <li>Show transparency and customer care</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="epcFaqHeadingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#epcFaqCollapseFive" aria-expanded="false" aria-controls="epcFaqCollapseFive">
                                    5. How does SolaReviews rank EPCs?
                                </button>
                            </h2>
                            <div id="epcFaqCollapseFive" class="accordion-collapse collapse" aria-labelledby="epcFaqHeadingFive" data-bs-parent="#howItWorksEpcFaq">
                                <div class="accordion-body">
                                    <p>SolaReviews uses a ranking algorithm based on:</p>
                                    <ul>
                                        <li>Number of verified reviews</li>
                                        <li>Average rating</li>
                                        <li>Recency of reviews</li>
                                        <li>Customer engagement (responses, photos)</li>
                                    </ul>
                                    <p>This helps highlight consistently high-quality EPCs for users.</p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="epcFaqHeadingSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#epcFaqCollapseSix" aria-expanded="false" aria-controls="epcFaqCollapseSix">
                                    6. What benefit do I get with more verified reviews?
                                </button>
                            </h2>
                            <div id="epcFaqCollapseSix" class="accordion-collapse collapse" aria-labelledby="epcFaqHeadingSix" data-bs-parent="#howItWorksEpcFaq">
                                <div class="accordion-body">
                                    <p>More verified reviews help your business by:</p>
                                    <ul>
                                        <li>Increasing trust among potential customers</li>
                                        <li>Improving your rank in search and lists</li>
                                        <li>Highlighting strengths through real experiences</li>
                                        <li>Reducing uncertainty for buyers</li>
                                    </ul>
                                    <p>Verified reviews act as social proof that your services are reliable.</p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="epcFaqHeadingSeven">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#epcFaqCollapseSeven" aria-expanded="false" aria-controls="epcFaqCollapseSeven">
                                    7. Can a negative review harm my business?
                                </button>
                            </h2>
                            <div id="epcFaqCollapseSeven" class="accordion-collapse collapse" aria-labelledby="epcFaqHeadingSeven" data-bs-parent="#howItWorksEpcFaq">
                                <div class="accordion-body">
                                    <p>A single negative review won’t ruin your reputation — and honestly, potential customers expect a mix of feedback. What matters most is:</p>
                                    <ul>
                                        <li>How you respond professionally</li>
                                        <li>Learning from feedback to improve services</li>
                                    </ul>
                                    <p>Consistent positive reviews outweigh occasional negatives.</p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="epcFaqHeadingEight">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#epcFaqCollapseEight" aria-expanded="false" aria-controls="epcFaqCollapseEight">
                                    8. Can I upload my own project photos & certifications?
                                </button>
                            </h2>
                            <div id="epcFaqCollapseEight" class="accordion-collapse collapse" aria-labelledby="epcFaqHeadingEight" data-bs-parent="#howItWorksEpcFaq">
                                <div class="accordion-body">
                                    <p>Yes — once your EPC profile is claimed, you can upload:</p>
                                    <ul>
                                        <li>Project installation photos</li>
                                        <li>Certifications & accreditations</li>
                                        <li>Team and equipment photos</li>
                                    </ul>
                                    <p>These visuals build credibility and show your expertise to users.</p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="epcFaqHeadingNine">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#epcFaqCollapseNine" aria-expanded="false" aria-controls="epcFaqCollapseNine">
                                    9. Do you provide leads?
                                </button>
                            </h2>
                            <div id="epcFaqCollapseNine" class="accordion-collapse collapse" aria-labelledby="epcFaqHeadingNine" data-bs-parent="#howItWorksEpcFaq">
                                <div class="accordion-body">
                                    <p>SolaReviews.in doesn’t sell leads directly, but a strong presence on the platform drives organic inquiries. Customers looking for installers often contact businesses directly after reading reviews — effectively turning your profile into a lead-generation tool.</p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="epcFaqHeadingTen">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#epcFaqCollapseTen" aria-expanded="false" aria-controls="epcFaqCollapseTen">
                                    10. How do I get a Verified EPC badge?
                                </button>
                            </h2>
                            <div id="epcFaqCollapseTen" class="accordion-collapse collapse" aria-labelledby="epcFaqHeadingTen" data-bs-parent="#howItWorksEpcFaq">
                                <div class="accordion-body">
                                    <p>The Verified EPC badge is awarded when your business:</p>
                                    <ul>
                                        <li>Has an authenticated profile</li>
                                        <li>Has several verified customer reviews</li>
                                        <li>Meets quality standards in engagement and responsiveness</li>
                                    </ul>
                                    <p>This badge signals trust and reliability to solar buyers.</p>
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
