<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add company_id foreign key
            $table->foreignId('company_id')
                  ->nullable()
                  ->after('id')
                  ->constrained('companies')
                  ->onDelete('set null');

            // Add phone column if it doesn't exist
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->after('email');
            }

            // Add role column
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['superadmin', 'admin', 'staff', 'viewer'])
                      ->default('admin')
                      ->after('password');
            }

            // Add user_type column
            if (!Schema::hasColumn('users', 'user_type')) {
                $table->enum('user_type', [
                    'manufacturer',
                    'distributor',
                    'dealer',
                    'installer',
                    'wholesaler',
                    'retailer',
                    'epc'
                ])->nullable()->after('role');
            }

            // Add status column if it doesn't exist
            if (!Schema::hasColumn('users', 'status')) {
                $table->enum('status', ['active', 'inactive'])
                      ->default('active')
                      ->after('user_type');
            }

            // Make email_verified_at nullable if it's not already
            $table->timestamp('email_verified_at')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop foreign key constraint first
            $table->dropForeign(['company_id']);
            
            // Drop columns
            $table->dropColumn([
                'company_id',
                'phone',
                'role',
                'user_type',
                'status'
            ]);

            // Revert email_verified_at to non-nullable if needed
            $table->timestamp('email_verified_at')->nullable(false)->change();
        });
    }
};