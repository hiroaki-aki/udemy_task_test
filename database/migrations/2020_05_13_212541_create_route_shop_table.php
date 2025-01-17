<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRouteShopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		// 113 リレーションDB3
        Schema::create('route_shop', function (Blueprint $table) {
			$table->unsignedBigInteger('route_id');
			$table->unsignedBigInteger('shop_id');
			// 以下処理で主キーを2つにできる。
			$table->primary(['route_id','shop_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('route_shop');
    }
}
