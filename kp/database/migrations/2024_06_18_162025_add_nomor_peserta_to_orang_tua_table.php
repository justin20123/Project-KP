<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNomorPesertaToOrangTuaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orang_tua', function (Blueprint $table) {
            $table->string('peserta_nomor',8);
            $table->foreign('peserta_nomor')->references('nomor')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orang_tua', function (Blueprint $table) {
            $table->dropForeign(['peserta_nomor']);
            $table->dropColumn('peserta_nomor');
        });
    }
}
