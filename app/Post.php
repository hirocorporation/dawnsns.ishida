<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        'user_id', 'posts',
    ];

    // 投稿の横にユーザーのアイコンと名前を表示させたい
    public function user(){
        return $this->belongsTo(User::class);
    }

}
