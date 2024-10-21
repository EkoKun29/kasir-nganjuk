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
        Schema::create('pindah_stock_outs', function (Blueprint $table) {
            $table->id();
            $table->string('atas_nama_sales');
            $table->string('yang_bawa_barang');
            $table->integer('nmr');
            $table->string('barang_ke');
            $table->string('nama_barang');
            $table->string('no_lot');
            $table->string('nama_barang_dan_no_lot')->nullable();
            $table->integer('qty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pindah_stock_outs');
    }
};
