<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor_pertemuan')->default(0);
            $table->enum('status', ["hadir", "alfa", "sakit", "ijin"]);

            $table->unsignedBigInteger('idpelatihan');
            $table->foreign('idpelatihan')->references('id')->on('pelatihan');

            $table->unsignedBigInteger('nomor_peserta');
            $table->foreign('nomor_peserta')->references('nomor')->on('peserta');

            $table->enum('jenis_pertemuan', ["pengganti", "reguler"]);
            $table->string("hari_pertemuan",10);
            $table->string("waktu_pertemuan",11);
            $table->string("waktu_absensi",45);

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
        Schema::table('absensi', function (Blueprint $table) {
            //
            $table->dropForeign(['idpelatihan']);
            $table->dropColumn('idpelatihan');
            $table->dropForeign(['peserta_nomor']);
            $table->dropColumn('peserta_nomor');
        });
        Schema::dropIfExists('absensi');
    }
}
