<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdpelatihanToJadwalPelatihanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jadwal_pelatihan', function (Blueprint $table) {
            $table->unsignedBigInteger('idpelatihan')->default(0);
            $table->foreign('idpelatihan')->references('id')->on('pelatihan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jadwal_pelatihan', function (Blueprint $table) {
            $table->dropForeign(['idpelatihan']);
            $table->dropColumn('idpelatihan');
        });
    }
}
