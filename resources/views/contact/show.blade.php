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
					<!-- 100 DBから取得してきたデータを取得する。 -->
                    showです。<br>
					{{ $contact->your_name }}<br>
					{{ $contact->title }}<br>
					{{ $contact->email }}<br>
					{{ $contact->url }}<br>
					{{ $gender }}<br>
					{{ $age }}<br>
					{{ $contact->contact }}
					<!-- 100 より作成 -->
					<!-- 101 より作成 個人情報表示の後に変更を行う -->
					<!-- id をパラメータとして接続する。 -->
					<form method="GET" action="{{route('contact.edit',['id' => $contact->id ])}}">
						@csrf
						<br>
						<input class="btn btn-info" type="submit" value="変更する">
					</form>
					<!-- 103 より作成 個人情報の削除&確認機能 -->
					<form method="POST" action="{{route('contact.destroy',['id' => $contact->id ])}}" id="delete_{{ $contact->id }}">
						@csrf
						<br>
						<!-- aタグ＋JSで送信処理を制御 -->
						<!-- なお、 class を btn-dangerとするとbootstrap上で赤色のボタンになる -->
						<a href="#" data-id="{{ $contact->id }}" class="btn btn-danger" onclick="deletePost(this);">削除する</a>
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
<!-- 103 js -->
<!-- 削除ボタンを押した時の確認処理 -->
function deletePost(e){
	'use strict';
	if(confirm('本当に削除してもいいですか？')){
		document.getElementById('delete_' + e.dataset.id).submit();
	}
}
</script>

@endsection