@extends('layouts.login')

@section('content')

<div class="follower_list">
<h1>Follower list</h1>

</div>

    <div class="posts-wrapper">
    @foreach($post as $posts)
        <h1>{{ $posts->posts }} </h1>
        <p>{{ $posts-> updated_at }}</p>
    </div>
    @endforeach

@endsection
