<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use ZendPdf\PdfDocument;
use ZendPdf\Font;
use ZendPdf\Page;

use DB;
use App\Models\Event;

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

  public function getEvent($id) {
    $event = new Event();
    $getEvent = $event->select($id);

    return $getEvent;
  }

  public function getCircles($id) {
    $circles = DB::select('select * from circles where event_id = '. $id);

    return $circles;
  }

}
