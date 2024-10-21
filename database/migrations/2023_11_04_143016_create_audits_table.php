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
        Schema::create('audits', function (Blueprint $table) {
            $table->id();
            $table->integer('id_opname_global')->nullable();
            $table->string('nama_barang')->nullable();
            $table->integer('duz')->nullable();
            $table->integer('btl')->nullable();
            $table->integer('total')->nullable(); 
            $table->string('penyetok')->nullable();
            $table->integer('kategori')->nullable();
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
        Schema::dropIfExists('audits');
    }
};
