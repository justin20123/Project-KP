<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrangTuaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orang_tua', function (Blueprint $table) {
            $table->id();
            $table->string('nama',45);
            $table->unsignedBigInteger('peserta_nomor');
            $table->foreign('peserta_nomor')->references('nomor')->on('peserta');
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
            //
            $table->dropForeign(['peserta_nomor']);

            //Hapus kolom
            $table->dropColumn('peserta_nomor');
        });
        Schema::dropIfExists('orang_tua');
    }
}
