<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier & Distributor FAQ - SolarReviews</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        :root {
            --primary: #1f8335;
            --secondary: #0f5132;
            --body: #4b5563;
            --muted: #94a3b8;
            --light: #f8fafc;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--light);
            color: var(--body);
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

        .faq-hero {
            background: linear-gradient(120deg, #1f8335, #0b3d23);
            color: #fff;
            padding: 4rem 0;
        }

        .faq-hero h1 {
            font-size: clamp(2rem, 4vw, 2.8rem);
            font-weight: 700;
            margin-bottom: 0.75rem;
        }

        .faq-hero p {
            max-width: 720px;
            color: rgba(255,255,255,0.9);
        }

        .faq-content {
            padding: 0 0 4rem;
        }

        .faq-wrapper {
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 35px 70px rgba(15,23,42,0.12);
            padding: 3rem 2.5rem;
            margin-top: -3.5rem;
        }

        @media (max-width: 576px) {
            .faq-wrapper {
                padding: 2rem 1.25rem;
            }
        }

        details {
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 1rem 1.25rem;
            background: #fdfefe;
        }

        details summary {
            list-style: none;
            cursor: pointer;
            font-weight: 600;
            color: #0f172a;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1.5rem;
        }

        details summary::-webkit-details-marker {
            display: none;
        }

        details summary::after {
            content: '\f078';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            color: var(--primary);
            transition: transform 0.2s ease;
        }

        details[open] summary::after {
            transform: rotate(180deg);
        }

        details p {
            margin-top: 0.85rem;
            color: var(--body);
            font-size: 0.98rem;
            line-height: 1.65;
        }

        details + details {
            margin-top: 1rem;
        }

        .faq-label {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #fff;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        @include('components.frontend.navbar')

        <section class="faq-hero">
            <div class="container-custom">
                <div class="faq-label">
                    <i class="fa-solid fa-circle-question"></i>
                    FAQ for distributors & suppliers
                </div>
                <h1>Frequently Asked Questions</h1>
                <p>Everything distributors, suppliers, dealers, and installers need to know about listing on SolarReviews.</p>
            </div>
        </section>

        <section class="faq-content">
            <div class="container-custom">
                <div class="faq-wrapper">
                    <div class="faq-list">
            @php
                $faqs = [
                    [
                        'q' => 'Q1. What kind of reviews and data does your website provide — is it only for homeowners, or also for distributors / dealers / installers / suppliers?',
                        'a' => 'Our platform includes reviews and data for all relevant stakeholders: solar panel/inverter manufacturers, system suppliers, distributors, dealers, and installers — not just homeowners. For each review or listing, we clearly indicate the type of reviewer (homeowner, installer, B2B buyer) so that visitors understand the context.'
                    ],
                    [
                        'q' => 'Q2. Can I list my company or products (panels, inverters, batteries, accessories) on your website as a supplier or distributor?',
                        'a' => 'Yes — you can submit your company profile and product catalog through our “Become a Supplier / Distributor” form. Once approved, we list your company as a registered supplier/distributor/vendor so potential clients can view your profile and contact you.'
                    ],
                    [
                        'q' => 'Q3. Do you show technical specifications, certifications, performance data, warranty / guarantee details, and actual user/installer feedback for listed products?',
                        'a' => 'Absolutely. Each product listing or supplier page can include detailed technical specs, certifications, warranty information, and, where available, real reviews or feedback from buyers or installers so buyers can make confident decisions.'
                    ],
                    [
                        'q' => 'Q4. If I register as a distributor/supplier, can you forward leads or enquiries from buyers/installers to me?',
                        'a' => 'Yes. Each supplier listing includes an enquiry/contact action. When a visitor submits a form, we either forward the lead to you (with your consent) or display your contact details so the buyer can reach you directly.'
                    ],
                    [
                        'q' => 'Q5. How do I know your reviews and data are credible? Are there measures to avoid fake or biased reviews?',
                        'a' => 'We value transparency and credibility. We display review counts, reviewer types (homeowner / installer / B2B), and a “verified reviewer” badge where applicable. Our team moderates submissions and removes suspicious or unsubstantiated entries.'
                    ],
                    [
                        'q' => 'Q6. Does your site cover all kinds of solar systems — residential, commercial, industrial; rooftop, ground-mount; hybrid or battery-storage systems?',
                        'a' => 'Yes — our database spans residential rooftop, commercial ground-mount, industrial-scale installs, and hybrid/battery-storage solutions. Suppliers can list under the categories that match their specialization.'
                    ],
                    [
                        'q' => 'Q7. Do you provide price transparency — like approximate price ranges — or at least a quote-request option for buyers?',
                        'a' => 'We provide flexibility. If you agree, we can display approximate price ranges. Otherwise, buyers can use “Request for Quote (RFQ)” or “Contact for Price” so you control exact pricing conversations.'
                    ],
                    [
                        'q' => 'Q8. Can buyers/installers rate or review not only the products but also suppliers/distributors — for service quality, delivery, reliability, support, etc.?',
                        'a' => 'Yes — we maintain a “Supplier / Distributor Reviews & Ratings” section where buyers, installers, or other clients can evaluate service quality, delivery, support, and reliability.'
                    ],
                    [
                        'q' => 'Q9. Do you offer “featured” or “premium” listings — e.g. promoted supplier or product listing — if we want more visibility?',
                        'a' => 'Yes — we offer featured or premium listing options so your profile or products receive elevated placement (highlighted spots, top listing, etc.) under mutually agreed terms.'
                    ],
                    [
                        'q' => 'Q10. What happens after I submit my company/product details — how is the verification and approval process handled?',
                        'a' => 'After submission, our team reviews the details for completeness and authenticity. We may request supporting documents. Once approved, your listing goes live—often with a “Verified Supplier” badge.'
                    ],
                    [
                        'q' => 'Q11. Can I update my product catalog or listing details after the listing is live?',
                        'a' => 'Yes — we offer a supplier dashboard so you can update catalogs, specs, prices, warranties, certifications, and contact information whenever needed.'
                    ],
                    [
                        'q' => 'Q12. Do you provide analytics or reports to suppliers — e.g. how many people viewed my listing, how many enquiries came, how many quotes requested, etc.?',
                        'a' => 'Yes — suppliers receive basic analytics including listing views, enquiry counts, and RFQ submissions so you can measure interest and follow up effectively.'
                    ],
                    [
                        'q' => 'Q13. Is there any cost or fee for listing as supplier/distributor or for using your lead-generation / premium listing services?',
                        'a' => 'We offer a free basic listing (subject to approval). Premium visibility, promoted listings, and lead-generation boosts fall under optional paid plans with transparent pricing.'
                    ],
                    [
                        'q' => 'Q14. Do you support multiple regions / languages / markets — e.g. if I operate in multiple states or supply across India / globally?',
                        'a' => 'Yes — our platform supports multi-region listings. Specify the states or regions you serve, list multiple warehouses or service areas, and reach buyers wherever you operate.'
                    ],
                    [
                        'q' => 'Q15. Do you provide after-sales support, complaint-handling or conflict-resolution — especially if a buyer complains about product quality or delivery?',
                        'a' => 'We operate as a neutral marketplace and review platform. Buyers and suppliers resolve product quality or delivery issues directly, while we mediate only in cases of review disputes or policy misuse.'
                    ],
                ];
            @endphp

            @foreach($faqs as $faq)
                <details class="faq-item">
                    <summary>{{ $faq['q'] }}</summary>
                    <p>{{ $faq['a'] }}</p>
                </details>
                    @endforeach
                    </div>
                </div>
            </div>
        </section>

        @include('components.frontend.footer')
    </div>
</body>
</html>
