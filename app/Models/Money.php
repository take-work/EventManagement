<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Money extends Model {

    /**
     * 金額管理と関連しているテーブル
     *
     * @var string
     */
    protected $table = 'money';

    /*
     * money テーブルからイベント毎にデータを取得して結果を返す関数
     */
    public function select($id) {
        $money = Money::where('event_id', $id)
            ->get();

        return $money;
    }

    /*
     * money テーブルからイベント毎ではなく、特定のデータを取得して結果を返す関数
     */
    public function specificData($id) {
        $money = Money::where('id', $id)
            ->get();

        return $money;
    }

    /*
     * money テーブルからイベント毎に、ではなく、全てのデータを取得して結果を返す関数
     */
    public function fullSelect() {
        $moneys = DB::table('money')
            ->get();

            return $moneys;
    }

    /*
     * 金額情報の新規登録処理を行う関数
     */
    public function insert($inputs) {
        $now = date("Y-m-d H:i:s");

        DB::table('money')->insert([
            'event_id'      => $inputs['id'],
            'hundred'       => $inputs['hundred'],
            'five_hundred'  => $inputs['five_hundred'],
            'thousand'      => $inputs['thousand'],
            'five_thousand' => $inputs['five_thousand'],
            'million'       => $inputs['million'],
            'created_at'    => $now,
            'updated_at'    => $now
        ]);

        return true;
    }

    /*
     * 金額情報の更新処理を行う関数
     */
    public function updateData($inputs) {
        $now = date("Y-m-d H:i:s");

        DB::table('money')
            ->where('id', $inputs['id'])
            ->update([
                'hundred'       => $inputs['hundred'],
                'five_hundred'  => $inputs['five_hundred'],
                'thousand'      => $inputs['thousand'],
                'five_thousand' => $inputs['five_thousand'],
                'million'       => $inputs['million'],
                'updated_at'    => $now
            ]);

        return true;
    }

    /*
     * 登録された金額を計算する関数
     */
    public function totalMpney($id) {
        $money = DB::select('select * from money where event_id ='. $id);

        if (! empty($money)) {
            foreach ($money as $coin) {
                $hundred       = $coin->hundred * 100;
                $five_hundred  = $coin->five_hundred * 500;
                $thousand      = $coin->thousand * 1000;
                $five_thousand = $coin->five_thousand * 5000;
                $million       = $coin->million * 10000;
            }

            $total = $hundred + $five_hundred + $thousand + $five_thousand + $million;
        } else {
            $total = null;
        }

        return $total;
    }

    /*
     * 合計金額 - 準備費用 を計算して純利益を出す関数
     */
    public function calculater($totalMoney = 0, $price = 0) {
        $moneyCalc = $totalMoney - $price;

        return $moneyCalc;
    }

}
