@extends('layouts.login')

@section('content')

<div>
    <form action="{{route('profile_edit')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $user->id }}" />
        <span>UserName</span>
        <input type="text" name="username" value="{{ $user->username }}" /><br>
        <span>MailAdress</span>
        <input type="text" name="mail" value="{{ $user->mail }}" /><br>
        <span>Password</span>
        <input type="password" name="password" value="{{ $user->password }}" readonly /><br>
        <span>new Password</span>
        <input type="password" name="password" value="{{ $user->password }}" /><br>
        <span>Bio</span>
        <input type="text" name="bio" value="{{ $user->bio }}" /><br>
        <span>Icon Image</span>
        <input type="file" name="images"value="{{ $user->images }}"><br>

        <input type="submit" value="更新" />
    </form>
</div>

@endsection
