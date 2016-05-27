<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Circle extends Model {

  public function count($eventId) {
    $counter = DB::table('circles')
      ->select(DB::raw('count(*) as counter'))
      ->where('event_id', $eventId)
      ->get();

    return $counter;
  }

  public function deskCounter($circles) {
    $first = true;
    $desk = 0;

    foreach ($circles as $circleData) {
      if ($first == true) {
        $desk = $circleData->desk;
        $first = false;
      } elseif($first == false) {
        $desk += $circleData->desk;
      }
    }

    return $desk;
  }

  public function chairCounter($circles) {
    $first = true;
    $chair = 0;

    foreach ($circles as $circleData) {
      if ($first == true) {
        $chair = $circleData->chair;
        $first = false;
      } else {
        $chair += $circleData->chair;
      }
    }

    return $chair;
  }

  public function insert($inputs) {
    $now = date("Y-m-d");

    DB::table('circles')->
      insert([
        'event_id'    => $inputs['id'],
        'number'      => $inputs['number'],
        'space'       => $inputs['space'],
        'circle_name' => $inputs['circleName'],
        'host'        => $inputs['circleLeader'],
        'staff'       => $inputs['staff'],
        'desk'        => $inputs['desk'],
        'chair'       => $inputs['chair'],
        'created_at'  => $now,
        'updated_at'  => $now
      ]);

    return true;
  }

  public function updateData($inputs) {
    $now = date("Y-m-d");

    DB::table('circles')
      ->where('id', $inputs['id'])
      ->update([
        'number'      => $inputs['number'],
        'space'       => $inputs['space'],
        'circle_name' => $inputs['circleName'],
        'host'        => $inputs['circleLeader'],
        'staff'       => $inputs['staff'],
        'desk'        => $inputs['desk'],
        'chair'       => $inputs['chair'],
        'updated_at'  => $now
      ]);

    return true;
  }

  public function deleteData($id) {
    DB::delete('delete from circles where id = '. $id);

    return true;
  }

}
