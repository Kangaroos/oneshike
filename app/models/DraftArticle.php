<?php

class DraftArticle extends BaseModel
{
    protected $fillable = array('user_id', 'status');
    /**
     * 数据库表名称（不包含前缀）
     * @var string
     */
    protected $table = 'draft_articles';

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

    public static function boot()
    {
        parent::boot();

        static::deleting(function($model)
        {
            foreach($model->pictures as $picture) {
                $path = $picture->path;
                $thumbnail = $picture->thumbnail;
                if($picture->delete()) {
                    File::delete(public_path($path));
                    File::delete(public_path($thumbnail));
                } else {
                    return false;
                }
            }
        });
    }

    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }

    public function pictures()
    {
        return $this->hasMany('DraftArticlePicture', 'article_id');
    }
}