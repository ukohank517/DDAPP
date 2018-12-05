<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">





</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
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
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
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
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </nav>





<div class="box">
    <ul id="flip2" class="dropmenu"><!-- http://weboook.blog22.fc2.com/blog-entry-408.html -->
        <li><a href="#">レポート</a>
            <ul>
                <li><a href="#">デフォルト</a></li>
                <li><a href="#">新規設定</a></li>
            </ul>
        </li>
        <li><a href="#">発注関連</a>
            <ul>
                <li><a href="{{ route('order_receive::orderdocuments.index') }}">発注書追加</a></li>
                <li><a href="{{ route('order_receive::orderdocuments.confirm') }}">発注書確認</a></li>
            </ul>
        </li>
        <li><a href="#">受注関連</a>
            <ul>
                <li><a href="{{ route('order_receive::receive.index') }}">受注処理(発注書検索)</a></li>
            </ul>
        </li>
        <li><a href="#">DB更新＆確認</a>
            <ul>
                <li><a href="{{ route('order_receive::itemrelations.index') }}">親子sku, JAN 関連</a></li>
                <li><a href="{{ route('order_receive::itemborders.index') }}">判断基準</a></li>
            </ul>
        </li>
    </ul>
</div>



        <main class="py-4">
            @yield('content')
        </main>

    </div>
</body>
</html>


<!-- ナビゲーションサンプル
</nav>
<ul class="nav">
    <li><a href="#">Home</a></li>
    <li><a href="#">Strategy</a>
        <ul>
            <li><a href="#">b1</a></li>
            <li><a href="#">b1</a>
                <ul>
                    <li><a href="#">b2</a></li>
                    <li><a href="#">b2</a></li>
                </ul>
            </li>
        </ul>
    </li>
    <li><a href="#">About</a>
        <ul>
            <li><a href="#">c1</a>
                <ul>
                    <li><a href="#">c2</a></li>
                    <li><a href="#">c2</a></li>
                </ul>
            </li>
            <li><a href="#">c1</a></li>
        </ul>
    </li>
    <li><a href="#">Works</a>
        <ul>
            <li><a href="#">d1</a></li>
            <li><a href="#">d1</a>
                <ul>
                    <li><a href="#">d2</a></li>
                    <li><a href="#">d2</a>
                        <ul class="left">
                            <li><a href="#">d3</a></li>
                            <li><a href="#">d3</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </li>
    <li><a href="#">Contact</a>
        <ul>
            <li><a href="#">e1</a>
                <ul class="left">
                    <li><a href="#">e2-1</a></li>
                    <li><a href="#">e2-1</a></li>
                </ul>
            </li>
            <li><a href="#">e1</a>
                <ul class="left">
                    <li><a href="#">e2-2</a></li>
                    <li><a href="#">e2-2</a></li>
                </ul>
            </li>
        </ul>
    </li>
</ul>
-->
