<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdjadwalpelatihanToLaporanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('laporan', function (Blueprint $table) {
            $table->unsignedBigInteger('idjadwalpelatihan');
            $table->foreign('idjadwalpelatihan')->references('id')->on('jadwal_pelatihan');
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
            $table->dropForeign(['idjadwalpelatihan']);
            $table->dropColumn('idjadwalpelatihan');
        });
    }
}
