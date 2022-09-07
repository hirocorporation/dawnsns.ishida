<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Post;

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
}
