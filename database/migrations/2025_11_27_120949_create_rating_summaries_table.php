<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rating_summaries', function (Blueprint $table) {
            $table->id();
            
            // Polymorphic relationship
            $table->string('reviewable_type');
            $table->unsignedBigInteger('reviewable_id');
            
            // Rating summary
            $table->decimal('avg_rating', 3, 2)->default(0);
            $table->integer('total_reviews')->default(0);
            
            // Add index for the polymorphic relationship
            $table->index(['reviewable_type', 'reviewable_id']);
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rating_summaries');
    }
};