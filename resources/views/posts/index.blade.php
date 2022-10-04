@extends('layouts.login')

@section('content')
<h2>機能を実装していきましょう。</h2>

        <!-- 投稿フォームここから記述 -->

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
        <p>{{ $posts-> updated_at }}</p>
    </div>
    @endforeach

        <!-- ここまで -->



@endsection
