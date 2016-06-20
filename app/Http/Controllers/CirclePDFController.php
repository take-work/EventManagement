<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use ZendPdf\PdfDocument;
use ZendPdf\Font;
use ZendPdf\Resource\Extractor;

use App\Models\Event;
use App\Models\Circle;

class CirclePDFController extends Controller {

    public function pdfCreate($id) {
        $pdfDocument = new PdfDocument();
        $extractor   = new Extractor();

        $getEvent   = $this->getEvent($id);
        $getCircles = $this->getCircles($id);

        $fileOne = 'PDF/circleList.pdf';
        $fileTwo = 'PDF/circleListTwo.pdf';

        $circleNumber = count($getCircles);

        $files = [$fileOne];

        for ($pageBorder = 1; $pageBorder < $circleNumber; $pageBorder++) {
            if ($pageBorder == 21 || ($pageBorder - 21) % 25 == 0) {
                /*
                 * サークルデータが21組以上40組以下の場合、2ページ目のPDFを追加する。
                 * 41組目以降は25組毎にPDFのページを追加する。
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

        $font = Font::fontWithPath('fonts/HanaMinA.ttf');

        $firstPage = $pdfDocument->pages[0];
        $firstPage->setFont($font , 18);

        $firstPage->drawText($getEvent[0]->name, 128, 717, 'UTF-8');
        $firstPage->drawText($getEvent[0]->startDay, 128, 692, 'UTF-8');
        $firstPage->drawText($getEvent[0]->endDay, 347, 692, 'UTF-8');

        $circles = $this->getCircles($id);

        // ファイルとして保存、ブラウザに出力
        header ('Content-Type:', 'application/pdf');
        header ('Content-Disposition:', 'inline;');
        echo $pdfDocument->render();
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
