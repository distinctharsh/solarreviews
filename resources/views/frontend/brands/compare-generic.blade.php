<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Compare Tesla & Battery Brands - Solar Reviews</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQo9RWCH3ppc1J/hu0uS2mQF6FQ3l6bJf2qYkP0h6fQpsI1f9bXwj8gKa7a7l28pQ5u0SYJcNQF7C4h3rqYg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f8fafc; color: #0f172a; }
        .page-wrapper { min-height: 100vh; display: flex; flex-direction: column; }
        .container-custom { max-width: 1200px; margin: 0 auto; padding: 0 1.5rem; }
        .hero { background: linear-gradient(135deg,#0d3b66,#1b998b); color:#fff; padding:4rem 0 3rem; }
        .hero h1 { font-size: clamp(2rem,4vw,3rem); margin-bottom: 0.75rem; }
        .hero p { color: rgba(255,255,255,0.85); max-width: 640px; }
        .section-card { background:#fff; border-radius:18px; padding:2rem; box-shadow:0 15px 45px rgba(15,23,42,0.12); border:1px solid #e5e7eb; }
        .brand-card { display:flex; justify-content:space-between; gap:1rem; padding:1.25rem 0; border-bottom:1px solid #f1f5f9; }
        .brand-card:last-child { border-bottom:none; }
        .brand-info { display:flex; gap:1rem; align-items:center; }
        .brand-logo { width:64px; height:64px; border-radius:14px; background:#f1f5f9; display:flex; align-items:center; justify-content:center; overflow:hidden; }
        .metrics { text-align:right; }
        .badge-chip { background:#ecfdf5; color:#047857; border-radius:999px; padding:0.25rem 0.9rem; font-weight:600; font-size:0.9rem; }
        .efficiency-board .item { display:flex; justify-content:space-between; padding:0.8rem 0; border-bottom:1px dashed #e2e8f0; }
        .efficiency-board .item:last-child { border-bottom:none; }
    </style>
</head>
<body>
<div class="page-wrapper">
    @include('components.frontend.navbar')

    <section class="hero">
        <div class="container-custom">
            <p class="text-uppercase text-white-50 mb-1">Brand comparison</p>
            <h1>Compare {{ $selectedBrand->name }} & Competitors</h1>
            <p>Review ratings, efficiency data, and product counts for brands similar to {{ $selectedBrand->name }}.</p>
        </div>
    </section>

    <main class="py-5 flex-grow-1">
        <div class="container-custom">
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="section-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h2 class="h4 mb-1">Top Battery Brands by Ratings</h2>
                                <p class="text-muted mb-0">Sorted by average consumer rating, then review volume.</p>
                            </div>
                            <span class="badge-chip">{{ $brands->count() }} brands listed</span>
                        </div>

                        @forelse ($brands as $brand)
                            <div class="brand-card">
                                <div class="brand-info">
                                    <div class="brand-logo">
                                        @if($brand->logo_url)
                                            <img src="{{ asset($brand->logo_url) }}" alt="{{ $brand->name }}" style="max-width:100%; max-height:100%; object-fit:contain;">
                                        @else
                                            <span class="fw-bold text-muted">{{ Str::substr($brand->name,0,2) }}</span>
                                        @endif
                                    </div>
                                    <div>
                                        <h3 class="h5 mb-1">{{ $brand->name }}</h3>
                                        <p class="mb-0 text-muted small">{{ $brand->country ?? 'Global brand' }} • {{ $brand->battery_products_count ?? 0 }} battery SKUs</p>
                                    </div>
                                </div>
                                <div class="metrics">
                                    <div class="d-flex gap-2 justify-content-end align-items-center">
                                        <span class="badge-chip">
                                            <i class="fas fa-star text-warning"></i>
                                            {{ number_format($brand->avg_rating, 1) }} / 5
                                        </span>
                                        <span class="text-muted small">{{ number_format($brand->total_reviews) }} reviews</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="mb-0 text-muted">No brands found. Ensure brands are linked to the “batteries” category and rerun the seeders.</p>
                        @endforelse
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="section-card efficiency-board">
                        <h2 class="h5 mb-3">Efficiency Leaders</h2>
                        <p class="text-muted small mb-4">Calculated from average product efficiency inside the “batteries” category.</p>
                        @forelse ($efficiencyLeaders as $item)
                            <div class="item">
                                <div>
                                    <strong>{{ $item->brand_name }}</strong>
                                    <p class="text-muted small mb-0">{{ $item->product_count }} models tracked</p>
                                </div>
                                <div class="text-end">
                                    <div class="fw-bold">{{ number_format($item->avg_efficiency, 2) }}%</div>
                                    <p class="text-muted small mb-0">Peak {{ number_format($item->max_efficiency, 2) }}%</p>
                                </div>
                            </div>
                        @empty
                            <p class="mb-0 text-muted">No efficiency data yet. Populate `products.efficiency` for battery SKUs.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('components.frontend.footer')
</div>

</body>
</html>