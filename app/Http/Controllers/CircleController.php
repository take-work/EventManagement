<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Circle;

class CircleController extends Controller {

    /*
     * サークル一覧ページにアクセスするための関数
     */
    public function show($id) {
        $circle = new Circle();
        $circles = $circle->select($id);

        $desk = $circle->deskCounter($id);
        $chair = $circle->chairCounter($id);

        return view('circle.list', compact('circles', 'id', 'desk', 'chair'));
    }

    /*
     * イベント一覧ページで検索されたときに呼び出される関数
     */
    public function search(Request $request) {
        $circle = new Circle();

        $rules = $this->searchValidationRules();
        $this->validate($request, $rules);

        $circles = $circle->search($request);

        $id = $request['id'];
        $desk = $circle->deskCounter($id);
        $chair = $circle->chairCounter($id);

        $searchFlag = true;

        return view('circle.list', compact('circles', 'id', 'desk', 'chair', 'searchFlag'));
    }

    /*
     * サークルの新規作成ページにアクセスするための関数
     */
    public function create($id) {
        $circleContents = $this->circleContents();

        return view('circle.create', compact('id', 'circleContents'));
    }

    /*
     * サークルの新規作成処理を実行するための関数
     */
    public function insert(Request $request) {
        $circle = new Circle();

        $rules = $this->validationRules();
        $this->validate($request, $rules);

        $circle->insert($request);

        \Session::flash('flash_message', '新サークル「'. $request['circleName'] .'」を新規登録しました。');
        return redirect('/circleList/'. $request['id']);
    }

    /*
     * サークルの更新ページにアクセスするための関数
     */
    public function updateConfirm(Request $request, $id) {
        $circle = new Circle();
        $circles = $circle->specificData($id);

        $circleContents = $this->circleContents();

        return view('circle.update', compact('circles', 'circleContents'));
    }

    /*
     * サークルの更新処理を実行するための関数
     */
    public function update(Request $request) {
        $circle = new Circle();

        $rules = $this->validationRules();
        $this->validate($request, $rules);

        $circle->updateData($request);

        $id = $request['id'];
        $circles    = $circle->specificData($id);
        $circleName = $circles[0]->circle_name;
        $eventId         = $circles[0]->event_id;

        \Session::flash('flash_message', $circleName .'の情報を更新しました。');
        return redirect('/circleList/'. $eventId);
    }

    /*
     * サークルの削除確認ページにアクセスするための関数
     */
    public function deleteConfirm($id) {
        $circle = new Circle();
        $circles = $circle->specificData($id);

        $circleContents = $this->circleContents();

        return view('circle.delete', compact('circles', 'circleContents'));
    }

    /*
     * サークルの削除処理を実行するための関数
     */
    public function delete($id) {
        $circle = new Circle();
        $circles = $circle->specificData($id);

        $name = $circles[0]->circle_name;
        $eventId = $circles[0]->event_id;

        $circle->deleteData($id);

        \Session::flash('flash_message', $name .'の情報を削除しました。');
        return redirect('/circleList/'. $eventId);
    }

    /*
     * バリデーションのルールを設定するための関数
     */
    private function validationRules() {
        $rules = [
            'circleName'   => 'required',
            'circleLeader' => 'required',
            'staff'        => 'integer',
            'desk'         => 'integer',
            'chair'        => 'integer'
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
    private function circleContents() {
        $circleContents = [
            'number'     => 'ナンバー',
            'space'      => 'スペース',
            'circleName' => 'サークル名',
            'host'       => '代表者',
            'staffs'     => 'スタッフの数',
            'desks'      => '机の数',
            'chairs'     => '椅子の数'
        ];

        return $circleContents;
    }

}
