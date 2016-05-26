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

  public function insert(Request $request) {
    $event = new Event();

    $rules = $this->validationRules();
    $this->validate($request, $rules);

    $event->insert($request);

    \Session::flash('flash_message', '新イベント「'. $request['eventName'] .'」を新規登録しました。');
    return redirect('/list');
  }

  public function updateConfirm($id) {
    $event = new Event();
    $events = $event->select($id);

    return view('event.update', compact('events'));
  }

  public function update(Request $request) {
    $event = new Event();

    $rules = $this->validationRules();
    $this->validate($request, $rules);

    $event->updateData($request);

    \Session::flash('flash_message', $request['eventName'] .'の情報を更新しました。');
    return redirect('/list');
  }

  public function deleteConfirm($id) {
    $event = new Event();
    $events = $event->select($id);

    return view('event.delete', compact('events'));
  }

  public function delete($id) {
    $event = new Event();

    $events = $event->select($id);
    $name = $events[0]->name;

    $event->deleteData($id);

    \Session::flash('flash_message', $name .'を削除しました。');
    return redirect('/list');
  }

  public function validationRules() {
    $rules = [
      'startDay'  => 'required',
      'endDay'    => 'required',
      'eventName' => 'required',
      'host'      => 'required',
      'price'     => 'required | integer'
    ];

    return $rules;
  }
}
