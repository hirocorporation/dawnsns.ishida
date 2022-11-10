

@extends('layouts.login')

@section('content')

<h1>相手のプロフィール </h1>
<table>
  <tbody>
    <tr>
      <td>{{ $user->images }}</td>
      <td>{{ $user->username }}</td>
      <td>{{ $user->bio }}</td>
      <td>
   @if (auth()->user()->isFollowing($user->id))

        <form action="{{ route('unfollow', ['id' => $user->id]) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}

    <button type="submit">フォロー解除</button>
    </form>
     @else
    <form action="{{ route('follow', ['id' => $user->id]) }}" method="POST">
    {{ csrf_field() }}

    <button type="submit">フォローする</button>
    </form>
    @endif
  </td>
    </tr>
  </tbody>
</table>

@endsection
