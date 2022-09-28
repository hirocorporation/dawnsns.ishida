<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\Follow as Authenticatable;

class Follow extends Model
{
        //// フォロー数/フォロワー数の表示
    public function getFollowCount($user_id)
    {
        return $this->where('follow', $user_id)->count();
    }

    public function getFollowerCount($user_id)
    {
        return $this->where('follower', $user_id)->count();
    }
}
