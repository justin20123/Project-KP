<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelatihanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelatihan', function (Blueprint $table) {
            $table->id();
            $table->string("nama",45);

            $table->unsignedBigInteger('pengajar_id');
            $table->foreign('pengajar_id')->references('id')->on('pengajar');

            $table->string("jadwal_pelatihan",20);
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
            //
            $table->dropForeign(['pengajar_id']);

            //Hapus kolom
            $table->dropColumn('pengajar_id');
        });
        Schema::dropIfExists('pelatihan');
    }
}
