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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('state_id')->constrained()->onDelete('cascade');
            
            // Pricing
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->date('sale_start_date')->nullable();
            $table->date('sale_end_date')->nullable();
            
            // Inventory
            $table->integer('stock_quantity')->default(0);
            $table->string('sku')->unique()->nullable();
            
            // Shipping
            $table->decimal('weight', 8, 2)->nullable()->comment('in kg');
            $table->decimal('length', 8, 2)->nullable()->comment('in cm');
            $table->decimal('width', 8, 2)->nullable()->comment('in cm');
            $table->decimal('height', 8, 2)->nullable()->comment('in cm');
            
            // Status
            $table->boolean('is_active')->default(true);
            $table->boolean('is_available')->default(true);
            
            // Additional info
            $table->json('specifications')->nullable();
            
            // Timestamps
            $table->timestamps();
            $table->softDeletes();
            
            // Composite unique key
            $table->unique(['product_id', 'state_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
