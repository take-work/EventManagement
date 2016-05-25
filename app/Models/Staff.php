<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query;
use DB;

class Staff extends Model {
  /**
   * スタッフと関連しているテーブル
   *
   * @var string
   */
  protected $table = 'staffs';

  public function count($eventId) {
    $counter = DB::table('staffs')
                 ->select(DB::raw('count(*) as counter'))
                 ->where('event_id', $eventId)
                 ->get();

    return $counter;
  }

  public function insert($inputs) {
    $now = date("Y-m-d");

    DB::table('staffs')
      ->insert([
        'event_id'   => $inputs['id'],
        'name'       => $inputs['name'],
        'position'   => $inputs['position'],
        'mail'       => $inputs['mail'],
        'tel'        => $inputs['tel'],
        'twitter'    => $inputs['twitter'],
        'experience' => $inputs['experience'],
        'rank'       => $inputs['rank'],
        'updated_at' => $now,
        'created_at' => $now
      ]);

  return true;
  }

  public function updateData($inputs) {
    $now = date("Y-m-d");

    DB::table('staffs')
      ->where('id', $inputs['id'])
      ->update([
        'name'       => $inputs['name'],
        'position'   => $inputs['position'],
        'mail'       => $inputs['mail'],
        'tel'        => $inputs['tel'],
        'experience' => $inputs['experience'],
        'rank'       => $inputs['rank'],
        'updated_at' => $now
      ]);

    return true;
  }

  public function deleteData($id) {
    DB::delete('delete from staffs where id = '. $id);

    return true;
  }

}
