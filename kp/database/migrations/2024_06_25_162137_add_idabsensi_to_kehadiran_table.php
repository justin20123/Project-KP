<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdabsensiToKehadiranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kehadiran', function (Blueprint $table) {
            $table->unsignedBigInteger('idabsensi');
            $table->foreign('idabsensi')->references('id')->on('absensi');
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
            $table->dropForeign(['idabsensi']);
            $table->dropColumn('idabsensi');
        });
    }
}
