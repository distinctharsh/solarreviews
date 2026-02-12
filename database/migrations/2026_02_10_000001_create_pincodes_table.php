<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('pincodes')) {
            Schema::create('pincodes', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('state_id');
                $table->unsignedBigInteger('city_id')->nullable();
                $table->string('city_name')->nullable();
                $table->string('pincode', 20);
                $table->boolean('is_active')->default(true);
                $table->timestamps();

                $table->index(['state_id', 'city_id']);
                $table->index(['state_id', 'pincode']);
                $table->unique(['state_id', 'city_id', 'pincode']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('pincodes');
    }
};
