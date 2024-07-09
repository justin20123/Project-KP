<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdPeriodeToJadwalKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jadwal_kelas', function (Blueprint $table) {
            $table->unsignedBigInteger('idperiode')->default(0);
            $table->foreign('idperiode')->references('id')->on('periode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jadwal_kelas', function (Blueprint $table) {
            $table->dropForeign(['idperiode']);
            $table->dropColumn('idperiode');
        });
    }
}
