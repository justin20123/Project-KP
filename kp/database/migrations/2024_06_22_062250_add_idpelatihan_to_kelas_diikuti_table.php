<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdpelatihanToKelasDiikutiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kelas_diikuti', function (Blueprint $table) {
            $table->unsignedBigInteger('idpelatihan');
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
        Schema::table('kelas_diikuti', function (Blueprint $table) {
            $table->dropForeign(['idpelatihan']);
            $table->dropColumn('idpelatihan');
        });
    }
}
