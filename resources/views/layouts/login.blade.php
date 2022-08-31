

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
        <a　class="logo" href="#"><img src="images/main_logo.png" alt="ロゴ"></a>

            <nav>

                    <h2 class="accordion-title js-accordion-title"></h1><?php $user = Auth::user(); ?>{{ $user->username }}さん<img src="images/arrow.png"></h2>

                    <ul class="accordion-content">
                        <li><a href="/top">ホーム</a></li>
                        <li><a href="/profile">プロフィール編集</a></li>
                        <li><a href="/logout">ログアウト</a></li>
                     </ul>
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
                <p>〇名</p>
                </div>
                <input type="button" onclick="location.href='/followList'" value="フォローリスト">
                <div>
                <p>フォロワー数</p>
                <p>〇〇名</p>
                </div>
                <input type="button" onclick="location.href='/followerList'" value="フォロワーリスト">
            </div>


            <input type="button" onclick="location.href='/search'" value="ユーザー検索">

        </div>
    </div>

        <!-- 投稿フォームここから記述してみる -->

<div class="wrapper">
        <form action="/posts/index" method="post">
            {{ csrf_field() }}
        <input type="text" name="posts" placeholder="何をつぶやこうか…？">
        <button type="submit"><img src="images/post.png"></button>
    </div>

    @if($errors->first('posts'))
        <p>※{{ $errors->first('posts') }}</p>
    @endif
    </form>
    <div class="posts-wrapper">
    @foreach($post as $posts)
        <h1>{{ $posts->posts }} </h1>
    </div>
    @endforeach

        <!-- ここまで -->



    <footer>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
   <script src="./js/script.js"></script>
</body>
</html>
