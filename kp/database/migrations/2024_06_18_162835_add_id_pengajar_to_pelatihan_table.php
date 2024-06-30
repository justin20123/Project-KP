<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdPengajarToPelatihanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pelatihan', function (Blueprint $table) {
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
        Schema::table('pelatihan', function (Blueprint $table) {
            $table->dropForeign(['id_pengajar']);
            $table->dropColumn('id_pengajar');
        });
    }
}
