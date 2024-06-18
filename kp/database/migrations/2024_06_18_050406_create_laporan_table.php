<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->unsignedBigInteger('peserta_nomor');
            $table->foreign('peserta_nomor')->references('nomor')->on('peserta');
            $table->unsignedBigInteger('idpelatihan');
            $table->foreign('idpelatihan')->references('id')->on('pelatihan');

            $table->integer('nilai')->default(0);
            $table->string('evaluasi', 200);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('laporan', function (Blueprint $table) {
            //
            $table->dropForeign(['idpelatihan']);
            $table->dropColumn('idpelatihan');
            $table->dropForeign(['peserta_nomor']);
            $table->dropColumn('peserta_nomor');
        });
        Schema::dropIfExists('laporan');
    }
}
