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
 * イベントに関連するルート
 */

Route::get('/list', 'EventListController@show');
Route::get('/create', 'EventListController@create');
Route::post('/create', 'EventListController@insert');

Route::get('/update/{id}', 'EventListController@updateConfirm');
Route::post('/update/{id}', 'EventListController@update');

Route::get('/delete/{id}', 'EventListController@deleteConfirm');
Route::post('/delete/{id}', 'EventListController@delete');

/*
 * スタッフに関連するルート
 */

Route::get('/staffList/{id}', 'StaffController@show');
Route::get('/staffCreate/{id}', 'StaffController@create');
Route::post('/staffCreate/{id}', 'StaffController@insert');

Route::get('/staffUpdate/{id}', 'StaffController@updateConfirm');

/*
 * サークルに関連するルート
 */

Route::get('/circleList/{id}', 'CircleController@show');
Route::get('/circleCreate/{id}', 'CircleController@create');
Route::post('/circleCreate/{id}', 'CircleController@insert');

/*
 * 金額管理に関連するルート
 */
Route::get('/moneyCreate/{id}', 'MoneyController@create');
Route::post('/moneyCreate/{id}', 'MoneyController@insert');
