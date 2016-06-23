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
     * /staffList にアクセスするとスタッフ一覧ページが開く。
     */
    public function testCircleListAccess() {
        $this
            ->visit('/circleList/8')
            ->see('サークル一覧');
    }
}
