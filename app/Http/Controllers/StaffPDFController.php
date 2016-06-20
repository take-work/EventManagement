<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use ZendPdf\PdfDocument;
use ZendPdf\Font;
use ZendPdf\Resource\Extractor;

use App\Models\Event;
use DB;

class StaffPDFController extends Controller {

    public function pdfCreate($id) {
        $pdfDocument = new PdfDocument();
        $extractor = new Extractor();

        // 1ページ目のPDF
        $files = ['PDF/staffList.pdf', 'PDF/staffListTwo.pdf'];

        foreach ($files as $file) {
            $pdf = PdfDocument::load($file);

            foreach ($pdf->pages as $page) {
                $pdfExtract = $extractor->clonePage($page);
                $pdfDocument->pages[] = $pdfExtract;
            }
        }

        $firstPage = $pdfDocument->pages[0];
        $secondPage = $pdfDocument->pages[1];

        $font = Font::fontWithPath('fonts/HanaMinA.ttf');

        $firstPage->setFont($font , 18);
        $secondPage->setFont($font, 18);

        // 出力する文字と位置、文字コードの指定
        $getEvent = $this->getEvent($id);
        $firstPage->drawText($getEvent[0]->name, 150, 458, 'UTF-8');
        $firstPage->drawText($getEvent[0]->startDay, 150, 432, 'UTF-8');
        $firstPage->drawText($getEvent[0]->endDay, 415, 432, 'UTF-8');

        $staffs = $this->getStaffs($id);

        $y = 345;
        $staffCount = 0;

        foreach ($staffs as $staff) {
            $firstPage->setFont($font , 12);

            $firstPage->drawText($staff->name, 80, $y, 'UTF-8');
            $firstPage->drawText($staff->position, 215, $y, 'UTF-8');

            $firstPage->setFont($font , 8);

            $firstPage->drawText($staff->mail, 370, $y, 'UTF-8');
            $firstPage->drawText($staff->tel, 535, $y, 'UTF-8');
            $firstPage->drawText($staff->twitter, 620, $y, 'UTF-8');

            $y = $y - 28;
            $staffCount++;

            if ($staffCount == 11) {
                $y = 345;
            }

            if ($staffCount >= 11) {
                $secondPage->drawText($staff->name, 80, $y, 'UTF-8');
            }
        }

        // ファイルとして保存、ブラウザに出力
        header ('Content-Type:', 'application/pdf');
        header ('Content-Disposition:', 'inline;');
        echo $pdfDocument->render();
    }

    public function getEvent($id) {
        $event = new Event();
        $getEvent = $event->select($id);

        return $getEvent;
    }

    public function getStaffs($id) {
        $staffs = DB::select('select * from staffs where event_id = '. $id);

        return $staffs;
    }

}
