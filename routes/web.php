<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostsController;

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

// ログインユーザーのみ表示可能
Route::get('/posts/index', function() {
})->middleware('auth');
Route::post('/posts/index', 'PostsController@create');

//ログイン中のページ
Route::group(['middleware' => 'auth'], function() {

    Route::get('/top', [App\Http\Controllers\PostsController::class, 'index'])->name('posts.index');

    // 自分の投稿のみに編集・削除ボタンを設置
    Route::post('/post-edit', [App\Http\Controllers\PostsController::class, 'postUpdate'])->name('post_edit');
    Route::delete('/top/{id}', [App\Http\Controllers\PostsController::class, 'destroy'])->name('posts.destroy');

    // 自分のプロフィール編集ページ
    Route::get('/posts/profile','UsersController@profile');
    Route::post('/posts/profile', [App\Http\Controllers\UsersController::class, 'profileUpdate'])->name('profile_edit');

    // 他のユーザーのプロフィールページ
    Route::get('/users/profile/{id}', [App\Http\Controllers\UsersController::class, 'followerProfile'])
    ->name('users.profile');

    // フォローする/フォロー解除するボタン設置（他のユーザーのプロフィールページ）
    Route::post('/users/profile/{id}/follow', 'FollowsController@follow')->name('follow');
    Route::delete('/users/profile/{id}/unfollow', 'FollowsController@unfollow')->name('unfollow');

    // ユーザー検索ページ
    Route::get('/search', [App\Http\Controllers\UsersController::class, 'search'])
    ->name('users.search');

    // フォローする/フォロー解除するボタン設置（ユーザー検索ページ）
    Route::post('/search/{id}/follow', 'FollowsController@follow')->name('follow');
    Route::delete('/search/{id}/unfollow', 'FollowsController@unfollow')->name('unfollow');

    // フォロー/フォロワーの一覧画面
    Route::get('/followerList','PostsController@followerTimeline');
    Route::get('/followList','PostsController@followTimeline');

    Route::get('/logout', 'Auth\LoginController@logout');
});
