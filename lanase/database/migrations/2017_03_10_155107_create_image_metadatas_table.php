<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageMetadatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_metadatas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('image_id')->unsigned();
            $table->integer('resolution_units')->nullable();
            $table->integer('width')->nullable();
            $table->integer('heigth')->nullable();
            $table->integer('latitude')->nullable();
            $table->integer('longitude')->nullable();
            $table->string('device_name')->nullable();
            $table->date('date')->nullable();
            $table->integer('size');
            $table->string('compress_scheme')->nullable();
            $table->boolean('is_color')->nullable();
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('image_metadatas', function (Blueprint $table) {
            $table->dropForeign('image_metadatas_image_id_foreign');
        });
        Schema::dropIfExists('image_metadatas');
    }
}
