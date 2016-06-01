<?php

/*
|--------------------------------------------------------------------------
| アプリケーションのルート
|--------------------------------------------------------------------------
|
| ここでアプリケーションのルートを全て登録することが可能です。
| 簡単です。ただ、Laravelへ対応するURIと、そのURIがリクエスト
| されたときに呼び出されるコントローラーを指定してください。
|
*/

Route::get('/', function () {
    return redirect('/list');
});

/*
 * イベント管理に関連するルート
 */

Route::get('/list', 'EventListController@show');
Route::get('/create', 'EventListController@create');
Route::post('/create', 'EventListController@insert');

Route::get('/update/{id}', 'EventListController@updateConfirm');
Route::post('/update/{id}', 'EventListController@update');

Route::get('/delete/{id}', 'EventListController@deleteConfirm');
Route::post('/delete/{id}', 'EventListController@delete');

/*
 * スタッフ管理に関連するルート
 */

Route::get('/staffList/{id}', 'StaffController@show');
Route::get('/staffCreate/{id}', 'StaffController@create');
Route::post('/staffCreate/{id}', 'StaffController@insert');

Route::get('/staffUpdate/{id}', 'StaffController@updateConfirm');
Route::post('/staffUpdate/{id}', 'StaffController@update');

Route::get('/staffDelete/{id}', 'StaffController@deleteConfirm');
Route::post('/staffDelete/{id}', 'StaffController@delete');

Route::get('/staffPdf/{id}','staffPDFController@pdfCreate');

/*
 * サークル管理に関連するルート
 */

Route::get('/circleList/{id}', 'CircleController@show');
Route::get('/circleCreate/{id}', 'CircleController@create');
Route::post('/circleCreate/{id}', 'CircleController@insert');

Route::get('/circleUpdate/{id}', 'CircleController@updateConfirm');
Route::post('/circleUpdate/{id}', 'CircleController@update');

Route::get('/circleDelete/{id}', 'CircleController@deleteConfirm');
Route::post('/circleDelete/{id}', 'CircleController@delete');

Route::get('/circlePdf/{id}','circlePDFController@pdfCreate');

/*
 * 金額管理に関連するルート
 */
Route::get('/moneyCreate/{id}', 'MoneyController@create');
Route::post('/moneyCreate/{id}', 'MoneyController@insert');

Route::get('/moneyUpdate/{id}', 'MoneyController@updateConfirm');
Route::post('/moneyUpdate/{id}', 'MoneyController@update');

/*
 * ログイン認証に関連するルート
 */
Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@getLogout');

Route::get('/register', 'Auth\AuthController@getRegister');
Route::post('/register', 'Auth\AuthController@postRegister');
