<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('company_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            
            $table->boolean('is_manufacturer')->default(0);
            $table->enum('stock_status', ['in_stock', 'out_of_stock'])->default('in_stock');
            $table->decimal('price', 10, 2)->nullable();
            $table->integer('min_order_qty')->default(1);
            
            $table->timestamps();
            
            // Add unique constraint to prevent duplicate entries
            $table->unique(['company_id', 'product_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_product');
    }
};