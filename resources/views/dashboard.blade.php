@php($user = auth()->user())

@if($user?->is_admin)
    <script>
        window.location.href = '{{ route('admin.dashboard') }}';
    </script>
@else


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
            --text: #0f172a;
            --muted: #64748b;
            --border: #e4e7ec;
            --surface: #ffffff;
            --subtle: #f5f7fb;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #ffffff;
            color: var(--text);
            min-height: 100vh;
        }

        .container-custom {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.75rem;
        }

        @media (max-width: 768px) {
            .container-custom {
                padding: 0 1.25rem;
            }
        }

        .dashboard-page {
            background: #ffffff;
            padding: 48px 0 80px;
        }

        .dashboard-hero {
            padding: 16px 0 40px;
            border-bottom: 1px solid var(--border);
            background: #fff;
        }

        .hero-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 32px;
            padding: 2.5rem;
            box-shadow: 0 40px 65px rgba(15, 23, 42, 0.08);
            display: flex;
            flex-wrap: wrap;
            gap: 2.5rem;
            align-items: center;
        }

        .hero-chip {
            display: inline-flex;
            padding: 0.35rem 1rem;
            border-radius: 999px;
            font-size: 0.8rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            background: rgba(59, 161, 76, 0.12);
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .hero-card h1 {
            font-size: clamp(2rem, 3.5vw, 3rem);
            margin-bottom: 0.8rem;
        }

        .hero-card p {
            color: var(--muted);
            max-width: 540px;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: 1.75rem;
        }

        .btn-primary {
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 999px;
            padding: 0.85rem 1.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 14px 30px rgba(59, 161, 76, 0.25);
        }

        .btn-outline {
            border: 1px solid var(--border);
            border-radius: 999px;
            padding: 0.85rem 1.5rem;
            font-weight: 600;
            background: transparent;
            color: var(--text);
        }

        .hero-progress {
            background: #f4fbf6;
            border-radius: 24px;
            padding: 2rem;
            border: 1px solid #c8ebd2;
            min-width: 260px;
        }

        .progress-label {
            text-transform: uppercase;
            letter-spacing: 0.25em;
            font-size: 0.75rem;
            color: #1c3d1f;
            margin-bottom: 0.6rem;
        }

        .progress-value {
            font-size: clamp(2.2rem, 3vw, 2.8rem);
            font-weight: 700;
            margin: 0;
            color: #18562e;
        }

        .progress-meter {
            height: 10px;
            border-radius: 999px;
            background: #dfeee4;
            margin: 1rem 0 0.65rem;
            overflow: hidden;
        }

        .progress-meter span {
            display: block;
            height: 100%;
            background: linear-gradient(90deg, rgba(59,161,76,1) 0%, rgba(130,214,131,1) 100%);
        }

        .section {
            padding: 48px 0;
        }

        .section-heading {
            margin-bottom: 24px;
        }

        .section-heading h3 {
            margin-bottom: 0.35rem;
            font-size: 1.35rem;
        }

        .section-heading p {
            color: var(--muted);
        }

        .highlight-grid {
            display: grid;
            gap: 24px;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        }

        .highlight-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 28px;
            padding: 24px;
            box-shadow: 0 18px 35px rgba(15, 23, 42, 0.06);
        }

        .highlight-card .chip {
            text-transform: uppercase;
            letter-spacing: 0.12em;
            font-size: 0.73rem;
            color: var(--muted);
        }

        .accent-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.35rem 0.85rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 600;
            background: rgba(59, 161, 76, 0.12);
            color: var(--primary);
        }

        .tag-button {
            border: 1px dashed var(--border);
            border-radius: 14px;
            padding: 0.85rem 1rem;
            background: #f8fafc;
            font-weight: 600;
            text-align: left;
            transition: border-color 0.2s ease, transform 0.2s ease;
        }

        .tag-button:hover {
            border-color: rgba(59, 161, 76, 0.5);
            transform: translateY(-2px);
        }

        .stat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .stat-card {
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 20px;
            background: var(--surface);
            box-shadow: 0 14px 30px rgba(16, 24, 40, 0.05);
        }

        .stat-card__label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.25em;
            color: var(--muted);
            margin-bottom: 0.5rem;
        }

        .stat-card__value {
            font-size: 2rem;
            font-weight: 700;
        }

        .section-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 32px;
            padding: 2.5rem;
            box-shadow: 0 35px 65px rgba(15, 23, 42, 0.08);
        }

        .workspace-card h3 {
            margin-bottom: 0.5rem;
        }

        .workspace-card p {
            color: var(--muted);
        }

        .link-green {
            color: var(--primary);
            font-weight: 600;
        }

        .activity-grid {
            display: grid;
            gap: 24px;
            grid-template-columns: minmax(0, 1.4fr) minmax(0, 0.6fr);
        }

        @media (max-width: 1024px) {
            .activity-grid {
                grid-template-columns: 1fr;
            }
        }

        .activity-card,
        .support-card {
            border: 1px solid var(--border);
            border-radius: 28px;
            padding: 24px;
            background: var(--surface);
            box-shadow: 0 20px 45px rgba(15, 23, 42, 0.07);
        }

        .activity-item {
            display: flex;
            gap: 16px;
            padding: 18px;
            border-radius: 20px;
            border: 1px dashed var(--border);
            background: #f9fafb;
        }

        .activity-index {
            width: 48px;
            height: 48px;
            border-radius: 16px;
            background: #ffffff;
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .support-card button {
            width: 100%;
            border-radius: 999px;
            border: none;
            padding: 0.9rem 1rem;
            font-weight: 600;
            background: var(--primary);
            color: #fff;
            box-shadow: 0 14px 26px rgba(59, 161, 76, 0.22);
        }

        .playbook-grid {
            display: grid;
            gap: 20px;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        }

        .playbook-card {
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 20px;
            background: var(--surface);
            transition: border-color 0.2s ease, transform 0.2s ease;
        }

        .playbook-card:hover {
            border-color: rgba(59, 161, 76, 0.5);
            transform: translateY(-3px);
        }

        .playbook-card p {
            color: var(--muted);
        }

        .playbook-card button {
            border: none;
            background: transparent;
            padding: 0;
            margin-top: 0.8rem;
            font-weight: 600;
            color: var(--primary);
        }

        .card-slab {
            border-radius: 32px;
            border: 1px solid var(--border);
            background: var(--surface);
            padding: 32px;
            box-shadow: 0 32px 55px rgba(15, 23, 42, 0.08);
            color: var(--text);
        }

        .card-slab--warning {
            border-color: rgba(59, 161, 76, 0.35);
            background: #f4fbf6;
        }

        .card-slab h3 {
            color: var(--text);
        }

        .insight-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.35rem 0.9rem;
            border-radius: 999px;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.28em;
            font-weight: 600;
        }

        .chip-amber {
            background: rgba(59, 161, 76, 0.12);
            color: var(--primary);
        }

        .text-muted {
            color: var(--muted);
        }

        .stack-24 {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .suggestion-grid {
            display: grid;
            gap: 24px;
        }

        @media (min-width: 768px) {
            .suggestion-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        .link-button {
            border: none;
            background: transparent;
            color: var(--primary);
            font-weight: 600;
            padding: 0;
        }

        .upgrade-card {
            border-radius: 24px;
            border: 1px dashed var(--border);
            background: #f9fafb;
            padding: 24px;
        }
    </style>
</head>
<body>
    @include('components.frontend.navbar')


    <main class="dashboard-page">
        <section class="dashboard-hero">
            <div class="container-custom">
                <div class="hero-card">
                    <div class="hero-details">
                        <span class="hero-chip">{{ $user?->isManufacturer() ? 'Manufacturer workspace' : ($user?->isDistributor() ? 'Distributor workspace' : 'Member workspace') }}</span>
                        <h1>Welcome back, {{ $user?->name ?? 'Partner' }}</h1>
                        <p>
                            Progress through your onboarding checklist and highlight the wins that matter to prospects.
                            Important actions now surface with our signature SolarReviews green accents so you know where to focus.
                        </p>
                        <div class="hero-actions">
                            <button class="btn-primary">
                                Finish profile
                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                            <button class="btn-outline">Invite teammates</button>
                        </div>
                    </div>
                    <div class="hero-progress">
                        <p class="progress-label">Profile completion</p>
                        <p class="progress-value">20%</p>
                        <div class="progress-meter">
                            <span style="width: 20%"></span>
                        </div>
                        <p class="text-sm" style="color:#18562e;">Complete onboarding to unlock insights.</p>
                    </div>
                </div>
            </div>
        </section>

        @if($requiresDistributorIntake)
            <section class="section">
                <div class="container-custom">
                    <div class="card-slab card-slab--warning">
                        <span class="insight-chip chip-amber">Required</span>
                        <h3 class="text-2xl fw-semibold mt-3">Complete your distributor intake</h3>
                        <p class="text-sm text-muted mb-4">
                            We need verified business information once so OEMs and EPCs can consider you for territory allocations.
                        </p>
                        @include('dashboard.partials.distributor-registration-form')
                    </div>
                </div>
            </section>
        @elseif($requiresSupplierIntake)
            <section class="section">
                <div class="container-custom">
                    <div class="card-slab card-slab--warning">
                        <span class="insight-chip chip-amber">Required</span>
                        <h3 class="text-2xl fw-semibold mt-3">Complete your supplier intake</h3>
                        <p class="text-sm text-muted mb-4">
                            Share compliance, manufacturing capacity, and catalog details once so we can activate your supplier workspace.
                        </p>
                        @include('dashboard.partials.supplier-registration-form')
                    </div>
                </div>
            </section>
        @else
            <section class="section">
                <div class="container-custom">
                    <div class="section-heading">
                        <h3>Start with the essentials</h3>
                        <p>Keep your profile compelling and ready for serious buyers.</p>
                    </div>
                    <div class="highlight-grid">
                        <article class="highlight-card">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="chip">Onboarding checklist</p>
                                    <h3>Complete company profile</h3>
                                </div>
                                <span class="accent-pill">20% done</span>
                            </div>
                            <p class="text-sm text-muted mt-2">Add business details so prospects can trust your listings.</p>
                            <div class="progress-meter mt-4">
                                <span style="width: 20%"></span>
                            </div>
                            <button class="btn-primary mt-4">Finish profile</button>
                        </article>
                        <article class="highlight-card">
                            <p class="chip">Quick actions</p>
                            <h3>Stay responsive</h3>
                            <div class="grid gap-3 mt-4">
                                <button class="tag-button">Update contact info</button>
                                <button class="tag-button">Invite teammates</button>
                                <button class="tag-button">Contact support</button>
                            </div>
                        </article>
                    </div>
                </div>
            </section>

            <section class="section">
                <div class="container-custom">
                    <div class="stat-grid">
                        @foreach([
                            ['label' => 'Leads this week', 'value' => '0'],
                            ['label' => 'Messages', 'value' => '0'],
                            ['label' => 'Profile views', 'value' => '0'],
                        ] as $stat)
                            <article class="stat-card">
                                <p class="stat-card__label">{{ $stat['label'] }}</p>
                                <p class="stat-card__value">{{ $stat['value'] }}</p>
                                <p class="text-sm text-muted">Complete onboarding to unlock insights</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>

            <section class="section">
                <div class="container-custom">
                    <div class="section-card workspace-card space-y-4">
                        <div class="flex flex-wrap items-center justify-between gap-3">
                            <div>
                                <p class="text-sm text-muted">
                                    {{ $user?->isManufacturer() ? 'Manufacturer workspace' : ($user?->isDistributor() ? 'Distributor workspace' : 'Member workspace') }}
                                </p>
                                <h3 class="text-xl font-semibold">
                                    {{ $user?->isManufacturer() ? 'Build trust with installers & distributors' : ($user?->isDistributor() ? 'Showcase services & win projects' : 'Get started with SolarReviews') }}
                                </h3>
                            </div>
                            <a href="#" class="link-green">Add update →</a>
                        </div>
                        <div class="grid gap-4 md:grid-cols-2">
                            @if($user?->isManufacturer())
                                @include('dashboard.partials._manufacturer-suggestions')
                            @elseif($user?->isDistributor())
                                @include('dashboard.partials._distributor-suggestions')
                            @else
                                <div class="rounded-2xl border border-dashed border-gray-200 bg-slate-50 p-4">
                                    <h4 class="font-semibold text-slate-900">Upgrade your account</h4>
                                    <p class="text-sm text-muted mt-1">Switch to manufacturer or distributor to unlock advanced tools.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>

            <section class="section">
                <div class="container-custom">
                    <div class="activity-grid">
                        <div class="activity-card space-y-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-muted uppercase tracking-[0.2em]">Activity feed</p>
                                    <h3 class="text-xl font-semibold">Latest nudges</h3>
                                </div>
                                <button class="link-green border-0 bg-transparent">View all</button>
                            </div>
                            @foreach([
                                ['01','Complete your company overview','Add address, certifications and a short bio so buyers can verify you.'],
                                ['02','Connect your WhatsApp or support line','We’ll route verified leads directly to your team.'],
                                ['03','Publish a success story','Feature your latest install or product milestone on comparison pages.']
                            ] as $item)
                                <div class="activity-item">
                                    <div class="activity-index">{{ $item[0] }}</div>
                                    <div>
                                        <p class="font-semibold">{{ $item[1] }}</p>
                                        <p class="text-sm text-muted">{{ $item[2] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="support-card space-y-3">
                            <p class="text-sm text-muted uppercase tracking-[0.2em]">Need help?</p>
                            <h3 class="text-xl font-semibold">Partner success desk</h3>
                            <p class="text-sm text-muted">Our team helps with profile setup, verification and lead curation.</p>
                            <div class="space-y-1 text-sm">
                                <p><span class="font-semibold">Email:</span> support@solarreviews.in</p>
                                <p><span class="font-semibold">Phone:</span> +91-98765-43210</p>
                                <p><span class="font-semibold">Hours:</span> Mon–Sat, 9am–7pm IST</p>
                            </div>
                            <button>Open support ticket</button>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section">
                <div class="container-custom">
                    <div class="section-heading flex flex-wrap items-center justify-between gap-3">
                        <div>
                            <p class="text-sm text-muted uppercase tracking-[0.2em]">Learn & grow</p>
                            <h3 class="text-xl font-semibold">Recommended playbooks</h3>
                            <p class="text-sm text-muted">
                                Short guides curated for {{ $user?->isManufacturer() ? 'manufacturers' : ($user?->isDistributor() ? 'service providers' : 'members') }}.
                            </p>
                        </div>
                        <a href="#" class="link-green">See resource library →</a>
                    </div>
                    <div class="playbook-grid">
                        @foreach([
                            ['Playbook','Designing tiered pricing for installers','Offer slabs that reward reliable partners without hurting margins.','Read guide'],
                            ['Checklist','What to include in project case studies','Capture KPIs, client quotes and site photos to build trust.','Download PDF'],
                            ['Webinar','Navigating incentive schemes in 2025','Understand how MNRE and state programs impact demand.','Register']
                        ] as $resource)
                            <article class="playbook-card">
                                <p class="text-xs uppercase tracking-[0.3em] text-green-600">{{ $resource[0] }}</p>
                                <h4 class="mt-2 text-base font-semibold">{{ $resource[1] }}</h4>
                                <p class="mt-2 text-sm">{{ $resource[2] }}</p>
                                <button>{{ $resource[3] }} →</button>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <section class="section">
            <div class="container-custom">
                @include('components.frontend.chatbot-widget')
            </div>
        </section>
    </main>










@endif
