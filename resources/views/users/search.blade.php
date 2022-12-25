@extends('layouts.login')

@section('content')


<?php
define("HOST", "localhost");
define("DB_NAME", "dawnsns");
define("USER", "root");
define("PASS", "");

$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8'");
$pdo = new PDO("mysql:host=".HOST.";dbname=".DB_NAME, USER, PASS, $options);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$sql = "SELECT * FROM users ORDER BY id ASC;";
$stmt = $pdo->query($sql);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- ユーザー検索窓 -->
<form name="search-window" action="{{ route('users.search') }}" method="GET">
  <input name="search-window" placeholder="ユーザー名" type="text" name="keyword" value="{{ $keyword }}">
  <input name="search-button" type="image" type="image" src="/images/search.png">
  <p class="search-word">検索ワード：{{ $keyword }}</p>
</form>

<table class="search-users">
  @forelse ($username as $user)
    <tr class="search-user">
      <td class="search-icon"><a href="{{ route('users.profile', ['id' =>$user->id]) }}"><img onclick="location.href='/posts/profile'" name="search-icon" src="{{ asset('storage/images/'.$user->images) }}"></td></a>
      <td class="username">{{ $user->username }}</td>
      <td class="follow-button">
        @if (auth()->user()->isFollowing($user->id))
          <form action="{{ route('unfollow', ['id' => $user->id]) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button name="unfollow-button" type="submit">フォロー解除</button>
          </form>
        @else
          <form action="{{ route('follow', ['id' => $user->id]) }}" method="POST">
            {{ csrf_field() }}
            <button name="follow-button" type="submit">フォローする</button>
          </form>
        @endif
      </td>
    </tr>
  @empty
    <td>投稿がありません</td>
  @endforelse
</table>


@endsection
