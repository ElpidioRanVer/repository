<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSamplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('samples', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('specimen_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('collect_id')->unsigned();
            $table->string('sample_type');
            $table->text('observations')->nullable();
            $table->foreign('specimen_id')->references('id')->on('specimens')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('collect_id')->references('id')->on('collects')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('samples', function (Blueprint $table) {
            $table->dropForeign('samples_specimen_id_foreign');
            $table->dropForeign('samples_user_id_foreign');
            $table->dropForeign('samples_collect_id_foreign');
        });
        Schema::dropIfExists('samples');
    }
}
