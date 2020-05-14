<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		// 106 ダミーデータの挿入
		// なお当該ファイルは1つのテーブルにしか記載できない。
		// 他のテーブルにも記載したい場合は新しいファイルの作成が必要。
		// 当該ファイルはUsersTableのみ対応。
		// 下記の通り[]をさらに配列にする事で複数データの登録が可能。
		DB::table('users')->insert([
			[
				'name'		=> 'ああああ',
				'email'		=> 'test@test.com',
				'password'	=> Hash::make('test')
			],[
				'name'		=> 'いいいいいい',
				'email'		=> 'test2@test.com',
				'password'	=> Hash::make('test')
			],[
				'name'		=> 'ううううう',
				'email'		=> 'test3@test.com',
				'password'	=> Hash::make('test')
			]
		]);
    }
}
