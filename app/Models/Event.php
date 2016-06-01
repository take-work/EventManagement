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
      $events = DB::table('events')->paginate(10);
    } else {
      $events = Event::where('id', $id)->get();
    }

    return $events;
  }

  public function insert($inputs) {
    $now = date("Y-m-d");

    list ($startDay, $endDay) = $this->connectDate($inputs);

    DB::table('events')
      ->insert([
        'name'       => $inputs['eventName'],
        'host'       => $inputs['host'],
        'price'      => $inputs['price'],
        'startDay'   => $startDay,
        'endDay'     => $endDay,
        'created_at' => $now,
        'updated_at' => $now
      ]);

    return true;
  }

  public function updateData($inputs) {
    $now = date("Y-m-d");

    list ($startDay, $endDay) = $this->connectDate($inputs);

    DB::table('events')
      ->where('id', $inputs['id'])
      ->update([
        'name'       => $inputs['eventName'],
        'host'       => $inputs['host'],
        'price'      => $inputs['price'],
        'startDay'   => $startDay,
        'endDay'     => $endDay,
        'updated_at' => $now
      ]);

    return true;
  }

  public function deleteData($id) {
    DB::delete('delete from events where id = '. $id);

    return true;
  }

  public function connectDate($inputs) {
    $start = $inputs['startDay'];
    $end   = $inputs['endDay'];

    $startYear  = mb_substr($start, 0, 4);
    $startMonth = mb_substr($start, 4, 2);
    $startDays  = mb_substr($start, 6, 2);

    $endYear  = mb_substr($end, 0, 4);
    $endMonth = mb_substr($end, 4, 2);
    $endDays  = mb_substr($end, 6, 2);

    $startDay = $startYear .'/'. $startMonth .'/'. $startDays;
    $endDay   = $endYear .'/'. $endMonth .'/'. $endDays;

    return array($startDay, $endDay);
  }

}
