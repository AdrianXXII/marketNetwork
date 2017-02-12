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
            $table->string('firstname', 30);
            $table->string('street', 50);
            $table->string('zip', 30);
            $table->string('tel', 15);
            $table->boolean('ventor');
            $table->boolean('trialperiode');
            $table->timestamp('abo_start');
            $table->timestamp('abo_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
