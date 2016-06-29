<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Staff;
use App\Models\Circle;
use App\Models\Money;

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
     * events テーブルから全てのデータを取得して結果を返す関数
     */
    public function fullSelect() {
        $events = DB::table('events')
            ->get();

        return $events;
    }

    /*
     * events テーブルから検索されたときに検索結果を返す関数
     */
    public function search($request) {
        $searchContent = $request['searchContents'];
        $searchText    = $request['searchText'];

        $searchQuery = Event::query();
        $searchQuery->where($searchContent, 'like', '%'. $searchText .'%');

        $events = $searchQuery->paginate(10);

        return $events;
    }


    /*
     * イベント情報の新規登録処理
     */
    public function insert($inputs) {
        $now = date("Y-m-d H:i:s");

        list ($startDay, $endDay) = $this->connectDate($inputs);

        DB::table('events')
            ->insert([
                'name'       => $inputs['eventName'],
                'host'       => $inputs['host'],
                'price'      => $inputs['price'],
                'startDay'   => $startDay,
                'endDay'     => $endDay,
                'created_at' => $now,
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
        DB::table('events')
            ->delete($id);

        DB::table('staffs')
            ->where('event_id', $id)
            ->delete();

        DB::table('circles')
            ->where('event_id', $id)
            ->delete();

        DB::table('money')
            ->where('event_id', $id)
            ->delete();
    }

    /*
     * それぞれのイベントに登録されているスタッフ数を計算する関数
     */
    public function staffCounter($events) {
        $staff = new Staff();

        foreach ($events as $id) {
            $eventId = $id->id;

            $staffCount = $staff->count($eventId);
            $staffCounter[$eventId] = $staffCount;
        }

        return $staffCounter;
    }

    /*
     * それぞれのイベントに登録されているサークル数を計算する関数
     */
    public function circleCounter($events) {
        $circle = new Circle();

        foreach ($events as $id) {
            $eventId = $id->id;

            $circleCount = $circle->count($eventId);
            $circleCounter[$eventId] = $circleCount;
        }

        return $circleCounter;
    }

    /*
     * それぞれのイベントに登録されている金額を計算する関数
     */
    public function moneyCounter($events) {
        $money = new Money();

        foreach ($events as $id) {
            $eventId = $id->id;
            $eventPrice = $id->price;

            $totalMoney = $money->totalMpney($eventId);
            $moneyCount[$eventId] = $totalMoney;

            $moneyCalc = $money->calculater($totalMoney, $eventPrice);
            $moneyList[$eventId] = $moneyCalc;
        }

        $moneyCounter = [$moneyCount, $moneyList];

        return $moneyCounter;
    }

    /*
     * 金額情報が入力されていない場合に純利益を表示させるために値を渡す関数
     */
    public function moneyList($events) {
        foreach ($events as $event) {
            $eventId = $event->id;
            $eventPrice = $event->price;

            $moneyList[$eventId] = $eventPrice;
        }

        return $moneyList;
    }

    /*
     * それぞれのイベントに登録されているスタッフ数・サークル数・利益等を計算する関数
     */
    public function counter($events) {
        $staff  = new Staff();
        $circle = new Circle();
        $money  = new Money();

        $staffs  = $staff->fullSelect();
        $circles = $circle->fullSelect();
        $moneys = $money->fullSelect();

        foreach ($events as $id) {
            $eventId = $id->id;
            $eventPrice = $id->price;

            if (! empty($staffs)) {
                // スタッフ情報が存在する場合

                $staffCount = $staff->count($eventId);
                $staffCounter[$eventId] = $staffCount;
            } else {
                // スタッフ情報が一つも存在しない場合

                $staffCounter[$eventId] = 0;
            }

            if (! empty($circles)) {
                // サークル情報が存在する場合

                $circleCount = $circle->count($eventId);
                $circleCounter[$eventId] = $circleCount;
            } else {
                // サークル情報が一つも存在しない場合

                $circleCounter[$eventId] = 0;
            }

            if (empty($moneys)) {
                $totalMoney = $money->totalMpney($eventId);
                $moneyCounter[$eventId] = $totalMoney;

                $moneyCalc = $money->calculater($totalMoney, $eventPrice);
                $moneyList[$eventId] = $moneyCalc;
            } else {
                $moneyCounter[$eventId] = 0;
                $moneyList[$eventId] = 0;
            }
        }

        $counter = [$staffCounter, $circleCounter, $moneyCounter, $moneyList];

        return $counter;
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

        $connectData = [$startDay, $endDay];

        return $connectData;
    }

}
