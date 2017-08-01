<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExternalLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('external_links', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('taxonomy_id')->unsigned();
            $table->string('provider_name');
            $table->string('provider_abbr')->nullable();
            $table->string('url');
            $table->string('subject')->nullable();
            $table->string('category')->nullable();
            $table->string('attribute')->nullable();
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
        Schema::table('external_links', function (Blueprint $table) {
            $table->dropForeign('external_links_taxonomy_id_foreign');
        });
        Schema::dropIfExists('external_links');
    }
}
