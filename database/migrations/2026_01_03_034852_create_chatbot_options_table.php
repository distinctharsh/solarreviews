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
        if (!Schema::hasTable('chatbot_options')) {
            Schema::create('chatbot_options', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('question_id');
            $table->string('label', 255);
            $table->string('value', 255)->nullable();
            $table->text('description')->nullable();
            $table->integer('display_order')->default(0);
            $table->bigInteger('next_question_id')->nullable();
            $table->text('metadata')->nullable();
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
        Schema::dropIfExists('chatbot_options');
    }
};