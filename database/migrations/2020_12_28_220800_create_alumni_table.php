<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni', function (Blueprint $table) {
            $table->id();
            $table->string('no_induk');
            $table->string('nama');
            $table->string('foto')->nullable();
            $table->string('jk');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->text('alamat');
            $table->string('sekolah_ke');
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
        Schema::dropIfExists('alumni');
    }
}
