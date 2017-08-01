<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('citation_id')->unsigned();
            $table->string('type');
            $table->string('format');
            $table->string('identifier');
            $table->string('references');
            $table->string('title');
            $table->string('description');
            $table->string('audience');
            $table->timestamp('created')->nullable();
            $table->string('creator');
            $table->string('contributor')->nullable();
            $table->string('publisher');
            $table->string('license');
            $table->string('rights_holder');
            $table->foreign('citation_id')->references('id')->on('citations')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('medias', function (Blueprint $table) {
            $table->dropForeign('medias_citation_id_foreign');
        });
        Schema::dropIfExists('medias');
    }
}
