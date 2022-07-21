<?php

use Illuminate\Database\Seeder;

class CreateUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
           DB::table('users')->insert([
            [
            'username' => '初期ユーザー',
            'mail' => 'shoki@mail.com',
            'password' => 'shoki123',
            'bio' => '初期ユーザーです。宜しくお願いします。',
            ]
        ]);
    }
}
