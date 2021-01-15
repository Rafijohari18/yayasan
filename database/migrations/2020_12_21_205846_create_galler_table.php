<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGallerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('g_album', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->text('description')->nullable();
            $table->text('banner')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->index(['created_by', 'updated_by']);

            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('updated_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('no action');
        });

        Schema::create('g_photo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('album_id')->index();
            $table->string('file');    
            $table->timestamps();

            $table->foreign('album_id')
                ->references('id')
                ->on('g_album')
                ->onDelete('cascade')
                ->onUpdate('no action');
        });

        Schema::create('g_playlist', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->text('description')->nullable();
            $table->text('banner')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->index(['created_by', 'updated_by']);

            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('updated_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('no action');
        });

        Schema::create('g_video', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('playlist_id')->index();
            $table->string('file')->nullable();
            $table->string('youtube_id')->nullable();
            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('playlist_id')
                ->references('id')
                ->on('g_playlist')
                ->onDelete('cascade')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('g_album');
        Schema::dropIfExists('g_photo');
        Schema::dropIfExists('g_playlist');
        Schema::dropIfExists('g_video');
    }
}
