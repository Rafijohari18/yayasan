<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuruTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guru', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->string('pendidikan');
            $table->string('foto')->nullable();
            $table->date('tgl_lahir');
            $table->text('pelatihan')->nullable();
            $table->text('prestasi')->nullable();
            $table->text('penghargaan')->nullable();
            $table->string('jabatan');
            $table->string('thn_masuk');
            $table->text('alamat')->nullable();
            $table->string('jk');
            $table->string('agama');
            $table->date('tmt');
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
        Schema::dropIfExists('guru');
    }
}
