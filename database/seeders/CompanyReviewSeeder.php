<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyReview;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CompanyReviewSeeder extends Seeder
{
    private $firstNames = ['John', 'Jane', 'Michael', 'Emily', 'David', 'Sarah', 'James', 'Jennifer', 'Robert', 'Lisa'];
    private $lastNames = ['Smith', 'Johnson', 'Williams', 'Brown', 'Jones', 'Miller', 'Davis', 'Garcia', 'Rodriguez', 'Wilson'];
    
    private $sources = ['Google', 'Facebook', 'Yelp', 'Website', 'Trustpilot'];
    
    private $reviewTemplates = [
        'Great experience with {company}. The installation was quick and the team was professional.',
        '{company} did an amazing job on our solar installation. Highly recommend!',
        'Very satisfied with the service from {company}. Our energy bills have dropped significantly.',
        'The team at {company} was knowledgeable and helpful throughout the entire process.',
        'I would give {company} 10 stars if I could. Excellent service and support!',
        '{company} provided a great solar solution for our home. The installation was seamless.',
        'Professional and efficient service from {company}. Very happy with our new solar panels.',
        '{company} made going solar easy and stress-free. Great customer service!',
        'Our experience with {company} was outstanding from start to finish. Highly recommend!',
        'Thanks to {company}, we are now saving money and reducing our carbon footprint.'
    ];
    
    public function run()
    {
        $companies = Company::all();
        
        foreach ($companies as $company) {
            $reviewCount = rand(5, 20);
            
            for ($i = 0; $i < $reviewCount; $i++) {
                $rating = $this->getWeightedRating();
                $reviewDate = Carbon::now()->subDays(rand(0, 365))->subMonths(rand(0, 12))->subYears(rand(0, 2));
                
                CompanyReview::create([
                    'company_id' => $company->id,
                    'reviewer_name' => $this->getRandomName(),
                    'rating' => $rating,
                    'review_text' => $this->generateReviewText($company->name),
                    'review_date' => $reviewDate,
                    'source' => $this->sources[array_rand($this->sources)],
                    'is_featured' => rand(1, 10) === 1,
                    'created_at' => $reviewDate,
                    'updated_at' => $reviewDate,
                ]);
            }
            
            $company->updateAverageRating();
        }
    }
    
    private function getWeightedRating()
    {
        $weights = [1 => 5, 2 => 10, 3 => 20, 4 => 30, 5 => 35];
        $total = array_sum($weights);
        $rand = mt_rand(1, $total);
        
        foreach ($weights as $rating => $weight) {
            $total -= $weight;
            if ($rand > $total) {
                return $rating;
            }
        }
        
        return 5;
    }
    
    private function getRandomName()
    {
        return $this->firstNames[array_rand($this->firstNames)] . ' ' . 
               $this->lastNames[array_rand($this->lastNames)] . 
               (rand(1, 4) === 1 ? ' ' . strtoupper(chr(rand(65, 90))) : '');
    }
    
    private function generateReviewText($companyName)
    {
        $template = $this->reviewTemplates[array_rand($this->reviewTemplates)];
        return str_replace('{company}', $companyName, $template);
    }
}