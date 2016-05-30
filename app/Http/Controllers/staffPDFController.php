<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use ZendPdf\PdfDocument;
use ZendPdf\Font;
use ZendPdf\Page;

use App\Models\Event;

class staffPDFController extends Controller {

  public function pdfCreate($id) {
    $pdf = new PdfDocument();

    // 1ページ目のPDF
    $pdf = PdfDocument::load('PDF/staffList.pdf');
    $firstPage = $pdf->pages[0];

    $font = Font::fontWithPath('fonts/HanaMinA.ttf');

    // フォントと文字のサイズを指定
    $firstPage->setFont($font , 18);

    // 出力する文字と位置、文字コードの指定
    $getEvent = $this->getEvent($id);
    $firstPage->drawText($getEvent[0]->name, 150, 680, 'UTF-8');
    $firstPage->drawText($getEvent[0]->startDay, 150, 655, 'UTF-8');
    $firstPage->drawText($getEvent[0]->endDay, 369, 655, 'UTF-8');

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

}