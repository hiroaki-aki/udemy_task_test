<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 112 リレーショナルDB2
// DB操作を行うので、Modelクラスをインポートする。
use App\Models\Shop;
use App\Models\Area;

class ShopController extends Controller
{
	// 112 リレーショナルDB2
	public function index(){
		// 主 -> 従
		// これはAreaモデルファイル（/app/Models/Area.php）内のshops()メソッドを呼び出している。
		$area = Area::find(1)->shops;

		// 主 <- 従
		// これはShopモデルファイル（/app/Models/Shop.php）内のarea()メソッドを呼び出している。
		// ついでにarea()メソッドにnameを渡しており、nameカラムを取ってこれる。
		// 要は、ここで記載しなくても勝手に外部結合してくれている。
		$shop = Shop::find(3)->area->name;
		//dd($shop);

		// 113 リレーショナル4
		$route = Shop::find(1)->routes()->get();
		dd($route);
		
	}
}
