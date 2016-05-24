<?php

namespace App\Events;

use Illuminate\Database\Eloquent\Model;
use DB;

class Event extends Model
{
  /**
   * イベントと関連しているテーブル
   *
   * @var string
   */
  protected $table = 'events';

  public function insert($inputs) {
    $startDay = $inputs['startYear'] .'/'.$inputs['startMonth'].'/'.$inputs['startDay'];
    $endDay = $inputs['endYear'] .'/'.$inputs['endMonth'].'/'.$inputs['endDay'];

    $now = date("Y-m-d");

    DB::table('events')->insert([
      'name' => $inputs['eventName'],
      'host' => $inputs['host'],
      'price' => $inputs['price'],
      'startDay' => $startDay,
      'endDay' => $endDay,
      'updated_at' => $now,
      'created_at' => $now
    ]);

    return true;
  }
}
