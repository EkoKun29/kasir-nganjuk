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
        Schema::create('pembelian_nas', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('no_nota');
            $table->string('atas_nama_sales');
            $table->string('yang_bawa_barang');
            $table->string('nama_suplier');
            $table->string('nama_barang');
            $table->string('no_lot');
            $table->string('nama_barang_dan_no_lot')->nullable();
            $table->integer('qty');
            $table->integer('tunai')->default(0);
            $table->integer('hutang')->default(0);
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
        Schema::dropIfExists('pembelian_nas');
    }
};
