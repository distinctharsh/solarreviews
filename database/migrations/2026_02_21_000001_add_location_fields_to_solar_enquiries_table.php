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
        Schema::table('solar_enquiries', function (Blueprint $table) {
            // Location preference field
            $table->enum('use_location', ['dropdown', 'other'])->default('dropdown')->comment('Location input method preference');
            
            // Dropdown location fields (relational)
            $table->unsignedBigInteger('state_id')->nullable()->comment('State ID from states table');
            $table->string('city', 100)->nullable()->comment('City name from cities table');
            $table->unsignedBigInteger('city_id')->nullable()->comment('City ID from cities table (linked city)');
            $table->string('pincode', 10)->nullable()->comment('Pincode from pincodes table');
            
            // Manual location field
            $table->text('other_location')->nullable()->comment('Manual location description when dropdown not used');
            
            // Other field for additional details
            $table->text('other')->nullable()->comment('Other details or requirements');
            
            // Foreign key constraints
            $table->foreign('state_id')->references('id')->on('states')->onDelete('set null');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');
            
            // Indexes for performance
            $table->index('state_id');
            $table->index('city_id');
            $table->index('pincode');
            $table->index('use_location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('solar_enquiries', function (Blueprint $table) {
            // Drop foreign keys first
            $table->dropForeign(['state_id']);
            $table->dropForeign(['city_id']);
            
            // Drop columns
            $table->dropColumn([
                'use_location',
                'state_id', 
                'city',
                'city_id',
                'pincode',
                'other_location',
                'other'
            ]);
            
            // Drop indexes
            $table->dropIndex(['state_id']);
            $table->dropIndex(['city_id']);
            $table->dropIndex(['pincode']);
            $table->dropIndex(['use_location']);
        });
    }
};
