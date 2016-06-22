<?php

class EventTest extends TestCase {
    /**
     * /list にアクセスするとイベント一覧ページが開く。
     *
     * @return void
     */
    public function testBasicExample() {
        $this->visit('/')
            ->see('ログイン画面');
    }
}
