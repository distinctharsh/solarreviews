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
            // Add description column if it doesn't exist
            if (!Schema::hasColumn('brands', 'description')) {
                $table->text('description')->nullable()->after('logo_url');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('brands', function (Blueprint $table) {
            // Drop the description column if it exists
            if (Schema::hasColumn('brands', 'description')) {
                $table->dropColumn('description');
            }
        });
    }
};
