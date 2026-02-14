<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('customer_name');
            $table->string('customer_company')->nullable();
            $table->string('project_type')->nullable();
            $table->text('testimonial_text');
            $table->integer('rating')->nullable()->comment('1-5 stars');
            $table->string('customer_image')->nullable();
            $table->boolean('show_on_frontend')->default(true);
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
            
            $table->index(['user_id', 'show_on_frontend']);
            $table->index(['is_approved', 'show_on_frontend']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
