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
            $table->id();
            $table->string('password', 225);
            $table->string('nama', 30);
            $table->string('alamat', 45);
            $table->string('email', 20)->unique();
            $table->integer('umur')->default(0)->nullable();
            $table->enum('role', ["orang_tua", "pengajar", "admin"])->default("orang_tua");
            $table->tinyInteger('status');
            $table->dateTime('last_login')->nullable();
            $table->timestamps();
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
