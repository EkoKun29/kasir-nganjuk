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
        Schema::create('penjualan_piutangs', function (Blueprint $table) {
            $table->id();
            $table->string('no_nota')->nullable()->unique();
            $table->string('toko');
            $table->string('nama_konsumen');
            $table->integer('total'); // TOTAL PIUTANG
            $table->integer('sisa')->default(0); // SISA PIUTANG
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
        Schema::dropIfExists('penjualan_piutangs');
    }
};
