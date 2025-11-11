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
        Schema::table('company_reviews', function (Blueprint $table) {
            $table->string('email')->after('reviewer_name')->nullable();
            $table->foreignId('state_id')->after('company_id')->nullable()->constrained('states')->onDelete('set null');
            $table->string('review_title')->after('reviewer_name')->nullable();
            $table->string('otp', 6)->nullable();
            $table->boolean('otp_verified')->default(false);
            $table->timestamp('otp_expires_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company_reviews', function (Blueprint $table) {
            $table->dropForeign(['state_id']);
            $table->dropColumn(['email', 'state_id', 'review_title', 'otp', 'otp_verified', 'otp_expires_at']);
        });
    }
};
