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
            'California' => ['Los Angeles', 'San Diego', 'San Jose', 'San Francisco', 'Fresno'],
            'Texas' => ['Houston', 'San Antonio', 'Dallas', 'Austin', 'Fort Worth'],
            'Florida' => ['Jacksonville', 'Miami', 'Tampa', 'Orlando', 'St. Petersburg'],
            'New York' => ['New York City', 'Buffalo', 'Rochester', 'Yonkers', 'Syracuse'],
            'Arizona' => ['Phoenix', 'Tucson', 'Mesa', 'Chandler', 'Glendale'],
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