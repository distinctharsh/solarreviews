<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top {{ $category->name }} Companies - Solar Reviews</title>
</head>
<body>
    <h1>Top Companies for {{ $category->name }}</h1>
    <p>Showing top 20 companies based on average rating and total reviews.</p>

    @if($companies->isEmpty())
        <p>No companies found for this category yet.</p>
    @else
        <ul>
            @foreach($companies as $company)
                <li>
                    {{ $company->name }} - Rating: {{ number_format($company->average_rating, 1) }} ({{ $company->total_reviews }} reviews)
                </li>
            @endforeach
        </ul>
    @endif
</body>
</html>
