<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Money extends Model {

  public function insert($inputs) {
    $now = date("Y-m-d");

    DB::table('money')->insert([
      'event_id'      => $inputs['id'],
      'hundred'       => $inputs['hundred'],
      'five_hundred'  => $inputs['five_hundred'],
      'thousand'      => $inputs['thousand'],
      'five_thousand' => $inputs['five_thousand'],
      'million'       => $inputs['million'],
      'created_at'    => $now,
      'updated_at'    => $now
    ]);

    return true;
  }
}
