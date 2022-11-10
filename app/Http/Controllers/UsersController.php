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

        return view('posts.profile')->with(['user' => $user, 'follow_count' =>$follow_count, 'follower_count' =>$follower_count]);

    }

    public function profileUpdate(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required|string|min:4|max:12',
            'mail' => ['required', 'string', 'email', 'min:4', 'max:12', Rule::unique('users')->ignore(Auth::id())],
            'password' => 'required', 'min:4', 'max:12',
            'bio' => 'string|max:200|nullable',
            'images' => 'file|nullable',
        ]);

        if(!isset($image)){
            $user = Auth::user();
            $user->username = $request->input('username');
            $user->mail = $request->input('mail');
            $user->password = bcrypt($request->input('password'));
            $user->bio = $request->input('bio');
            $user->save();

        }else{
            $user = Auth::user();
            $user->username = $request->input('username');
            $user->mail = $request->input('mail');
            $user->bio = $request->input('bio');
            $user->save();
        }

            return redirect()->route('profile_edit')->with('msg_success', 'プロフィールの更新が完了しました');
    }

        // 相手のプロフィール

    public function followerProfile($id){

        $follow_count = DB::table('follows')->where('follow',Auth::id())->count();
        $follower_count = DB::table('follows')->where('follower',Auth::id())->count();

        $user = User::find($id);

        return view('users.profile', compact('user'))->with([ 'follow_count' =>$follow_count, 'follower_count' =>$follower_count, ]);
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
