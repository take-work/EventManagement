<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Staff extends Model {

    /**
     * スタッフと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'staffs';

    /*
     * staffs テーブルからイベント毎にデータを取得して結果を返す関数
     */
    public function select($id) {
        $staffs = Staff::where('event_id', $id)
            ->orderBy('rank', 'asc')
            ->paginate(20);

        return $staffs;
    }

    /*
     * スタッフ一覧ページから検索された時に結果を返す関数
     */
    public function search($request) {
        $id            = $request['id'];
        $searchContent = $request['searchContents'];
        $searchText    = $request['searchText'];

        $searchQuery = Staff::query();
        $searchQuery
            ->where('event_id', $id)
            ->where($searchContent, 'like', '%'. $searchText .'%')
            ->orderBy('rank', 'asc');

        $staffs = $searchQuery->paginate(20);

        return $staffs;
    }

    /*
     * staffs テーブルから特定のデータを取りたい時に使用する関数
     */
    public function specificData($id) {
        $staffs = Staff::where('id', $id)
            ->get();

        return $staffs;
    }

    /*
     * イベント一覧ページで、そのイベントに登録されているスタッフの総数を出力するための関数
     */
    public function count($eventId) {
        $counter =
            DB::table('staffs')
                ->select(DB::raw('count(*) as counter'))
                ->where('event_id', $eventId)
                ->get();

        return $counter;
    }

    /*
     * スタッフの新規登録処理を行う関数
     */
    public function insert($inputs) {
        $now = date("Y-m-d");

        DB::table('staffs')
            ->insert([
                'event_id'   => $inputs['id'],
                'name'       => $inputs['staffName'],
                'position'   => $inputs['position'],
                'mail'       => $inputs['mail'],
                'tel'        => $inputs['tel'],
                'twitter'    => $inputs['twitter'],
                'experience' => $inputs['experience'],
                'rank'       => $inputs['rank'],
                'updated_at' => $now,
                'created_at' => $now
        ]);

        return true;
    }

    /*
     * スタッフ情報の更新処理を行う関数
     */
    public function updateData($inputs) {
        $now = date("Y-m-d");

        DB::table('staffs')
            ->where('id', $inputs['id'])
            ->update([
                'name'       => $inputs['staffName'],
                'position'   => $inputs['position'],
                'mail'       => $inputs['mail'],
                'tel'        => $inputs['tel'],
                'twitter'    => $inputs['twitter'],
                'experience' => $inputs['experience'],
                'rank'       => $inputs['rank'],
                'updated_at' => $now
            ]);

        return true;
    }

    /*
     * スタッフ情報の削除処理を行う関数
     */
    public function deleteData($id) {
        DB::table('staffs')
            ->delete($id);
    }

}
