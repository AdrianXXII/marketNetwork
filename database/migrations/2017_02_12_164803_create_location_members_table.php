<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_members', function (Blueprint $table) {
            $table->integer('location_id')->unsigned();
            $table->integer('member_id')->unsigned();

            $table->foreign('location_id')->references('id')->on('locations');
            $table->foreign('member_id')->references('id')->on('members');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('location_members', function($table){
            $table->dropForeign(['location_id']);
            $table->dropForeign(['member_id']);
        });
        Schema::dropIfExists('location_members');
    }
}
