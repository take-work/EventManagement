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

/*
 * スタッフに関連するルート
 */

Route::get('/staffList/{id}', 'StaffController@show');
Route::get('/staffCreate/{id}', 'StaffController@create');

/*
 * サークルに関連するルート
 */

Route::get('/circleList/{id}', 'CircleController@show');
