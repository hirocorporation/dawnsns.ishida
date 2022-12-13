@extends('layouts.login')

@section('content')

<div class="follower_list">
<h1>Follower list</h1>
<div class="follower-icon">
     @foreach($follower_user->unique('follower') as $follower_users)
@if (Auth::user()->id == $follower_users->follower)
        <img onclick="location.href='/posts/profile'" name="timeline-icon" src="/images/{{$follower_users->images}}">
        {{ csrf_field() }}

@else
   <a href="{{ route('users.profile', ['id' =>$follower_users->follow]) }}"><img name="timeline-icon" src="/images/{{$follower_users->images}}"></a>
        {{ csrf_field() }}
@endif
    @endforeach
    </div>
</div>


    <div class="posts-wrapper">
    @foreach($posts as $post)

    @if (Auth::user()->id == $post->user_id)
    <div class="my-post">
        <img onclick="location.href='/posts/profile'" name="timeline-icon" src="/images/{{$post->images}}">
        {{ csrf_field() }}

<!-- 投稿内容のまとまり -->
    <ul class="post-content">
        <li class="timeline-name">{{ $post->username }}</li>
        <li class="date">{{ $post-> updated_at }}</li>
         <li class="post">{{ $post->posts }} </li>
    </ul>

    </div>

@else

<div class="other-post">
   <a href="{{ route('users.profile', ['id' =>$post->user_id]) }}"><img name="timeline-icon" src="/images/{{$post->images}}"></a>
        {{ csrf_field() }}

<!-- 投稿内容のまとまり -->
    <ul class="post-content">
        <li class="timeline-name">{{ $post->username }}</li>
        <li class="date">{{ $post-> updated_at }}</li>
        <li class="post">{{ $post->posts }} </li>
    </ul>

    </div>

        @endif

    @endforeach
    </div>
@endsection
