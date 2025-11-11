<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Solar Companies in {{ $state['name'] }} - Solar Reviews</title>
    <style>
        * {
            margin: 0; padding: 0; box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background-color: #f6f9fc;
            color: #333;
        }

        .page-wrapper {
            display: flex;
            justify-content: center;
            padding: 30px 20px;
        }

        /* Left Sidebar */
        .sidebar {
            width: 260px;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 20px;
            margin-right: 25px;
            height: fit-content;
        }

        .sidebar h3 {
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 12px;
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar ul li {
            margin-bottom: 8px;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #3498db;
            font-size: 14px;
        }

        .calculator {
            margin-top: 25px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }

        .calculator input {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 5px;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .calculator button {
            width: 100%;
            background: #3498db;
            color: #fff;
            border: none;
            padding: 10px 0;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
        }

        /* Right Content */
        .content {
            max-width: 850px;
            flex: 1;
        }

        .header {
            margin-bottom: 25px;
        }

        .header h1 {
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .company-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            margin-bottom: 25px;
            padding: 20px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
        }

        .company-left {
            display: flex;
            align-items: flex-start;
        }

        .company-logo {
            width: 90px;
            height: 70px;
            object-fit: contain;
            margin-right: 20px;
            border: 1px solid #eee;
            padding: 5px;
            background: #fff;
            border-radius: 5px;
        }

        .company-info h2 {
            font-size: 18px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .stars {
            color: #f5a623;
            font-size: 15px;
        }

        .rating-text {
            font-size: 14px;
            color: #7f8c8d;
        }

        .company-desc {
            font-size: 14px;
            color: #555;
            margin-top: 8px;
            line-height: 1.6;
        }

        .company-desc a {
            color: #3498db;
            text-decoration: none;
        }

        .rating-bar {
            margin-top: 12px;
            display: flex;
            align-items: center;
        }

        .blue-bar {
            background: #3498db;
            height: 8px;
            width: 60px;
            border-radius: 3px;
            margin-right: 6px;
        }

        .get-quote {
            background: #3498db;
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        @media(max-width: 992px) {
            .page-wrapper { flex-direction: column; }
            .sidebar { width: 100%; margin-right: 0; margin-bottom: 20px; }
            .content { width: 100%; }
        }
    </style>
</head>
<body>

<div class="page-wrapper">
    <!-- Sidebar -->
    <div class="sidebar">
        <h3>Solar in your state </h3>
        <ul>
            @foreach($states as $s)
                <li><a href="{{ url('state/'.$s['slug']) }}">{{ $s['name'] }}</a></li>
            @endforeach
        </ul>

        <div class="calculator">
            <h3>Try our solar cost calculator</h3>
            <input type="text" placeholder="Enter your PIN code">
            <button>Calculate Now</button>
        </div>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="header">
            <h1>Top Solar Companies in {{ $state['name'] }}</h1>
            <p>Compare verified solar installation companies in {{ $state['name'] }} with customer reviews and ratings.</p>
        </div>

        @forelse($companies as $company)
            @php
                $company = (object) $company; // Convert array to object for easier access
            @endphp
            <div class="company-card">
                <div class="company-left">
                    @if(!empty($company->logo) && $company->logo !== 'null')
                        <img src="{{ $company->logo }}" class="company-logo" alt="{{ $company->name ?? 'Company Logo' }}">
                    @else
                        <img src="{{ asset('images/default-logo.png') }}" class="company-logo" alt="Default Logo">
                    @endif

                    <div class="company-info">
                        <h2>{{ $company->name ?? 'Company Name' }}</h2>
                        <div class="stars">
                            @php
                                $rating = $company->average_rating ?? 0;
                                $fullStars = floor($rating);
                                $hasHalfStar = $rating - $fullStars >= 0.5;
                            @endphp
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $fullStars)
                                    ★
                                @elseif($i == $fullStars + 1 && $hasHalfStar)
                                    ☆
                                @else
                                    ☆
                                @endif
                            @endfor
                            <span class="rating-text">
                                {{ number_format($rating, 1) }} 
                                ({{ $company->total_reviews ?? 0 }} {{ $company->total_reviews == 1 ? 'review' : 'reviews' }})
                            </span>
                        </div>
                        <div class="company-desc">
                            {{ Str::limit($company->description ?? 'No description available.', 180) }}
                            @if(strlen($company->description ?? '') > 180)
                                <a href="#" class="read-more">Read more</a>
                            @endif
                        </div>
                        <div class="rating-bar">
                            <div class="blue-bar"></div>
                            <div class="blue-bar"></div>
                            <div class="blue-bar"></div>
                            <div class="blue-bar"></div>
                            <div class="blue-bar"></div>
                            <span style="color:#777; font-size:13px; margin-left:5px;">Elite</span>
                        </div>
                    </div>
                </div>

                <div>
                    <button class="get-quote">Get Quote</button>
                </div>
            </div>
        @empty
            <div style="background:#fff; padding:30px; text-align:center; border-radius:8px; border:1px solid #eee;">
                <h3>No companies found in {{ $state['name'] }}</h3>
                <p>Check back later or explore other nearby states.</p>
            </div>
        @endforelse
    </div>
</div>

</body>
</html>
