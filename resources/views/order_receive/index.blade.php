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





        <ul class="nav">
        <li><a href="#">Home</a>
        </li>
        <li><a href="#">Strategy</a>
        <ul>
        <li><a href="#">b1</a></li>
        <li><a href="#">b1</a></li>
        <li><a href="#">b1</a></li>
        <li><a href="#">b1</a></li>
        <li><a href="#">b1</a></li>
        <li><a href="#">b1</a></li>
        <li><a href="#">b1</a></li>
        <li><a href="#">b1</a></li>
        <li><a href="#">b1</a></li>
        <li><a href="#">b1</a></li>
        <li><a href="#">b1</a></li>
        <li><a href="#">b1</a></li>
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
        <!--nav--></ul>
        <div class="content">
        <p>transitionプロパティで動きのある横並びドロップダウンメニューです。メニュー部分にマウスオーバーするとコンテンツの上に子メニューが展開します。</p>
        <p>transitionプロパティはdisplayでの制御をサポートしていないため、子孫メニューの制御はoverflowで行っております。displayでの制御も可能ですが、その場合動きはなくなります。</p>
        </div>





        <div class="content">
            <main class="py-4">
                <div>
                    <p>^^^^^^^-^^^^^^^^</p>
                </div>
                @yield('content')
            </main>
        </div>

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
<div class="content">
    <p>モデル作ろう。。。</p>
    <p>-</p>
    <p>レポート:</p>
    <p>黄色、赤色一覧</p>
    <p>日程再設定、基準再設定の黄色赤色一覧</p>
    <p>-</p>
    <p>発注:</p>
    <p>全部DL</p>
    <p>yellow redだけのDL</p>
    <p>指定SKUのDL</p>
    <p>-</p>
    <p>受注:</p>
    <p>skuより注文履歴検索</p>
    <p>履歴確定で更新</p>
    <main class="py-4">
        @yield('content')
    </main>

</div>
