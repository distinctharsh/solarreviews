<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            // Remove unnecessary columns
            $columnsToDrop = [
                'about', 'logo', 'website', 'service_area', 'licenses', 'meta',
                'coverage_states', 'installations_per_year', 'production_capacity',
                'distribution_regions', 'postal_code'
            ];
            
            // Only drop columns that exist
            $existingColumns = Schema::getColumnListing('companies');
            $columnsToDrop = array_intersect($columnsToDrop, $existingColumns);
            
            if (!empty($columnsToDrop)) {
                // Drop foreign key constraints first if they exist
                if (in_array('state_id', $existingColumns)) {
                    Schema::table('companies', function (Blueprint $table) {
                        $table->dropForeign(['state_id']);
                    });
                }
                
                if (in_array('city_id', $existingColumns)) {
                    Schema::table('companies', function (Blueprint $table) {
                        $table->dropForeign(['city_id']);
                    });
                }
                
                // Now drop the columns
                Schema::table('companies', function (Blueprint $table) use ($columnsToDrop) {
                    $table->dropColumn($columnsToDrop);
                });
            }

            // Modify company_type enum if needed
            if (Schema::hasColumn('companies', 'company_type')) {
                DB::statement("ALTER TABLE companies MODIFY COLUMN company_type ENUM(
                    'manufacturer', 'distributor', 'dealer', 'installer', 
                    'wholesaler', 'retailer', 'epc'
                ) NOT NULL");
            }

            // Add missing columns if they don't exist
            if (!Schema::hasColumn('companies', 'gst_number')) {
                $table->string('gst_number')->nullable()->after('owner_name');
            }

            if (!Schema::hasColumn('companies', 'address')) {
                $table->text('address')->after('gst_number');
            }

            if (!Schema::hasColumn('companies', 'city')) {
                $table->string('city')->after('address');
            }

            if (!Schema::hasColumn('companies', 'state')) {
                $table->string('state')->after('city');
            }

            if (!Schema::hasColumn('companies', 'pincode')) {
                $table->string('pincode')->after('state');
            }

            if (!Schema::hasColumn('companies', 'website_url')) {
                $table->string('website_url')->nullable()->after('phone');
            }

            if (!Schema::hasColumn('companies', 'logo_url')) {
                $table->string('logo_url')->nullable()->after('website_url');
            }

            if (!Schema::hasColumn('companies', 'description')) {
                $table->text('description')->nullable()->after('logo_url');
            }

            if (!Schema::hasColumn('companies', 'status')) {
                $table->enum('status', ['active', 'inactive'])->default('active')->after('description');
            }
            
            // Rename website to website_url if it exists
            if (Schema::hasColumn('companies', 'website') && !Schema::hasColumn('companies', 'website_url')) {
                $table->renameColumn('website', 'website_url');
            }
            
            // Rename logo to logo_url if it exists
            if (Schema::hasColumn('companies', 'logo') && !Schema::hasColumn('companies', 'logo_url')) {
                $table->renameColumn('logo', 'logo_url');
            }
            
            // Rename about to description if it exists
            if (Schema::hasColumn('companies', 'about') && !Schema::hasColumn('companies', 'description')) {
                $table->renameColumn('about', 'description');
            }
        });
    }

    public function down()
    {
        // Note: This is a simplified down migration that may need adjustment
        Schema::table('companies', function (Blueprint $table) {
            // Add back any columns that were dropped
            $table->text('about')->nullable();
            $table->string('logo')->nullable();
            $table->string('website')->nullable();
            $table->string('service_area')->nullable();
            $table->string('licenses')->nullable();
            $table->json('meta')->nullable();
            $table->string('coverage_states')->nullable();
            $table->unsignedInteger('installations_per_year')->nullable();
            $table->string('production_capacity')->nullable();
            $table->string('distribution_regions')->nullable();
            $table->string('postal_code', 20)->nullable();
            
            // Add back foreign keys if they were removed
            $table->unsignedBigInteger('state_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            
            $table->foreign('state_id')->references('id')->on('states')->onDelete('SET NULL');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('SET NULL');
        });
    }
};