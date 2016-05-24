<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Staff extends Model {
  /**
   * スタッフと関連しているテーブル
   *
   * @var string
   */
  protected $table = 'staffs';

  public function insert($inputs) {
    $now = date("Y-m-d");

    DB::table('staffs')->insert([
      'event_id' => $inputs['id'],
      'name' => $inputs['name'],
      'position' => $inputs['position'],
      'mail' => $inputs['mail'],
      'tel' => $inputs['tel'],
      'twitter' => $inputs['twitter'],
      'experience' => $inputs['experience'],
      'rank' => $inputs['rank'],
      'updated_at' => $now,
      'created_at' => $now
    ]);

  return true;
  }

  public function count($id) {
    $counter = DB::select('select * from staffs where event_id ='. $id);
    $count = $counter->num_rows;

    return $count;
  }
}
