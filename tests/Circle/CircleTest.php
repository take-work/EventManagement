<?php

use App\User;

class CircleTest extends TestCase {
    /*
     * 最初にログインする。
     */
    public function setUp() {
        parent::setUp();

        $user = new User(['user' => 'take']);
        $this->be($user);
    }

    /*
     * /circleList にアクセスするとサークル一覧ページが開く。
     */
    public function testCircleListAccess() {
        $id = $this->eventIdGet();

        $this
            ->visit('/circleList/'.$id)
            ->see('サークル一覧');
    }

    /*
     * サークルを新規登録できる。
     */
    public function testCircleCreate() {
        $faker = Faker\Factory::create('ja_JP');
        $name = $faker->unique()->name;

        $id = $this->eventIdGet();

        $this
            ->visit('/circleCreate/'.$id)
            ->see('サークル情報入力')
            ->type('a-1', 'number')
            ->type('a-2', 'space')
            ->type('Aquars', 'circleName')
            ->type($name, 'circleLeader')
            ->type('1', 'staff')
            ->type('1', 'desk')
            ->type('1', 'chair')
            ->press('登録する')
            ->see('新サークル「Aquars」を新規登録しました。');

        // faker で生成された代表名が正しくデータベースに登録されているかチェックする。
        $this
            ->seeInDatabase('circles', ['host' => $name]);
    }

    /*
     * サークル情報を編集できる。
     */
    public function testCircleUpdate() {
        $faker = Faker\Factory::create('ja_JP');
        $name = $faker->unique()->name;

        list($id, $circleName) = $this->circleDataGet();

        $this
            ->visit('/circleUpdate/'.$id)
            ->see('サークル編集')
            ->type('a-1', 'number')
            ->type('a-2', 'space')
            ->type('Aquars', 'circleName')
            ->type($name, 'circleLeader')
            ->type('1', 'staff')
            ->type('1', 'desk')
            ->type('1', 'chair')
            ->press('更新する')
            ->see('Aquarsの情報を更新しました。');

        // faker で生成された代表者名が正しくデータベースに登録されているかチェックする。
        $this
            ->seeInDatabase('circles', ['host' => $name]);
    }

    /*
     * サークルを削除できる。
     */
    public function testCircleDelete() {
        list($id, $circleName) = $this->circleDataGet();

        // スタッフ情報を削除する。
        $this
            ->visit('/circleDelete/'.$id)
            ->see('サークル削除確認')
            ->press('削除する')
            ->see($circleName.'の情報を削除しました。');

        // データが削除されているかチェックする。
        $search = DB::table('circles')
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
     * テストで使用するサークルのデータを取得する。
     */
    private function circleDataGet() {
        $query = DB::table('circles')->get();

        $id          = $query[0]->id;
        $circleName  = $query[0]->circle_name;

        $circleData = [$id, $circleName];

        return $circleData;
    }

}
