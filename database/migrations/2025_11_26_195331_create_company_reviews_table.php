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
        Schema::create('company_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->foreignId('state_id')->nullable()->constrained('states')->nullOnDelete();

            $table->string('reviewer_name');
            $table->string('email');
            $table->unsignedTinyInteger('rating');
            $table->string('review_title')->nullable();
            $table->text('review_text');
            $table->date('review_date')->nullable();
            $table->string('source')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_approved')->default(false);

            $table->timestamps();

            $table->index(['company_id', 'is_approved']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_reviews');
    }
};
