<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Circle extends Model {

    /**
     * サークルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'circles';

    /*
     * circles テーブルからイベント毎にデータを取得して結果を返す関数
     */
    public function select($id) {
        $circles = Circle::where('event_id', $id)
            ->paginate(20);

        return $circles;
    }

    /*
     * circles テーブルからイベント毎にデータを取得して結果を返す関数
     * PDF ファイルの生成用に、paginate していない版も用意する。
     */
    public function allSelect($id) {
        $circles = Circle::where('event_id', $id)
            ->get();

        return $circles;
    }

    /*
     * circles テーブルから検索された時に検索結果を返す関数
     */
    public function search($request) {
        $id            = $request['id'];
        $searchContent = $request['searchContents'];
        $searchText    = $request['searchText'];

        $searchQuery = Circle::query();
        $searchQuery
            ->where('event_id', $id)
            ->where($searchContent, 'like', '%'. $searchText .'%');

        $circles = $searchQuery->paginate(20);

        return $circles;
    }

    /*
     * circles テーブルから特定のデータを取りたい時に使用する関数
     */
    public function specificData($id) {
        $circles = Circle::where('id', $id)
            ->get();

        return $circles;
    }

    /*
     * イベント一覧ページでそのイベントに登録されているサークル数を出力するために数を数えている関数
     */
    public function count($eventId) {
        $counter = DB::table('circles')
            ->select(DB::raw('count(*) as counter'))
            ->where('event_id', $eventId)
            ->get();

        return $counter;
    }

    /*
     * 必要な机の数を数えている関数
     */
    public function deskCounter($id) {
        $circles = Circle::where('event_id', $id)
            ->get();

        $first = true;
        $desk = 0;

        foreach ($circles as $circleData) {
            if ($first == true) {
                $desk = $circleData->desk;
                $first = false;
            } elseif($first == false) {
                $desk += $circleData->desk;
            }
        }

        return $desk;
    }

    /*
     * 必要な椅子の数を数えている関数
     */
    public function chairCounter($id) {
        $circles = Circle::where('event_id', $id)
            ->get();

        $first = true;
        $chair = 0;

        foreach ($circles as $circleData) {
            if ($first == true) {
                $chair = $circleData->chair;
                $first = false;
            } else {
                $chair += $circleData->chair;
            }
        }

        return $chair;
    }

    /*
     * 新規登録処理を行う関数
     */
    public function insert($inputs) {
        $now = date("Y-m-d");

        DB::table('circles')
            ->insert([
                'event_id'    => $inputs['id'],
                'number'      => $inputs['number'],
                'space'       => $inputs['space'],
                'circle_name' => $inputs['circleName'],
                'host'        => $inputs['circleLeader'],
                'staff'       => $inputs['staff'],
                'desk'        => $inputs['desk'],
                'chair'       => $inputs['chair'],
                'created_at'  => $now,
                'updated_at'  => $now
            ]);

        return true;
    }

    /*
     * 更新処理を行う関数
     */
    public function updateData($inputs) {
        $now = date("Y-m-d");

        DB::table('circles')
            ->where('id', $inputs['id'])
            ->update([
                'number'      => $inputs['number'],
                'space'       => $inputs['space'],
                'circle_name' => $inputs['circleName'],
                'host'        => $inputs['circleLeader'],
                'staff'       => $inputs['staff'],
                'desk'        => $inputs['desk'],
                'chair'       => $inputs['chair'],
                'updated_at'  => $now
            ]);

        return true;
    }

    /*
     * 削除処理を行う関数
     */
    public function deleteData($id) {
        DB::table('circles')
            ->delete($id);
    }

}
