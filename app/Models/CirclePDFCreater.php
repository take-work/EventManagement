<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use DB;

use ZendPdf\PdfDocument;
use ZendPdf\Font;
use ZendPdf\Resource\Extractor;

class CirclePDFCreater extends Model {

    public function pdfCreate($getEvent, $getCircles) {
        $pdfDocument = new PdfDocument();
        $extractor   = new Extractor();

        // PDFのタイトルを設定する。
        $pdfDocument->properties['Title'] = 'サークル一覧';

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

        // イベント情報を記載する。
        $firstPage->drawText($getEvent[0]->name, 128, 717, 'UTF-8');
        $firstPage->drawText($getEvent[0]->startDay, 128, 692, 'UTF-8');
        $firstPage->drawText($getEvent[0]->endDay, 347, 692, 'UTF-8');

        $circleCount = 1;
        $pageCount   = 1;

        $firstY = 624;

        foreach ($getCircles as $circles) {
            if ($circleCount <= 21) {
                $firstPage->setFont($font, 12);

                $firstPage->drawText($circles->number, 60, $firstY, 'UTF-8');
                $firstPage->drawText($circles->space, 130, $firstY, 'UTF-8');
                $firstPage->drawText($circles->circle_name, 250, $firstY, 'UTF-8');
                $firstPage->drawText($circles->host, 400, $firstY, 'UTF-8');

                $firstY = $firstY - 27;

            } else {
                if ($circleCount == 22 || ($circleCount - 21) % 26 == 0) {
                    $secondPage = $pdfDocument->pages[$pageCount];
                    $secondY    = 737;

                    $pageCount++;

                }

                $secondPage->setFont($font, 12);

                $secondPage->drawText($circles->number, 60, $secondY, 'UTF-8');
                $secondPage->drawText($circles->space, 130, $secondY, 'UTF-8');
                $secondPage->drawText($circles->circle_name, 250, $secondY, 'UTF-8');
                $secondPage->drawText($circles->host, 400, $secondY, 'UTF-8');

                $secondY = $secondY - 27;

            }

            $circleCount++;

        }

        // ファイルとして保存し、ブラウザに出力する。
        header ('Content-Type:', 'application/pdf');
        header ('Content-Disposition:', 'inline;');
        echo $pdfDocument->render();

    }

    /*
     * searchCircles テーブルからデータを取得する。
     */
    public function getSearch($id) {
        $searchCircles = DB::table('searchCircles')
            ->where('event_id', $id)
            ->get();

        $getSearch = end($searchCircles);

        return $getSearch;
    }

    /*
     * 検索結果から PDF を出力するために circles テーブルから検索結果を返す
     */
    public function searchCircles($id, $content, $text) {
        $searchCircles = Circle::where('event_id', $id)
            ->where($content, 'like', '%'. $text .'%')
            ->get();

        return $searchCircles;
    }

}
