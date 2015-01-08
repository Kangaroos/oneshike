<?php

class Cookbook extends BaseModel
{
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    protected $fillable = array('draft_cookbook_id');

    /**
     * 数据库表名称（不包含前缀）
     * @var string
     */
    protected $table = 'cookbooks';

    public static $rules  = array(
        'title'    => 'required'
    );

    /**
     * 自定义验证消息
     * @var array
     */
    public static $validatorMessages = array(
        'title.required'      => '请输入标题。'
    );

    public function steps()
    {
        return $this->hasMany('CookbookStep');
    }

    public function foods()
    {
        return $this->hasMany('CookbookFood');
    }
}