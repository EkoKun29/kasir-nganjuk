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
        Schema::create('barter_piutangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_konsumen');
            $table->string('nama_barang');
            $table->string('no_lot');
            $table->string('nama_barang_dan_no_lot')->nullable();
            $table->integer('harga');
            $table->integer('qty');
            $table->integer('sub_total')->default(0);
            $table->integer('piutang');
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
        Schema::dropIfExists('barter_piutangs');
    }
};
