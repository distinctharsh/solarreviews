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
        Schema::create('solar_enquiries', function (Blueprint $table) {
            $table->id();
            $table->decimal('capacity', 8, 2)->comment('Capacity in KW');
            $table->string('category', 50)->comment('Installation category: Residential/Commercial/Industrial/Groundmount/Group Captive');
            $table->enum('net_metering', ['Yes', 'No'])->comment('Net metering option');
            $table->string('type', 50)->comment('Installation type: Tin Shed/RCC roof/Groundmount');
            $table->integer('tin_shed_age')->nullable()->comment('Age of tin shed in years (for Tin Shed type)');
            $table->decimal('distance_from_substation', 8, 2)->nullable()->comment('Distance from substation in Kms (for Groundmount type)');
            $table->string('line', 10)->nullable()->comment('Power line voltage: 11/33/66/132 KV (for Groundmount type)');
            $table->string('name', 255)->comment('Customer name');
            $table->string('mobile_number', 15)->comment('Customer mobile number');
            $table->string('email', 255)->nullable()->comment('Customer email address (optional)');
            $table->text('notes')->nullable()->comment('Additional requirements or notes');
            $table->string('ip_address', 45)->nullable()->comment('Customer IP address for tracking');
            $table->text('user_agent')->nullable()->comment('Browser and device information');
            $table->timestamps();
            
            // Performance indexes
            $table->index('category');
            $table->index('type');
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
        Schema::dropIfExists('solar_enquiries');
    }
};
