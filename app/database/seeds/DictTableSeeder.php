<?php

class  DictTableSeeder extends Seeder {

    public function run()
    {
        DB::table('dicts')->delete();
        Dict::create(array(
            'code' => 'USER_LEVEL',
            'name' => '会员等级',
            'para_code' => '001',
            'para_name' => '食客'
        ));
        Dict::create(array(
            'code' => 'USER_LEVEL',
            'name' => '会员等级',
            'para_code' => '002',
            'para_name' => '高级食客'
        ));
        Dict::create(array(
            'code' => 'USER_LEVEL',
            'name' => '会员等级',
            'para_code' => '003',
            'para_name' => '美食家'
        ));
        Dict::create(array(
            'code' => 'USER_STATUS',
            'name' => '会员状态',
            'para_code' => '001',
            'para_name' => '正常'
        ));
        Dict::create(array(
            'code' => 'USER_STATUS',
            'name' => '会员状态',
            'para_code' => '002',
            'para_name' => '待审核'
        ));
        Dict::create(array(
            'code' => 'USER_STATUS',
            'name' => '会员状态',
            'para_code' => '003',
            'para_name' => '已禁用'
        ));
    }
}