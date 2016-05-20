<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use App\Event;

class EventListController extends Controller
{
  public function events() {
    return view('event.eventList');
  }

  public function show() {
    $events = DB::select('select * from events');

    return view('event.list', compact('events'));
  }

  public function create() {
    return view('event.create');
  }

  public function insert() {
    $inputs = \Request::all();

    $startDay = $inputs['startYear'] .'/'.$inputs['startMonth'].'/'.$inputs['startDay'];
    $endDay = $inputs['endYear'] .'/'.$inputs['endMonth'].'/'.$inputs['endDay'];

    $now = date("Y-m-d");

    DB::table('events')->insert([
      'name' => $inputs['eventName'],
      'host' => $inputs['host'],
      'price' => $inputs['price'],
      'startDay' => $startDay,
      'endDay' => $endDay,
      'updated_at' => $now,
      'created_at' => $now
    ]);

    return "登録しました。";
  }
}
