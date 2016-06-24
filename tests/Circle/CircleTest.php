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
        $this
            ->visit('/circleList/8')
            ->see('サークル一覧');
    }

    /*
     * サークルを新規登録できる。
     */
    public function testCircleCreate() {
        $faker = Faker\Factory::create('ja_JP');
        $name = $faker->unique()->name;

        $query = DB::table('events')->get();
        $id = $query[0]->id;

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

        $query = DB::table('circles')->get();
        $id = $query[0]->id;

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

}
