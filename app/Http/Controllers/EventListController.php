<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EventListController extends Controller
{
  public function events() {
    return view('events/eventList');
  }

}
