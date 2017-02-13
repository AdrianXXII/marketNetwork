<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('markets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("location_id")->unsigned();
            $table->string("name", 30);
            $table->timestamp("start_date")->nullable();
            $table->timestamp("end_date")->nullable();
            $table->boolean("available");

            $table->foreign('location_id')->references('id')->on('locations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('markets', function($table){
            $table->dropForeign(['location_id']);
        });
        Schema::dropIfExists('markets');
    }
}
