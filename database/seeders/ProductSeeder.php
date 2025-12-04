<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    private array $products = [
        ['name' => 'HelioMax Prime 555', 'brand' => 'HelioMax', 'category' => 'Residential Rooftop', 'type' => 'Solar Panel', 'capacity_kw' => 0.555, 'warranty' => '25 years performance'],
        ['name' => 'HelioMax Duo 600', 'brand' => 'HelioMax', 'category' => 'Industrial EPC', 'type' => 'Solar Panel', 'capacity_kw' => 0.6, 'warranty' => '30 years performance'],
        ['name' => 'VoltEdge Hybrid H5', 'brand' => 'VoltEdge', 'category' => 'Solar Inverters', 'type' => 'Hybrid Inverter', 'capacity_kw' => 5, 'warranty' => '10 years'],
        ['name' => 'VoltEdge Hybrid H10', 'brand' => 'VoltEdge', 'category' => 'Solar Inverters', 'type' => 'Hybrid Inverter', 'capacity_kw' => 10, 'warranty' => '10 years'],
        ['name' => 'BrightCell LFP Rack 10kWh', 'brand' => 'BrightCell', 'category' => 'Energy Storage', 'type' => 'Battery Rack', 'capacity_kw' => 10, 'warranty' => '8 years'],
        ['name' => 'BrightCell LFP Rack 20kWh', 'brand' => 'BrightCell', 'category' => 'Energy Storage', 'type' => 'Battery Rack', 'capacity_kw' => 20, 'warranty' => '8 years'],
        ['name' => 'EcoRack TerraFix-RT', 'brand' => 'EcoRack', 'category' => 'Mounting Structures', 'type' => 'Rooftop Mount', 'capacity_kw' => null, 'warranty' => '15 years'],
        ['name' => 'EcoRack TerraFix-GM', 'brand' => 'EcoRack', 'category' => 'Mounting Structures', 'type' => 'Ground Mount', 'capacity_kw' => null, 'warranty' => '20 years'],
        ['name' => 'Aquila Solar Axis 50', 'brand' => 'Aquila Solar', 'category' => 'Commercial EPC', 'type' => 'String Inverter', 'capacity_kw' => 50, 'warranty' => '7 years'],
        ['name' => 'Aquila Solar Axis 110', 'brand' => 'Aquila Solar', 'category' => 'Industrial EPC', 'type' => 'String Inverter', 'capacity_kw' => 110, 'warranty' => '7 years'],
        ['name' => 'PulseVolt SyncDrive 25', 'brand' => 'PulseVolt', 'category' => 'Commercial EPC', 'type' => 'Central Inverter', 'capacity_kw' => 25, 'warranty' => '10 years'],
        ['name' => 'Terraspan GroundPro 2P', 'brand' => 'Terraspan', 'category' => 'Mounting Structures', 'type' => 'Ground Structure', 'capacity_kw' => null, 'warranty' => '20 years'],
        ['name' => 'Lumiflow RapidSafe', 'brand' => 'Lumiflow', 'category' => 'Monitoring & IoT', 'type' => 'Rapid Shutdown', 'capacity_kw' => null, 'warranty' => '5 years'],
        ['name' => 'Solaris PumpTech 5HP', 'brand' => 'Solaris PumpTech', 'category' => 'Solar Pumps', 'type' => 'Solar Pump', 'capacity_kw' => 3.7, 'warranty' => '5 years'],
        ['name' => 'Solaris PumpTech 7.5HP', 'brand' => 'Solaris PumpTech', 'category' => 'Solar Pumps', 'type' => 'Solar Pump', 'capacity_kw' => 5.5, 'warranty' => '5 years'],
    ];

    public function run(): void
    {
        $brands = Brand::pluck('id', 'name');
        $categories = Category::pluck('id', 'name');

        foreach ($this->products as $product) {
            if (!isset($brands[$product['brand']]) || !isset($categories[$product['category']])) {
                continue;
            }

            Product::updateOrCreate(
                ['slug' => Str::slug($product['name'])],
                [
                    'brand_id' => $brands[$product['brand']],
                    'category_id' => $categories[$product['category']],
                    'product_name' => $product['name'],
                    'slug' => Str::slug($product['name']),
                    'model_name' => $product['name'],
                    'type' => $product['type'],
                    'capacity_kw' => $product['capacity_kw'],
                    'warranty' => $product['warranty'],
                    'technical_details' => [
                        'efficiency' => $product['capacity_kw'] ? rand(19, 22) . '%' : null,
                        'notes' => 'Seed data item for showcase listings.',
                    ],
                ]
            );
        }
    }
}