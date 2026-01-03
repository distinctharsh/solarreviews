<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('migrations')) {
            try {
                DB::statement('ALTER TABLE `migrations` MODIFY `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT');
            } catch (\Throwable $e) {
                // noop
            }
        }

        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (! Schema::hasColumn('users', 'google_id')) {
                    $table->string('google_id', 255)->nullable()->after('email');
                }

                if (! Schema::hasColumn('users', 'google_avatar')) {
                    $table->string('google_avatar', 2048)->nullable()->after('google_id');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasColumn('users', 'google_avatar')) {
                    $table->dropColumn('google_avatar');
                }

                if (Schema::hasColumn('users', 'google_id')) {
                    $table->dropColumn('google_id');
                }
            });
        }
    }
};
