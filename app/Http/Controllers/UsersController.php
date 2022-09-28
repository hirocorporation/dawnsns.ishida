<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;

class UsersController extends Controller
{
    //
    public function profile(){
        return view('users.profile');
    }
    public function search(Request $request){

        $keyword = $request->input('keyword');

        $query = User::query();

        if(!empty($keyword)) {
            $query->where('username', 'LIKE', "%{$keyword}%");
        }

        $username = $query->get();


        return view('users.search', compact('username', 'keyword'));
    }

      // フォロー数/フォロワー数の表示
    public function show(Follow $follower){

        $follow_count = $follower->getFollowCount($id);
        $follower_count = $follower->getFollowerCount($id);

        return view('layouts.login', [
            'follow_count' => $follow_count,
            'follower_count' => $follower_count
        ]);
    }


}
