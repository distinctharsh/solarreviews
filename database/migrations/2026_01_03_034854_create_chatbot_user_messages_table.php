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
        if (!Schema::hasTable('chatbot_user_messages')) {
            Schema::create('chatbot_user_messages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('session_id');
            $table->bigInteger('question_id')->nullable();
            $table->bigInteger('option_id')->nullable();
            $table->string('sender', 255)->default('user');
            $table->text('input_value')->nullable();
            $table->text('payload')->nullable();
            $table->integer('sequence')->default(0);
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
        Schema::dropIfExists('chatbot_user_messages');
    }
};