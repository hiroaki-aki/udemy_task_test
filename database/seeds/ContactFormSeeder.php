<?php
// 107 新規作成シーダーファイル。

// デフォルトで記載されている処理。
// SeederはDarabaseSeeder.phpの事。
use Illuminate\Database\Seeder;

// 107 DB（Modelファイル）との紐付けが必要。
// DBを操作する時は必ずModelファイルの紐付けが必要である事を忘れないように！
use App\Models\ContactForm;

class ContactFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		// 107 ContacFactory.phpで作成したフェイカ処理を実行する。
		// ContactFormテーブルにフェイカで用意した処理内容で200個のデータを作成する。
		factory(ContactForm::class, 200)->create();
    }
}
