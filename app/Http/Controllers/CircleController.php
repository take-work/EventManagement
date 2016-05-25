<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use App\Models\Circle;

class CircleController extends Controller {
  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Request $request, $id) {
    $circles = DB::select('select * from circles where event_id ='.$id);

    return view('circle.list', compact('circles', 'id'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request, $id) {
    return view('circle.create', compact('id'));
  }

  public function insert() {
    $inputs = \Request::all();
    $inserts = new Circle();
    $inserts->insert($inputs);

    return "登録しました。";
  }

  public function updateConfirm(Request $request, $id) {
    $circles = DB::select('select * from circles where id ='.$id);

    return view('circle.update', compact('circles'));
  }

  public function update() {
    $inputs = \Request::all();
    $circle = new Circle();

    $circle->updateData($inputs);

    return "更新しました。";
  }

}
