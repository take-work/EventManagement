<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Staffs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
      Schema::create('staffs', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('event_id');
        $table->string('name');
        $table->string('position');
        $table->string('mail');
        $table->string('tel');
        $table->string('twitter');
        $table->integer('experience');
        $table->integer('rank');
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
      Schema::drop('staffs');
    }
}
