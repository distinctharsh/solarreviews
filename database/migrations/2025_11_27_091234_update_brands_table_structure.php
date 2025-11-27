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
        Schema::table('brands', function (Blueprint $table) {
            // Drop columns that are not in the required schema
            $table->dropColumn([
                'description',
                'website',
                'established_year',
                'sort_order',
                'is_active',
                'is_featured'
            ]);

            // Rename logo to logo_url
            $table->renameColumn('logo', 'logo_url');

            // Add any missing columns (if any)
            if (!Schema::hasColumn('brands', 'country')) {
                $table->string('country')->nullable()->after('logo_url');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('brands', function (Blueprint $table) {
            // Add back the dropped columns
            $table->text('description')->nullable()->after('country');
            $table->string('website')->nullable()->after('description');
            $table->year('established_year')->nullable()->after('website');
            $table->integer('sort_order')->default(0)->after('established_year');
            $table->boolean('is_active')->default(true)->after('sort_order');
            $table->boolean('is_featured')->default(false)->after('is_active');
            
            // Revert the column name
            $table->renameColumn('logo_url', 'logo');
        });
    }
};
