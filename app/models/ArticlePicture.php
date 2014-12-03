<?php

class ArticlePicture extends BaseModel
{
    protected $fillable = array('article_id');
    /**
     * 数据库表名称（不包含前缀）
     * @var string
     */
    protected $table = 'article_pictures';
}