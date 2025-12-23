<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('company_reviews', function (Blueprint $table) {
            if (!Schema::hasColumn('company_reviews', 'manual_company_name')) {
                $table->string('manual_company_name')->nullable()->after('company_id');
            }
            if (!Schema::hasColumn('company_reviews', 'company_url')) {
                $table->string('company_url')->nullable()->after('manual_company_name');
            }
        });
    }

    public function down(): void
    {
        Schema::table('company_reviews', function (Blueprint $table) {
            if (Schema::hasColumn('company_reviews', 'company_url')) {
                $table->dropColumn('company_url');
            }
            if (Schema::hasColumn('company_reviews', 'manual_company_name')) {
                $table->dropColumn('manual_company_name');
            }
        });
    }
};
