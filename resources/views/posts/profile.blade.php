@extends('layouts.login')

@section('content')

<div class="edit-form">
        <form name="edit-form" action="{{route('profile_edit')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="profile-icon">
                        <img name="profile-icon" src="{{ asset('storage/images/'.$user->images) }}">
                </div>
                <input type="hidden" name="id" value="{{ $user->id }}" />
                        <div class="edit-content">
                                <span class="edit-username">UserName</span>
                                <input type="text" name="username" value="{{ $user->username }}" /><br>
                                @if ($errors->has('username'))
                                <p>{{$errors->first('username')}}</p>
                                @endif
                                <span class="edit-mail">MailAdress</span>
                                <input type="text" name="mail" value="{{ $user->mail }}" /><br>
                                @if ($errors->has('mail'))
                                <p>{{$errors->first('mail')}}</p>
                                @endif
                                <span class="edit-password">Password</span>
                                <input type="password" name="password1" value="{{ $user->password }}" readonly /><br>
                                <span class="edit-password">new Password</span><input type="password" name="password2" placeholder="新しいパスワード" /><br>
                                @if ($errors->has('password2'))
                                <p>{{$errors->first('password2')}}</p>
                                @endif

                                <div class="form-bio">
                                        <span class="edit-bio">Bio</span>
                                        <textarea name="bio" rows="3">{{ $user->bio }}</textarea><br>
                                        @if ($errors->has('bio'))
                                        <p>{{$errors->first('bio')}}</p>
                                        @endif
                                </div>

                                <div class="form-images">
                                        <span class="edit-images">Icon Image</span>
                                        <div class="choice-images">
                                                <label id="label-images">
                                                        {{ csrf_field() }}
                                                        <input type="file" name="images" >
                                                </label>
                                        </div><br>
                                </div>

                                        <div class="update-button">
                                                <input type="submit" name="update-button" value="更新" />
                                        </div>
        </form>
</div>
@endsection
