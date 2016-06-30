<?php

use App\User;

class MoneyTest extends TestCase {

    /*
     * 最初にログインして、イベントデータを作成する。
     */
    public function setUp() {
        parent::setUp();

        $user = new User(['user' => 'take']);
        $this->be($user);
    }

    /*
     * /moneyCreate にアクセスすると金額情報の登録ページが開いて、金額を新規登録できる。
     * その後、初期費用(10000) - 登録した金額(1000) が計算出来ているか確認する。
     */
    public function testStaffListAccess() {
        DB::table('events')
            ->insert([
                'name'       => 'eventName',
                'host'       => 'host',
                'price'      => '10000',
                'startDay'   => '2016/01/01',
                'endDay'     => '2016/01/03',
            ]);

        $id = $this->eventIdGet();

        $this
            ->visit('/moneyCreate/'.$id)
            ->see('金額情報入力')
            ->type('0', 'hundred')
            ->type('0', 'five_hundred')
            ->type('1', 'thousand')
            ->type('0', 'five_thousand')
            ->type('0', 'million')
            ->press('登録する')
            ->see('￥-9,000');

        $this->deleteEvent();
    }

    /*
     * ページにアクセスするためのイベントIDを取得する。
     */
    private function eventIdGet() {
        $query = DB::table('events')->get();
        $id = $query[0]->id;

        return $id;
    }

    /*
     * テストが終了した後、挿入した events テーブルの情報を削除する。
     */
    private function deleteEvent() {
        DB::table('events')
            ->where('name', 'eventName')
            ->delete();
    }

}
