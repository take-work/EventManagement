<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Event;
use App\Models\Staff;
use App\Models\Circle;
use App\Models\Money;

class EventController extends Controller {

    /*
     * イベント一覧ページにアクセスするための関数
     */
    public function show() {
        $event = new Event();

        list($eventCheck, $staffCheck, $circleCheck, $moneyCheck) = $this->dataCheck();

        $events = $event->select();
        $eventContents = $this->eventContents();

        if (! $eventCheck) {
            // イベントデータが一つでも存在する場合

            if ($staffCheck && $circleCheck && $moneyCheck) {
                // スタッフ・サークル・金額情報が何もない場合
                $moneyList = $event->moneyList($events);

                return view('event.list', compact('events', 'eventContents', 'moneyList'));

            } elseif(! $staffCheck && $circleCheck && $moneyCheck) {
                // スタッフデータだけがある場合
                $staffCounter = $event->staffCounter($events);
                $moneyList = $event->moneyList($events);

                return view('event.list', compact('events', 'eventContents', 'staffCounter', 'moneyList'));

            } elseif(! $staffCheck && ! $circleCheck && $moneyCheck) {
                // スタッフデータ・サークルデータだけがある場合
                $staffCounter = $event->staffCounter($events);
                $circleCounter = $event->circleCounter($events);
                $moneyList = $event->moneyList($events);

                return view('event.list', compact('events', 'eventContents', 'staffCounter', 'circleCounter', 'moneyList'));

            } elseif(! $staffCheck && $circleCheck && ! $moneyCheck) {
                // スタッフデータ・金額情報だけがある場合
                $staffCounter = $event->staffCounter($events);
                list($moneyCounter, $moneyList) = $event->moneyCounter($events);

                return view('event.list', compact('events', 'eventContents', 'staffCounter', 'moneyCounter', 'moneyList'));

            } elseif($staffCheck && ! $circleCheck && $moneyCheck) {
                // サークルデータだけがある場合
                $circleCounter = $event->circleCounter($events);
                $moneyList = $event->moneyList($events);

                return view('event.list', compact('events', 'eventContents', 'circleCounter', 'moneyList'));

            } elseif($staffCheck && ! $circleCheck && ! $moneyCheck) {
                // サークルデータ・金額情報だけがある場合
                $circleCounter = $event->circleCounter($events);
                list($moneyCounter, $moneyList) = $event->moneyCounter($events);

                return view('event.list', compact('events', 'eventContents', 'circleCounter', 'moneyCounter', 'moneyList'));

            } elseif($staffCheck && $circleCheck && ! $moneyCheck) {
                // 金額情報だけがある場合
                list($moneyCounter, $moneyList) = $event->moneyCounter($events);

                return view('event.list', compact('events', 'eventContents', 'moneyCounter', 'moneyList'));

            } else {
                // 全てのデータがある場合
                $staffCounter = $event->staffCounter($events);
                $circleCounter = $event->circleCounter($events);
                list($moneyCounter, $moneyList) = $event->moneyCounter($events);

                return view('event.list', compact('events', 'eventContents', 'staffCounter', 'circleCounter', 'moneyCounter', 'moneyList'));

            }

        } else {
            // イベントデータが存在しない場合

            return view('event.list', compact('events', 'eventContents'));
        }
    }

    /*
     * イベント一覧ページで検索されたときに呼び出される関数
     */
    public function search(Request $request) {
        $event  = new Event();

        $rules = $this->searchValidationRules();
        $this->validate($request, $rules);

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
     * 検索時のバリデーションのルールを設定する関数
     */
    private function searchValidationRules() {
        $rules = [
            'searchContents' => 'required',
            'searchText'     => 'required'
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

    /*
     * データが存在しているかどうかをチェックして結果を返す関数
     */
    private function dataCheck() {
        $event  = new Event();
        $staff  = new Staff();
        $circle = new Circle();
        $money  = new Money();

        $eventCheck  = empty($event->fullSelect());
        $staffCheck  = empty($staff->fullSelect());
        $circleCheck = empty($circle->fullSelect());
        $moneyCheck  = empty($money->fullSelect());

        $dataCheck = [$eventCheck, $staffCheck, $circleCheck, $moneyCheck];

        return $dataCheck;
    }
}
