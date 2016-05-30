<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Circles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
      Schema::create('circles', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('event_id');
        $table->string('number');
        $table->string('space');
        $table->string('circle_name');
        $table->string('host');
        $table->integer('staff');
        $table->integer('desk');
        $table->integer('chair');
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
        Schema::drop('circles');
    }
}
