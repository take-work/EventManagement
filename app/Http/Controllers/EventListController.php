<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Event;
use App\Models\Staff;
use App\Models\Circle;

class EventListController extends Controller {

  public function show() {
    $staff = new Staff();
    $circle = new Circle();
    $event = new Event();

    $events = $event->select();

    foreach ($events as $id) {
      $eventId = $id->id;

      $staffCount = $staff->count($eventId);
      $staffCounter[$eventId] = $staffCount;

      $circleCount = $circle->count($eventId);
      $circleCounter[$eventId] = $circleCount;
    }

    return view('event.list', compact('events', 'staffCounter', 'circleCounter'));
  }

  public function create() {
    return view('event.create');
  }

  public function insert() {
    $inputs = \Request::all();

    $inserts = new Event();
    $inserts->insert($inputs);

    return "登録しました。";
  }

  public function updateConfirm($id) {
    $event = new Event();

    $events = $event->select($id);
    return view('event.update', compact('events'));
  }

  public function update() {
    $inputs = \Request::all();

    $updates = new Event();
    $updates->updateData($inputs);

    return "更新しました。";
  }
}
