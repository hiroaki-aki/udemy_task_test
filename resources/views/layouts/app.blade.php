<!-- 超重要！ -->
<!-- ここでもコメントアウトはできるが、@から始まるメソッドはコメントアウトしても起動するから注意！！ -->
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
	<!-- 94 Laravelではmetaタグ内のCSRFトークンは必須 -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- 94 /app/config/app.phpを読み込んでおり、最終的に.envファイルのAPP_NAME を表示している。-->
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
	<!-- 94 同一階層のjs/app.jsを読み込んでいるが、webpack.mix.jsも起動しているので、public/jsも合わせた形で読み込んでいる。 -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
	<!-- 94 Googleのフォントを持ってきている。 -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
	<!-- 94 jsと同じ。 -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
					<!-- ここでも.envファイルのAPP_NAMEが使用される。 -->
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <!-- 94 認証UI専用のディレクトリ -->
						@guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        <!-- 94 formを使う時は@csrf とすればCSRFを適用できる。 -->
										@csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
			<!-- 95 上記までがヘッダー部分で以降はmainタグとして各種ファイルを展開する。 -->
			<!-- なお、当該ファイルを読み込むにあたり、yield()内の引数が合言葉になる。 -->
			<!-- 読込む側のファイルではcontentをextends('layouts.app')　section('content')と記載する。 -->
            @yield('content')
        </main>
    </div>
</body>
</html>
