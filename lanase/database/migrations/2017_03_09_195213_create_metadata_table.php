<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetadataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metadata', function (Blueprint $table) {
            $table->increments('id');
            $table->string('creator');
            $table->string('title');
            $table->string('publisher');
            $table->string('publication_status_year');
            $table->string('subject');
            $table->string('contributor');
            $table->date('date');
            $table->string('language');
            $table->string('resource_type');
            $table->string('alternate_identifier')->nullable();
            $table->string('related_identifier');
            $table->decimal('size')->nullable();
            $table->string('format')->nullable();
            $table->string('version')->nullable();
            $table->string('rights');
            $table->string('description');
            $table->string('geolocation')->nullable();
            $table->date('input_date');
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
        Schema::dropIfExists('metadata');
    }
}
