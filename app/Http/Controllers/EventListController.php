<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Event;

class EventListController extends Controller {

    /*
     * イベント一覧ページにアクセスするための関数
     */
    public function show() {
        $event  = new Event();

        $eventContents = $this->eventContents();
        $events = $event->select();

        list($staffCounter, $circleCounter, $moneyCounter, $moneyList) = $event->counter($events);

        return view('event.list', compact('events', 'eventContents', 'staffCounter', 'circleCounter', 'moneyCounter', 'moneyList'));
    }

    /*
     * イベント一覧ページで検索されたときに呼び出される関数
     */
    public function search(Request $request) {
        $event  = new Event();

        $eventContents = $this->eventContents();
        $events = $event->search($request);

        list($staffCounter, $circleCounter, $moneyCounter, $moneyList) = $event->counter($events);

        return view('event.list', compact('events', 'eventContents', 'staffCounter', 'circleCounter', 'moneyCounter', 'moneyList'));
    }

    /*
     * イベントの新規作成ページにアクセスするための関数
     */
    public function create() {
        $inputContents = $this->inputContents();

        return view('event.create', compact('inputContents'));
    }

    /*
     * イベント情報を新規作成するための関数
     */
    public function insert(Request $request) {
        $event = new Event();

        $rules = $this->validationRules();
        $this->validate($request, $rules);

        $event->insert($request);

        \Session::flash('flash_message', 'イベント「'. $request['eventName'] .'」を新規登録しました。');
        return redirect('/list');
    }

    /*
     * イベント更新ページにアクセスするための関数
     */
    public function updateConfirm($id) {
        $event = new Event();
        $events = $event->select($id);

        $inputContents = $this->inputContents();

        return view('event.update', compact('events', 'inputContents'));
    }

    /*
     * イベント情報を更新するための関数
     */
    public function update(Request $request) {
        $event = new Event();

        $rules = $this->validationRules();
        $this->validate($request, $rules);

        $event->updateData($request);

        \Session::flash('flash_message', $request['eventName'] .'の情報を更新しました。');
        return redirect('/list');
    }

    /*
     * イベント削除確認ページにアクセスするための関数
     */
    public function deleteConfirm($id) {
        $event = new Event();
        $events = $event->select($id);

        $inputContents = $this->inputContents();

        return view('event.delete', compact('events', 'inputContents'));
    }

    /*
     * イベントの削除を実行するための関数
     */
    public function delete($id) {
        $event = new Event();

        $events = $event->select($id);
        $name = $events[0]->name;

        $event->deleteData($id);

        \Session::flash('flash_message', $name .'を削除しました。');
        return redirect('/list');
    }

    /*
     * バリデーションのルールを設定する関数
     */
    private function validationRules() {
        $rules = [
            'startDay'  => 'required | digits:8',
            'endDay'    => 'required | digits:8',
            'eventName' => 'required',
            'host'      => 'required',
            'price'     => 'required | integer'
        ];

        return $rules;
    }

    /*
     * イベント一覧ページで表示するテーブルの項目を渡す関数
     */
    private function eventContents() {
        $eventContents = [
            'startDay'  => '開始年月日',
            'endDay'    => '終了年月日',
            'eventName' => 'イベント名',
            'host'      => '主催者',
            'staffs'    => 'スタッフ数',
            'circles'   => 'サークル数',
            'price'     => '準備費用',
            'moneyCalc' => '合計金額',
            'moneyList' => '純利益'
        ];

        return $eventContents;
    }

    /*
     * イベントの新規作成・更新・削除ページで表示するテーブルの項目を渡す関数
     */
    private function inputContents() {
        $inputContents = [
            'startDay'  => '開始年月日',
            'endDay'    => '終了年月日',
            'eventName' => 'イベント名',
            'host'      => '主催者',
            'price'     => '準備費用'
        ];

        return $inputContents;
    }

}
