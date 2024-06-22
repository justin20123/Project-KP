<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('nomor', 8)->unique()->primary();
            $table->string('password', 225);
            $table->string('nama', 30);
            $table->string('alamat', 45);
            $table->string('email', 30)->unique();
            $table->integer('umur')->default(0);
            $table->date('tanggal_lahir');
            $table->enum('role', ["peserta", "pengajar", "admin"])->default("peserta");
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
        Schema::dropIfExists('users');
    }
}