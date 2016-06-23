<?php

use App\User;
use DB;

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
        $this
            ->visit('/list')
            ->see('イベント一覧');
    }

    /*
     * イベント情報を新規登録できる。
     */
    public function testCreate() {
        // 主催者名を生成する。
        $faker = Faker\Factory::create('ja_JP');
        $host = $faker->unique()->name;

        // イベント情報を入力する。
        $this
            ->visit('/create')
            ->see('イベント情報入力')
            ->type('20160101', 'startDay')
            ->type('20160102', 'endDay')
            ->type('イベント名', 'eventName')
            ->type($host, 'host')
            ->type('10000', 'price')
            ->press('登録する')
            ->see('イベント「イベント名」を新規登録しました。');

        // faker で生成された主催者名が正しくデータベースに登録されているかチェックする。
        $this
            ->seeInDatabase('events', ['host' => $host]);
    }

    /*
     * イベント情報を更新できる。
     */
    public function testUpdate() {
        // イベント名を生成する。
        $faker = Faker\Factory::create('ja_JP');
        $eventName = $faker->unique()->name;

        $query = DB::table('events')->get();
        $id = $query[0]->id;

        // イベント情報を入力する。
        $this
            ->visit('/update/'.$id)
            ->see('イベント編集')
            ->type('20160101', 'startDay')
            ->type('20160102', 'endDay')
            ->type($eventName, 'eventName')
            ->type('主催者', 'host')
            ->type('10000', 'price')
            ->press('変更する')
            ->see($eventName.'の情報を更新しました。');

        // faker で生成されたイベント名が正しくデータベースに更新されているかチェックする。
        $this
            ->seeInDatabase('events', ['name' => $eventName]);
    }

    /*
     * イベント情報を削除できる。
     */
    public function testDelete() {
        $query = DB::table('events')->get();
        $id = $query[0]->id;

        // イベント情報を削除する。
        $this
            ->visit('/delete/'.$id)
            ->see('イベント削除確認')
            ->press('削除する')
            ->see('削除しました。');

        // 削除されているかチェックする。
        // $this->assertFalse($this->seeInDatabase('events', ['id' => $id]));
    }
}
