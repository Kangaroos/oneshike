<?php

class  AdminTableSeeder extends Seeder {

    public function run()
    {
        DB::table('admins')->delete();
        Admin::create(array(
            'account' => 'admin',
            'pwd' => Hash::make('admin'),
            'name'=> '超级管理员'
        ));
    }
}