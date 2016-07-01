<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Staff;

class StaffController extends Controller {

    /*
     * スタッフ一覧ページにアクセスするための関数
     */
    public function show($id) {
        $staff = new Staff();

        $staffs = $staff->select($id);
        $staffContents = $this->staffContents();

        return view('staff.list', compact('staffs', 'id', 'staffContents'));
    }

    /*
     * イベント一覧ページで検索されたときに呼び出される関数
     */
    public function search(Request $request) {
        $staff = new Staff();

        $rules = $this->searchValidationRules();
        $this->validate($request, $rules);

        $staffs = $staff->search($request);
        $id = $request['id'];
        $staffContents = $this->staffContents();

        $searchFlag = true;

        return view('staff.list', compact('staffs', 'id', 'staffContents', 'searchFlag'));
    }

    /*
     * スタッフの新規作成ページにアクセスするための関数
     */
    public function create($id) {
        $staffContents = $this->staffContents();

        return view('staff.create', compact('id', 'staffContents'));
    }

    /*
     * スタッフの新規作成処理を呼び出すための関数
     */
    public function insert(Request $request) {
        $staff = new Staff();

        $rules = $this->validationRules();
        $this->validate($request, $rules);

        $staffName = $request['staffName'];
        $id        = $request['id'];

        $staff->insert($request);

        \Session::flash('flash_message', '新スタッフ「'. $staffName .'」さんを新規登録しました。');
        return redirect('/staffList/'. $id);
    }

    /*
     * スタッフの更新ページにアクセスするための関数
     */
    public function updateConfirm($id) {
        $staff = new Staff();
        
        $staffs = $staff->specificData($id);
        $staffContents = $this->staffContents();

        return view('staff.update', compact('staffs', 'staffContents'));
    }

    /*
     * スタッフの更新処理を呼び出すための関数
     */
    public function update(Request $request) {
        $staff = new Staff();

        $rules = $this->validationRules();
        $this->validate($request, $rules);

        $id = $request['id'];
        $staffName = $request['staffName'];

        $staff->updateData($request);
        $staffs = $staff->specificData($id);

        $eventId = $staffs[0]->event_id;

        \Session::flash('flash_message', $staffName .'さんの情報を更新しました。');
        return redirect('/staffList/'. $eventId);
    }

    /*
     * スタッフの削除確認ページにアクセスするための関数
     */
    public function deleteConfirm($id) {
        $staff = new Staff();

        $staffs = $staff->specificData($id);
        $staffContents = $this->staffContents();

        return view('staff.delete', compact('staffs', 'staffContents'));
    }

    /*
     * スタッフ情報の削除処理を呼び出すための関数
     */
    public function delete($id) {
        $staff = new Staff();

        $staffs = $staff->specificData($id);

        $name = $staffs[0]->name;
        $eventId = $staffs[0]->event_id;

        $staff->deleteData($id);

        \Session::flash('flash_message', $name .'さんの情報を削除しました。');
        return redirect('/staffList/'. $eventId);
    }

    /*
     * バリデーションを設定するための関数
     */
    private function validationRules() {
        $rules = [
            'staffName'  => 'required',
            'mail'       => 'email | required_without:tel',
            'tel'        => 'required_without:mail',
            'experience' => 'required',
            'rank'       => 'required'
        ];

        return $rules;
    }

    /*
     * 検索時に行うバリデーションの設定
     */
    private function searchValidationRules() {
        $rules = [
            'searchContents' => 'required',
            'searchText'     => 'required'
        ];

        return $rules;
    }

    /*
     * view ファイルで表示するテーブルの項目を設定するための関数
     */
    private function staffContents() {
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
