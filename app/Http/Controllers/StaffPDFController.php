<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\StaffPDFCreator;
use App\Models\Event;
use App\Models\Staff;

class StaffPDFController extends Controller {

    public function pdfCreate($id) {
        $pdfCreator = new StaffPDFCreator();

        $getEvent  = $this->getEvent($id);
        $getStaffs = $this->getStaffs($id);

        $pdfCreator->pdfCreate($getEvent, $getStaffs);
    }

    public function searchPdfCreate($id) {
        $pdfCreator = new StaffPDFCreator();

        $getEvent  = $this->getEvent($id);
        $getSearchStaffs = $this->getSearchStaffs($id);

        $pdfCreator->pdfCreate($getEvent, $getSearchStaffs);
    }

    private function getEvent($id) {
        $event = new Event();

        $getEvent = $event->select($id);

        return $getEvent;
    }

    private function getStaffs($id) {
        $staffs = new Staff();

        $getStaffs = $staffs->allSelect($id);

        return $getStaffs;
    }

    private function getSearchStaffs($id) {
        $staffPDFCreator = new StaffPDFCreator();

        $getSearch = $staffPDFCreator->getSearch($id);
        $content = $getSearch->content;
        $text = $getSearch->text;

        $searchStaffs = $staffPDFCreator->searchStaffs($id, $content, $text);

        return $searchStaffs;
    }

}
