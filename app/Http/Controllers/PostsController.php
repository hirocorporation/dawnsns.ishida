<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//投稿フォーム作成で以下追加した
use App\Http\Controllers\Controller;
use App\Post;
//

class PostsController extends Controller
{
    //
    public function index(){
        if (auth::check()){
        return view('posts.index');
    } else {
        return view('auth.login');
    }


}

//ここから↓投稿欄
public function showCreateForm (Request $request)
{
    $post = Post::orderBy('created_at', 'desc')->get();
    return view('posts.index')->with(['post' =>$post]);
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

// ここまで

}
