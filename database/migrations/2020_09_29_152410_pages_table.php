<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('parent')->default(0);
            $table->string('slug', 50);
            $table->integer('position');
            $table->timestamps();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->index(['slug', 'created_by', 'updated_by']);

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

        Schema::create('c_pages_lang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('page_id')->index();
            $table->string('title');
            $table->text('content')->nullable();

            $table->foreign('page_id')
                ->references('id')
                ->on('c_pages')
                ->onDelete('cascade')
                ->onUpdate('no action');
        });

        Schema::create('c_pages_media', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('page_id')->index();
            $table->integer('position');

            $table->foreign('page_id')
                ->references('id')
                ->on('c_pages')
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
        Schema::dropIfExists('c_pages');
        Schema::dropIfExists('c_pages_lang');
        Schema::dropIfExists('c_pages_media');
    }
}
