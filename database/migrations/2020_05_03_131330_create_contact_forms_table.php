<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		// 90 DB名は複数形かつ全部小文字（大文字は認識しない事がある）
        Schema::create('contact_forms', function (Blueprint $table) {
			$table->bigIncrements('id');
			// 90 氏名、メルアド、URL、性別、年齢、問合せ内容のDBカラムを追加
			$table->string('your_name',20);
			$table->string('email',255);
			$table->longText('url')->nullable($value = true);
			$table->boolean('gendaer');
			$table->tinyInteger('age');
			$table->string('contact',200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_forms');
    }
}
