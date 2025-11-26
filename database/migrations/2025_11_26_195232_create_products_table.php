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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('brand_id')->nullable()->constrained('brands')->nullOnDelete();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();

            $table->string('name');
            $table->string('slug')->unique();
            $table->string('model_number')->nullable();
            $table->string('variant')->nullable();
            $table->string('wattage_or_capacity')->nullable();
            $table->string('technology')->nullable();
            $table->decimal('efficiency', 5, 2)->nullable();
            $table->unsignedInteger('warranty_years')->nullable();
            $table->string('datasheet_url')->nullable();
            $table->decimal('msrp', 10, 2)->nullable();
            $table->json('specs')->nullable();

            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['company_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
