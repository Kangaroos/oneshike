<?php

class  UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();
        User::create(array(
            'email' => 'yechunan@qq.com',
            'password' => Hash::make('oneshike'),
            'nickname'=> '叶尐楠'
        ));
    }
}