<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Money;
use App\Models\Event;

class MoneyController extends Controller {

    /*
     * 金額情報の新規作成ページにアクセスするための関数
     */
    public function create($id) {
        return view('money.create', compact('id'));
    }

    /*
     * 金額情報の新規登録処理を実行するための関数
     */
    public function insert(Request $request) {
        $money = new Money();
        $event = new Event();

        $id = $request['id'];
        $events = $event->select($id);

        $eventName = $events[0]->name;

        $rules = $this->validationRules();
        $this->validate($request, $rules);

        $money->insert($request);

        \Session::flash('flash_message', $eventName .'の金額情報を新規登録しました。');
        return redirect('/list');
    }

    /*
     * 金額情報の更新ページにアクセスするための関数
     */
    public function updateConfirm($id) {
        $money = new Money();

        $moneyList = $money->select($id);

        return view('money.update', compact('moneyList'));
    }

    /*
     * 金額情報の更新処理を実行するための関数
     */
    public function update(Request $request, $id) {
        $money = new Money();
        $event = new Event();

        $moneyData = $money->specificData($id);
        $eventId = $moneyData[0]->event_id;

        $events = $event->select($eventId);
        $eventName = $events[0]->name;

        $rules = $this->validationRules();
        $this->validate($request, $rules);

        $money->updateData($request);

        \Session::flash('flash_message', $eventName .'の金額情報を更新しました。');
        return redirect('/list');
    }

    /*
     * バリデーションルールを設定するための関数
     */
    private function validationRules() {
        $rules = [
            'hundred'       => 'required | integer',
            'five_hundred'  => 'required | integer',
            'thousand'      => 'required | integer',
            'five_thousand' => 'required | integer',
            'million'       => 'required | integer'
        ];

    return $rules;
    }

}
