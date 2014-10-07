<?php

class Product extends BaseModel
{
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    /**
     * 数据库表名称（不包含前缀）
     * @var string
     */
    protected $table = 'products';
}