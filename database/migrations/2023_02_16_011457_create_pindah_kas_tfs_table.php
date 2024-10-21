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
        Schema::create('pindah_kas_tfs', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal');
            $table->string('sales');
            $table->string('no_nota');
            $table->string('nominal');
            $table->string('bank');
            $table->string('keterangan');
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
        Schema::dropIfExists('pindah_kas_tfs');
    }
};
