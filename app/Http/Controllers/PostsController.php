<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//投稿フォーム作成で以下追加した
use App\Http\Controllers\Controller;
use App\Post;
use App\Follow;
//

class PostsController extends Controller
{
    //
    public function index(){
        if (auth::check()){

     // 3.3 サイドバー/フォロー,フォロワー数の表示
    $follow_count = DB::table('follows')->where('follow',Auth::id())->count();
    $follower_count = DB::table('follows')->where('follower',Auth::id())->count();

        return view('posts.index')->with(['follow_count' =>$follow_count], ['follower_count' =>$follower_count]);
    } else {
        return view('auth.login');
    }
}

//ここから↓投稿欄
public function showCreateForm (Request $request)
{
    $post = Post::orderBy('created_at', 'desc')->get();

    // 3.3 サイドバー/フォロー,フォロワー数の表示
    $follow_count = DB::table('follows')->where('follow',Auth::id())->count();
    $follower_count = DB::table('follows')->where('follower',Auth::id())->count();

    return view('posts.index')->with(['post' =>$post], ['follow_count' =>$follow_count], ['follower_count' =>$follower_count]);
}

public function create(Request $request){

$validator = $request->validate([
    'posts' => ['required', 'string', 'max:150'],
]);

    Post::create([
        'user_id' => Auth::user()->id,
        'posts' => $request->posts,
    ]);

    return back();
}
}
