<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Fix the id column to have AUTO_INCREMENT
        DB::statement('ALTER TABLE `normal_users` MODIFY `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Note: Removing AUTO_INCREMENT is not recommended, but if needed:
        // DB::statement('ALTER TABLE `normal_users` MODIFY `id` BIGINT UNSIGNED NOT NULL');
    }
};

