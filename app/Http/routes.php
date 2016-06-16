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

Route::get('/home', function () {
  return redirect('/list');
});

/*
 * イベント管理に関連するルート
 */

Route::get('/list', [
         'middleware' => 'auth',
         'uses'       => 'EventListController@show'
       ]);
Route::post('/list', 'EventListController@search');

Route::get('/create', [
         'middleware' => 'auth',
         'uses'       => 'EventListController@create'
       ]);
Route::post('/create', 'EventListController@insert');

Route::get('/update/{id}', [
         'middleware' => 'auth',
         'uses'       => 'EventListController@updateConfirm'
       ]);
Route::post('/update/{id}', 'EventListController@update');

Route::get('/delete/{id}', [
         'middleware' => 'auth',
         'uses'       => 'EventListController@deleteConfirm'
       ]);
Route::post('/delete/{id}', 'EventListController@delete');

/*
 * スタッフ管理に関連するルート
 */

Route::get('/staffList/{id}', [
         'middleware' => 'auth',
         'uses'       => 'StaffController@show'
]);
Route::post('/staffList/{id}', 'StaffController@search');

Route::get('/staffCreate/{id}', [
         'middleware' => 'auth',
         'uses'       => 'StaffController@create'
]);
Route::post('/staffCreate/{id}', 'StaffController@insert');

Route::get('/staffUpdate/{id}', [
         'middleware' => 'auth',
         'uses'       => 'StaffController@updateConfirm'
]);
Route::post('/staffUpdate/{id}', 'StaffController@update');

Route::get('/staffDelete/{id}', [
         'middleware' => 'auth',
         'uses'       => 'StaffController@deleteConfirm'
]);

Route::post('/staffDelete/{id}', 'StaffController@delete');

Route::get('/staffPdf/{id}', [
         'middleware' => 'auth',
         'uses'       => 'staffPDFController@pdfCreate'
]);

/*
 * サークル管理に関連するルート
 */

Route::get('/circleList/{id}', [
         'middleware' => 'auth',
         'uses'       => 'CircleController@show'
]);
Route::post('/circleList/{id}', 'CircleControlle@search');

Route::get('/circleCreate/{id}', [
         'middleware' => 'auth',
         'uses'       => 'CircleController@create'
]);
Route::post('/circleCreate/{id}', 'CircleController@insert');

Route::get('/circleUpdate/{id}', [
         'middleware' => 'auth',
         'uses'       => 'CircleController@updateConfirm'
]);
Route::post('/circleUpdate/{id}', 'CircleController@update');

Route::get('/circleDelete/{id}', [
         'middleware' => 'auth',
         'uses'       => 'CircleController@deleteConfirm'
]);
Route::post('/circleDelete/{id}', 'CircleController@delete');

Route::get('/circlePdf/{id}', [
         'middleware' => 'auth',
         'uses'       => 'circlePDFController@pdfCreate'
]);

/*
 * 金額管理に関連するルート
 */
Route::get('/moneyCreate/{id}', [
         'middleware' => 'auth',
         'uses'       => 'MoneyController@create'
]);
Route::post('/moneyCreate/{id}', 'MoneyController@insert');

Route::get('/moneyUpdate/{id}', [
         'middleware' => 'auth',
         'uses'       => 'MoneyController@updateConfirm'
]);
Route::post('/moneyUpdate/{id}', 'MoneyController@update');

/*
 * ログイン認証に関連するルート
 */
Route::get('/auth/login', 'Auth\AuthController@getLogin');
Route::post('/auth/login', 'Auth\AuthController@postLogin');
Route::get('/auth/logout', 'Auth\AuthController@getLogout');

Route::get('/auth/createUser', 'Auth\AuthController@getRegister');
Route::post('/auth/createUser', 'Auth\AuthController@postRegister');

/*
 * パスワード変更に関連するルート
 */
Route::get('/password', 'Auth\PasswordController@getEmail');
Route::post('/password', 'Auth\PasswordController@postEmail');

Route::get('/password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('/password/reset', 'Auth\PasswordController@postReset');
