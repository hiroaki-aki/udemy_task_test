@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
		<!-- 99 bootstrapより8→12とかにするとサイズを変更できる -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>
				indexですよ!
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
					<!-- 96 波かっこ（ここで書くとコメントアウトでもエラー扱い）
					        を使用すればroute()を使用できる。ルーティングできる。 -->
					<a href="{{ route('contact.create') }}">新規登録</a>
					<form method="GET" action="{{ route('contact.create') }}">
						@csrf
						<button type="submit" class="btn btn-primary">新規登録</button>
					</form>

					<!-- 109 検索フォーム -->
					<!-- Bootstrapよりコードをコピペ & Formのアクションやnameを記載 -->
					<form metod="GEt" action="{{ route('contact.index') }}" class="form-inline my-2 my-lg-0">
						@csrf
						<input class="form-control mr-sm-2" name="search" type="search" placeholder="検索したいワード" aria-label="Search">
						<button class="btn btn-outline-success my-2 my-sm-0" type="submit">検索する</button>
					</form>
					
					<!-- 96 formファサード（UI）なるものもある。 -->

					<!-- 99 bootstrap よりコード拝借 https://getbootstrap.com/docs/4.4/content/tables/ -->
					<table class="table">
						<thead>
							<tr>
								<th scope="col">id</th>
								<th scope="col">氏名</th>
								<th scope="col">件名</th>
								<th scope="col">登録日時</th>
								<th scope="col">詳細</th>
							</tr>
						</thead>
						<tbody>
							<!-- 99 DBからデータを取得 -->
							<!-- ContactFormController.phpから$contactsを取得している。 -->
							@foreach($contacts as $contact)
							<tr>
								<th>{{ $contact->id }}</th>
								<td>{{ $contact->your_name }}</td>
								<td>{{ $contact->title }}</td>
								<td>{{ $contact->created_at }}</td>
								<!-- ルーティングの第二引数に[]で以下のように値を指定すれば、パラメータとして扱える -->
								<!-- 下記の例では、contact.showのURL?id=$contact->idの値 というURLが生成される -->
								<!-- 要は各idをパラメータに入れたURLを生成してるってこと。 -->
								<td><a href="{{ route('contact.show',['id' => $contact->id ] )}}">詳細をみる</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<!-- 108 ページネーション機能 -->
					{{ $contacts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
