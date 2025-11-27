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
        Schema::table('categories', function (Blueprint $table) {
            // Remove columns that are not in the new schema
            $table->dropColumn(['icon', 'image', 'sort_order', 'is_active']);
            
            // Add status enum column
            $table->enum('status', ['active', 'inactive'])->default('active')->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            // Add back the dropped columns
            $table->string('icon')->nullable()->after('description');
            $table->string('image')->nullable()->after('icon');
            $table->integer('sort_order')->default(0)->after('image');
            $table->boolean('is_active')->default(true)->after('sort_order');
            
            // Remove the status column
            $table->dropColumn('status');
        });
    }
};
