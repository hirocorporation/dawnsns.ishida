@extends('layouts.login')

@section('content')

<!-- 投稿フォームここから記述 -->
<div class="wrapper">
        <form name="new-post" action="/posts/index" method="post">
            {{ csrf_field() }}
           <?php $user = Auth::user(); ?><img onclick="location.href='/posts/profile'" name="post-icon" src="/images/{{$user->images}}">
       <div class="new-post">
         <textarea name="new-post" cols="150" rows="3" placeholder="何をつぶやこうか…？"></textarea>
        <button name="post-button" type="submit"><img src="images/post.png"></button>

</div>

    </form>
    <div>
            @if($errors->first('posts'))
        <p>※{{ $errors->first('posts') }}</p>
    @endif
    </div>
</div>

<!-- 投稿欄全体 -->
<div class="posts-wrapper">
    @foreach($posts as $post)

    @if (Auth::user()->id == $post->user_id)
    <!-- １投稿 -->

<div class="my-post">
    <!-- 投稿欄のアイコン -->
        <img onclick="location.href='/posts/profile'" name="timeline-icon" src="/images/{{$user->images}}">
        {{ csrf_field() }}

<!-- 投稿内容のまとまり -->
<ul class="post-content">
 <li class="timeline-name">{{ $post->username }}</li>
        <li class="date">{{ $post-> updated_at }}</li>
        <li class="post">{{ $post->posts }} </li>
</ul>

</div>
<!-- 各投稿の編集ボタン -->
<div class="button-link">
<a id="modal-open" class="button-link"><img name="button-link" src="/images/edit.png"></a>

<!-- モーダル編集 -->
<div id="modal-content">
    <form action="{{ route('post_edit',  $post->id) }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $post->id }}" />
        <textarea name="modal-post">{{ $post->posts }}</textarea><br>
        <input name="edit-button" type="image" src="/images/edit.png"/>
    </form>
</div>
<!-- <div id="modal-content">

    <form action="{{ route('post_edit',  $post->id) }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
        <input type="hidden" name="user_id" value="{{ $post->user_id }}" />
        <textarea name="modal-post">{{ $post->posts }}</textarea><br>
        <input name="edit-button" type="image" src="/images/edit.png"/>
    </form>

</div> -->

<!-- モーダル削除 -->
<div>
<form onsubmit="return confirm('本当に削除しますか？')" action="{{ route('posts.destroy', $post->id) }}" method="POST">
    {{ csrf_field() }}
    @method('delete')
<!-- 各投稿の削除ボタン -->
     <button type="submit" class="button-link"><img name="button-link" src="/images/trash.png" onmouseover="this.src='/images/trash_h.png'" onmouseout="this.src='/images/trash.png'"/></button>

   </form>
</div>
  </div>
</div>
    @else

    <!-- １投稿 -->
<div class="other-post">

    <!-- 投稿欄のアイコン -->
   <a href="{{ route('users.profile', ['id' =>$post->user_id]) }}"><img name="timeline-icon" src="/images/{{$user->images}}"></a>
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
