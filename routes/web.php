<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');

Route::get('/', function () {
    return view('/auth/login');
})->name('login');

// ログイン後投稿編集画面へ
Route::get('/posts/index', function() {
    // 認証済みのユーザーのみが入れる
})->middleware('auth');
Route::post('/posts/index', 'PostsController@index');


//ログイン中のページ
Route::group(['middleware' => 'auth'], function() {

    Route::get('/top','PostsController@index');

    Route::get('/profile','UsersController@profile');

    Route::get('/search','UsersController@search');

    Route::get('/followList','FollowsController@followList');
    Route::get('/followerList','FollowsController@followerList');

    Route::get('/logout', 'Auth\LoginController@logout');

//投稿フォーム作成で以下作成した
Route::get('/top', 'PostsController@showCreateForm');
Route::post('/posts/index', 'PostsController@create');


//

});
