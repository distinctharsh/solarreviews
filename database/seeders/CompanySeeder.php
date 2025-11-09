<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    private $companyNames = [
        'SunPower Solar', 'Tesla Energy', 'Sunrun', 'Vivint Solar', 'Sunpro Solar',
        'Momentum Solar', 'PetersenDean', 'Sunnova', 'Freedom Forever', 'Trinity Solar',
        'Blue Raven Solar', 'Palmetto Solar', 'Sunlux', 'ADT Solar', 'SunPower by Blue Raven',
        'Sunworks', 'SunPower by Infinity', 'SunPower by Custom Energy', 'SunPower by Horizon',
        'SunPower by Sunworks'
    ];

    public function run()
    {
        $cities = City::all();
        
        foreach ($this->companyNames as $companyName) {
            $city = $cities->random();
            
            $company = Company::create([
                'name' => $companyName,
                'slug' => Str::slug($companyName),
                'description' => $this->generateDescription($companyName, $city->name),
                'city_id' => $city->id,
                'website' => 'https://' . Str::slug($companyName) . '.com',
                'phone' => $this->generatePhoneNumber(),
                'email' => 'info@' . Str::slug($companyName) . '.com',
                'address' => rand(100, 9999) . ' ' . $this->getRandomStreet() . ', ' . $city->name,
                'average_rating' => 0,
                'total_reviews' => 0,
                'is_active' => true,
            ]);
        }
    }

    private function generateDescription($companyName, $city)
    {
        $descriptions = [
            "{$companyName} is a leading solar energy company serving {$city} and surrounding areas. We provide high-quality solar panel installation and energy solutions for residential and commercial properties.",
            "At {$companyName}, we're committed to helping {$city} residents save money on their energy bills with our top-rated solar panel systems and exceptional customer service.",
            "Serving {$city} since " . (2000 + rand(0, 20)) . ", {$companyName} has established itself as a trusted name in the solar energy industry with thousands of satisfied customers.",
            "{$companyName} offers innovative solar solutions in the {$city} area, including solar panel installation, battery storage, and energy efficiency upgrades.",
            "As a locally-owned and operated solar company in {$city}, {$companyName} is dedicated to providing personalized service and the latest solar technology to our customers."
        ];

        return $descriptions[array_rand($descriptions)];
    }

    private function generatePhoneNumber()
    {
        return sprintf('(%03d) %03d-%04d', rand(200, 999), rand(100, 999), rand(1000, 9999));
    }

    private function getRandomStreet()
    {
        $streets = ['Main St', 'Oak Ave', 'Pine St', 'Maple Dr', 'Cedar Ln', 'Elm St', 'Washington Blvd', 'Park Ave', 'Lake View Dr', 'Sunset Blvd'];
        return $streets[array_rand($streets)];
    }
}