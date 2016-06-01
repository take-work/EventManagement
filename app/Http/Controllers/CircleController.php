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
  public function show($id) {
    $circle = new Circle();
    $circles = Circle::where('event_id', $id)->paginate(20);

    $desk = $circle->deskCounter($id);
    $chair = $circle->chairCounter($id);

    return view('circle.list', compact('circles', 'id', 'desk', 'chair'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request, $id) {
    return view('circle.create', compact('id'));
  }

  public function insert(Request $request) {
    $inserts = new Circle();

    $rules = $this->validationRules();
    $this->validate($request, $rules);

    $inserts->insert($request);

    \Session::flash('flash_message', '新サークル「'. $request['circleName'] .'」を新規登録しました。');
    return redirect('/circleList/'. $request['id']);
  }

  public function updateConfirm(Request $request, $id) {
    $circles = DB::select('select * from circles where id ='.$id);

    return view('circle.update', compact('circles'));
  }

  public function update(Request $request) {
    $circle = new Circle();

    $rules = $this->validationRules();
    $this->validate($request, $rules);

    $circle->updateData($request);

    $circles = Circle::where('id', $request['id'])->get();

    \Session::flash('flash_message', $circles[0]->circle_name .'の情報を更新しました。');
    return redirect('/circleList/'. $circles[0]->event_id);
  }

  public function deleteConfirm($id) {
    $circles = Circle::where('id', $id)->get();

    return view('circle.delete', compact('circles'));
  }

  public function delete($id) {
    $circle = new Circle();
    $circles = Circle::where('id', $id)->get();

    $name = $circles[0]->circle_name;
    $eventId = $circles[0]->event_id;

    $circle->deleteData($id);

    \Session::flash('flash_message', $name .'の情報を削除しました。');
    return redirect('/circleList/'. $eventId);  }

  public function validationRules() {
    $rules = [
      'circleName'   => 'required',
      'circleLeader' => 'required',
      'staff'        => 'integer',
      'desk'         => 'integer',
      'chair'        => 'integer'
    ];

    return $rules;
  }
}
