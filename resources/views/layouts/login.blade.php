<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->

    <!-- JavaScriptファイルのURL -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="{{ asset('/js/script.js') }}"></script>
</head>



<body>
    <header>
        <div id = "head">
            <a href="/index"><img class="icon" src="{{asset('images/main_logo.png')}}"></a>
            <div id="userbox">

                <div id="user">
                    <!-- Controller.phpで設定した$name＝テーブル「users」からデータを引っ張る -->
                    <p class="username">{{$name->username}}さん</p>
                    <ul class="nav">
                        <li><a class="link" href="/index">HOME</a></li>
                        <li><a class="link" href="/profile">プロフィール編集</a></li>
                        <li><a class="link" href="/logout">ログアウト</a></li>
                    </ul>

                    <div class="menu-trigger">
                        <span></span>
                        <span></span>
                    </div>

                <a href="/profile"><img class="userIcon" src="{{ asset('storage/'.$name->images) }}"></a>

                </div>


            </div>
        </div>
    </header>



    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm">
                <p class="username">{{$name->username}}さんの</p>

                <div>
                <p class="follow">フォロー数</p>
                <p class="count">{{$count_follow}}名</p>
                </div>

                <p class="btn"><a href="/followList">フォローリスト</a></p>

                <div>
                <p class="follow">フォロワー数</p>
                <p class="count">{{$count_follower}}名</p>
                </div>


                <p class="btn"><a href="/followerList">フォロワーリスト</a></p>

            </div>

            <p class="searchBtn"><a href="/search">ユーザー検索</a></p>

        </div>
    </div>


    <footer>
    </footer>
</body>
</html>