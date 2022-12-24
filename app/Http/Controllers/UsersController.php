<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;
use App\Follow;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;



class UsersController extends \App\Http\Controllers\Controller
{
    //
    public function profile(Request $request, User $user){

        $user = Auth::user();

        $follow_count = DB::table('follows')->where('follow',Auth::id())->count();
        $follower_count = DB::table('follows')->where('follower',Auth::id())->count();

        return view('posts.profile')->with(['user' => $user, 'follow_count' =>$follow_count, 'follower_count' =>$follower_count, ]);

    }

    public function profileUpdate(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required|string|min:4|max:12',
            'mail' => ['required', 'string', 'email', 'min:4', 'max:12', Rule::unique('users')->ignore(Auth::id())],
            'password2' => 'nullable', 'min:4',
            'bio' => 'string|max:200|nullable',
            'images' => 'nullable',
        ], [
        'username.required' => 'ユーザー名は必須項目です',
        'username.min' => 'ユーザー名は4文字以上で入力してください',
        'username.max' => 'ユーザー名は12文字以内で入力してください',
		'mail.required' => 'メールアドレスは必須項目です',
		'mail.email' => 'メールアドレスではありません',
        'mail.min' => 'メールアドレスは4文字以上で入力してください',
        'mail.max' => 'メールアドレスは12文字以内で入力してください',
        'mail.unique' => 'このメールアドレスは既に使われています。',
		'password2.required' => 'パスワードは必須項目です',
		'password2.min' => 'パスワードは4文字以上で入力してください',
        'password2.alpha_num' => 'パスワードは半角英数字で入力してください',
        'bio.max' => '自己紹介文は200文字以内で入力してください',
	]);


        // パターン１
        // もしimagesのフォームが空なら、imagesをスルーしてimages以外の項目を更新する。それ以外の場合は（imagesのフォームに値があれば、すべての項目を更新する。※このパターンの場合、画像を選択しても更新されずそのまま）
// dd($user->bio);
        // if(!isset($file_name)){
        //     $user = Auth::user();
        //     $user->username = $request->input('username');
        //     $user->mail = $request->input('mail');
        //     $user->password = bcrypt($request->input('password2'));
        //     $user->bio = $request->input('bio');

        //     $user->save();

        // }else{
        //     $user = Auth::user();
        //     $user->username = $request->input('username');
        //     $user->mail = $request->input('mail');
        //     $user->password = bcrypt($request->input('password2'));
        //     $user->bio = $request->input('bio');
        //                         $dir = 'sample';
        // $file_name = $request->file('images')->getClientOriginalName();
        // $request->file('images')->storeAs('public/' . $dir, $file_name);
        // $user->images = $file_name;
        // $user->images = 'storage/' . $dir . '/' . $file_name;
        // $user->save();
        // }

// パターン２
// 特に条件分岐させない記述だと、選択した画像でimagesは更新できる。でも画像を選択しないと空だと怒られる。バリデーションで'nullable'してるつもりだけど意味ない。
// ※Call to a member function getClientOriginalName() on null
            $user = Auth::user();
            $id = Auth::id();
            $username = $request->input('username');
            $mail = $request->input('mail');
            $password = bcrypt($request->input('password2'));
            $bio = $request->input('bio');

            DB::table('users')
              ->where('id', $id)
              ->update(['username' => $username ,'mail' => $mail ,'password' => $password , 'bio' => $bio]);

            if(!empty($request->file('images'))){

                $file_name = $request->file('images')->getClientOriginalName();
                $request->file('images')->storeAs('public/images' , $file_name);
                $user->images = $file_name;
                DB::table('users')
                    ->where('id', $id)
                    ->update(['images' => $file_name]);
                // $user->images = 'storage/' . $dir . '/' . $file_name;
                // $user->save();
            }
            return redirect()->route('profile_edit')->with('msg_success', 'プロフィールの更新が完了しました');
    }

        // 相手のプロフィール

    public function followerProfile($id, Request $request){

        $follow_count = DB::table('follows')->where('follow',Auth::id())->count();
        $follower_count = DB::table('follows')->where('follower',Auth::id())->count();

        $user = User::find($id);
        $posts = DB::table('posts')->join('users','posts.user_id','=','users.id')->where('user_id', $id)->get();

        return view('users.profile', compact('user'))->with([ 'posts' =>$posts, 'follow_count' =>$follow_count, 'follower_count' =>$follower_count, ]);
    }


    public function search(Request $request){

        $keyword = $request->input('keyword');
        $query = User::query();

        $follow_count = DB::table('follows')->where('follow',Auth::id())->count();
        $follower_count = DB::table('follows')->where('follower',Auth::id())->count();

        if(!empty($keyword)) {
            $query->where('username', 'LIKE', "%{$keyword}%");
        }
            $username = $query->get();

        return view('users.search', compact('username', 'keyword'))->with(['follow_count' =>$follow_count, 'follower_count' =>$follower_count]);
    }



}
