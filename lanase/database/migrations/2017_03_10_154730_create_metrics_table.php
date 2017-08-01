<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metrics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dataset_id')->unsigned();
            $table->foreign('dataset_id')->references('id')->on('datasets')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('datasetkey');
            $table->integer('count_usages');
            $table->string('count_by_rank');
            $table->string('count_by_kingdom');
            $table->string('count_by_origin');           
            $table->timestamp('downloaded')->nullable();
            $table->timestamp('created')->nullable();
            $table->boolean('latest');
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
        Schema::table('metrics', function (Blueprint $table) {
            $table->dropForeign('metrics_dataset_id_foreign');
        });
        Schema::dropIfExists('metrics');
    }
}
