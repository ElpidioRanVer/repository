<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxonomicClassificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxonomic_classifications', function (Blueprint $table) {
            $table->integer('id')->unsigned()->unique()->primary();
            $table->string('scientific_name');
            $table->string('canonic_name')->nullable();
            $table->string('infra_generic')->nullable();
            $table->string('infra_epiteto_specific')->nullable();
            $table->string('rank_marker')->nullable();
            $table->timestamp('modified')->nullable();
            $table->integer('specific_epithet')->nullable();
            $table->string('superkingdom')->nullable();
            $table->string('kingdom')->nullable();
            $table->string('phylum')->nullable();
            $table->string('subphylum')->nullable();
            $table->string('superclass')->nullable();
            $table->string('class')->nullable();
            $table->string('subclass')->nullable();
            $table->string('infraclass')->nullable();
            $table->string('superorder')->nullable();
            $table->string('order')->nullable();
            $table->string('suborder')->nullable();
            $table->string('infraorder')->nullable();
            $table->string('parvorder')->nullable();
            $table->string('superfamily')->nullable();
            $table->string('family')->nullable();
            $table->string('subfamily')->nullable();
            $table->string('tribe')->nullable();
            $table->string('genus');
            $table->string('subgenus')->nullable();
            $table->string('specie')->nullable();
            $table->string('subspecie')->nullable();
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
        Schema::dropIfExists('taxonomic_classifications');
    }
}
