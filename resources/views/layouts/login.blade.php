<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="/reset.">
    <link rel="stylesheet" href="/style.">
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
</head>



<body>
    <header>
        <div id = "head">
        <h1><a href="/index"><img src="images/main_logo.png"></a></h1>
            <div id="userWrap">
                <div id="user">
                    <!-- Controller.phpで設定した$name＝テーブル「users」からデータを引っ張る -->
                    <p class="container">{{$name->username}}さん</p>
                    <a href="/profile"><img src="{{ asset('/images/' . $name->images) }}"></a>
                <div>
                <ul>
                    <li><a href="/top"><a href="/index">HOME</a></li>
                    <li><a href="/profile"><a href="/profile">プロフィール編集</a></li>
                    <li><a href="/logout"><a href="/logout">ログアウト</a></li>
                </ul>
            </div>
        </div>
    </header>



    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm">
                <p>{{$name->username}}さんの</p>


                <!-- UsersControllerのsearchからカウント情報を取得している -->
                <div>
                <p>フォロー数</p>
                <p>名</p>
                </div>
                <p class="btn"><a href="/followList">フォローリスト</a></p>
                <div>
                <p>フォロワー数</p>
                <p>名</p>
                </div>


                <p class="btn"><a href="/followerList">フォロワーリスト</a></p>
            </div>
            <p class="btn"><a href="/search">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>
    <script src="JavaScriptファイルのURL"></script>
    <script src="JavaScriptファイルのURL"></script>
</body>
</html>