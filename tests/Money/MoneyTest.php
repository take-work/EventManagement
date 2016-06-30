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

        DB::table('events')
            ->insert([
                'name'       => 'eventName',
                'host'       => 'host',
                'price'      => '10000',
                'startDay'   => '2016/01/01',
                'endDay'     => '2016/01/03',
            ]);
    }

    /*
     * /moneyCreate にアクセスすると金額情報の登録ページが開く。
     */
    public function testStaffListAccess() {
        $id = $this->eventIdGet();

        $this
            ->visit('/moneyCreate/'.$id)
            ->see('金額情報入力');
    }

    /*
     * ページにアクセスするためのイベントIDを取得する。
     */
    private function eventIdGet() {
        $query = DB::table('events')->get();
        $id = $query[0]->id;

        return $id;
    }

}
