<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Models\Staff;
use App\Models\Circle;

class DatabaseSeeder extends Seeder {
  /**
   * データベース初期値設定実行
   *
   * @return void
   */
  public function run() {
    Model::unguard();

    // $this->call('StaffsTableSeeder');
    $this->call('CirclesTableSeeder');

    Model::reguard();
  }
}

class StaffsTableSeeder extends Seeder {

  public function run() {
    for ($i = 0; $i < 50; $i++) {
      Staff::create([
        'event_id'   => '2',
        'name'       => '凛ちゃん',
        'position'   => 'Hello,星を数えて',
        'mail'       => 'Rinchan@example.com',
        'tel'        => '000-1111-2222',
        'twitter'    => 'rippi',
        'experience' => '1',
        'rank'       => '3'
      ]);
    }
  }
}

class CirclesTableSeeder extends Seeder {

  public function run() {
    for ($i = 0; $i < 50; $i++) {
      Circle::create([
        'event_id'    => '1',
        'number'      => 'あ-A',
        'space'       => '北エリア',
        'circle_name' => '恋のシグナル',
        'host'        => 'RinRinRin',
        'staff'       => '1',
        'desk'        => '1',
        'chair'       => '1'
      ]);
    }
  }

}