<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{asset('/css/reset.css')}}">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
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
   <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
   <script src="{{ asset('./js/script.js') }}"></script>
   <script src="modal.js"></script>
</head>

<body>
    <header>
        <div class="logo">
            <a class="logo"><img src="/images/main_logo.png" onclick="location.href='/top'" alt="ロゴ"></a>
        </div>
        <div class="accordion accordion-item">
            <div class="accordion-title js-accordion-title">
                <p class="title-name"> <?php $user = Auth::user(); ?>{{ $user->username }}さん</p> <img name="user-icon" src="{{ asset('storage/images/'.$user->images) }}"></div>
                <ul class="accordion-content">
                    <li class="accordion-list"><a href="/top">HOME</a></li>
                    <li class="accordion-list"><a href="/posts/profile">プロフィール編集</a></li>
                    <li class="accordion-list"><a href="/logout">ログアウト</a></li>
                </ul>
            </div>
        </div>
    </header>

    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <p class="follow-title"><?php $user = Auth::user(); ?>{{ $user->username }}さんの</p>
            <ul>
                <li class="follow-count">フォロー数</li>
                <li class="follow-count1">{{ $follower_count }}名</li>
            </ul>
            <input name="follow-list" type="button" onclick="location.href='/followList'" value="フォローリスト">
            <ul>
                <li class="follow-count">フォロワー数</p>
                <li class="follow-count1">{{ $follow_count }}名</li>
            </ul>
            <input name="follower-list" type="button" onclick="location.href='/followerList'" value="フォロワーリスト">
        </div>
        <div  class="search-button">
            <input name="search" type="button" onclick="location.href='/search'" value="ユーザー検索">
        </div>
    </div>

    <footer>
    </footer>

</body>
</html>
