<?php

class DraftCookbook extends BaseModel
{
    protected $fillable = array('user_id', 'status');
    /**
     * 数据库表名称（不包含前缀）
     * @var string
     */
    protected $table = 'draft_cookbooks';

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

    public static function boot()
    {
        parent::boot();

        static::deleting(function($model)
        {
            foreach($model->steps as $step) {
                $picture = $step->picture;
                if($step->delete()) {
                    File::delete(public_path($picture));
                    return true;
                } else {
                    return false;
                }
            }

            foreach($model->foods as $food) {
                if($food->delete()) {
                    return true;
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

    public function foods()
    {
        return $this->hasMany('DraftCookbookFood', 'cookbook_id');
    }

    public function steps()
    {
        return $this->hasMany('DraftCookbookStep', 'cookbook_id');
    }
}