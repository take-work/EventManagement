<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use App\Models\Staff;

class StaffController extends Controller {

  public function show($id) {
    $staffs = Staff::where('event_id', $id)->orderBy('rank','asc')->paginate(20);
    $staffContents = $this->staffContents();

    return view('staff.list', compact('staffs', 'id', 'staffContents'));
  }

  public function create($id) {
    $staffContents = $this->staffContents();

    return view('staff.create', compact('id', 'staffContents'));
  }

  public function insert(Request $request) {
    $staff = new Staff();

    $rules = $this->validationRules();
    $this->validate($request, $rules);

    $staff->insert($request);

    \Session::flash('flash_message', '新スタッフ「'. $request['staffName'] .'」さんを新規登録しました。');
    return redirect('/staffList/'. $request['id']);
  }

  public function updateConfirm($id) {
    $staffs = DB::select('select * from staffs where id ='.$id);
    $staffContents = $this->staffContents();

    return view('staff.update', compact('staffs', 'staffContents'));
  }

  public function update(Request $request) {
    $staff = new Staff();

    $rules = $this->validationRules();
    $this->validate($request, $rules);

    $staffs = Staff::where('id', $request['id'])->get();

    $staff->updateData($request);

    \Session::flash('flash_message', $request['staffName'] .'さんの情報を更新しました。');
    return redirect('/staffList/'. $staffs[0]->event_id);
  }

  public function deleteConfirm($id) {
    $staffs = DB::select('select * from staffs where id ='.$id);
    $staffContents = $this->staffContents();

    return view('staff.delete', compact('staffs', 'staffContents'));
  }

  public function delete($id) {
    $staff = new Staff();

    $staffs = Staff::where('id', $id)->get();

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

  public function staffContents() {
    $staffContents = [
      'staffName' => '氏名(HN)',
      'position' => '担当 / 持ち場',
      'mail' => 'メールアドレス',
      'tel' => '電話番号',
      'twitter' => 'Twitter',
      'experience' => '経験',
      'rank' => '役職'
    ];

    return $staffContents;
  }
}
