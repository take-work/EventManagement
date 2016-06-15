<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Event extends Model {

    /**
     * イベントと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'events';

    /*
     * events テーブルを select して結果を返す関数
     */
    public function select($id = 0) {
        if ($id == 0) {
            $events = DB::table('events')->paginate(10);
        } else {
            $events = Event::where('id', $id)->get();
        }

      return $events;
    }

    /*
     * events テーブルから検索されたときに検索結果を返す関数
     */
    public function search($inputs) {
        $searchQuery = Event::query();
        $searchContent = $inputs['searchContents'];
        $searchText    = $inputs['searchText'];

        if ($searchContent === "startDay") {
            $searchQuery->where('startDay', 'like', '%'. $searchText .'%');
            $events = $searchQuery->paginate(10);
        }

        return $events;
    }


    /*
     * イベント情報の新規登録処理
     */
    public function insert($inputs) {
        $now = date("Y-m-d");

        list ($startDay, $endDay) = $this->connectDate($inputs);

        DB::table('events')
            ->insert([
                'name'       => $inputs['eventName'],
                'host'       => $inputs['host'],
                'price'      => $inputs['price'],
                'startDay'   => $startDay,
                'endDay'     => $endDay,
                'created_at' => $now,
                'updated_at' => $now
            ]);

      return true;
    }

    /*
     * イベント情報の更新処理
     */
    public function updateData($inputs) {
        $now = date("Y-m-d");
        list ($startDay, $endDay) = $this->connectDate($inputs);

        DB::table('events')
            ->where('id', $inputs['id'])
            ->update([
                'name'       => $inputs['eventName'],
                'host'       => $inputs['host'],
                'price'      => $inputs['price'],
                'startDay'   => $startDay,
                'endDay'     => $endDay,
                'updated_at' => $now
            ]);

        return true;
    }

    /*
     * 削除処理を行う関数
     */
    public function deleteData($id) {
        Event::delete('id', $id);

        return true;
    }

    /*
     * 日付を出力する際は、xxxx/yy/dd の形式で出力してほしいという要望に答えるため、
     * 一旦入力された値をバラして結合してからデータベースに格納するための処理を行う関数
     */
    private function connectDate($inputs) {
        $start = $inputs['startDay'];
        $end   = $inputs['endDay'];

        $startYear  = mb_substr($start, 0, 4);
        $startMonth = mb_substr($start, 4, 2);
        $startDays  = mb_substr($start, 6, 2);

        $endYear  = mb_substr($end, 0, 4);
        $endMonth = mb_substr($end, 4, 2);
        $endDays  = mb_substr($end, 6, 2);

        $startDay = $startYear .'/'. $startMonth .'/'. $startDays;
        $endDay   = $endYear .'/'. $endMonth .'/'. $endDays;

        return array($startDay, $endDay);
    }

}
