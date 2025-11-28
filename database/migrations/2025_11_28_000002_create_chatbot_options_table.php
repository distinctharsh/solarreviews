<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chatbot_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained('chatbot_questions')->cascadeOnDelete();
            $table->string('label');
            $table->string('value')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('display_order')->default(0);
            $table->foreignId('next_question_id')->nullable()->constrained('chatbot_questions')->nullOnDelete();
            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chatbot_options');
    }
};
