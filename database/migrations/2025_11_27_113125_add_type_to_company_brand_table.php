<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/[timestamp]_add_type_to_company_brand_table.php
    public function up()
    {
        Schema::table('company_brand', function (Blueprint $table) {
            $table->enum('type', [
                'manufacturer',
                'authorized_dealer',
                'distributor'
            ])->default('distributor')->after('brand_id');
        });
    }

    public function down()
    {
        Schema::table('company_brand', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
