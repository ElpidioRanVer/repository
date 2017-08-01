<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicationStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publication_status', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('specimen_id')->unsigned();
            $table->boolean('pub_status');
            $table->date('pub_date');
            $table->foreign('specimen_id')->references('id')->on('specimens')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('publication_status', function (Blueprint $table) {
            $table->dropForeign('publication_status_specimen_id_foreign');
        });
        Schema::dropIfExists('publication_status');
    }
}
