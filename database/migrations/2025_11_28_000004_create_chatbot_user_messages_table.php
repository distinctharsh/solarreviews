<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chatbot_user_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained('chatbot_user_sessions')->cascadeOnDelete();
            $table->foreignId('question_id')->nullable()->constrained('chatbot_questions')->nullOnDelete();
            $table->foreignId('option_id')->nullable()->constrained('chatbot_options')->nullOnDelete();
            $table->string('sender')->default('user');
            $table->text('input_value')->nullable();
            $table->json('payload')->nullable();
            $table->unsignedInteger('sequence')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chatbot_user_messages');
    }
};
