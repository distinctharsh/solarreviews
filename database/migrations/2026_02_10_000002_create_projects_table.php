<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('projects')) {
            Schema::create('projects', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->cascadeOnDelete();
                $table->foreignId('company_id')->nullable()->constrained('companies')->nullOnDelete();

                $table->string('site_name');
                $table->string('site_location');
                $table->decimal('total_capacity_kw', 10, 2)->nullable();
                $table->string('installation_type')->nullable();
                $table->string('financial_model')->nullable();
                $table->decimal('average_generation_units_per_kw_year', 10, 2)->nullable();

                $table->string('contact_no')->nullable();
                $table->string('email_id')->nullable();

                $table->boolean('show_contact_on_frontend')->default(false);
                $table->boolean('show_email_on_frontend')->default(false);

                $table->timestamps();

                $table->index(['user_id', 'company_id']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
