<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
	// 113 リレーショナルDB3
	public function shops(){
		// Routeのモデルと多対多という処理
		return $this->belongsToMany('App\Models\Shop');
	}
}
