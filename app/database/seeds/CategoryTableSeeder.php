<?php

class  CategoryTableSeeder extends Seeder {

    public function run()
    {
        DB::table('categorys')->delete();
        Category::create(array(
            'code' => 'FOOD_AREA',
            'parent_code' => 'FOOD',
            'level' => 1,
            'name'=> '原产地'
        ));

        Category::create(array(
            'code' => 'FOOD_CATEGORY',
            'parent_code' => 'FOOD',
            'level' => 1,
            'name'=> '食材分类'
        ));

        /*** 菜系 ***/

        Category::create(array(
            'code' => 'COOKBOOK_STYLE',
            'parent_code' => 'COOKBOOK',
            'level' => 1,
            'name'=> '菜系'
        ));

        Category::create(array(
            'code' => 'MIN_CAI',
            'parent_code' => 'COOKBOOK_STYLE',
            'level' => 2,
            'name'=> '闽菜'
        ));

        Category::create(array(
            'code' => 'YUE_CAI',
            'parent_code' => 'COOKBOOK_STYLE',
            'level' => 2,
            'name'=> '粤菜'
        ));

        Category::create(array(
            'code' => 'XIANG_CAI',
            'parent_code' => 'COOKBOOK_STYLE',
            'level' => 2,
            'name'=> '湘菜'
        ));

        /*** 人群/场景 ***/

        Category::create(array(
            'code' => 'COOKBOOK_CROWD',
            'parent_code' => 'COOKBOOK',
            'level' => 1,
            'name'=> '人群/场景'
        ));

        Category::create(array(
            'code' => 'ZCSP',
            'parent_code' => 'COOKBOOK_CROWD',
            'level' => 2,
            'name'=> '早餐食谱'
        ));

        Category::create(array(
            'code' => 'YFSP',
            'parent_code' => 'COOKBOOK_CROWD',
            'level' => 2,
            'name'=> '孕妇食谱'
        ));

        Category::create(array(
            'code' => 'CFSP',
            'parent_code' => 'COOKBOOK_CROWD',
            'level' => 2,
            'name'=> '产妇食谱'
        ));

        /*** 菜式 ***/

        Category::create(array(
            'code' => 'COOKBOOK_THEME',
            'parent_code' => 'COOKBOOK',
            'level' => 1,
            'name'=> '菜式'
        ));

        Category::create(array(
            'code' => 'JIA_CHANG',
            'parent_code' => 'COOKBOOK_THEME',
            'level' => 2,
            'name'=> '家常菜'
        ));

        Category::create(array(
            'code' => 'XIA_FAN',
            'parent_code' => 'COOKBOOK_THEME',
            'level' => 2,
            'name'=> '下饭菜'
        ));

        Category::create(array(
            'code' => 'TIAN_PIN',
            'parent_code' => 'COOKBOOK_THEME',
            'level' => 2,
            'name'=> '甜品'
        ));

        Category::create(array(
            'code' => 'ROU_LEI',
            'parent_code' => 'COOKBOOK_THEME',
            'level' => 2,
            'name'=> '家常菜'
        ));

        /*** 烹饪方法 ***/

        Category::create(array(
            'code' => 'COOKBOOK_METHOD',
            'parent_code' => 'COOKBOOK',
            'level' => 1,
            'name'=> '烹饪方法'
        ));

        Category::create(array(
            'code' => 'JIAN',
            'parent_code' => 'COOKBOOK_METHOD',
            'level' => 2,
            'name'=> '煎'
        ));

        Category::create(array(
            'code' => 'CHAO',
            'parent_code' => 'COOKBOOK_METHOD',
            'level' => 2,
            'name'=> '炒'
        ));

        Category::create(array(
            'code' => 'ZHA',
            'parent_code' => 'COOKBOOK_METHOD',
            'level' => 2,
            'name'=> '炸'
        ));

        /*** 商品分类 ***/
        Category::create(array(
            'code' => 'PRODUCT_CATEGORY_XXSP',
            'parent_code' => 'PRODUCT_CATEGORY',
            'level' => 2,
            'name'=> '休闲食品'
        ));

        /*** 图文分类 ***/
        Category::create(array(
            'code' => 'ARTICLE_CATEGORY',
            'parent_code' => 'ARTICLE',
            'level' => 1,
            'name'=> '图文分类'
        ));

        Category::create(array(
            'code' => 'ARTICLE_CATEGORY_OTHER',
            'parent_code' => 'ARTICLE_CATEGORY',
            'level' => 2,
            'name'=> '其他'
        ));
    }
}