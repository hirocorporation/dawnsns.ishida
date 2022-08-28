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

//ここから↓投稿欄作成に為に描いた
public function showCreateForm()
{
    return view('posts.index');
}

public function create(Request $request){

   $post = new Post;
        $post->posts = $request->posts;
        $post->save();

    return back();
}



// ここまで

}
