<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProfilAlumni extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profil_alumni', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('foto');
            $table->string('pekerjaan');
            $table->text('alamat');
            $table->string('angkatan');
            $table->string('moto_hidup');
            $table->string('pesan_kesan');
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
        Schema::dropIfExists('profil_alumni');
    }
}
