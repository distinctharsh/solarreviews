<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chatbot_questions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('prompt');
            $table->string('type')->default('choice');
            $table->boolean('is_required')->default(true);
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('display_order')->default(0);
            $table->string('input_placeholder')->nullable();
            $table->json('input_validation')->nullable();
            $table->foreignId('default_next_question_id')->nullable()->constrained('chatbot_questions');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chatbot_questions');
    }
};
