<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('specimen_id')->unsigned();
            $table->decimal('latitude');
            $table->decimal('longitude');
            $table->decimal('altitude')->nullable();
            $table->text('site')->nullable();
            $table->date('date')->nullable();
            $table->string('country')->nullable();
            $table->string('region')->nullable();
            $table->string('locality')->nullable();
            $table->string('sub_locality')->nullable();
            $table->timestamps();
            $table->foreign('specimen_id')->references('id')->on('specimens')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('distributions', function (Blueprint $table) {
            $table->dropForeign('distributions_specimen_id_foreign');
        });
        Schema::dropIfExists('distributions');
    }
}
