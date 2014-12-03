<?php

class Article extends BaseModel
{
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    protected $fillable = array('draft_article_id');
    /**
     * 数据库表名称（不包含前缀）
     * @var string
     */
    protected $table = 'articles';

    public static $rules  = array(
        'title'    => 'required',
        'content'    => 'required'
    );

    /**
     * 自定义验证消息
     * @var array
     */
    public static $validatorMessages = array(
        'title.required'      => '请输入标题。',
        'content.required'      => '请输入内容。'
    );

    public function pictures()
    {
        return $this->hasMany('ArticlePicture');
    }
}