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
        Schema::table('company_reviews', function (Blueprint $table) {
            $table->unsignedTinyInteger('sales_process_rating')->nullable()->after('rating');
            $table->unsignedTinyInteger('price_charged_as_quoted_rating')->nullable()->after('sales_process_rating');
            $table->unsignedTinyInteger('on_schedule_rating')->nullable()->after('price_charged_as_quoted_rating');
            $table->unsignedTinyInteger('installation_quality_rating')->nullable()->after('on_schedule_rating');
            $table->unsignedTinyInteger('after_sales_support_rating')->nullable()->after('installation_quality_rating');
            $table->string('primary_media_path')->nullable()->after('media_paths');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company_reviews', function (Blueprint $table) {
            $table->dropColumn([
                'sales_process_rating',
                'price_charged_as_quoted_rating',
                'on_schedule_rating',
                'installation_quality_rating',
                'after_sales_support_rating',
                'primary_media_path',
            ]);
        });
    }
};
