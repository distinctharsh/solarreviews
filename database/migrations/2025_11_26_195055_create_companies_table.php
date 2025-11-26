<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->enum('company_type', ['manufacturer', 'distributor']);
            $table->text('about')->nullable();
            $table->string('logo')->nullable();
            $table->string('website')->nullable();
            $table->string('phone', 32)->nullable();
            $table->string('email')->nullable();
            $table->unsignedInteger('years_in_business')->nullable();
            $table->string('gst_number')->nullable();

            // Location
            $table->foreignId('state_id')->nullable()->constrained('states')->nullOnDelete();
            $table->foreignId('city_id')->nullable()->constrained('cities')->nullOnDelete();
            $table->string('address_line1')->nullable();
            $table->string('address_line2')->nullable();
            $table->string('postal_code', 20)->nullable();
            $table->string('service_area')->nullable();

            // Business info
            $table->string('certifications')->nullable();
            $table->string('licenses')->nullable();
            $table->json('meta')->nullable();

            // Distributor specifics
            $table->string('coverage_states')->nullable();
            $table->unsignedInteger('installations_per_year')->nullable();

            // Manufacturer specifics
            $table->string('production_capacity')->nullable();
            $table->string('distribution_regions')->nullable();

            // Stats
            $table->decimal('average_rating', 3, 1)->default(0);
            $table->unsignedInteger('total_reviews')->default(0);

            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['company_type', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
