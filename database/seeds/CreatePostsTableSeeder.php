<?php

use Illuminate\Database\Seeder;

class CreatePostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('posts')->insert([
            ['posts' => '1つ目の投稿になります'],
            ['posts' => 'Laravelの投稿ページを作りました'],
            ['posts' => '投稿についてのCRUD一式を作っています'],
            ['posts' => 'MVCの役割を体験中です'],
            ['posts' => '初期レコードがこれで終わりです。']
        ]);
    }
}
