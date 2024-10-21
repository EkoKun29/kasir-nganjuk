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
        Schema::create('retur_pembelian_nas', function (Blueprint $table) {
            $table->id();
            $table->string('atas_nama_sales');
            $table->string('yang_bawa_barang');
            $table->string('nmr');
            $table->string('tgl_retur');
            $table->string('nama_suplier');
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
        Schema::dropIfExists('retur_pembelian_nas');
    }
};
