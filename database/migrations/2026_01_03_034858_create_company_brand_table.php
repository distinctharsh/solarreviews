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
        if (!Schema::hasTable('company_brand')) {
            Schema::create('company_brand', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id');
            $table->bigInteger('brand_id');
            $table->enum('type', ['manufacturer','authorized_dealer','distributor'])->default('distributor');
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
        Schema::dropIfExists('company_brand');
    }
};