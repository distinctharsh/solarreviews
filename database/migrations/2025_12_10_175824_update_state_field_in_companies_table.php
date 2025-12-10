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
        Schema::table('companies', function (Blueprint $table) {

            // 1. Ensure state_id column exists and correct type
            if (!Schema::hasColumn('companies', 'state_id')) {
                $table->unsignedBigInteger('state_id')->nullable()->after('state');
            }

            // 2. Add foreign key constraint
            $table->foreign('state_id')
                  ->references('id')
                  ->on('states')
                  ->onDelete('set null')
                  ->onUpdate('cascade');

            // 3. (Optional) Remove old "state" text column
            // If you want to remove it:
            // if (Schema::hasColumn('companies', 'state')) {
            //     $table->dropColumn('state');
            // }
        });
    }

    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            // Drop foreign key
            $table->dropForeign(['state_id']);

            // Optional rollback:
            // $table->string('state')->nullable();

            // $table->dropColumn('state_id');
        });
    }
};
