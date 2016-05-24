<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use App\Models\Event;

class EventListController extends Controller
{
  public function show() {
    $events = DB::select('select * from events');

    return view('event.list', compact('events'));
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
