<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAbsensiIdpelatihanToKehadiranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kehadiran', function (Blueprint $table) {
            $table->unsignedBigInteger('absensi_idpelatihan');
            $table->foreign('absensi_idpelatihan')->references('idpelatihan')->on('absensi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kehadiran', function (Blueprint $table) {
            $table->dropForeign(['absensi_idpelatihan']);
            $table->dropColumn('absensi_idpelatihan');
        });
    }
}
