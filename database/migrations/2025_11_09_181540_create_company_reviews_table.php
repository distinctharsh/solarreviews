<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('company_reviews')) {
            Schema::create('company_reviews', function (Blueprint $table) {
                $table->id();
                $table->foreignId('company_id')->constrained()->onDelete('cascade');
                $table->string('reviewer_name');
                $table->integer('rating');
                $table->text('review_text');
                $table->date('review_date');
                $table->string('source')->default('website');
                $table->boolean('is_featured')->default(false);
                $table->timestamps();
                $table->softDeletes();
            });
        } else {
            // Add any missing columns
            Schema::table('company_reviews', function (Blueprint $table) {
                if (!Schema::hasColumn('company_reviews', 'reviewer_name')) {
                    $table->string('reviewer_name')->after('company_id');
                }
                if (!Schema::hasColumn('company_reviews', 'rating')) {
                    $table->integer('rating')->after('reviewer_name');
                }
                if (!Schema::hasColumn('company_reviews', 'review_text')) {
                    $table->text('review_text')->after('rating');
                }
                if (!Schema::hasColumn('company_reviews', 'review_date')) {
                    $table->date('review_date')->after('review_text');
                }
                if (!Schema::hasColumn('company_reviews', 'source')) {
                    $table->string('source')->default('website')->after('review_date');
                }
                if (!Schema::hasColumn('company_reviews', 'is_featured')) {
                    $table->boolean('is_featured')->default(false)->after('source');
                }
                
                // Add soft deletes if not exists
                if (!Schema::hasColumn('company_reviews', 'deleted_at')) {
                    $table->softDeletes();
                }
            });

            // Add foreign key constraint if it doesn't exist
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $foreignKeys = $sm->listTableForeignKeys('company_reviews');
            $hasCompanyFk = false;
            foreach ($foreignKeys as $fk) {
                if ($fk->getLocalColumns() === ['company_id']) {
                    $hasCompanyFk = true;
                    break;
                }
            }
            
            if (!$hasCompanyFk) {
                Schema::table('company_reviews', function (Blueprint $table) {
                    $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
                });
            }
        }
    }

    public function down()
    {
        Schema::dropIfExists('company_reviews');
    }
};
