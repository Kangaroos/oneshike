<?php

class Product extends BaseModel
{
    #软删除
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    /**
     * 数据库表名称（不包含前缀）
     * @var string
     */
    protected $table = 'products';

    public static $rules  = array(
        'name'    => 'required',
    );

    /**
     * 自定义验证消息
     * @var array
     */
    public static $validatorMessages = array(
        'name.required'      => '请输入分类名称。'
    );
}