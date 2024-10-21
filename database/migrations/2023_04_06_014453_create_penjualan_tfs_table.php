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
        Schema::create('penjualan_tfs', function (Blueprint $table) {
            $table->id();
            $table->string('toko');
            $table->string('nama_konsumen');
            $table->string('bank');
            $table->integer('total');
            $table->integer('tf');
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
        Schema::dropIfExists('penjualan_tfs');
    }
};
