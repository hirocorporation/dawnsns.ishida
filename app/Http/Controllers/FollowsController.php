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
