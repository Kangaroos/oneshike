<?php

class Dict extends BaseModel
{
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    /**
     * 数据库表名称（不包含前缀）
     * @var string
     */
    protected $table = 'dicts';

    public static $rules  = array(
        'code'    => 'required',
        'name'    => 'required',
        'para_code'    => 'required',
        'para_name'    => 'required'
    );

    /**
     * 自定义验证消息
     * @var array
     */
    public static $validatorMessages = array(
        'code.required'      => '请输入字典组编码。',
        'name.required'      => '请输入字典组名称。',
        'para_code.required'      => '请输入字典编码。',
        'para_name.required'      => '请输入字典名称。'
    );
}