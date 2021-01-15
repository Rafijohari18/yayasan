<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('no_induk');
            $table->string('nisn');
            $table->string('nama');
            $table->string('jk');
            $table->string('foto')->nullable();
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->text('umur');
            $table->string('agama');
            $table->text('alamat')->nullable();
            $table->string('nama_ortu');
            $table->string('pendidikan_ortu');
            $table->text('alamat_ortu')->nullable();
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('siswa');
    }
}
