@extends('layouts.login')

@section('content')

<div class="follower_list">
<h1>Follower list</h1>


</div>

    <div class="posts-wrapper">
    @foreach((array)$posts as $post)

         <h1>{{ $posts->user->images }}{{ $posts->user->username }}</h1>
        <p>{{ $posts->posts }}{{ $posts-> updated_at }}</p>
    </div>
    @endforeach
@endsection
