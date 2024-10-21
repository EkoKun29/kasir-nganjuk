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
        Schema::table('pembayaran_piutang_returs', function (Blueprint $table) {
            $table->string('tgl_bayar')->nullable()->after('tgl_nota_piutang');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pembayaran_piutang_returs', function (Blueprint $table) {
            $table->dropColumn('tgl_bayar');
            
        });
    }
};
