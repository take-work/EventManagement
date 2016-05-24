<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Money extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('money', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('event_id');
      $table->integer('hundred');
      $table->integer('five_hundred');
      $table->integer('thousand');
      $table->integer('five_thousand');
      $table->integer('million');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('money');
  }
}
