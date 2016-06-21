<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use ZendPdf\PdfDocument;
use ZendPdf\Font;
use ZendPdf\Resource\Extractor;

use App\Models\Event;
use App\Models\Staff;

class StaffPDFController extends Controller {

    public function pdfCreate($id) {
        $pdfDocument = new PdfDocument();
        $extractor   = new Extractor();

        // PDFのタイトルを設定する。
        $pdfDocument->properties['Title'] = 'スタッフ一覧';

        $getEvent  = $this->getEvent($id);
        $getStaffs = $this->getStaffs($id);

        $fileOne = 'PDF/staffList.pdf';
        $fileTwo = 'PDF/staffListTwo.pdf';

        $staffNumber = count($getStaffs);

        $files = [$fileOne];

        for ($pageBorder = 1; $pageBorder < $staffNumber; $pageBorder++) {
            if ($pageBorder == 12 || ($pageBorder - 12) % 14 == 0) {
                /*
                 * スタッフデータが12人以上26人以下の場合、2ページ目のPDFを追加する。
                 * 27人目以降は14人毎にPDFのページを追加する。
                 */

                $files[] = $fileTwo;
            }
        }

        foreach ($files as $file) {
            $pdf = PdfDocument::load($file);

            foreach ($pdf->pages as $page) {
                $pdfExtract = $extractor->clonePage($page);
                $pdfDocument->pages[] = $pdfExtract;
            }
        }

        $font  = Font::fontWithPath('fonts/HanaMinA.ttf');

        $firstPage = $pdfDocument->pages[0];
        $firstPage->setFont($font , 18);

        // イベント情報を記載する。
        $firstPage->drawText($getEvent[0]->name, 150, 458, 'UTF-8');
        $firstPage->drawText($getEvent[0]->startDay, 150, 432, 'UTF-8');
        $firstPage->drawText($getEvent[0]->endDay, 415, 432, 'UTF-8');

        $staffCount = 1;
        $pageCount  = 1;

        $firstY  = 345;

        foreach ($getStaffs as $staff) {
            if ($staffCount <= 11) {
                $firstPage->setFont($font , 12);

                $firstPage->drawText($staff->name, 80, $firstY, 'UTF-8');
                $firstPage->drawText($staff->position, 215, $firstY, 'UTF-8');

                $firstPage->setFont($font , 8);

                $firstPage->drawText($staff->mail, 370, $firstY, 'UTF-8');
                $firstPage->drawText($staff->tel, 535, $firstY, 'UTF-8');
                $firstPage->drawText($staff->twitter, 620, $firstY, 'UTF-8');

                if ($staffCount == 5) {
                    $firstY = 238;
                }

                $firstY = $firstY - 28;
            } else {
                if ($staffCount == 12 || ($staffCount - 12) % 14 == 0) {
                    $secondPage = $pdfDocument->pages[$pageCount];
                    $secondY    = 495;

                    $pageCount++;
                }

                $secondPage->setFont($font, 12);

                $secondPage->drawText($staff->name, 80, $secondY, 'UTF-8');
                $secondPage->drawText($staff->position, 215, $secondY, 'UTF-8');

                $secondPage->setFont($font, 8);

                $secondPage->drawText($staff->mail, 370, $secondY, 'UTF-8');
                $secondPage->drawText($staff->tel, 535, $secondY, 'UTF-8');
                $secondPage->drawText($staff->twitter, 620, $secondY, 'UTF-8');

                $secondY = $secondY - 31;
            }

            $staffCount++;

        }

        // ファイルとして保存、ブラウザに出力する。
        header ('Content-Type:', 'application/pdf');
        header ('Content-Disposition:', 'inline;');
        echo $pdfDocument->render();
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

}
