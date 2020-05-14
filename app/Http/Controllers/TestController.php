<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
// 82 クエリビルダー
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
	// 78 MVCの設定と理解
	public function index(){
		// tests : /resources/views/配下のディレクリ名
		// test  : 上記フォルダ内でのViewファイル名
		//			正式ファイル名は test.blade.php【/resources/views/tests/】
		//			viewファイルの作成には.bladeを記載する必要がある。
		// view('tests.test');は上記ディレクト下のファイルを表示するという処理。
		
		// 79 MVCの記載２
		// DBからTestテーブルの中身を全部取得してくる。
		// 行ごとに配列を１つづつ作成し、実際の内容はattributesに格納される。
		$values = Test::all();

		// 82 クエリビルダー
		// testsはテーブル名、DB::table('tests')->のあとはメソッドチェーンも可能。最後は->get();
		// DB::raw()ってやると生SQL文も使える。ただしSQLインジェクションは自分で設定しないといけない。
		$tests = DB::table('tests')->get();
		// idだけを取得してくるというSQL文（他にも->where('id=',1) , ->groupBy('id=',1) , なども使用できる。）
		$tests = DB::table('tests')
		->select('id')
		->get();

		// dd die+var_dump()をくっつけたヘルパー関数 
		dd($tests);

		// compact('変数名($なし)')って書くと、指定のviewファイルでの$変数名の宣言、値の代入ができる。
		// 当該ファイルで使用した変数をviewファイル（test.blade.php【/resources/views/tests/】）内に受け渡す事ができる。
		return view('tests.test', compact('values'));
	}
}
