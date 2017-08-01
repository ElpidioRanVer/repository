<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecimensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specimens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dataset_id')->unsigned();
            $table->integer('taxonomy_id')->unsigned();
            $table->integer('media_id')->unsigned();
            $table->integer('literature_id')->unsigned();
            $table->integer('metadata_id')->unsigned();
            $table->integer('identifier_id')->unsigned();
            $table->integer('collection_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('family', 45);
            $table->string('genus', 45);
            $table->foreign('dataset_id')->references('id')->on('datasets')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('taxonomy_id')->references('id')->on('taxonomic_classifications')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('media_id')->references('id')->on('medias')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('literature_id')->references('id')->on('literatures')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('metadata_id')->references('id')->on('metadata')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('identifier_id')->references('id')->on('identifiers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('collection_id')->references('id')->on('collections')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('specimens', function (Blueprint $table) {
            $table->dropForeign('specimens_dataset_id_foreign');
            $table->dropForeign('specimens_taxonomy_id_foreign');
            $table->dropForeign('specimens_media_id_foreign');
            $table->dropForeign('specimens_literature_id_foreign');
            $table->dropForeign('specimens_metadata_id_foreign');
            $table->dropForeign('specimens_identifier_id_foreign');
            $table->dropForeign('specimens_collection_id_foreign');
            $table->dropForeign('specimens_user_id_foreign');
        });
        Schema::dropIfExists('specimens');
    }
}
