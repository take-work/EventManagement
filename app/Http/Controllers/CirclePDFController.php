<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\CirclePDFCreator;
use App\Models\Event;
use App\Models\Circle;

class CirclePDFController extends Controller {

    public function pdfCreate($id) {
        $circlePDFCreator = new CirclePDFCreator();

        $getEvent   = $this->getEvent($id);
        $getCircles = $this->getCircles($id);

        $circlePDFCreator->pdfCreate($getEvent, $getCircles);
    }

    public function searchPdfCreate($id) {
        $pdfCreator = new CirclePDFCreator();

        $getEvent  = $this->getEvent($id);
        $getSearchCircles = $this->getSearchCircles($id);

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

    private function getSearchCircles($id) {
        $circlePDFCreator = new CirclePDFCreator();

        $getSearch = $circlePDFCreator->getSearch($id);
        $content = $getSearch->content;
        $text = $getSearch->text;

        $searchCircles = $circlePDFCreator->searchCircles($id, $content, $text);

        return $searchCircles;
    }

}
