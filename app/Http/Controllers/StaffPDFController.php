<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\StaffPDFCreater;
use App\Models\Event;
use App\Models\Staff;

class StaffPDFController extends Controller {

    public function pdfCreate($id) {
        $pdfCreater = new StaffPDFCreater();

        $getEvent  = $this->getEvent($id);
        $getStaffs = $this->getStaffs($id);

        $pdfCreater->pdfCreate($getEvent, $getStaffs);
    }

    public function searchPdfCreate($id) {
        $pdfCreater = new StaffPDFCreater();

        $getEvent  = $this->getEvent($id);
        $getSearchStaffs = $this->getSearchStaffs($id);

        $pdfCreater->pdfCreate($getEvent, $getSearchStaffs);
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
        $staffPDFCreater = new StaffPDFCreater();

        $getSearch = $staffPDFCreater->getSearch($id);
        $content = $getSearch->content;
        $text = $getSearch->text;

        $searchStaffs = $staffPDFCreater->searchStaffs($id, $content, $text);

        return $searchStaffs;
    }

}
