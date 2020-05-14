<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
	// 112 リレーショナルDB2
	public function area(){
		// Areaのモデルに従属しているという処理
		return $this->belongsTo('App\Models\Area');
	}
	// 113 リレーショナルDB3
	public function routes(){
		// Routeのモデルと多対多という処理
		return $this->belongsToMany('App\Models\Route');
	}
}
