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
  public function create($id) {
    return view('staff.create', compact('id'));
  }

  public function insert(Request $request) {
    $staff = new Staff();

    $rules = $this->validationRules();
    $this->validate($request, $rules);

    $staff->insert($request);

    \Session::flash('flash_message', '新スタッフ「'. $request['staffName'] .'」さんを新規登録しました。');
    return redirect('/staffList/'. $request['id']);
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

  public function update(Request $request) {
    $staff = new Staff();

    $rules = $this->validationRules();
    $this->validate($request, $rules);

    $staffs = DB::select('select * from staffs where id = '. $request['id']);
    $staff->updateData($request);

    \Session::flash('flash_message', $request['staffName'] .'さんの情報を更新しました。');
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

  public function validationRules() {
    $rules = [
      'staffName'  => 'required',
      'mail'       => 'email',
      'experience' => 'required',
      'rank'       => 'required'
    ];

    return $rules;
  }
}
