<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solar_enquiries', function (Blueprint $table) {
            $table->unsignedDecimal('capacity')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solar_enquiries', function (Blueprint $table) {
            $table->unsignedDecimal('capacity')->nullable(false)->change();
        });
    }
};
