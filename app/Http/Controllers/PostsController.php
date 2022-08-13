<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
