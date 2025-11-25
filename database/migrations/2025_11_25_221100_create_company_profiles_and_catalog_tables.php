<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('product_parts');
        Schema::dropIfExists('product_models');
        Schema::dropIfExists('product_brands');
        Schema::dropIfExists('company_service_type');
        Schema::dropIfExists('company_product_line_type');
        Schema::dropIfExists('service_types');
        Schema::dropIfExists('product_line_types');
        Schema::dropIfExists('company_profiles');

        Schema::create('company_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
            $table->string('company_type', 50);
            $table->string('company_name');
            $table->string('brand_name')->nullable();
            $table->string('website')->nullable();
            $table->unsignedSmallInteger('year_founded')->nullable();
            $table->string('employee_count')->nullable();
            $table->string('primary_goal')->nullable();
            $table->string('production_capacity')->nullable();
            $table->string('distribution_regions')->nullable();
            $table->string('coverage_states')->nullable();
            $table->unsignedInteger('installations_per_year')->nullable();
            $table->text('certifications')->nullable();
            $table->text('licenses')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country', 2)->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
        });

        Schema::create('product_line_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('service_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('service_group')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('company_product_line_type', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_profile_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_line_type_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->unique(['company_profile_id', 'product_line_type_id'], 'cmp_profile_product_line_uq');
        });

        Schema::create('company_service_type', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_profile_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_type_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->unique(['company_profile_id', 'service_type_id'], 'cmp_profile_service_uq');
        });

        Schema::create('product_brands', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_profile_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('product_line_type_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('origin_country', 2)->nullable();
            $table->string('website')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('product_models', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_brand_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('product_line_type_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('model_number')->nullable();
            $table->json('specifications')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('product_parts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_model_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('product_brand_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('product_line_type_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('part_number')->nullable();
            $table->json('compatibility')->nullable();
            $table->json('specifications')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        $productLines = [
            ['name' => 'Solar panels', 'slug' => 'solar-panels', 'description' => 'Photovoltaic modules for residential, C&I, and utility scale'],
            ['name' => 'Inverters', 'slug' => 'inverters', 'description' => 'String, central, and hybrid inverters'],
            ['name' => 'Battery storage', 'slug' => 'battery-storage', 'description' => 'Lithium, lead-acid, and hybrid battery systems'],
            ['name' => 'Hybrid kits', 'slug' => 'hybrid-kits', 'description' => 'Bundled hybrid or microgrid kits'],
            ['name' => 'Mounting structures', 'slug' => 'mounting-structures', 'description' => 'Rooftop and ground-mount structures'],
            ['name' => 'Components / parts', 'slug' => 'components-parts', 'description' => 'Cables, junction boxes, BMS, optimizers, etc.'],
        ];

        $serviceTypes = [
            ['name' => 'EPC turnkey', 'slug' => 'epc-turnkey', 'service_group' => 'solar-epc', 'description' => 'End-to-end engineering, procurement, and construction'],
            ['name' => 'Residential installs', 'slug' => 'residential-installs', 'service_group' => 'solar-epc', 'description' => 'Small-scale rooftop projects'],
            ['name' => 'Commercial / industrial', 'slug' => 'commercial-industrial', 'service_group' => 'solar-epc', 'description' => 'Large rooftop or ground-mount C&I'],
            ['name' => 'O&M / AMC', 'slug' => 'om-amc', 'service_group' => 'after-sales', 'description' => 'Operations, maintenance, and annual maintenance contracts'],
            ['name' => 'Inverter service', 'slug' => 'inverter-service', 'service_group' => 'service-type', 'description' => 'Inverter repairs and replacements'],
            ['name' => 'Battery retrofits', 'slug' => 'battery-retrofits', 'service_group' => 'service-type', 'description' => 'Battery upgrades and retrofits'],
            ['name' => 'Component distribution', 'slug' => 'component-distribution', 'service_group' => 'distribution', 'description' => 'Wholesale distribution of parts and components'],
            ['name' => 'Hybrid / microgrid service', 'slug' => 'hybrid-service', 'service_group' => 'hybrid', 'description' => 'Microgrid, hybrid, and miscellaneous services'],
        ];

        DB::table('product_line_types')->upsert($productLines, ['slug'], ['name', 'description', 'is_active']);
        DB::table('service_types')->upsert($serviceTypes, ['slug'], ['name', 'description', 'service_group', 'is_active']);
    }

    public function down(): void
    {
        Schema::dropIfExists('product_parts');
        Schema::dropIfExists('product_models');
        Schema::dropIfExists('product_brands');
        Schema::dropIfExists('company_service_type');
        Schema::dropIfExists('company_product_line_type');
        Schema::dropIfExists('service_types');
        Schema::dropIfExists('product_line_types');
        Schema::dropIfExists('company_profiles');
    }
};
