<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\CirclePDFCreator;
use App\Models\Event;
use App\Models\Circle;
use Illuminate\Http\Request;

class CirclePDFController extends Controller {

    public function pdfCreate($id) {
        $circlePDFCreator = new CirclePDFCreator();

        $getEvent   = $this->getEvent($id);
        $getCircles = $this->getCircles($id);

        $circlePDFCreator->pdfCreate($getEvent, $getCircles);
    }

    public function searchPdfCreate(Request $request) {
        $pdfCreator = new CirclePDFCreator();

        $id = $request['saveId'];
        $getEvent  = $this->getEvent($id);
        $getSearchCircles = $this->getSearchCircles($request);

        $pdfCreator->pdfCreate($getEvent, $getSearchCircles);
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

    private function getSearchCircles($request) {
        $circlePDFCreator = new CirclePDFCreator();

        $id = $request['saveId'];
        $content = $request['saveContent'];
        $text = $request['saveText'];

        $searchCircles = $circlePDFCreator->searchCircles($id, $content, $text);

        return $searchCircles;
    }

}
