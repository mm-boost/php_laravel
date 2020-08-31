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

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
     Route::get('news/create', 'Admin\NewsController@add');
     Route::post('news/create', 'Admin\NewsController@create'); //'middleware' => 'auth'でまとめてリダイレクト設定
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::get('profile/create','Admin\ProfileController@add');
    Route::post('profile/create','Admin\ProfileController@create');
});

Route::group(['prefix' => 'admin','middleware' => 'auth'], function() {
    Route::get('profile/edit','Admin\ProfileController@edit');
    Route::post('profile/edit','Admin\ProfileController@update');
});

//PHP/Laravel 09 Routingについて理解する
/*課題
１.URLとControllerやActionを紐付ける機能を何といいますか？
 Routing  Webアプリケーションで設定したURLにアクセスすると、URLに応じたcontrollerやActionを呼び出せるように設定する機能である
 
2.あなたが考える、group化をすることのメリットを考えてみてください。
 グループ化することで、一度に複数のcontrollerにURLとのrouting設定が行えるから。
 
３.「http://XXXXXX.jp/XXX というアクセスが来たときに、 AAAControllerのbbbというAction に渡すRoutingの設定」を書いてみてください。
Route::get('xxx','Admin\AAAController@bbb');

4.【応用】 前章でAdmin/ProfileControllerを作成し、add Action, edit Actionを追加しました。web.phpを編集して、
           admin/profile/create にアクセスしたら ProfileController の add Action に、
           admin/profile/edit にアクセスしたら ProfileController の edit Action に割り当てるように設定してください。 
上記コードにて追加作成*/



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
