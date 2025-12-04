<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    private array $brands = [
        ['name' => 'HelioMax', 'country' => 'India', 'description' => 'Mono PERC panel specialist with BIS certification.', 'logo' => 'brands/heliomax.png'],
        ['name' => 'VoltEdge', 'country' => 'Germany', 'description' => 'Hybrid inverter range with smart monitoring.', 'logo' => 'brands/voltedge.png'],
        ['name' => 'SunCraft', 'country' => 'USA', 'description' => 'Premium high-efficiency modules.', 'logo' => 'brands/suncraft.png'],
        ['name' => 'BrightCell', 'country' => 'India', 'description' => 'Lithium battery racks and BMS.', 'logo' => 'brands/brightcell.png'],
        ['name' => 'Aquila Solar', 'country' => 'Spain', 'description' => 'String inverters with AFCI protection.', 'logo' => 'brands/aquila.png'],
        ['name' => 'EcoRack', 'country' => 'India', 'description' => 'Mounting and tracking hardware.', 'logo' => 'brands/ecorack.png'],
        ['name' => 'Nimbus Charge', 'country' => 'Singapore', 'description' => 'EV + solar hybrid controllers.', 'logo' => 'brands/nimbus.png'],
        ['name' => 'PulseVolt', 'country' => 'Taiwan', 'description' => 'Industrial UPS-integrated inverters.', 'logo' => 'brands/pulsevolt.png'],
        ['name' => 'Terraspan', 'country' => 'India', 'description' => 'Ground-mount structure OEM.', 'logo' => 'brands/terraspan.png'],
        ['name' => 'Lumiflow', 'country' => 'India', 'description' => 'DC optimizers and rapid-shutdown gear.', 'logo' => 'brands/lumiflow.png'],
        ['name' => 'AegisGrid', 'country' => 'USA', 'description' => 'Utility-scale monitoring suites.', 'logo' => 'brands/aegisgrid.png'],
        ['name' => 'Solaris PumpTech', 'country' => 'India', 'description' => 'MNRE-approved solar pump kits.', 'logo' => 'brands/solaris.png'],
        ['name' => 'ZenithCharge', 'country' => 'India', 'description' => 'Battery-backed micro inverter range.', 'logo' => 'brands/zenithcharge.png'],
        ['name' => 'AuroraFlex', 'country' => 'France', 'description' => 'Flexible thin-film panels.', 'logo' => 'brands/auroraflex.png'],
        ['name' => 'GridPulse', 'country' => 'India', 'description' => 'SCADA and analytics for mid-scale solar.', 'logo' => 'brands/gridpulse.png'],
    ];

    public function run(): void
    {
        foreach ($this->brands as $brand) {
            Brand::updateOrCreate(
                ['slug' => Str::slug($brand['name'])],
                [
                    'name' => $brand['name'],
                    'slug' => Str::slug($brand['name']),
                    'country' => $brand['country'],
                    'description' => $brand['description'],
                    'logo_url' => $brand['logo'],
                ]
            );
        }
    }
}