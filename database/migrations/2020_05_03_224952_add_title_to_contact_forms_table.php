<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleToContactFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		// 補足 マイグレーションの追加で作成されたファイル。
		Schema::table('contact_forms', function($table){
			$table->string('title',50)->after('your_name');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contact_forms', function (Blueprint $table) {
			// 補足 rollbackするときはここに書いといて、ターミナルでrollbackを行う。
			//$table->dropColumn('title');
        });
    }
}
