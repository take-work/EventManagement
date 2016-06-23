<?php

use App\User;

class EventTest extends TestCase {
    /*
     * 最初にログインする。
     */
    public function setUp() {
        parent::setUp();

        $user = new User(['user' => 'take']);
        $this->be($user);
    }

    /*
     * /list にアクセスするとイベント一覧ページが開く。
     */
    public function testListAccess() {
        $this->visit('/list')
            ->see('イベント一覧');
    }

    /*
     * イベント情報を新規登録できる。
     */
    public function testSelect() {
        $this
            ->visit('/create')
            ->see('イベント情報入力')
            ->type('20160101', 'startDay')
            ->type('20160102', 'endDay')
            ->type('イベント名', 'eventName')
            ->type('主催者', 'host')
            ->type('10000', 'price')
            ->press('登録する')
            ->see('イベント「イベント名」を新規登録しました。');
    }
}
