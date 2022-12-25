<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id', 'posts',
    ];

    // 投稿は一つの投稿者に従属することを意味する記述
    public function user(){
        return $this->belongsTo(User::class);
    }
}
