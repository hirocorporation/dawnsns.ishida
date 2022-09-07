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


<!-- 検索フォームここから -->

<div>
  <form action="{{ route('users.profile') }}" method="GET">
    <input type="text" name="keyword" value="{{ $keyword }}">
    <input type="submit" value="ユーザー名">
</form>
</div>


<!-- 検索ここまで -->

<table>
@forelse ($username as $user)
  <tr>
    <td class="images"><a href="{{ route('users.profile', $user) }}">{{ $user->images }}</td></a>
    <td class="username">{{ $user->username }}
    </td>

<!-- フォローボタン設置 -->

 </tr>
@empty
<td>No posts!!</td>
@endforelse
</table>
</div>


@endsection
