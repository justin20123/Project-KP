<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNomorPesertaToKelasDiikutiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kelas_diikuti', function (Blueprint $table) {
            $table->string('nomor_peserta',8);
            $table->foreign('nomor_peserta')->references('nomor')->on('users');
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
            $table->dropForeign(['nomor_peserta']);
            $table->dropColumn('nomor_peserta');
        });
    }
}
