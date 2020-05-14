<?php
// 107 ファクトリーの作成
/** @var \Illuminate\Database\Eloquent\Factory $factory */

// 107 当該ファイルが継承するModel。
// 初期値は「Model」とされているので、自身で継承先を変更する必要がある。
// 今回は「app/Models/ContactForm.php」を継承するので「ContactForm」と書き換える　
use App\Models\ContactForm;
use Faker\Generator as Faker;

// 107 ここも変更する必要がある。（デフォルトはModel）
$factory->define(ContactForm::class, function (Faker $faker) {
    return [
		// 107 ここにフェイカーとしての処理を記載していく。
		// ちなみにLaravelでは、fakerというソフトウェアがインストールされている。
		// https://github.com/fzaninotto/Faker 本家URL（英語）
		// https://qiita.com/Sa2Knight/items/fb82be7551cc84764267 （日本語）
		// ダミーデータの作成
		'your_name'	=> $faker->name,
		'title'		=> $faker->realText(50),
		'email'		=> $faker->unique()->email,
		'url'		=> $faker->url,
		'gender'	=> $faker->randomElement(['0','1']),
		'age'		=> $faker->numberBetween($min = 1, $max = 6),
		'contact'	=> $faker->realText(20),
    ];
});
