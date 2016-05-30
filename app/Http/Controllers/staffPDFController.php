<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//ZendPdfをインポート
use ZendPdf\PdfDocument;
use ZendPdf\Font;
use ZendPdf\Page;

class staffPDFController extends Controller {

  public function pdfCreate() {
    $pdf = new PdfDocument();

    // 1ページ目のPDF
    $pdf = PdfDocument::load('PDF/staffList.pdf');
    $firstPage = $pdf->pages[0];

    $font = Font::fontWithPath('fonts/HanaMinA.ttf');

    // フォントと文字のサイズを指定
    $firstPage->setFont($font , 24);

    // 出力する文字と位置、文字コードの指定
    $firstPage->drawText("テスト", 100, 600, 'UTF-8');

    // ファイルとして保存、ブラウザに出力
    header ('Content-Type:', 'application/pdf');
    header ('Content-Disposition:', 'inline;');
    echo $pdf->render();
  }

}