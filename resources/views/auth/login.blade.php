@extends('layouts.logout')

@section('content')

<h2>Social Network Service</h2>

<div class="logout-content">

{!! Form::open() !!}

<h1>DAWNのSNSへようこそ</h1>
<div class='logout-form logout-form1'>
{{ Form::label('MailAddress') }}
{{ Form::text('mail',null,['class' => 'input']) }}
</div>
<div class='logout-form logout-form2'>
{{ Form::label('Password') }}
{{ Form::password('password',['class' => 'input']) }}
</div>
<div class="submit-button">
{{ Form::submit('LOGIN', ['class' => 'button']) }}
</div>

<p><a href="/register">新規ユーザーの方はこちら</a></p>


{!! Form::close() !!}
</div>
</div>

@endsection
