<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder {

	public function run()
	{
		//$faker = Faker::create();这个可能是随机数据模块

        DB::table('products')->delete();

		foreach(range(1, 2) as $index)
		{
			Product::create([
                'name'=>'狗屎'.$index,
                'category'=>'PRODUCT_CATEGORY_xxsp'
			]);
		}
	}

}