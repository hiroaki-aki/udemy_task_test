<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
	// 112 リレーショナルDB2
	// 親テーブルとか子テーブルの設定を行う。
	// 今回はAreaが親、Shopが子という関係。
	// メソッドの買い方は以下の公式参照
	// https://readouble.com/laravel/6.x/ja/eloquent-relationships.html#one-to-many
	public function shops(){
		return $this->hasMany('App\Models\Shop');
	}
}
