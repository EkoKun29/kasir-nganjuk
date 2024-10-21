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
        Schema::create('detail_retur_pembelian_nas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('retur_pembelian_na_id')->constrained('retur_pembelian_nas');
            $table->string('nama_barang');
            $table->string('no_lot');
            $table->string('nama_barang_dan_no_lot');
            $table->integer('harga');
            $table->integer('qty');
            $table->integer('retur_ngurang_hutang');
            $table->integer('retur_minta_cash');
            $table->integer('sub_total');
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
        Schema::dropIfExists('detail_retur_pembelian_nas');
    }
};
