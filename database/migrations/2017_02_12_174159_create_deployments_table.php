<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeploymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deployments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',30);
            $table->string('employee',50)->nullable();
            $table->text('description')->nullable();
            $table->timestamp("deployment_date")->nullable();
            $table->timestamp("deployment_end")->nullable();
            $table->decimal("duration",10,2)->nullable();
            $table->decimal("cost",10,2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deployments');
    }
}
