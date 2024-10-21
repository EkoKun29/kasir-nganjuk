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
        Schema::create('bank_ke_ttbs', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal');
            $table->string('dari_bank');
            $table->string('nominal');
            $table->string('ke_akun')->default('TTB');
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
        Schema::dropIfExists('bank_ke_ttbs');
    }
};
