<?php

class CookbookStep extends BaseModel
{
    protected $fillable = array('cookbook_id');
    /**
     * 数据库表名称（不包含前缀）
     * @var string
     */
    protected $table = 'cookbook_steps';
}