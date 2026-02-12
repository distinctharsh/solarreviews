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
            $table->tinyInteger('sales_process_experience_rating')->nullable()->after('rating');
            $table->tinyInteger('price_charged_vs_quoted_rating')->nullable()->after('sales_process_experience_rating');
            $table->string('adherence_to_project_schedule', 32)->nullable()->after('price_charged_vs_quoted_rating');
            $table->tinyInteger('commissioning_timeliness_rating')->nullable()->after('adherence_to_project_schedule');
            $table->tinyInteger('smart_system_design_rating')->nullable()->after('commissioning_timeliness_rating');
            $table->tinyInteger('space_utilisation_efficiency_rating')->nullable()->after('smart_system_design_rating');
            $table->tinyInteger('installation_quality_workmanship_rating')->nullable()->after('space_utilisation_efficiency_rating');
            $table->tinyInteger('material_quality_rating')->nullable()->after('installation_quality_workmanship_rating');
            $table->string('plant_generation_performance', 48)->nullable()->after('material_quality_rating');
            $table->string('om_schedule_adherence', 32)->nullable()->after('plant_generation_performance');
            $table->tinyInteger('documentation_quality_timeliness_rating')->nullable()->after('om_schedule_adherence');
            $table->tinyInteger('subsidy_approval_experience')->nullable()->after('documentation_quality_timeliness_rating');
            $table->tinyInteger('net_metering_process_experience')->nullable()->after('subsidy_approval_experience');
            $table->tinyInteger('team_behaviour_professionalism_rating')->nullable()->after('net_metering_process_experience');
            $table->tinyInteger('overall_satisfaction_rating')->nullable()->after('team_behaviour_professionalism_rating');
            $table->string('would_recommend', 8)->nullable()->after('overall_satisfaction_rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company_reviews', function (Blueprint $table) {
            $table->dropColumn([
                'sales_process_experience_rating',
                'price_charged_vs_quoted_rating',
                'adherence_to_project_schedule',
                'commissioning_timeliness_rating',
                'smart_system_design_rating',
                'space_utilisation_efficiency_rating',
                'installation_quality_workmanship_rating',
                'material_quality_rating',
                'plant_generation_performance',
                'om_schedule_adherence',
                'documentation_quality_timeliness_rating',
                'subsidy_approval_experience',
                'net_metering_process_experience',
                'team_behaviour_professionalism_rating',
                'overall_satisfaction_rating',
                'would_recommend',
            ]);
        });
    }
};
