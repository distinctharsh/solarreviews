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
        if (!Schema::hasTable('rating_summaries')) {
            Schema::create('rating_summaries', function (Blueprint $table) {
            $table->id();
            $table->string('reviewable_type', 255);
            $table->bigInteger('reviewable_id');
            $table->decimal('avg_rating')->default(0);
            $table->integer('total_reviews')->default(0);
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
        Schema::dropIfExists('rating_summaries');
    }
};