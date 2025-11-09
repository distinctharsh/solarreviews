<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Solar Products in {{ $stateName ?? 'Your State' }} - Solar Reviews</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])
    <style>
        :root {
            --primary-color: #1e40af;
            --secondary-color: #1e3a8a;
            --accent-color: #3b82f6;
            --text-color: #1f2937;
            --light-bg: #f9fafb;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            color: var(--text-color);
            background-color: var(--light-bg);
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }
        
        .state-header {
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .state-header h1 {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        
        .state-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-top: 2rem;
        }
        
        .state-image {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
        }
        
        .state-image img {
            width: 100%;
            height: auto;
            display: block;
        }
        
        .back-button {
            display: inline-flex;
            align-items: center;
            color: var(--primary-color);
            text-decoration: none;
            margin-bottom: 2rem;
            font-weight: 500;
        }
        
        .back-button i {
            margin-right: 0.5rem;
        }
        
        @media (max-width: 768px) {
            .state-content {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ url('/') }}" class="back-button">
            <i class="fas fa-arrow-left"></i> Back to Home
        </a>
        
        <div class="state-header">
            <h1>Solar Solutions in {{ $stateName ?? 'Your State' }}</h1>
            <p>Explore the best solar products and services available in your area</p>
        </div>
        
        <div class="state-content">
            <div class="state-image">
                <img src="{{ asset('images/state-wise.png') }}" alt="{{ $stateName }} Solar Solutions">
            </div>
            <div class="state-image">
                <img src="{{ asset('images/state-wise2.png') }}" alt="{{ $stateName }} Solar Statistics">
            </div>
        </div>
    </div>
</body>
</html>
