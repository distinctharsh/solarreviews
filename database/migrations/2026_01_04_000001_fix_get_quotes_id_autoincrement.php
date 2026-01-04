<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Throwable;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('get_quotes')) {
            return;
        }

        // Ensure `id` behaves like Laravel's $table->id() (AUTO_INCREMENT primary key)
        try {
            DB::statement('ALTER TABLE `get_quotes` MODIFY `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT');
        } catch (Throwable $e) {
            // Ignore if already correct or DB does not support this change.
        }

        try {
            DB::statement('ALTER TABLE `get_quotes` ADD PRIMARY KEY (`id`)');
        } catch (Throwable $e) {
            // Ignore if primary key already exists.
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No-op (we don't want to risk breaking existing data by reverting PK changes).
    }
};
