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
        if (!Schema::hasTable('company_reviews')) {
            Schema::create('company_reviews', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->nullable();
            $table->string('manual_company_name', 255)->nullable();
            $table->string('company_url', 255)->nullable();
            $table->bigInteger('category_id')->nullable();
            $table->bigInteger('state_id')->nullable();
            $table->bigInteger('reviewer_state_id')->nullable();
            $table->string('reviewer_city', 255)->nullable();
            $table->string('reviewer_name', 255);
            $table->string('email', 255);
            $table->bigInteger('normal_user_id')->nullable();
            $table->tinyInteger('rating');
            $table->tinyInteger('sales_process_rating')->nullable();
            $table->tinyInteger('price_charged_as_quoted_rating')->nullable();
            $table->tinyInteger('on_schedule_rating')->nullable();
            $table->tinyInteger('installation_quality_rating')->nullable();
            $table->tinyInteger('after_sales_support_rating')->nullable();
            $table->text('experience_metrics')->nullable();
            $table->decimal('system_size_kw')->nullable();
            $table->decimal('system_price')->nullable();
            $table->integer('year_installed')->nullable();
            $table->string('panel_brand', 255)->nullable();
            $table->string('inverter_brand', 255)->nullable();
            $table->string('review_title', 255)->nullable();
            $table->text('review_text');
            $table->text('media_paths')->nullable();
            $table->string('primary_media_path', 255)->nullable();
            $table->boolean('media_terms_accepted')->default(0);
            $table->date('review_date')->nullable();
            $table->string('source', 255)->nullable();
            $table->boolean('is_featured')->default(0);
            $table->boolean('is_approved')->default(0);
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
        Schema::dropIfExists('company_reviews');
    }
};