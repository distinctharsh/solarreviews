<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    private array $categories = [
        ['name' => 'Residential Rooftop', 'slug' => 'residential-rooftop', 'description' => 'Turnkey systems for villas and societies.'],
        ['name' => 'Commercial EPC', 'slug' => 'commercial-epc', 'description' => 'Solar EPC for malls, offices, institutions.'],
        ['name' => 'Industrial EPC', 'slug' => 'industrial-epc', 'description' => 'High-capacity solar for factories and warehouses.'],
        ['name' => 'Solar Inverters', 'slug' => 'solar-inverters', 'description' => 'On-grid, hybrid, off-grid inverter portfolio.'],
        ['name' => 'Energy Storage', 'slug' => 'energy-storage', 'description' => 'Lithium battery racks, BMS, hybrid systems.'],
        ['name' => 'Mounting Structures', 'slug' => 'mounting-structures', 'description' => 'Rails, clamps, rooftop & ground-mount kits.'],
        ['name' => 'Monitoring & IoT', 'slug' => 'monitoring-iot', 'description' => 'Smart data loggers, SCADA, predictive O&M.'],
        ['name' => 'Solar Pumps', 'slug' => 'solar-pumps', 'description' => 'Irrigation-focused solar water pumping kits.'],
    ];

    public function run(): void
    {
        foreach ($this->categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                array_merge($category, ['status' => 'active'])
            );
        }
    }
}