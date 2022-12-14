<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;
use App\Follow;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;



class UsersController extends \App\Http\Controllers\Controller
{
    //
    public function profile(Request $request, User $user){

        $user = Auth::user();

        $follow_count = DB::table('follows')->where('follow',Auth::id())->count();
        $follower_count = DB::table('follows')->where('follower',Auth::id())->count();

        return view('posts.profile')->with(['user' => $user, 'follow_count' =>$follow_count, 'follower_count' =>$follower_count, ]);

    }

    public function profileUpdate(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required|string|min:4|max:12',
            'mail' => ['required', 'string', 'email', 'min:4', 'max:12', Rule::unique('users')->ignore(Auth::id())],
            'password2' => 'required', 'min:4',
            'bio' => 'string|max:200|nullable',
            'images' => 'nullable',
        ], [
        'username.required' => 'ユーザー名は必須項目です',
        'username.min' => 'ユーザー名は4文字以上で入力してください',
        'username.max' => 'ユーザー名は12文字以内で入力してください',
		'mail.required' => 'メールアドレスは必須項目です',
		'mail.email' => 'メールアドレスではありません',
        'mail.min' => 'メールアドレスは4文字以上で入力してください',
        'mail.max' => 'メールアドレスは12文字以内で入力してください',
        'mail.unique' => 'このメールアドレスは既に使われています。',
		'password2.required' => 'パスワードは必須項目です',
		'password2.min' => 'パスワードは4文字以上で入力してください',
        'password2.alpha_num' => 'パスワードは半角英数字で入力してください',
        'bio.max' => '自己紹介文は200文字以内で入力してください',
	]);

        if(!isset($user->images)){
            $user = Auth::user();
            $user->username = $request->input('username');
            $user->mail = $request->input('mail');
            $user->password = bcrypt($request->input('password2'));
            $user->bio = $request->input('bio');
            $user->save();

        }else{
            $user = Auth::user();
            $user->username = $request->input('username');
            $user->mail = $request->input('mail');
            $user->password = bcrypt($request->input('password2'));
            $user->bio = $request->input('bio');
            $user->images = $request->input('images');
            $user->save();
        }
            return redirect()->route('profile_edit')->with('msg_success', 'プロフィールの更新が完了しました');
    }

        // 相手のプロフィール

    public function followerProfile($id, Request $request){

        $follow_count = DB::table('follows')->where('follow',Auth::id())->count();
        $follower_count = DB::table('follows')->where('follower',Auth::id())->count();

        $user = User::find($id);
        $posts = DB::table('posts')->join('users','posts.user_id','=','users.id')->where('user_id', $id)->get();

        return view('users.profile', compact('user'))->with([ 'posts' =>$posts, 'follow_count' =>$follow_count, 'follower_count' =>$follower_count, ]);
    }


    public function search(Request $request){

        $keyword = $request->input('keyword');
        $query = User::query();

        $follow_count = DB::table('follows')->where('follow',Auth::id())->count();
        $follower_count = DB::table('follows')->where('follower',Auth::id())->count();

        if(!empty($keyword)) {
            $query->where('username', 'LIKE', "%{$keyword}%");
        }
            $username = $query->get();

        return view('users.search', compact('username', 'keyword'))->with(['follow_count' =>$follow_count, 'follower_count' =>$follower_count]);
    }



}
