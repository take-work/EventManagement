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

  public function create() {
    return view('event.create');
  }

  public function show() {
    $events = DB::table('events')->get();

    return view('event.list', compact($events));
  }
}
