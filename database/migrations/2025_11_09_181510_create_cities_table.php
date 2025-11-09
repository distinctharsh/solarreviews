<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('cities')) {
            Schema::create('cities', function (Blueprint $table) {
                $table->id();
                $table->foreignId('state_id')->constrained()->onDelete('cascade');
                $table->string('name');
                $table->string('slug')->unique();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        } else {
            // Add any missing columns
            Schema::table('cities', function (Blueprint $table) {
                if (!Schema::hasColumn('cities', 'slug')) {
                    $table->string('slug')->after('name');
                    // We'll add the unique constraint later after ensuring no duplicates
                }
                if (!Schema::hasColumn('cities', 'is_active')) {
                    $table->boolean('is_active')->default(true)->after('slug');
                }
            });

            // Add unique constraint if it doesn't exist
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $indexes = $sm->listTableIndexes('cities');
            if (!isset($indexes['cities_slug_unique'])) {
                Schema::table('cities', function (Blueprint $table) {
                    $table->unique('slug');
                });
            }
        }
    }

    public function down()
    {
        Schema::dropIfExists('cities');
    }
};
