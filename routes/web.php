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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

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