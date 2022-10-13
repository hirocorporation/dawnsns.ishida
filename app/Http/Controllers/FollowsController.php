<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Post;
use App\Follow;
use App\User;
use Illuminate\Support\Facades\DB;

//

class FollowsController extends Controller
{
    //
    public function followList(Request $request){
        $post = Post::orderBy('created_at', 'desc')->get();

        $follow_count = DB::table('follows')->where('follow',Auth::id())->count();
        $follower_count = DB::table('follows')->where('follower',Auth::id())->count();

        return view('follows.followList')->with(['post' =>$post], ['follow_count' =>$follow_count], ['follower_count' =>$follower_count]);
    }

    public function followerList(Request $request){
        $post = Post::orderBy('created_at', 'desc')->get();

        $follow_count = DB::table('follows')->where('follow',Auth::id())->count();
        $follower_count = DB::table('follows')->where('follower',Auth::id())->count();

        return view('follows.followerList')->with(['post' =>$post], ['follow_count' =>$follow_count], ['follower_count' =>$follower_count]);
    }

    // フォローする、解除ボタン作成
    public function follow(Int $id){
        $follower = auth()->user();

        $is_following = $follower->isFollowing($id);
        if(!$is_following){
            $follower->follow($id);

            return back();
        }
    }

    public function unfollow(Int $id){
        $follower = auth()->user();

        $is_following = $follower->isFollowing($id);
        if($is_following){
            $follower->unfollow($id);

            return back();
        }
    }
}
