<?php

namespace App\Circles;

use Illuminate\Database\Eloquent\Model;
use DB;

class Circle extends Model {
  /**
   * スタッフと関連しているテーブル
   *
   * @var string
   */
  protected $table = 'staffs';

  public function insert($inputs) {
    $now = date("Y-m-d");

    DB::table('circles')->insert([
      'event_id' => $inputs['id'],
      'number' => $inputs['number'],
      'space' => $inputs['space'],
      'circle_name' => $inputs['name'],
      'host' => $inputs['host'],
      'staff' => $inputs['staff'],
      'desk' => $inputs['desk'],
      'chair' => $inputs['chair'],
      'created_at' => $now,
      'updated_at' => $now
    ]);

    return true;
  }
}
