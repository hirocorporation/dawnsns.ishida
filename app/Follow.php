<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\Follow as Authenticatable;

class Follow extends Model
{
    //
    // フォローするボタン フォロー解除するボタン作成中
    public function follow(Int $user_id){
        return $this->follows()->attach($user_id);
    }
    public function unfollow(Int $user_id){
        return $this->follows()->detach($user_id);
    }
    public function isFollowing(Int $user_id){
        return (boolean) $this->follows()->where('follower', $user_id)->first(['id']);
    }
    public function isFollowed(Int $user_id){
        return (boolean) $this
        ->followers()->where('follow', $user_id)->first(['id']);
    }

}
