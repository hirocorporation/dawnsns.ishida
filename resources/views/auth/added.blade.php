@extends('layouts.logout')

@section('content')

<div class="logout-content">
  <div class="welcome-text">
    <h1>{{ session('username') }}さん</h1>
      <p>ようこそ！DAWNSNSへ！</p><br>
      <p>ユーザー登録が完了しました。</p>
      <p>さっそく、ログインをしてみましょう。</p>
  </div>
  <p class="go-login"><a href="/login">ログイン画面へ</a></p>
</div>

@endsection
