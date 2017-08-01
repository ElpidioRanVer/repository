<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVernacularNameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vernacular_name', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('taxonomy_id')->unsigned();
            $table->string('name');
            $table->char('language', 3)->nullable();
            $table->boolean('preferred')->nullable();
            $table->boolean('sex')->nullable();
            $table->string('life_stage')->nullable();
            $table->string('area')->nullable();
            $table->char('country',2)->nullable();
            $table->boolean('plural')->nullable();
            $table->timestamps();
            $table->foreign('taxonomy_id')->references('id')->on('taxonomic_classifications')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vernacular_name', function (Blueprint $table) {
            $table->dropForeign('vernacular_name_taxonomy_id_foreign');
        });
        Schema::dropIfExists('vernacular_name');
    }
}
