<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Faker\Factory as Faker;
use App\Models\Staff;

class DatabaseSeeder extends Seeder {
  /**
   * データベース初期値設定実行
   *
   * @return void
   */
  public function run() {
    Model::unguard();

    $this->call('StaffsTableSeeder');

    Model::reguard();
  }
}

class StaffsTableSeeder extends Seeder {

  public function run() {
    $faker = Faker::create('en_US');  // ⑤

    for ($i = 0; $i < 50; $i++) {  // ⑥
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