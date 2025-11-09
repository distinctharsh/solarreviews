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
        
        .providers-container {
            margin-top: 2rem;
        }
        
        .providers-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .providers-header h2 {
            font-size: 1.5rem;
            color: var(--primary-color);
            margin: 0;
        }
        
        .providers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }
        
        .provider-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: var(--card-shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .provider-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        .provider-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }
        
        .provider-name {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-color);
            margin: 0;
        }
        
        .provider-rating {
            display: inline-flex;
            align-items: center;
            background: #f59e0b;
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        .provider-rating i {
            margin-right: 0.25rem;
        }
        
        .provider-location, .provider-reviews {
            display: flex;
            align-items: center;
            color: #6b7280;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }
        
        .provider-location i, .provider-reviews i {
            margin-right: 0.5rem;
            color: var(--accent-color);
        }
        
        .provider-description {
            color: #4b5563;
            font-size: 0.9rem;
            margin: 1rem 0;
            line-height: 1.5;
        }
        
        .provider-features {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin: 1rem 0;
        }
        
        .feature-tag {
            background: #e0f2fe;
            color: #0369a1;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .view-profile-btn {
            display: inline-block;
            background: var(--primary-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.3s ease;
            text-align: center;
            width: 100%;
            margin-top: 1rem;
        }
        
        .view-profile-btn:hover {
            background: var(--secondary-color);
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
        
        <div class="providers-container">
            <div class="providers-header">
                <h2>Top Solar Providers in {{ $stateName }}</h2>
                <div class="filter-options">
                    <select class="filter-select">
                        <option>Sort by: Rating (High to Low)</option>
                        <option>Price (Low to High)</option>
                        <option>Number of Reviews</option>
                    </select>
                </div>
            </div>
            
            <div class="providers-grid">
                <!-- Sample Provider Card 1 -->
                <div class="provider-card">
                    <div class="provider-header">
                        <h3 class="provider-name">Tata Power Solar</h3>
                        <span class="provider-rating">
                            <i class="fas fa-star"></i> 4.8
                        </span>
                    </div>
                    
                    <div class="provider-location">
                        <i class="fas fa-map-marker-alt"></i> {{ $stateName }}, India
                    </div>
                    
                    <div class="provider-reviews">
                        <i class="fas fa-comment-alt"></i> 1,245 reviews
                    </div>
                    
                    <p class="provider-description">
                        Leading solar solutions provider with 10+ years of experience in {{ $stateName }}. Specializing in residential and commercial solar installations.
                    </p>
                    
                    <div class="provider-features">
                        <span class="feature-tag">Residential</span>
                        <span class="feature-tag">Commercial</span>
                        <span class="feature-tag">Maintenance</span>
                    </div>
                    
                    <a href="#" class="view-profile-btn">View Profile</a>
                </div>
                
                <!-- Sample Provider Card 2 -->
                <div class="provider-card">
                    <div class="provider-header">
                        <h3 class="provider-name">Adani Solar</h3>
                        <span class="provider-rating">
                            <i class="fas fa-star"></i> 4.6
                        </span>
                    </div>
                    
                    <div class="provider-location">
                        <i class="fas fa-map-marker-alt"></i> {{ $stateName }}, India
                    </div>
                    
                    <div class="provider-reviews">
                        <i class="fas fa-comment-alt"></i> 987 reviews
                    </div>
                    
                    <p class="provider-description">
                        Trusted solar energy provider with a strong presence in {{ $stateName }}. Offering end-to-end solar solutions with 25-year performance warranty.
                    </p>
                    
                    <div class="provider-features">
                        <span class="feature-tag">Residential</span>
                        <span class="feature-tag">Industrial</span>
                        <span class="feature-tag">Warranty</span>
                    </div>
                    
                    <a href="#" class="view-profile-btn">View Profile</a>
                </div>
                
                <!-- Sample Provider Card 3 -->
                <div class="provider-card">
                    <div class="provider-header">
                        <h3 class="provider-name">Vikram Solar</h3>
                        <span class="provider-rating">
                            <i class="fas fa-star"></i> 4.5
                        </span>
                    </div>
                    
                    <div class="provider-location">
                        <i class="fas fa-map-marker-alt"></i> {{ $stateName }}, India
                    </div>
                    
                    <div class="provider-reviews">
                        <i class="fas fa-comment-alt"></i> 1,532 reviews
                    </div>
                    
                    <p class="provider-description">
                        Premier solar panel manufacturer and EPC solutions provider. Serving {{ $stateName }} with high-efficiency solar panels and professional installation.
                    </p>
                    
                    <div class="provider-features">
                        <span class="feature-tag">Manufacturer</span>
                        <span class="feature-tag">EPC</span>
                        <span class="feature-tag">Maintenance</span>
                    </div>
                    
                    <a href="#" class="view-profile-btn">View Profile</a>
                </div>
            </div>
            
            <div style="text-align: center; margin-top: 3rem;">
                <button class="view-profile-btn" style="max-width: 200px;">
                    Load More Providers
                </button>
            </div>
        </div>
    </div>
</body>
</html>
