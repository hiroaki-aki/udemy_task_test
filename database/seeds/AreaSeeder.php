<?php

use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		// 111 リレーションDB(不動産紹介サイト)
		DB::table('areas')->insert([
			[
				'id'		=> 1,
				'name'		=> '東京',
				'sort_no'	=> 1
			],
			[
				'id'		=> 2,
				'name'		=> '大阪',
				'sort_no'	=> 2
			],
			[
				'id'		=> 3,
				'name'		=> '福岡',
				'sort_no'	=> 3
			]
		]);
    }
}
