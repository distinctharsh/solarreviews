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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');                          // Inverter, Panel, Battery, EPC
            $table->string('slug')->unique();                // inverter, panel, battery, epc
            $table->text('description')->nullable();         // Category description
            $table->string('icon')->nullable();              // Icon class or image path
            $table->string('image')->nullable();             // Category image
            $table->integer('sort_order')->default(0);       // Display order
            $table->boolean('is_active')->default(true);     // Active/Inactive
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};

