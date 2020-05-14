<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		// 111 リレーションDB(不動産紹介サイト)
        Schema::create('shops', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('shop_name', 20);
			// areas テーブルのカラム「id」と外部結合する為のカラム
			// Laravelにおいては「unsigned」を付与する必要がある。
			$table->unsignedBigInteger('area_id');
			$table->timestamps();
			// 113 外部キー制限の設定
			$table->foreign('area_id')->references('id')->on('Areas');
			
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
    }
}
