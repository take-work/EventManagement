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
        $this
            ->visit('/staffList/8')
            ->see('スタッフ一覧');
    }
}
