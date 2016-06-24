<?php

use App\User;
use DB;

class StaffTest extends TestCase {
    /*
     * 最初にログインする。
     */
    public function setUp() {
        parent::setUp();

        $user = new User(['user' => 'take']);
        $this->be($user);
    }

    /*
     * /staffList にアクセスするとスタッフ一覧ページが開く。
     */
    public function testStaffListAccess() {
        $query = DB::table('events')->get();
        $id = $query[0]->id;

        $this
            ->visit('/staffList/'.$id)
            ->see('スタッフ一覧');
    }

    /*
     * スタッフを新規登録できる。
     */
    public function testStaffCreate() {
        // スタッフ名を生成する。
        $faker = Faker\Factory::create('ja_JP');
        $staffName = $faker->unique()->name;

        $query = DB::table('events')->get();
        $id = $query[0]->id;

        $this
            ->visit('/staffCreate/'.$id)
            ->see('スタッフ情報入力')
            ->type($staffName, 'staffName')
            ->type('担当/持ち場', 'position')
            ->type('aaa@example.co.jp', 'mail')
            ->type('000-0000-0000', 'tel')
            ->type('twitter', 'twitter')
            ->select('1', 'experience')
            ->select('1', 'rank')
            ->press('登録する')
            ->see('新スタッフ「'.$staffName.'」さんを新規登録しました。');

        // faker で生成されたスタッフ名が正しくデータベースに登録されているかチェックする。
        $this
            ->seeInDatabase('staffs', ['name' => $staffName]);
    }

}
