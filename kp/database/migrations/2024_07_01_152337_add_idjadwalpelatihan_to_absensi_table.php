<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdjadwalpelatihanToAbsensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('absensi', function (Blueprint $table) {
            $table->unsignedBigInteger('idjadwalpelatihan')->default(0);
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
        Schema::table('absensi', function (Blueprint $table) {
            $table->dropForeign(['idjadwalpelatihan']);
            $table->dropColumn('idjadwalpelatihan');
        });
    }
}
