<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

// 右上のロゴを押すときのあれ
Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware'=>['auth', 'can:admin-higher'], 'namespace' => 'Admin', 'as' => 'admin::'], function(){
    Route::get('zonecodes', 'ZonecodesController@index')->name('zonecodes');
    Route::post('zonecodes/upload', 'ZonecodesController@upload')->name('zonecodes.upload');
    Route::get('zonecodes/download', 'ZonecodesController@download')->name('zonecodes.download');

    Route::get('skutransfers', 'SkutransfersController@index')->name('skutransfers');
    Route::post('skutransfers/upload', 'SkutransfersController@upload')->name('skutransfers.upload');
    Route::get('skutransfers/download', 'SkutransfersController@download')->name('skutransfers.download');

    Route::get('ordersheets', 'OrdersheetsController@index')->name('ordersheets');
    Route::post('ordersheets/upload', 'OrdersheetsController@upload')->name('ordersheets.upload');
    Route::get('ordersheets/download', 'OrdersheetsController@download')->name('ordersheets.download');
    Route::get('ordersheets/deletelines', 'OrdersheetsController@deletelines')->name('ordersheets.deletelines');
});


Route::group(['prefix' => '', 'middleware'=>['auth', 'can:admin-higher'], 'namespace' => 'Work', 'as' => 'work::'], function(){
    Route::get('/work', 'WorkController@index')->name('work');
    Route::get('work/greet', 'WorkController@greet')->name('work.greet');
});




/*
// 全ユーザー
Route::group(['middleware'=>['auth', 'can:user-higher']], function(){
    // ユーザ一覧
    Route::get('/account', 'AccountController@index')->name('account.index');
});

// 管理者以上
Route::group(['middleware' => ['auth', 'can:admin-higher']], function(){
    // ユーザ登録
    Route::get('/account/regist', 'AccountController@regist')->name('account.regist');
    Route::post('/account/regist', 'AccountController@createData')->name('account.regist');

    // ユーザ編集
    Route::get('/account/edit/{user_id}', 'AccountController@edit')->name('account.edit');
    Route::post('/account/edit/{user_id}', 'AccountController@edit')->name('account.edit');
});


Route::group(['middleware' => ['auth', 'can:system-only']],function(){
    // ユーザ削除
    Route::post('/account/delete/{user_id}', 'AccountController@deleteData');
});
*/