<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <!-- windowsの基本ブラウザであるedgeに対応するという記載。
　　　　　　　ぶっちゃけとりあえず書く呪文みたいなものという認識でOK。-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        
        <!-- 画面幅を小さくしたとき、例えばスマートフォンで見たときなどに文字や画像の大きさを調整してくれるタグ。 -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
         {{-- 後の章で説明します --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- 各ページごとにtitleタグを入れるために@yieldで空けておきます。 --}}
        <!-- ＠yieldは指定したセッションの内容を表示するために使用します。
        今回であれば、titleというセッションの内容を表示します。
        コメントに書いてある通り、各ページ毎にタイトルを変更できるようにするためです。-->
        <title>@yield('title')</title>

        <!-- Scripts -->
         {{-- Laravel標準で用意されているJavascriptを読み込みます --}}
         <!--asset(‘ファイルパス’)は、publicディレクトリのパスを返す関数。要するに、「/js/app.js」というパスを生成します。-->
         <script src="{{ secure_asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        {{-- Laravel標準で用意されているCSSを読み込みます --}}
        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
        {{-- この章の後半で作成するCSSを読み込みます --}}
        <link href="{{ secure_asset('css/admin.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            {{-- 画面上部に表示するナビゲーションバーです。 --}}
            <nav class="navbar navbar-expand-md navbar-dark navbar-laravel">
                <div class="container">
                    <!--{{ url('/') }}   url(“パス”)は、そのまんまURLを返すメソッドです。-->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                        <!--assetと似たような関数で、configフォルダのapp.phpの中にあるnameにアクセスをします。
                    基本的にはアプリケーションの名前「Laravel」が格納されています。-->
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                             <!-- Authentication Links -->
                             
                        {{-- ログインしていなかったらログイン画面へのリンクを表示 --}}
                        @guest  <!-- ユーザーログイン認証の判別に使用する -->
                        
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('messages.Login') }}</a></li><!-- ヘルパ関数　＿＿（）翻訳文字列取得 --> 
                                                                                                                   <!-- route関数 URLを生成、リダイレクト。今回は”/login”URLを生成　-->
                        {{-- ログインしていたらユーザー名とログアウトボタンを表示 --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('messages.Logout') }} <!-- ヘルパ関数　＿＿（）翻訳文字列取得 --> 
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest <!-- ユーザーログイン認証の判別に使用する -->

                        </ul>
                    </div>
                </div>
            </nav>
            {{-- ここまでナビゲーションバー --}}

            <main class="py-4">
                {{-- コンテンツをここに入れるため、＠yieldで空けておきます。 --}}
                @yield('content')
            </main>
        </div>
    </body>
</html>

