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
        $follow_id = DB::table('follows')->where('follower',Auth::id())->pluck('follow');
        $posts = DB::table('posts')->join('users','posts.user_id','=','users.id')->where('user_id',Auth::id())->orWhereIn('user_id',$follow_id)->get();

        $follow_count = DB::table('follows')->where('follow',Auth::id())->count();
        $follower_count = DB::table('follows')->where('follower',Auth::id())->count();

        return view('posts.index')->with(['posts' =>$posts, 'follow_count' => $follow_count, 'follower_count' =>$follower_count]);
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

        $follower_id = DB::table('follows')->where('follow',Auth::id())->pluck('follower');
        $posts = DB::table('posts')->join('users','posts.user_id','=','users.id')->where('user_id',Auth::id())->orWhereIn('user_id',$follower_id)->get();


        $follow_count = DB::table('follows')->where('follow',Auth::id())->count();
        $follower_count = DB::table('follows')->where('follower',Auth::id())->count();

        return view('follows.followerList')->with(['posts' => $posts, 'follow_count' => $follow_count, 'follower_count' =>$follower_count]);
    }

public function followTimeline() {

        $follow_id = DB::table('follows')->where('follower',Auth::id())->pluck('follow');
        $posts = DB::table('posts')->join('users','posts.user_id','=','users.id')->where('user_id',Auth::id())->orWhereIn('user_id',$follow_id)->get();

        $follow_count = DB::table('follows')->where('follow',Auth::id())->count();
        $follower_count = DB::table('follows')->where('follower',Auth::id())->count();

        return view('follows.followList')->with(['posts' => $posts, 'follow_count' => $follow_count, 'follower_count' =>$follower_count]);
    }

}
