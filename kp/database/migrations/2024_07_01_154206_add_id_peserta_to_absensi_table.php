<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdPesertaToAbsensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('absensi', function (Blueprint $table) {
            $table->unsignedBigInteger('id_peserta')->default(0);
            $table->foreign('id_peserta')->references('id')->on('users');
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
            $table->dropForeign(['id_peserta']);
            $table->dropColumn('id_peserta');
        });
    }
}
