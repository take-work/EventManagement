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

    \Session::flash('flash_title', 'スタッフ新規登録');
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

    $staff->updateData($inputs);

    return "更新しました。";
  }

  public function deleteConfirm($id) {
    $staffs = DB::select('select * from staffs where id ='.$id);

    return view('staff.delete', compact('staffs'));
  }

  public function delete($id) {
    $staff = new Staff();
    $staff->deleteData($id);

    return "削除しました。";
  }

}
