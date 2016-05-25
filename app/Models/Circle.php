<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Circle extends Model {

  public function insert($inputs) {
    $now = date("Y-m-d");

    DB::table('circles')->insert([
      'event_id'    => $inputs['id'],
      'number'      => $inputs['number'],
      'space'       => $inputs['space'],
      'circle_name' => $inputs['name'],
      'host'        => $inputs['host'],
      'staff'       => $inputs['staff'],
      'desk'        => $inputs['desk'],
      'chair'       => $inputs['chair'],
      'created_at'  => $now,
      'updated_at'  => $now
    ]);

    return true;
  }

  public function count($eventId) {
    $counter = DB::table('circles')
                 ->select(DB::raw('count(*) as counter'))
                 ->where('event_id', $eventId)
                 ->get();
  
    return $counter;
  }

}
