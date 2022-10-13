<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;
use App\Follow;
use Illuminate\Support\Facades\DB;
//

class PostsController extends Controller
{
    //
    public function index(Request $request){
        if (auth::check()){
            $post = Post::orderBy('created_at', 'desc')->get();

        $follow_count = DB::table('follows')->where('follow',Auth::id())->count();
        $follower_count = DB::table('follows')->where('follower',Auth::id())->count();

        return view('posts.index')->with(['post' =>$post, 'follow_count' => $follow_count, 'follower_count' =>$follower_count]);
         } else {
        return view('auth.login');
    }
}


      public function create(Request $request){

        $validator = $request->validate(['posts' => ['required', 'string', 'max:150'],]);
        Post::create([
        'user_id' => Auth::user()->id,
        'posts' => $request->posts,
        ]);

    return back();


}

// フォローしたユーザーの投稿を取得

public function followerTimeline() {
        $posts = Post::query()->whereIn('user_id', Auth::user()->follows()->pluck('follower'))->orWhere('user_id', Auth::user()->id)->latest()->first();

        $follow_count = DB::table('follows')->where('follow',Auth::id())->count();
        $follower_count = DB::table('follows')->where('follower',Auth::id())->count();

        return view('follows.followerList')->with(['posts' => $posts, 'follow_count' => $follow_count, 'follower_count' =>$follower_count]);
    }

public function followTimeline() {
        $posts = Post::query()->whereIn('user_id', Auth::user()->follows()->pluck('follow'))->orWhere('user_id', Auth::user()->id)->latest()->first();

        $follow_count = DB::table('follows')->where('follow',Auth::id())->count();
        $follower_count = DB::table('follows')->where('follower',Auth::id())->count();

        return view('follows.followList')->with(['posts' => $posts, 'follow_count' => $follow_count, 'follower_count' =>$follower_count]);
    }

}
