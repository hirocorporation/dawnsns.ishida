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
//トップページ
    public function index(Request $request){
        if (auth::check()){
            $follow_id = DB::table('follows')->where('follower',Auth::id())->pluck('follow');
            $posts = DB::table('posts')->join('users','posts.user_id','=','users.id')->where('user_id',Auth::id())->orWhereIn('user_id',$follow_id)->select('posts.*', 'users.username', 'users.images')->get()->sortByDesc('created_at');
            $follow_count = DB::table('follows')->where('follow',Auth::id())->count();
            $follower_count = DB::table('follows')->where('follower',Auth::id())->count();
            return view('posts.index')->with(['posts' =>$posts, 'follow_count' => $follow_count, 'follower_count' =>$follower_count,]);
        } else {
            return view('auth.login');
    }
}

// 自分の投稿内容編集
    public function postUpdate(Request $request)
    {
        $request->validate([
            'modal-post' => 'required|string|min:4|max:150',
        ]);
        $up_post = $request->input('modal-post');
        $id = $request->input('id');

        // dd($up_post);
        DB::table('posts')
            ->where('id', $id)
            ->update(
                ['posts' => $up_post]
            );
        return redirect('/top');
    }

// 自分の投稿のみに編集・削除ボタンを設置
    public function destroy($id){
        Post::where('id', $id)->delete();
        return back();
    }

// 新しいつぶやきを投稿
    public function create(Request $request){
        $validator = $request->validate([
            'new-post' => ['required', 'string', 'max:150'],
            ],[
            'new-post.required' => 'つぶやきを入力してください',
            'new-post.string' => '文字列ではありません',
            'new-post.max:150' => '150字以内で入力してください'
        ]);
        Post::create([
        'user_id' => Auth::user()->id,
        'posts' => $request->input('new-post'),
        ]);
        return back();
    }

// フォローしたユーザーの投稿表示
    public function followTimeline() {
        $follow_id = DB::table('follows')->where('follower',Auth::id())->pluck('follow');
        $posts = DB::table('posts')->join('users','posts.user_id','=','users.id')->where('user_id',Auth::id())->orWhereIn('user_id',$follow_id)->get();
        $follow_user = DB::table('follows')->join('users','follows.follow','=','users.id')->where('follow',Auth::id())->orWhereIn('follow',$follow_id)->get();
        $follow_count = DB::table('follows')->where('follow',Auth::id())->count();
        $follower_count = DB::table('follows')->where('follower',Auth::id())->count();
        return view('follows.followList')->with(['follow_user' => $follow_user, 'posts' => $posts, 'follow_count' => $follow_count, 'follower_count' =>$follower_count]);
    }

// フォローされたユーザーの投稿表示
    public function followerTimeline() {
        $follower_id = DB::table('follows')->where('follow',Auth::id())->pluck('follower');
        $posts = DB::table('posts')->join('users','posts.user_id','=','users.id')->where('user_id',Auth::id())->orWhereIn('user_id',$follower_id)->get();
        $follower_user = DB::table('follows')->join('users','follows.follower','=','users.id')->where('follower',Auth::id())->orWhereIn('follower',$follower_id)->get();
        $follow_count = DB::table('follows')->where('follow',Auth::id())->count();
        $follower_count = DB::table('follows')->where('follower',Auth::id())->count();
        return view('follows.followerList')->with(['follower_user' => $follower_user, 'posts' => $posts, 'follow_count' => $follow_count, 'follower_count' =>$follower_count]);
    }
}
