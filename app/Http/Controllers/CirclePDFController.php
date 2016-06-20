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
        $pdf = new PdfDocument();

        // 1ページ目のPDF
        $pdf = PdfDocument::load('PDF/circleList.pdf');
        $firstPage = $pdf->pages[0];

        $font = Font::fontWithPath('fonts/HanaMinA.ttf');

        // フォントと文字のサイズを指定
        $firstPage->setFont($font , 18);

        // 出力する文字と位置、文字コードの指定
        $getEvent = $this->getEvent($id);
        $firstPage->drawText($getEvent[0]->name, 128, 717, 'UTF-8');
        $firstPage->drawText($getEvent[0]->startDay, 128, 692, 'UTF-8');
        $firstPage->drawText($getEvent[0]->endDay, 347, 692, 'UTF-8');

        $circles = $this->getCircles($id);

        // ファイルとして保存、ブラウザに出力
        header ('Content-Type:', 'application/pdf');
        header ('Content-Disposition:', 'inline;');
        echo $pdf->render();
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
