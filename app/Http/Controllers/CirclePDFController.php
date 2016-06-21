<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\CirclePDFCreater;
use App\Models\Event;
use App\Models\Circle;

class CirclePDFController extends Controller {

    public function pdfCreate($id) {
        $circlePDFCreater = new CirclePDFCreater();

        $getEvent   = $this->getEvent($id);
        $getCircles = $this->getCircles($id);

        $circlePDFCreater->pdfCreate($getEvent, $getCircles);
    }

    private function getEvent($id) {
        $event = new Event();

        $getEvent = $event->select($id);

        return $getEvent;
    }

    private function getCircles($id) {
        $circles = new Circle();

        $getCircle = $circles->allSelect($id);

        return $getCircle;
    }

}
