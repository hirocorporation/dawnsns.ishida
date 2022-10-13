@extends('layouts.login')

@section('content')

<!-- 投稿フォームここから記述 -->
<div class="wrapper">
        <form action="/posts/index" method="post">
            {{ csrf_field() }}
        <input type="text" name="posts" placeholder="何をつぶやこうか…？">
        <button type="submit"><img src="images/post.png"></button>

    @if($errors->first('posts'))
        <p>※{{ $errors->first('posts') }}</p>
    @endif
    </form>
</div>

<div class="posts-wrapper">
    @foreach($post as $posts)
        <h1>{{ $posts->user->images }}{{ $posts->user->username }}</h1>
        <span>つぶやいた内容を表示します。</span>
        <span>{{ $posts->posts }} </span>
        <p>{{ $posts-> updated_at }}</p>
    @endforeach
</div>

@endsection
