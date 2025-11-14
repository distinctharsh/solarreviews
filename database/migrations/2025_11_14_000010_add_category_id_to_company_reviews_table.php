<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('company_reviews', function (Blueprint $table) {
            if (!Schema::hasColumn('company_reviews', 'category_id')) {
                $table->foreignId('category_id')
                    ->nullable()
                    ->after('company_id')
                    ->constrained()
                    ->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('company_reviews', function (Blueprint $table) {
            if (Schema::hasColumn('company_reviews', 'category_id')) {
                $table->dropForeign(['category_id']);
                $table->dropColumn('category_id');
            }
        });
    }
};
