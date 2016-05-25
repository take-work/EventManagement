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

  public function totalMpney($id) {
    $money = DB::select('select * from money where event_id ='.$id);

    if (!empty($money)) {
      foreach ($money as $coin) {
        $hundred       = $coin->hundred * 100;
        $five_hundred  = $coin->five_hundred * 500;
        $thousand      = $coin->thousand * 1000;
        $five_thousand = $coin->five_thousand * 5000;
        $million       = $coin->million * 10000;
      }

      $total = $hundred + $five_hundred + $thousand + $five_thousand + $million;
    } else {
      $total = null;
    }

    return $total;
  }

  public function updateData($inputs) {
    $now = date("Y-m-d");

    DB::table('money')
      ->where('id', $inputs['id'])
      ->update([
        'hundred'       => $inputs['hundred'],
        'five_hundred'  => $inputs['five_hundred'],
        'thousand'      => $inputs['thousand'],
        'five_thousand' => $inputs['five_thousand'],
        'million'       => $inputs['million'],
        'updated_at'    => $now
      ]);

    return true;
  }

  public function calculater($totalMoney = 0, $price = 0) {
    $moneyCalc = $totalMoney - $price;

    return $moneyCalc;
  }
}
