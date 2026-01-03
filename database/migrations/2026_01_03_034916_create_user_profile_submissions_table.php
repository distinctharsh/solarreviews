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
        if (!Schema::hasTable('user_profile_submissions')) {
            Schema::create('user_profile_submissions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('form_type', 255);
            $table->text('payload')->nullable();
            $table->string('status', 255)->default('pending');
            $table->text('review_notes')->nullable();
            $table->bigInteger('reviewed_by')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profile_submissions');
    }
};