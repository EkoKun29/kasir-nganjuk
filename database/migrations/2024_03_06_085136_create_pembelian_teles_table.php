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
        if (!Schema::hasTable('pembelian_teles')) {
        Schema::create('pembelian_teles', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('no_nota');
            $table->string('atas_nama_sales')->nullable();
            $table->string('yang_bawa_barang')->nullable();
            $table->string('nama_suplier')->nullable();
            $table->string('nama_barang')->nullable();
            $table->string('no_lot')->nullable();
            $table->string('nama_barang_dan_no_lot')->nullable();
            $table->integer('harga')->nullable();
            $table->integer('qty')->nullable();
            $table->string('cash')->nullable();
            $table->string('hutang')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('pembelian_teles');
    }
};
