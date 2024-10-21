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
        Schema::create('pembayaran_piutang_cashes', function (Blueprint $table) {
            $table->id();
            $table->string('toko');
            $table->string('nama_konsumen');
            $table->string('no_nota_piutang')->unique();
            $table->string('tgl_nota_piutang');
            $table->integer('sisa_piutang')->default(0);
            $table->integer('tunai');
            $table->integer('tf');
            $table->string('bank');
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
        Schema::dropIfExists('pembayaran_piutang_cashes');
    }
};
