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
        Schema::create('detail_retur_pembelian_gudangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('retur_pembelian_gudang_id')->constrained('retur_pembelian_gudangs');
            $table->string('nama_barang');
            $table->string('no_lot');
            $table->string('nama_barang_dan_no_lot');
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
        Schema::dropIfExists('detail_retur_pembelian_gudangs');
    }
};
