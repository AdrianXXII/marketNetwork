<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_members', function (Blueprint $table) {
            $table->integer('market_id')->unsigned();
            $table->integer('member_id')->unsigned();

            $table->foreign('market_id')->references('id')->on('markets');
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
        Schema::table('market_members', function($table){
            $table->dropForeign(['market_id']);
            $table->dropForeign(['member_id']);
        });
        Schema::dropIfExists('market_members');
    }
}
