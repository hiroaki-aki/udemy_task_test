<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
		// 107 作成したシーダーの紐付け処理
		// デフォルトではコメントアウトされている。
		$this->call(UsersTableSeeder::class);
		// 107 作成したシーダーファイル（ContactFomrSeeder.php）の紐付け処理
		$this->call(ContactFormSeeder::class);

		// 111 作成したシーダーファイル（AreaSeeder.php）の紐付け処理
		// 親テーブル(Area)から作成する必要がある。
		$this->call(AreaSeeder::class);
		// 111 作成したシーダーファイル（ShopSeeder.php）の紐付け処理
		$this->call(ShopSeeder::class);

		// 113 作成したシーダーファイル（RouteSeeder.php）の紐付け処理
		$this->call(RouteSeeder::class);
		// 113 作成したシーダーファイル（RouteShopSeeder.php）の紐付け処理
		$this->call(RouteShopSeeder::class);

	}
}
