<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_content_id');
            $table->string('title');
            $table->string('slug', 50);
            $table->text('content')->nullable();
            $table->timestamps();

            $table->foreign('category_content_id')->references('id')->on('category_content')
            ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content');
    }
}
