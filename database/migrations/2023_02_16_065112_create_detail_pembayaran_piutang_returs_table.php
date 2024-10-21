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
        Schema::create('detail_pembayaran_piutang_returs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('piutang_retur_id')->constrained('pembayaran_piutang_returs');
            $table->string('nama_barang');
            $table->string('no_lot');
            $table->string('nama_barang_dan_no_lot');
            $table->integer('harga');
            $table->integer('qty');
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
        Schema::dropIfExists('detail_pembayaran_piutang_returs');
    }
};
