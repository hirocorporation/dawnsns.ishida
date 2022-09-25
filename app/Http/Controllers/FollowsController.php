<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Post;
use App\Follow;
use App\User;

//

class FollowsController extends Controller
{
    //
    public function followList(Request $request){
        $post = Post::orderBy('created_at', 'desc')->get();
        return view('follows.followList')->with(['post' =>$post]);
    }
    public function followerList(Request $request){
        $post = Post::orderBy('created_at', 'desc')->get();
        return view('follows.followerList')->with(['post' =>$post]);
    }

    // フォローする、解除ボタン作成中
    public function follow(Follow $user){
        $follower = auth()->follow();

        $is_following = $follower->isFollowing($user->id);
        if(!$is_following){
            $follower->follow($user->id);
            return back();
        }
    }

    public function unfollow(Follow $user){
        $follower = auth()->follow();

        $is_following = $follower->isFollowing($user->id);
        if($is_following){
            $follower->unfollow($user->id);
            return back();
    }
}

}
