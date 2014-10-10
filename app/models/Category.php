<?php

class Category extends BaseModel
{
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    /**
     * 数据库表名称（不包含前缀）
     * @var string
     */
    protected $table = 'categorys';

    public static $rules  = array(
        'code'    => 'required',
        'parent_code'    => 'required',
        'name'    => 'required',
        'level'    => 'required'
    );

    /**
     * 自定义验证消息
     * @var array
     */
    public static $validatorMessages = array(
        'code.required'      => '请输入分类编码。',
        'parent_code.required'      => '请输入父编码。',
        'name.required'      => '请输入分类名称。',
        'level.required'      => '请输入层级。',
    );
}