@extends('layouts.login')

@section('content')

<div class="other-users">
  <a href="{{ route('users.profile', ['id' =>$user->id]) }}"><img name="search-icon" src="{{ asset('storage/images/'.$user->images) }}"></a>
    <div class="name-bio">
      <div class="other-username">
        <p class="other-username1">Name</p><p class="other-username2" >{{ $user->username }}</p>
      </div>

        <div class="other-bio">
          <p class="other-bio1">Bio</p><p class="other-bio2" >{{ $user->bio }}</p>
        </div>
    </div>
    @if (auth()->user()->isFollowing($user->id))
      <form name="follow-button1" action="{{ route('unfollow', ['id' => $user->id]) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button name="unfollow-button1" type="submit">フォローをはずす</button>
      </form>
    @else
      <form name="follow-button1" action="{{ route('follow', ['id' => $user->id]) }}" method="POST">
        {{ csrf_field() }}
        <button name="follow-button1" type="submit">フォローする</button>
      </form>
    @endif
</div>

<div class="posts-wrapper">
  @foreach($posts as $post)
    <div class="other-post">
      <a href="{{ route('users.profile', ['id' =>$user->id]) }}"><img name="timeline-icon" src="{{ asset('storage/images/'.$user->images) }}"></a>
      {{ csrf_field() }}
      <ul class="post-content">
        <li class="timeline-name">{{ $post->username }}</li>
        <li class="date">{{ $post-> updated_at }}</li>
        <li class="post">{{ $post->posts }} </li>
      </ul>
    </div>
  @endforeach
</div>

@endsection
