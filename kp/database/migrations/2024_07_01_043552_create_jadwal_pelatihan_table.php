<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalPelatihanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_pelatihan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_start');
            $table->enum('jenis_pelatihan', ['kelompok','private']);
            $table->enum('status', ['berjalan','selesai']);
            $table->string('jadwal',20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal_pelatihan');
    }
}
