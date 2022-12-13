@extends('layouts.login')

@section('content')

<div class="edit-form">
    <form action="{{route('profile_edit')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
         <div class="profile-icon">
                <img name="profile-icon" src="/images/{{$user->images}}">
         </div>
                <input type="hidden" name="id" value="{{ $user->id }}" />
         <div class="edit-content">
                <span class="edit-username">UserName</span>
                <input type="text" name="username" value="{{ $user->username }}" /><br><span class="edit-mail">MailAdress</span>
                <input type="text" name="mail" value="{{ $user->mail }}" /><br><span class="edit-password">Password</span>
                <input type="password" name="password1" value="{{ $user->password }}" readonly /><br><span class="edit-password">new Password</span>
                <input type="password" name="password2" value="{{ $user->password }}" /><br>
                <div class="form-bio">
                        <span class="edit-bio">Bio</span>
                        <textarea name="bio" rows="3" value="{{ $user->bio }}"></textarea><br>
                </div>
                <div class="form-images">
                        <span class="edit-images">Icon Image</span>
                                <div class="choice-images">
                                        <label class="label-images">
                                        <input type="file" name="images"value="{{ $user->images }}">ファイルを選択</label>
                                </div><br>
                </div>
                <div class="update-button">
                        <input type="submit" name="update-button" value="更新" />
                </div>
        </form>
        </div>
</div>
@endsection
