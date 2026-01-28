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
            background: rgba(30,58,138,0.12);
            color: #1e3a8a;
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

        .note {
            margin-top: 1.75rem;
            border-radius: 16px;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            padding: 1.25rem 1.25rem;
            color: #1e3a8a;
        }

        .note strong {
            color: #0b2a5b;
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
                    <div class="step">
                        <div class="step-number">1</div>
                        <div>
                            <h3>Create and optimize your company profile</h3>
                            <p>Ensure your company details are accurate so customers can understand your offerings, service areas and experience.</p>
                        </div>
                    </div>

                    <div class="step">
                        <div class="step-number">2</div>
                        <div>
                            <h3>Deliver great installations</h3>
                            <p>High-quality installs and responsive support lead to better reviews and higher conversion rates.</p>
                        </div>
                    </div>

                    <div class="step">
                        <div class="step-number">3</div>
                        <div>
                            <h3>Collect and respond to customer feedback</h3>
                            <p>Encourage customers to leave honest reviews and address concerns quickly to build credibility.</p>
                        </div>
                    </div>

                    <div class="step">
                        <div class="step-number">4</div>
                        <div>
                            <h3>Grow through visibility and trust</h3>
                            <p>Strong ratings and consistent engagement help you stand out when customers compare EPC partners.</p>
                        </div>
                    </div>

                    <div class="note">
                        <strong>Tip:</strong> Keep your contact information, service locations and website up to date so customers can reach you easily.
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
