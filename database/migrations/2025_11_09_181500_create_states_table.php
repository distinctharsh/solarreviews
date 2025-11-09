<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('states')) {
            Schema::create('states', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->text('description')->nullable();
                $table->timestamps();
            });
        } else {
            // Add any missing columns
            Schema::table('states', function (Blueprint $table) {
                if (!Schema::hasColumn('states', 'slug')) {
                    $table->string('slug')->unique()->after('name');
                }
                if (!Schema::hasColumn('states', 'description')) {
                    $table->text('description')->nullable()->after('slug');
                }
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('states');
    }
};
