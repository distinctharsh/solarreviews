<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StateSeeder extends Seeder
{
    public function run()
    {
        $states = [
            ['name' => 'California', 'code' => 'CA', 'is_active' => true],
            ['name' => 'Texas', 'code' => 'TX', 'is_active' => true],
            ['name' => 'Florida', 'code' => 'FL', 'is_active' => true],
            ['name' => 'New York', 'code' => 'NY', 'is_active' => true],
            ['name' => 'Arizona', 'code' => 'AZ', 'is_active' => true],
        ];

        foreach ($states as $state) {
            State::create([
                'name' => $state['name'],
                'slug' => Str::slug($state['name']),
                'code' => $state['code'],
                'is_active' => $state['is_active'],
                'description' => 'Top solar companies in ' . $state['name'],
            ]);
        }
    }
}