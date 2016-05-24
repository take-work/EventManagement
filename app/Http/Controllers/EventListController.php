<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use App\Models\Event;
use App\Models\Staff;

class EventListController extends Controller
{
  public function show() {
    $staff = new Staff();
    $events = DB::select('select * from events');

    foreach ($events as $id) {
      $eventId = $id->id;

      $staffCount = $staff->count($eventId);
      $staffCounter[$eventId] = $staffCount;
    }

    return view('event.list', compact('events', 'staffCounter'));
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
}
