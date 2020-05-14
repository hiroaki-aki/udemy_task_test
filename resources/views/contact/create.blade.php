@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

					<!-- 105 バリデーション適用時のエラーを表示する処理 -->
					@if($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
					@endif

                    createです。
					<!-- 96 createのフォームの作成 -->
					<!-- 97 フォームデータ送信後の処理先をactionに記載 -->
					<!-- route()を使ってweb.phpに記載した内容に基づき接続先を選定-->
					<!-- 以下処理では /routes/web.php の 
						Route::post('create', 'ContactFormController@store')->name('contact.store');  
						に繋がり、ここから /app/Http/Controllers/ContactFormController.php の 
						public function store(Request $request){} に繋がる。-->
					<form method="POST" action="{{ route('contact.store') }}">
						@csrf
						氏名
						<input type="type" name="your_name">
						<br>
						件名
						<input type="type" name="title">
						<br>
						メールアドレス
						<input type="email" name="email">
						<br>
						ホームページ
						<input type="url" name="url">
						<br>
						性別
						<input type="radio" name="gender" value="0">男性</input>
						<input type="radio" name="gender" value="1">女性</input>
						<br>
						年齢
						<select name="age">
							<option value="">選択してください</option>
							<option value="1">〜19歳</option>
							<option value="2">20〜29歳</option>
							<option value="3">30〜39歳</option>
							<option value="4">40〜49歳</option>
							<option value="5">50〜59歳</option>
							<option value="6">60歳〜</option>
						</select>
						<br>
						お問い合わせ内容
						<textarea name="contact"></textarea>
						<br>
						
						<input type="checkbox" name="caution" value="1">注意事項に同意する
						<br>

						<input class="btn btn-info" type="submit" value="登録する">
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
