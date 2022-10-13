
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
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
        <a　class="logo"><img src="images/main_logo.png" onclick="location.href='/top'" alt="ロゴ"></a>

            <nav>
                <div class="accordion">
                <div class="accordion-item">
                    <h3 class="accordion-title js-accordion-title"><?php $user = Auth::user(); ?>{{ $user->username }}さん<img src=<?php $user = Auth::user(); ?>{{ $user->images }}></h3>

                    <ul class="accordion-content">
                        <li><a href="/top">ホーム</a></li>
                        <li><a href="/profile">プロフィール編集</a></li>
                        <li><a href="/logout">ログアウト</a></li>
                     </ul>
                </div>
                </div>
            </nav>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div >

         <div id="side-bar">
            <div id="confirm">
                <p><?php $user = Auth::user(); ?>{{ $user->username }}さんの</p>
                <div>
                <p>フォロー数</p>
                <p>{{ $follow_count }}名</p>
                </div>
                <input type="button" onclick="location.href='/followList'" value="フォローリスト">
                <div>
                <p>フォロワー数</p>
                <p>{{ $follower_count }}名</p>
                </div>
                <input type="button" onclick="location.href='/followerList'" value="フォロワーリスト">
            </div>


            <input type="button" onclick="location.href='/search'" value="ユーザー検索">

        </div>
    </div>


    <footer>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
   <script src="./js/script.js"></script>
</body>
</html>
