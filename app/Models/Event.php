<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Event extends Model {
  /**
   * イベントと関連しているテーブル
   *
   * @var string
   */
  protected $table = 'events';

  public function select($id = 0) {
    if ($id == 0) {
      $events = DB::select('select * from events');
    } else {
      $events = DB::select('select * from events where id ='.$id);
    }

    return $events;
  }

  public function insert($inputs) {
    $startDay = $inputs['startYear'] .'/'.$inputs['startMonth'].'/'.$inputs['startDay'];
    $endDay = $inputs['endYear'] .'/'.$inputs['endMonth'].'/'.$inputs['endDay'];

    $now = date("Y-m-d");

    DB::table('events')
      ->insert([
        'name' => $inputs['eventName'],
        'host' => $inputs['host'],
        'price' => $inputs['price'],
        'startDay' => $startDay,
        'endDay' => $endDay,
        'created_at' => $now,
        'updated_at' => $now
      ]);

    return true;
  }

  public function updateData($inputs) {
    $now = date("Y-m-d");

    DB::table('events')
      ->where('id', $inputs['id'])
      ->update([
        'name' => $inputs['eventName'],
        'host' => $inputs['host'],
        'price' => $inputs['price'],
        'startDay' => $inputs['startDay'],
        'endDay' => $inputs['endDay'],
        'updated_at' => $now
      ]);

    return true;
  }
}
