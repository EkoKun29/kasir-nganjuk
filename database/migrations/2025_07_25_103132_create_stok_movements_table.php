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
        Schema::create('stok_movements', function (Blueprint $table) {
            $table->id();
            $table->integer('id_stok')->nullable()->index();
            $table->integer('id_stok_tanggal')->nullable()->index();
            $table->datetime('tanggal')->nullable();
            $table->string('tipe')->nullable()->index();
            $table->integer('dus')->nullable();
            $table->integer('btl')->nullable();
            $table->integer('total')->nullable();
            $table->integer('id_transaksi')->nullable();

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
        Schema::dropIfExists('stok_movements');
    }
};
