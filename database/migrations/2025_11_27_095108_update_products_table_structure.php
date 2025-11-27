<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Drop existing foreign key constraints if they exist
            $this->dropForeignIfExists($table, 'products_company_id_foreign');
            $this->dropForeignIfExists($table, 'products_category_id_foreign');
            $this->dropForeignIfExists($table, 'products_brand_id_foreign');

            // Rename columns to match new structure
            if (Schema::hasColumn('products', 'name')) {
                $table->renameColumn('name', 'product_name');
            }

            // Add new columns if they don't exist
            if (!Schema::hasColumn('products', 'model_name')) {
                $table->string('model_name')->nullable()->after('product_name');
            }

            if (!Schema::hasColumn('products', 'type')) {
                $table->string('type')->nullable()->after('model_name');
            }

            if (!Schema::hasColumn('products', 'capacity_kw')) {
                $table->decimal('capacity_kw', 10, 2)->nullable()->after('type');
            }

            if (!Schema::hasColumn('products', 'size')) {
                $table->string('size')->nullable()->after('capacity_kw');
            }

            if (!Schema::hasColumn('products', 'warranty')) {
                $table->string('warranty')->nullable()->after('size');
            }

            if (!Schema::hasColumn('products', 'technical_details')) {
                $table->json('technical_details')->nullable()->after('warranty');
            }

            // Update foreign key constraints
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('cascade');
                  
            $table->foreign('brand_id')
                  ->references('id')
                  ->on('brands')
                  ->onDelete('cascade');

            // Drop columns that are no longer needed
            $columnsToDrop = [
                'company_id',
                'model_number',
                'variant',
                'wattage_or_capacity',
                'technology',
                'efficiency',
                'warranty_years',
                'datasheet_url',
                'msrp',
                'specs',
                'is_active'
            ];

            foreach ($columnsToDrop as $column) {
                if (Schema::hasColumn('products', $column)) {
                    try {
                        $table->dropColumn($column);
                    } catch (\Exception $e) {
                        // Skip if column can't be dropped
                        continue;
                    }
                }
            }
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Drop foreign key constraints if they exist
            $this->dropForeignIfExists($table, 'products_category_id_foreign');
            $this->dropForeignIfExists($table, 'products_brand_id_foreign');

            // Revert column changes
            $columnsToRevert = [
                'model_name',
                'type',
                'capacity_kw',
                'size',
                'warranty',
                'technical_details'
            ];

            foreach ($columnsToRevert as $column) {
                if (Schema::hasColumn('products', $column)) {
                    try {
                        $table->dropColumn($column);
                    } catch (\Exception $e) {
                        continue;
                    }
                }
            }

            // Revert name change
            if (Schema::hasColumn('products', 'product_name')) {
                $table->renameColumn('product_name', 'name');
            }

            // Re-add dropped columns
            if (!Schema::hasColumn('products', 'company_id')) {
                $table->foreignId('company_id')->nullable()->constrained('companies')->cascadeOnDelete();
            }
            if (!Schema::hasColumn('products', 'model_number')) $table->string('model_number')->nullable();
            if (!Schema::hasColumn('products', 'variant')) $table->string('variant')->nullable();
            if (!Schema::hasColumn('products', 'wattage_or_capacity')) $table->string('wattage_or_capacity')->nullable();
            if (!Schema::hasColumn('products', 'technology')) $table->string('technology')->nullable();
            if (!Schema::hasColumn('products', 'efficiency')) $table->decimal('efficiency', 5, 2)->nullable();
            if (!Schema::hasColumn('products', 'warranty_years')) $table->unsignedInteger('warranty_years')->nullable();
            if (!Schema::hasColumn('products', 'datasheet_url')) $table->string('datasheet_url')->nullable();
            if (!Schema::hasColumn('products', 'msrp')) $table->decimal('msrp', 10, 2)->nullable();
            if (!Schema::hasColumn('products', 'specs')) $table->json('specs')->nullable();
            if (!Schema::hasColumn('products', 'is_active')) $table->boolean('is_active')->default(true);
        });
    }

    /**
     * Helper method to safely drop foreign key if it exists
     */
    private function dropForeignIfExists(Blueprint $table, string $constraintName): void
    {
        $connection = Schema::getConnection();
        $dbName = $connection->getDatabaseName();
        
        $constraint = $connection->selectOne("
            SELECT * FROM information_schema.TABLE_CONSTRAINTS 
            WHERE CONSTRAINT_SCHEMA = ? 
            AND TABLE_NAME = ? 
            AND CONSTRAINT_NAME = ? 
            AND CONSTRAINT_TYPE = 'FOREIGN KEY'
        ", [$dbName, 'products', $constraintName]);

        if ($constraint) {
            $table->dropForeign($constraintName);
        }
    }
};