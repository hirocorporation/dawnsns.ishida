<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use App\Follow;

class UsersController extends Controller
{
    //
    public function profile(){
                            // 3.3 サイドバー/フォロー,フォロワー数の表示
        $follow_count = DB::table('follows')->where('follow',Auth::id())->count();
        $follower_count = DB::table('follows')->where('follower',Auth::id())->count();

        return view('users.profile')->with(['follow_count' =>$follow_count], ['follower_count' =>$follower_count]);

    }

    public function search(Request $request){

        $keyword = $request->input('keyword');
        $query = User::query();

        if(!empty($keyword)) {
            $query->where('username', 'LIKE', "%{$keyword}%");
        }
            $username = $query->get();

            // 3.3 サイドバー/フォロー,フォロワー数の表示
            $follow_count = DB::table('follows')->where('follow',Auth::id())->count();
            $follower_count = DB::table('follows')->where('follower',Auth::id())->count();

        return view('users.search', compact('username', 'keyword', 'follow_count', 'follower_count'));
    }
}
