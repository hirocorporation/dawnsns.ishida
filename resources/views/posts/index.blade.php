@extends('layouts.login')

@section('content')

<!-- 投稿フォーム -->
<div class="wrapper">
    <form name="new-post" action="/posts/index" method="post">
        {{ csrf_field() }}
        <?php $user = Auth::user(); ?><img onclick="location.href='/posts/profile'" name="post-icon" src="{{ asset('storage/images/'.$user->images) }}">
            <div class="new-post">
                <textarea name="new-post" cols="150" rows="3" placeholder="何をつぶやこうか…？"></textarea>
                <button name="post-button" type="submit"><img src="images/post.png"></button>
            </div>
    </form>
</div>

<!-- 投稿内容欄全体 -->
<div class="posts-wrapper">
    @foreach($posts as $post)

<!-- 自分の投稿 -->
    @if (Auth::user()->id == $post->user_id)
        <div class="my-post">
            <img onclick="location.href='/posts/profile'" name="timeline-icon" src="{{ asset('storage/images/'.$user->images) }}">
            {{ csrf_field() }}
            <ul class="post-content">
                <li class="timeline-name">{{ $post->username }}</li>
                <li class="date">{{ $post-> updated_at }}</li>
                <li class="post">{{ $post->posts }} </li>
            </ul>

<!-- 自分の投稿の編集ボタン -->
                <div class="modalopen" data-target="{{ $post->id }}">
                    <a  class="button-link"><img name="button-link" src="/images/edit.png"></a>
                </div>

<!-- 自分の投稿編集モーダル -->
                <div id="{{ $post->id }}" class="modal-main js-modal">
                    <div class=" modal-inner">
                        <div class="inner-content">
                            <form action="post-edit" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $post->id }}" />
                                <textarea name="modal-post">{{ $post->posts }}</textarea><br>
                                <input name="send-button" type="image" src="/images/edit.png"/>
                            </form>
                        </div>
                    </div>
                </div>

<!-- 自分の投稿削除メッセ―ジ -->
                <div>
                    <form onsubmit="return confirm('本当に削除しますか？')" action="{{ route('posts.destroy', $post->id) }}" method="POST">
                        {{ csrf_field() }}
                        @method('delete')

<!-- 自分の投稿削除ボタン -->
                        <button type="submit" class="button-link">
                            <img name="button-link" src="/images/trash.png" onmouseover="this.src='/images/trash_h.png'" onmouseout="this.src='/images/trash.png'"/>
                        </button>
                    </form>
                </div>
        </div>

<!-- 他のユーザーの投稿 -->
    @else
        <div class="other-post">
            <a href="{{ route('users.profile', ['id' =>$post->user_id]) }}"><img name="timeline-icon" src="{{ asset('storage/images/'.$post->images) }}"></a>
            {{ csrf_field() }}
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
