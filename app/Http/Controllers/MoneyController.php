<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use App\Models\Money;

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
        $inserts = new Money();

        $eventName = DB::select('select * from events where id ='.$request['id']);

        $rules = $this->validationRules();
        $this->validate($request, $rules);

        $inserts->insert($request);

        \Session::flash('flash_message', $eventName[0]->name .'の金額情報を新規登録しました。');
        return redirect('/list');
    }

    /*
     * 金額情報の更新ページにアクセスするための関数
     */
    public function updateConfirm($id) {
        $moneyList = DB::select('select * from money where event_id ='.$id);

        return view('money.update', compact('moneyList'));
    }

    /*
     * 金額情報の更新処理を実行するための関数
     */
    public function update(Request $request, $id) {
        $money = new Money();

        $moneyId = DB::select('select * from money where id ='.$request['id']);
        $eventId = $moneyId[0]->event_id;

        $eventName = DB::select('select * from events where id ='.$eventId);

        $rules = $this->validationRules();
        $this->validate($request, $rules);

        $money->updateData($request);

        \Session::flash('flash_message', $eventName[0]->name .'の金額情報を更新しました。');
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
