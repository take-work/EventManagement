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

	/**
     * /list にアクセスするとイベント一覧ページが開く。
     *
     * @return void
     */
    public function testListAccess() {
        $this->visit('/list')
            ->see('イベント一覧');
    }
}
