<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use App\Follow;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    //
    public function profile(Request $request){

        $follow_count = DB::table('follows')->where('follow',Auth::id())->count();
        $follower_count = DB::table('follows')->where('follower',Auth::id())->count();

        return view('users.profile')->with(['follow_count' =>$follow_count, 'follower_count' =>$follower_count]);

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
