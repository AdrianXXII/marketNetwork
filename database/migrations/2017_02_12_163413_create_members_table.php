<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30);
            $table->string('firstname', 30)->nullable();
            $table->string('street', 50)->nullable();
            $table->string('city', 30)->nullable();
            $table->string('zip', 10)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('tel', 15)->nullable();
            $table->boolean('vendor')->default(false);
            $table->boolean('trialperiode')->nullable();
            $table->timestamp('abo_start')->nullable();
            $table->integer('abo_id', false, true)->nullable();

            $table->foreign('abo_id')->references('id')->on('abos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function($table){
            $table->dropForeign(['abo_id']);
        });
        Schema::dropIfExists('members');
    }
}
