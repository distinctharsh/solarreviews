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
        if (!Schema::hasTable('chatbot_questions')) {
            Schema::create('chatbot_questions', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('prompt');
            $table->string('type', 255)->default('choice');
            $table->boolean('is_required')->default(1);
            $table->boolean('is_active')->default(1);
            $table->integer('display_order')->default(0);
            $table->string('input_placeholder', 255)->nullable();
            $table->text('input_validation')->nullable();
            $table->bigInteger('default_next_question_id')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();

            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chatbot_questions');
    }
};