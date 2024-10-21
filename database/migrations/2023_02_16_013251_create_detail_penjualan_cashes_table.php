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
        Schema::create('detail_penjualan_cashes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penjualan_cash_id')->constrained('penjualan_cashes');
            $table->string('nama_barang_dan_no_lot');
            $table->integer('harga');
            $table->integer('qty');
            $table->integer('sub_total');
            $table->integer('diskon');
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
        Schema::dropIfExists('detail_penjualan_cashes');
    }
};
