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
            $table->json('experience_metrics')->nullable()->after('rating');
            $table->decimal('system_size_kw', 8, 2)->nullable()->after('experience_metrics');
            $table->decimal('system_price', 12, 2)->nullable()->after('system_size_kw');
            $table->integer('year_installed')->nullable()->after('system_price');
            $table->string('panel_brand')->nullable()->after('year_installed');
            $table->string('inverter_brand')->nullable()->after('panel_brand');
            $table->foreignId('reviewer_state_id')->nullable()->after('state_id')->constrained('states')->nullOnDelete();
            $table->string('reviewer_city')->nullable()->after('reviewer_state_id');
            $table->json('media_paths')->nullable()->after('review_text');
            $table->boolean('media_terms_accepted')->default(false)->after('media_paths');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company_reviews', function (Blueprint $table) {
            $table->dropForeign(['reviewer_state_id']);
            $table->dropColumn([
                'experience_metrics',
                'system_size_kw',
                'system_price',
                'year_installed',
                'panel_brand',
                'inverter_brand',
                'reviewer_state_id',
                'reviewer_city',
                'media_paths',
                'media_terms_accepted',
            ]);
        });
    }
};
