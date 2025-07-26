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
        Schema::create('stok_tanggals', function (Blueprint $table) {
            $table->id();
            $table->integer('id_stok')->nullable()->index();
            $table->date('tanggal')->nullable()->index();
            $table->integer('in')->nullable();
            $table->integer('pembelian_na')->nullable();
            $table->integer('retur_penjualan')->nullable();
            $table->integer('penjualan')->nullable();
            $table->integer('retur_gudang')->nullable();
            $table->integer('barter')->nullable();
            $table->integer('saldo_akhir')->nullable();

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
        Schema::dropIfExists('stok_tanggals');
    }
};
