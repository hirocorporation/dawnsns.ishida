<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password', 'bio', 'images'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    // リレーションの設定。投稿者は複数の投稿を持つ。
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function follows()
    {
        return $this->belongsToMany(self::class, 'follows', 'follower', 'follow');
    }

        // フォローする
    public function follow(Int $user_id)
    {
        return $this->follows()->attach($user_id);
    }

    // フォロー解除する
    public function unfollow(Int $user_id)
    {
        return $this->follows()->detach($user_id);
    }

    // フォローしているか
    public function isFollowing(Int $user_id)
    {
        return (bool) $this->follows()->where('follow', $user_id)->first(['follows.id']);
    }

    public function isFollowed(Int $user_id)
    {
        return (bool) $this
            ->followers()->where('follow', $user_id)->first(['follows.id']);
    }

// フォローしたユーザーの投稿を取得
public function follower_follow()
    {
        return $this->belongsToMany('App\User', 'follows', 'follower', 'follow');
    }

    // フォロー→フォロワー
    public function follow_follower()
    {
        return $this->belongsToMany('App\User', 'follows', 'follow', 'follower');
    }

}
