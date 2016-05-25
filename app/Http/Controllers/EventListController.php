<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Event;
use App\Models\Staff;
use App\Models\Circle;
use App\Models\Money;

class EventListController extends Controller {

  public function show() {
    $staff  = new Staff();
    $circle = new Circle();
    $event  = new Event();
    $money  = new Money();

    $events = $event->select();

    foreach ($events as $id) {
      $eventId = $id->id;
      $eventPrice = $id->price;

      $staffCount = $staff->count($eventId);
      $staffCounter[$eventId] = $staffCount;

      $circleCount = $circle->count($eventId);
      $circleCounter[$eventId] = $circleCount;

      $totalMoney = $money->totalMpney($eventId);
      $moneyCounter[$eventId] = $totalMoney;

      $moneyCalc = $money->calculater($totalMoney, $eventPrice);
      $moneyList[$eventId] = $moneyCalc;
    }

    return view('event.list', compact('events', 'staffCounter', 'circleCounter', 'moneyCounter', 'moneyList'));
  }

  public function create() {
    return view('event.create');
  }

  public function insert() {
    $inputs = \Request::all();

    $event = new Event();
    $event->insert($inputs);

    return "登録しました。";
  }

  public function updateConfirm($id) {
    $event = new Event();
    $events = $event->select($id);

    return view('event.update', compact('events'));
  }

  public function update() {
    $inputs = \Request::all();
    $event = new Event();

    $event->updateData($inputs);

    return "更新しました。";
  }

  public function deleteConfirm($id) {
    $event = new Event();
    $events = $event->select($id);

    return view('event.delete', compact('events'));
  }

  public function delete($id) {
    $event = new Event();
    $event->deleteData($id);

    return "削除しました。";
  }
}
