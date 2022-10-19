@extends('layouts.login')

@section('content')

<div class="follower_list">
<h1>Follower list</h1>
<div class="follower-icon">
    @foreach($posts as $post)

         <h1>{{ $post->images }}</h1>

    @endforeach
    </div>

</div>

    <div class="posts-wrapper">
    @foreach($posts as $post)

         <h1>{{ $post->images }}{{ $post->username }}</h1>
        <p>{{ $post->posts }}{{ $post-> updated_at }}</p>

    @endforeach
    </div>
@endsection
