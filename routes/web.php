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

// 78 ルーティングテーブルの設定変更
// TestController.php【/app/Http/Controlles/】内のpublic function index()を呼び出している。
// 第一引数のtests/testは【/resources/views/】内のパスを示す。なお、testはtest.blade.phpを示す。
Route::get('tests/test', 'TestController@index');

// 93 お問い合わせフォーム（Restで作成されたもの）
// Route::get('contact/index', 'ContactFormController@index');
// 下記は'contact/index'のcontactをグループ化&要認証とする記載方法
// とてもよく使う方法らしい。
Route::group(['prefix' => 'contact','middleware' => 'auth'],function(){

	// 'prefix' => 'contact'としているので 本来記述が必要なcontact/は不要になる。 
	// なおメソッドチェーンで->name()で名前を付けれる。
	// 名前をつけるとviewファイルやcontrollerファイルから呼び出しやすくなるし管理しやすくなる。
	// 呼出例：<a href="{{ route('contact.index') }}">ほげほげ</a>　みたいな。 
	// 呼出例：view('contact.index');　みたいな。
	Route::get('index', 'ContactFormController@index')->name('contact.index');

	// 96 Createの作成
	//    GET送信の時は/resources/views/contact/create.blade.phpと
	//    /app/http/controllers/ContactFormController.php の index()を紐づける
	//    index()にはview('contact.create')が記載されており、create.blade.phpが表示される。
	Route::get('create', 'ContactFormController@create')->name('contact.create');
	
	// 97 Storeの作成（上記はGET送信時なので、createファイルからのPOST送信時の用意もする。）
	Route::post('store', 'ContactFormController@store')->name('contact.store');

	// 100 DBのデータ取得（個人情報の詳細表示）
	// show/{id}とする事で、show以降に記載されたパラメータのキーから値を取得した状態でcontorollerファイルに引き渡せる。
	// 詳細はContactFormController.php【/app/Http/Controllers/】を確認の事。
	Route::get('show/{id}', 'ContactFormController@show')->name('contact.show');
	
	// 101 DBのデータの更新（個人情報の変更）
	// 上記と同じくedit/{id}とする事で、edit以降に記載されたパラメータのキーから値を取得した状態でcontorollerファイルに引き渡せる。
	// 詳細はContactFormController.php【/app/Http/Controllers/】を確認の事。
	Route::get('edit/{id}', 'ContactFormController@edit')->name('contact.edit');

	// 102 DBのデータの更新（個人情報の変更）
	// 上記と同じくupdate/{id}とする事で、edit以降に記載されたパラメータのキーから値を取得した状態でcontorollerファイルに引き渡せる。
	// 詳細はContactFormController.php【/app/Http/Controllers/】を確認の事。
	// 今回はPOST送信なのでPOSTを設定
	Route::post('update/{id}', 'ContactFormController@update')->name('contact.update');

	// 103 DBのデータの更新（個人情報の変更）
	// 上記と同じくdestroy/{id}とする事で、edit以降に記載されたパラメータのキーから値を取得した状態でcontorollerファイルに引き渡せる。
	// 詳細はContactFormController.php【/app/Http/Controllers/】を確認の事。
	// 今回はPOST送信なのでPOSTを設定
	Route::post('destroy/{id}', 'ContactFormController@destroy')->name('contact.destroy');
});

// 92 リソースコントローラーのルーティング設定変更
// リソースコントローラはデフォルトで７つのメソッドが設定されるが、
// 下記コードでルーティングするメソッドを指定する事ができる。
// Route::resource('contacts', 'ContactFormController')->only([
// 	'index', 'show'
// ]);

// 87 ララベルUIよりインストールして自動で追記された内容
// 下記は認証関連のUI
Auth::routes();



// 112 リレーショナルDB2
Route::get('shops/index', 'shopController@index');



// デフォルトで記載されている処理。
// Laravelのトップページに繋がる。
Route::get('/home', 'HomeController@index')->name('home');

