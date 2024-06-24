<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor_angkatan')->default(0); 
            $table->integer('nomor_pertemuan')->default(0);
            $table->enum('status', ["dibuka", "ditutup"]);
            $table->enum('jenis_pertemuan', ["pengganti", "reguler"]);
            $table->string("tanggal_absensi",10);

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absensi');
    }
}
