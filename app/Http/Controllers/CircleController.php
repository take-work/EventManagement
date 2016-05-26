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

    \Session::flash('flash_message', '新サークル「'. $inputs['name'] .'」を新規登録しました。');
    return redirect('/circleList/'. $inputs['id']);
  }

  public function updateConfirm(Request $request, $id) {
    $circles = DB::select('select * from circles where id ='.$id);

    return view('circle.update', compact('circles'));
  }

  public function update() {
    $inputs = \Request::all();
    $circle = new Circle();

    $circle->updateData($inputs);

    $circles = DB::select('select * from circles where id = '. $inputs['id']);

    \Session::flash('flash_message', $circles[0]->circle_name .'の情報を更新しました。');
    return redirect('/circleList/'. $circles[0]->event_id);
  }

  public function deleteConfirm($id) {
    $circles = DB::select('select * from circles where id ='.$id);

    return view('circle.delete', compact('circles'));
  }

  public function delete($id) {
    $circle = new Circle();

    $circles = DB::select('select * from circles where id = '. $id);
    $name = $circles[0]->circle_name;
    $eventId = $circles[0]->event_id;

    $circle->deleteData($id);

    \Session::flash('flash_message', $name .'の情報を削除しました。');
    return redirect('/circleList/'. $eventId);  }

}
