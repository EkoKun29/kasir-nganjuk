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
        Schema::create('retur_penjualans', function (Blueprint $table) {
            $table->id();
            $table->string('toko');
            $table->string('nama_konsumen');
            $table->string('total'); // Jumlah dari Subtotal
            $table->string('uang_keluar');
            $table->string('kembalian'); // Total - Uang keluar
            $table->string('no_nota_piutang');
            $table->string('tgl_nota_piutang');
            $table->string('sisa_piutang');
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
        Schema::dropIfExists('retur_penjualans');
    }
};
