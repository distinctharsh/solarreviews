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
        if (!Schema::hasTable('product_specs')) {
            Schema::create('product_specs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id');
            $table->string('spec_name', 255);
            $table->text('spec_value');
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
        Schema::dropIfExists('product_specs');
    }
};