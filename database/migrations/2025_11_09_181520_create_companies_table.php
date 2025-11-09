<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('companies')) {
            Schema::create('companies', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->text('description')->nullable();
                $table->string('logo')->nullable();
                $table->string('website')->nullable();
                $table->string('phone')->nullable();
                $table->string('email')->nullable();
                $table->string('address')->nullable();
                $table->foreignId('city_id')->constrained()->onDelete('cascade');
                $table->decimal('average_rating', 3, 1)->default(0);
                $table->integer('total_reviews')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        } else {
            // Add any missing columns
            Schema::table('companies', function (Blueprint $table) {
                if (!Schema::hasColumn('companies', 'slug')) {
                    $table->string('slug')->after('name');
                }
                if (!Schema::hasColumn('companies', 'description')) {
                    $table->text('description')->nullable()->after('slug');
                }
                if (!Schema::hasColumn('companies', 'logo')) {
                    $table->string('logo')->nullable()->after('description');
                }
                if (!Schema::hasColumn('companies', 'website')) {
                    $table->string('website')->nullable()->after('logo');
                }
                if (!Schema::hasColumn('companies', 'phone')) {
                    $table->string('phone')->nullable()->after('website');
                }
                if (!Schema::hasColumn('companies', 'email')) {
                    $table->string('email')->nullable()->after('phone');
                }
                if (!Schema::hasColumn('companies', 'address')) {
                    $table->string('address')->nullable()->after('email');
                }
                if (!Schema::hasColumn('companies', 'city_id')) {
                    $table->foreignId('city_id')->nullable()->after('address');
                }
                if (!Schema::hasColumn('companies', 'average_rating')) {
                    $table->decimal('average_rating', 3, 1)->default(0)->after('city_id');
                }
                if (!Schema::hasColumn('companies', 'total_reviews')) {
                    $table->integer('total_reviews')->default(0)->after('average_rating');
                }
                if (!Schema::hasColumn('companies', 'is_active')) {
                    $table->boolean('is_active')->default(true)->after('total_reviews');
                }
            });

            // Add foreign key constraint if it doesn't exist
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('companies');
            $hasCityFk = false;
            foreach ($foreignKeys as $fk) {
                if ($fk->getLocalColumns() === ['city_id']) {
                    $hasCityFk = true;
                    break;
                }
            }
            
            if (!$hasCityFk) {
                Schema::table('companies', function (Blueprint $table) {
                    $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
                });
            }
        }
    }

    public function down()
    {
        Schema::dropIfExists('companies');
    }
};
