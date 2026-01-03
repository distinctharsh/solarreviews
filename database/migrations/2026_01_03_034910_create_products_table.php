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
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('brand_id')->nullable();
            $table->bigInteger('category_id')->nullable();
            $table->string('product_name', 255);
            $table->string('model_name', 255)->nullable();
            $table->string('type', 255)->nullable();
            $table->decimal('capacity_kw')->nullable();
            $table->string('size', 255)->nullable();
            $table->string('warranty', 255)->nullable();
            $table->text('technical_details')->nullable();
            $table->decimal('efficiency')->nullable();
            $table->string('slug', 255);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->id();
            $table->bigInteger('product_id');
            $table->string('type', 255)->default('image');
            $table->string('file_path', 255);
            $table->string('thumbnail_path', 255)->nullable();
            $table->string('caption', 255)->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_primary')->default(0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};