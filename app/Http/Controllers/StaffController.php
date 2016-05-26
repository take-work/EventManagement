<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use App\Models\Staff;

class StaffController extends Controller {
  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Request $request, $id) {
    $staffs = DB::select('select * from staffs where event_id = '. $id .' order by rank');

    return view('staff.list', compact('staffs', 'id'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request, $id) {
    return view('staff.create', compact('id'));
  }

  public function insert() {
    $inputs = \Request::all();
    $inserts = new Staff();
    $inserts->insert($inputs);

    \Session::flash('flash_message', '新スタッフ「'. $inputs['name'] .'」さんを新規登録しました。');
    return redirect('/staffList/'. $inputs['id']);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function updateConfirm($id) {
    $staffs = DB::select('select * from staffs where id ='.$id);

    return view('staff.update', compact('staffs'));
  }

  public function update() {
    $inputs = \Request::all();
    $staff = new Staff();

    $staffs = DB::select('select * from staffs where id = '. $inputs['id']);
    $staff->updateData($inputs);

    \Session::flash('flash_message', $inputs['name'] .'さんの情報を更新しました。');
    return redirect('/staffList/'. $staffs[0]->event_id);
  }

  public function deleteConfirm($id) {
    $staffs = DB::select('select * from staffs where id ='.$id);

    return view('staff.delete', compact('staffs'));
  }

  public function delete($id) {
    $staff = new Staff();

    $staffs = DB::select('select * from staffs where id = '. $id);
    $name = $staffs[0]->name;
    $eventId = $staffs[0]->event_id;

    $staff->deleteData($id);

    \Session::flash('flash_message', $name .'さんの情報を削除しました。');
    return redirect('/staffList/'. $eventId);
  }

}
