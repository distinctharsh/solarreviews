<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CitySeeder extends Seeder
{
    public function run()
    {
        $cities = [
            'Maharashtra' => ['Mumbai', 'Pune', 'Nagpur', 'Nashik', 'Aurangabad'],
            'Gujarat' => ['Ahmedabad', 'Surat', 'Vadodara', 'Rajkot', 'Bhavnagar'],
            'Rajasthan' => ['Jaipur', 'Jodhpur', 'Udaipur', 'Kota', 'Bikaner'],
            'Karnataka' => ['Bengaluru', 'Mysuru', 'Mangaluru', 'Hubballi', 'Belagavi'],
            'Tamil Nadu' => ['Chennai', 'Coimbatore', 'Madurai', 'Tiruchirappalli', 'Salem'],
            'Uttar Pradesh' => ['Lucknow', 'Kanpur', 'Varanasi', 'Noida', 'Agra'],
            'Delhi' => ['New Delhi', 'Dwarka', 'Rohini', 'Saket', 'Karol Bagh'],
            'Telangana' => ['Hyderabad', 'Warangal', 'Nizamabad', 'Karimnagar', 'Khammam'],
            'West Bengal' => ['Kolkata', 'Howrah', 'Durgapur', 'Siliguri', 'Asansol'],
            'Madhya Pradesh' => ['Bhopal', 'Indore', 'Gwalior', 'Jabalpur', 'Ujjain'],
        ];

        foreach ($cities as $stateName => $cityNames) {
            $state = State::where('name', $stateName)->first();
            
            if (!$state) continue;
            
            foreach ($cityNames as $cityName) {
                City::create([
                    'name' => $cityName,
                    'slug' => Str::slug($cityName),
                    'state_id' => $state->id,
                    'is_active' => true,
                ]);
            }
        }
    }
}