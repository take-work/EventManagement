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

    $eventName = DB::select('select * from events where id ='.$inputs['id']);

    $inserts->insert($inputs);

    \Session::flash('flash_message', $eventName[0]->name .'の金額情報を新規登録しました。');
    return redirect('/list');
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

    $moneyId = DB::select('select * from money where id ='.$inputs['id']);
    $eventId = $moneyId[0]->event_id;

    $eventName = DB::select('select * from events where id ='.$eventId);

    $money->updateData($inputs);

    \Session::flash('flash_message', $eventName[0]->name .'の金額情報を更新しました。');
    return redirect('/list');
  }
}
