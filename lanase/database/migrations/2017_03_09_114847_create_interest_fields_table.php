<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterestFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interest_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('interest_tables_id')->unsigned();
            $table->foreign('interest_tables_id')->references('id')->on('interest_tables')->onDelete('cascade')->onUpdate('cascade');
            $table->string('field_name', 50);
            $table->string('equivalent_name');
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
        Schema::table('interest_fields', function (Blueprint $table) {
            $table->dropForeign('interest_fields_interest_tables_id_foreign');
        });
        Schema::dropIfExists('interest_fields');
    }
}
