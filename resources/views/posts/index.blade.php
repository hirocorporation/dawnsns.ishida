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
    @foreach($posts as $post)
        <h1>{{ $post->images }}{{ $post->username }}</h1>
        <span>{{ $post->posts }} </span>
        <p>{{ $post-> updated_at }}</p>
    @endforeach
</div>

@endsection
