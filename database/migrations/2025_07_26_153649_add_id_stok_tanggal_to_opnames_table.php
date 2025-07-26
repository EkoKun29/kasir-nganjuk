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
        Schema::table('opnames', function (Blueprint $table) {
            $table->integer('id_stok')->nullable()->index();
            $table->integer('id_stok_tanggal')->nullable()->index();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('opnames', function (Blueprint $table) {
            $table->dropColumn('id_stok','id_stok_tanggal');
            
        });
    }
};
