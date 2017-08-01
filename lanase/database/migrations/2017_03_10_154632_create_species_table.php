<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpeciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('species', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('taxonomy_id')->unsigned();
            $table->boolean('marine')->nullable();
            $table->boolean('terrestrial')->nullable();
            $table->boolean('extinct')->nullable();
            $table->boolean('hybrid')->nullable();
            $table->string('living_period')->nullable();
            $table->integer('age_in_days')->nullable();
            $table->decimal('size_in_mm')->nullable();
            $table->decimal('mass_in_gram')->nullable();
            $table->string('habitat')->nullable();
            $table->boolean('freshwater')->nullable();
            $table->foreign('taxonomy_id')->references('id')->on('taxonomic_classifications')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('species', function (Blueprint $table) {
            $table->dropForeign('species_citation_id_foreign');
        });
        Schema::dropIfExists('species');
    }
}
