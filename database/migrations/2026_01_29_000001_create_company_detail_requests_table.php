<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('company_detail_requests')) {
            Schema::create('company_detail_requests', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('company_id')->nullable();
                $table->string('name', 255);
                $table->string('mobile_number', 20);
                $table->string('email', 255)->nullable();
                $table->string('location', 255)->nullable();
                $table->text('message')->nullable();
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('company_detail_requests');
    }
};
