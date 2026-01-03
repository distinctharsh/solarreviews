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
        if (!Schema::hasTable('companies')) {
            Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('owner_id')->nullable();
            $table->string('slug', 255);
            $table->enum('company_type', ['manufacturer','distributor','dealer','installer','wholesaler','retailer','epc']);
            $table->string('owner_name', 255);
            $table->string('phone', 32)->nullable();
            $table->string('website_url', 255)->nullable();
            $table->string('logo_url', 255)->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['active','inactive'])->default('active');
            $table->string('email', 255)->nullable();
            $table->integer('years_in_business')->nullable();
            $table->string('gst_number', 255)->nullable();
            $table->text('address');
            $table->string('city', 255);
            $table->string('pincode', 255);
            $table->bigInteger('state_id')->nullable();
            $table->bigInteger('city_id')->nullable();
            $table->boolean('is_active')->default(1);
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
        Schema::dropIfExists('companies');
    }
};