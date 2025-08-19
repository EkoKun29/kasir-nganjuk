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
        if (!Schema::hasTable('detail_retur_penjualans')) {
        Schema::table('detail_retur_penjualans', function (Blueprint $table) {
            $table->integer("hpp")->nullable();
        });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_retur_penjualans', function (Blueprint $table) {
            $table->dropColumn('hpp');
        });
    }
};
