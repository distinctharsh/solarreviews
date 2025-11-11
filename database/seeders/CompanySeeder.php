<?php

namespace Database\Seeders;

use App\Models\State;
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
        $states = State::all();
        
        foreach ($this->companyNames as $companyName) {
            $state = $states->random();
            
            $company = Company::create([
                'name' => $companyName,
                'slug' => Str::slug($companyName),
                'description' => $this->generateDescription($companyName, $state->name),
                'state_id' => $state->id,
                'logo' => null,
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

}