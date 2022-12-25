@extends('layouts.logout')

@section('content')

<div class="logout-content">
  {!! Form::open() !!}
  <p>新規ユーザー登録</p>
    <div class='logout-form logout-form1'>
      {{ Form::label('UserName') }}
      {{ Form::text('username',null,['class' => 'input']) }}
      @if ($errors->has('username'))
        <li>{{$errors->first('username')}}</li>
      @endif
    </div>
    <div class='logout-form logout-form2'>
      {{ Form::label('MailAdress') }}
      {{ Form::text('mail',null,['class' => 'input']) }}
      @if ($errors->has('mail'))
        <li>{{$errors->first('mail')}}</li>
      @endif
    </div>
    <div class='logout-form logout-form3'>
      {{ Form::label('Password') }}
      {{ Form::password('password',null,['class' => 'input']) }}
      @if ($errors->has('password'))
        <li>{{$errors->first('password')}}</li>
      @endif
    </div>
    <div class='logout-form logout-form4'>
      {{ Form::label('Password confirm') }}
      {{ Form::password('password_confirmation',null,['class' => 'input']) }}
      @if ($errors->has('password_confirmation'))
        <li>{{$errors->first('password_confirmation')}}</li>
      @endif
    </div>
    <div class="submit-button">
      {{ Form::submit('REGISTER', ['class' => 'button']) }}
    </div>
  <p><a href="/login">ログイン画面へ戻る</a></p>
  {!! Form::close() !!}
</div>

@endsection
