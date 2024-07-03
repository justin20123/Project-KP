<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdPengajarToJadwalpelatihanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jadwal_pelatihan', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pengajar')->default(0);
            $table->foreign('id_pengajar')->references('id')->on('users');
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
            $table->dropForeign(['id_pengajar']);
            $table->dropColumn('id_pengajar');
        });
    }
}
