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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name');                          // Brand name (Tata, Luminous, Havells)
            $table->string('slug')->unique();                // URL-friendly slug
            $table->text('description')->nullable();         // Brand description
            $table->string('logo')->nullable();              // Brand logo image
            $table->string('website')->nullable();           // Brand website URL
            $table->string('country')->nullable();           // Country of origin
            $table->year('established_year')->nullable();    // Year established
            $table->integer('sort_order')->default(0);       // Display order
            $table->boolean('is_active')->default(true);     // Active/Inactive
            $table->boolean('is_featured')->default(false);  // Featured brand
            $table->timestamps();
        });

        // Pivot table for brand-category relationship (which categories this brand has products in)
        Schema::create('brand_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['brand_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brand_category');
        Schema::dropIfExists('brands');
    }
};

