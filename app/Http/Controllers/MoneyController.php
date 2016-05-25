<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use App\Models\Money;

class MoneyController extends Controller {
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request, $id) {
    return view('money.create', compact('id'));
  }

  public function insert() {
    $inputs = \Request::all();
    $inserts = new Money();
    $inserts->insert($inputs);

    return "登録しました。";
  }

  public function updateConfirm($id) {
    $moneyList = DB::select('select * from money where event_id ='.$id);

    return view('money.update', compact('moneyList'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {
    $inputs = \Request::all();
    $money = new Money();

    $money->updateData($inputs);

    return "更新しました。";
  }
}
