<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\StaffPDFCreator;
use App\Models\Event;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffPDFController extends Controller {

    public function pdfCreate($id) {
        $pdfCreator = new StaffPDFCreator();

        $getEvent  = $this->getEvent($id);
        $getStaffs = $this->getStaffs($id);

        $pdfCreator->pdfCreate($getEvent, $getStaffs);
    }

    public function searchPdfCreate(Request $request) {
        $pdfCreator = new StaffPDFCreator();

        $id        = $request['saveId'];
        $getEvent  = $this->getEvent($id);
        $getSearchStaffs = $this->getSearchStaffs($request);

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

    private function getSearchStaffs($request) {
        $staffPDFCreator = new StaffPDFCreator();

        $id      = $request['saveId'];
        $content = $request['saveContent'];
        $text    = $request['saveText'];

        $searchStaffs = $staffPDFCreator->searchStaffs($id, $content, $text);

        return $searchStaffs;
    }

}
