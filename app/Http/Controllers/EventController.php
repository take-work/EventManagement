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

        if (! $eventCheck) {
            // イベントデータが一つでも存在する場合

            if ($staffCheck && $circleCheck && $moneyCheck) {
                // スタッフ・サークル・金額情報が何もない場合
                $moneyList = $event->moneyList($events);

                return view('event.list', compact('events', 'moneyList'));

            } elseif(! $staffCheck && $circleCheck && $moneyCheck) {
                // スタッフデータだけがある場合
                $staffCounter = $event->staffCounter($events);
                $moneyList = $event->moneyList($events);

                return view('event.list', compact('events', 'staffCounter', 'moneyList'));

            } elseif(! $staffCheck && ! $circleCheck && $moneyCheck) {
                // スタッフデータ・サークルデータだけがある場合
                $staffCounter = $event->staffCounter($events);
                $circleCounter = $event->circleCounter($events);
                $moneyList = $event->moneyList($events);

                return view('event.list', compact('events', 'staffCounter', 'circleCounter', 'moneyList'));

            } elseif(! $staffCheck && $circleCheck && ! $moneyCheck) {
                // スタッフデータ・金額情報だけがある場合
                $staffCounter = $event->staffCounter($events);
                list($moneyCounter, $moneyList) = $event->moneyCounter($events);

                return view('event.list', compact('events', 'staffCounter', 'moneyCounter', 'moneyList'));

            } elseif($staffCheck && ! $circleCheck && $moneyCheck) {
                // サークルデータだけがある場合
                $circleCounter = $event->circleCounter($events);
                $moneyList = $event->moneyList($events);

                return view('event.list', compact('events', 'circleCounter', 'moneyList'));

            } elseif($staffCheck && ! $circleCheck && ! $moneyCheck) {
                // サークルデータ・金額情報だけがある場合
                $circleCounter = $event->circleCounter($events);
                list($moneyCounter, $moneyList) = $event->moneyCounter($events);

                return view('event.list', compact('events', 'circleCounter', 'moneyCounter', 'moneyList'));

            } elseif($staffCheck && $circleCheck && ! $moneyCheck) {
                // 金額情報だけがある場合
                list($moneyCounter, $moneyList) = $event->moneyCounter($events);

                return view('event.list', compact('events', 'moneyCounter', 'moneyList'));

            } else {
                // 全てのデータがある場合
                $staffCounter = $event->staffCounter($events);
                $circleCounter = $event->circleCounter($events);
                list($moneyCounter, $moneyList) = $event->moneyCounter($events);

                return view('event.list', compact('events', 'staffCounter', 'circleCounter', 'moneyCounter', 'moneyList'));

            }

        } else {
            // イベントデータが存在しない場合

            return view('event.list', compact('events'));
        }
    }

    /*
     * イベント一覧ページで検索されたときに呼び出される関数
     */
    public function search(Request $request) {
        $event  = new Event();

        $rules = $this->searchValidationRules();
        $this->validate($request, $rules);

        $events = $event->search($request);

        list($staffCounter, $circleCounter, $moneyCounter, $moneyList) = $event->counter($events);

        return view('event.list', compact('events', 'staffCounter', 'circleCounter', 'moneyCounter', 'moneyList'));
    }

    /*
     * イベントの新規作成ページにアクセスするための関数
     */
    public function create() {
        return view('event.create');
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

        return view('event.update', compact('events'));
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

        return view('event.delete', compact('events'));
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
