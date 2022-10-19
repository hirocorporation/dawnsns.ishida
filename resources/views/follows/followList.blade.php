@extends('layouts.login')



@section('content')

<div class="follow_list">
<h1>Follow list</h1>
<div class="follow-icon">
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
