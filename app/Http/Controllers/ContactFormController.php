<?php

namespace App\Http\Controllers;

// 97 以下ファイルを参照している。
// /vendor/laravel/framework/src/Illuminate/Http/Request.php
use Illuminate\Http\Request;

// 98 DBへの保存（DB操作するにはModelの呼び出しが必要）
// /app/Models/ContactForm.phpを呼び出している。
use App\Models\ContactForm;

// 99 DBのファサードの読み込み（クエリビルダーの有効化の為)
use Illuminate\Support\Facades\DB;

// 104 自作クラスの呼び込み
use App\Services\CheckFormData;

// 105 自作バリデーション読み込み
use App\Http\Requests\StoreContactForm;

class ContactFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	// 109 検索フォームの実装にRequest $requestを追記してデータを持ってくる。
    public function index(Request $request)
    {
		// 109 index.phpの＄searchを取得してくる。
		$search = $request->input('search');
		
		// 99 ORマッパーのエロクアントによるDBからのデータ取得。
		// DB接続にはModelの読み込みが必要（use App\Models\ContactForm;）
		// コンタクト形式のデータとしてDBからデータを取得できる。
		// $contacts = ContactForm::all();
		// dd($contacts);

		// 99 クエリビルダーによるDBの取得
		// クエリビルダーを使用するにはDBファサードが必要(use Illuminate\Support\Facardes\DB;)
		// ->select()でselect文を実行し->get()で、抽出したデータを取得する。便利すぎる。
		$contacts = DB::table('contact_forms')
		->select('id','your_name','title','created_at')
		->orderBy('created_at','desc')
		// 108 ページネーション　->get();　の代わりにこれ入れる。
		// あと、view 側もちょっとだけいじる必要がある。
		->paginate(20);
		// ->get();
		//dd($contacts);

		// 109 検索フォーム用のクエリの生成（99と区別する為に記載）
		// Likeによる曖昧検索を条件に入れる。
		$query = DB::table('contact_forms');
		if($search !== null){
			$search_split  = mb_convert_kana($search, 's');
			$search_split2 = preg_split('/[\s]+/', $search_split);
			foreach($search_split2 as $value){
				$query->where('your_name','like','%'.$value.'%');
			}
		}
		$query->select('id','your_name','title','created_at');
		$query->orderBy('id','asc');
		$contacts = $query->paginate(20);

		// 93 動画では記載指示がなかった？が一応記載
		// フォルダ名.ファイル名という形。
		// 99 DBのデータを引き渡し。
		return view('contact.index',compact('contacts'));
		 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		// 96 Createした時にファイル（ビューファイル）を表示する。
		// 表示するファイル（create.blade.php）は、/resouces/views/contact/に配置
		return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

	// 97 LaravelではFormからデータを取得する時はRequestクラスを使用する。
	// Requestクラスは以下から継承している。
	// /vendor/laravel/framework/src/Illuminate/Http/Request.php
	// 105 自作バリデーション「StoreContactForm」の読み込み（元々はRequest）
    public function store(StoreContactForm $request)
    {
		// 98 DBへの保存（Modelの呼出し）
		// 当該ファイル冒頭でDB操作の為、Modelクラスを呼び出しているので、以下でインスタンス化する必要がある。
		// $contact->カラム名（変数名ではない！）とする事で当該カラムに接続する事ができる。
		// テーブルはCntactFormに限定されているので指定不要。別テーブルを指定したい時はそれ専用に作成したModelファイルを使用する。
		$contact = new ContactForm;

		// 97 Formからデータを取得する為のメソッド。
		// Requestクラスは更に幾つかのクラスを継承しておりinput()メソッドは以下から継承している。
		// use Concerns\InteractsWithInput　という文で継承的な。以下のファイルを継承。
		// vendor/laravel/framework/src/Illuminate/Http/Concerns/InteractsWithInput.php
		// 98より追記。DBアクセスの為に$contact->を追記。
		// 超重要！$contact->以下はカラム名（文字列）であって変数名ではない。
		$contact->your_name	= $request->input('your_name');
		$contact->title		= $request->input('title');
		$contact->email		= $request->input('email');
		$contact->url		= $request->input('url');
		$contact->gender	= $request->input('gender');
		$contact->age		= $request->input('age');
		$contact->contact	= $request->input('contact');

		// なお、以下コードだと全件取得できる。
		$input_all	= $request->all();
		// dd($input_all);

		// 97 上記でDBにアクセス（$contactに値をセット）した後は、save()メソッドでinsertする事ができる。
		// これやらないと保存できない。
		$contact->save();

		// 97 処理終了後は強制的に/resources/views/contact/index.blade.phpにリダイレクトさせる。
		return redirect('contact/index');
		
		// 以下がないと検証できないので追記。
		//return view('contact.store',compact('your_name'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

	// 100 web.phpより規定された$idを引数として取得した状態で処理を展開していく。
    public function show($id)
    {
		// 100 DBから定められたデータを取得する。（個人情報をみるというもの）
		// 今回はORマッパーを使用。引数IDをキーにした１行分のデータを取得する。
		$contact = ContactForm::find($id);

		// 103 カラムのgender,ageは数値でDBに保管されているので、ここで文字に変換する。
		// 本来は必要な処理だが104にて外部ファイルのクラスを使用してスリム化
		// if($contact->gender === 0){
		// 	$gender = "男性";
		// }
		// if($contact->gender === 1){
		// 	$gender = "女性";
		// }
		// if($contact->age === 1){
		// 	$age = "〜19歳";
		// }
		// if($contact->age === 2){
		// 	$age = "20〜29歳";
		// }
		// if($contact->age === 3){
		// 	$age = "30〜39歳";
		// }
		// if($contact->age === 4){
		// 	$age = "40〜49歳";
		// }
		// if($contact->age === 5){
		// 	$age = "50〜59歳";
		// }
		// if($contact->age === 6){
		// 	$age = "60歳〜";
		// }

		// 104 自作クラスの展開（ファットクラスのスリム化）
		$gender = CheckFormData::checkGender($contact);
		$age    = CheckFormData::checkAge($contact);

		// おなじみのview()で指定ファイルを表示、compact()で複数の変数を引き渡す。
		return view('contact.show',
			compact('contact','gender','age')
		);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		// 101 DBの更新処理（個人情報の詳細の変更）
		// show()と同じくORマッパーを使用してIDをキーにデータを取得。
		$contact = ContactForm::find($id);
		return view('contact.edit',compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		// 101 DBの更新（ユーザー毎のデータを取得する。）
		$contact = ContactForm::find($id);
		
		// 101 97と同じで、Formからデータを取得する
		$contact->your_name	= $request->input('your_name');
		$contact->title		= $request->input('title');
		$contact->email		= $request->input('email');
		$contact->url		= $request->input('url');
		$contact->gender	= $request->input('gender');
		$contact->age		= $request->input('age');
		$contact->contact	= $request->input('contact');

		// なお、以下コードだと全件取得できる。
		$input_all	= $request->all();
		// dd($input_all);

		// 101 97と同じで、上記でDBにアクセス（$contactに値をセット）した後は、save()メソッドでinsertする事ができる。
		// これやらないと保存できない。SQLが実行されない状況になる。
		$contact->save();

		// 101 97と同じで、処理終了後は強制的に/resources/views/contact/index.blade.phpにリダイレクトさせる。
		return redirect('contact/index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		// 103 DBの削除
		// ユーザー毎のデータを取得する。
		$contact = ContactForm::find($id);

		// データの削除
		$contact->delete();

		return redirect('contact/index');
    }
}
