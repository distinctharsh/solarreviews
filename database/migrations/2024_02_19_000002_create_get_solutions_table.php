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
        Schema::create('get_solutions', function (Blueprint $table) {
            $table->id();
            $table->string('pincode', 6)->comment('Customer area pincode');
            $table->string('service_type', 50)->comment('Service type: O&M, AMC, Cleaning, Net metering, Delay in Execution');
            $table->string('generation_variation', 20)->nullable()->comment('Generation variation: committed, actual');
            $table->string('name', 255)->comment('Customer name');
            $table->string('mobile_number', 15)->comment('Customer mobile number');
            $table->string('email', 255)->nullable()->comment('Customer email address (optional)');
            $table->text('details')->nullable()->comment('Additional requirements or issues');
            $table->string('ip_address', 45)->nullable()->comment('Customer IP address for tracking');
            $table->text('user_agent')->nullable()->comment('Browser and device information');
            $table->timestamps();
            
            // Performance indexes
            $table->index('pincode');
            $table->index('service_type');
            $table->index('generation_variation');
            $table->index('mobile_number');
            $table->index('created_at');
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('get_solutions');
    }
};
