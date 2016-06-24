<?php

use App\User;

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
        $id = $this->eventIdGet();

        $this
            ->visit('/staffList/'.$id)
            ->see('スタッフ一覧');
    }

    /*
     * スタッフを新規登録できる。
     */
    public function testStaffCreate() {
        $staffName = $this->createStaffName();

        $id = $this->eventIdGet();

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

    /*
     * スタッフ情報を更新できる。
     */
    public function testStaffUpdate() {
        $staffName = $this->createStaffName();

        list($id, $name) = $this->staffDataGet();

        $this
            ->visit('/staffUpdate/'.$id)
            ->see('スタッフ編集')
            ->type($staffName, 'staffName')
            ->type('担当/持ち場', 'position')
            ->type('aaa@example.co.jp', 'mail')
            ->type('000-0000-0000', 'tel')
            ->type('twitter', 'twitter')
            ->select('1', 'experience')
            ->select('1', 'rank')
            ->press('変更する')
            ->see($staffName.'さんの情報を更新しました。');

        // faker で生成されたスタッフ名が正しくデータベースに登録されているかチェックする。
        $this
        ->seeInDatabase('staffs', ['name' => $staffName]);
    }

    /*
     * スタッフデータを削除できる。
     */
    public function testStaffDelete() {
        list($id, $name) = $this->staffDataGet();

        // スタッフ情報を削除する。
        $this
            ->visit('/staffDelete/'.$id)
            ->see('スタッフ削除確認')
            ->press('削除する')
            ->see($name.'さんの情報を削除しました。');

       // データが削除されているかチェックする。
       $search = DB::table('staffs')
            ->where('id', $id)
            ->get();

       $this
            ->assertEmpty($search);
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
     * テストで使用するスタッフのデータを取得する。
     */
    private function staffDataGet() {
       $query = DB::table('staffs')->get();

       $id    = $query[0]->id;
       $name  = $query[0]->name;

       $staffData = [$id, $name];

       return $staffData;
    }

    /*
     * faker でスタッフ名を生成する。
     */
    private function createStaffName() {
        $faker = Faker\Factory::create('ja_JP');
        $staffName = $faker->unique()->name;

        return $staffName;
    }

}
