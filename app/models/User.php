<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends BaseModel implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

    public static $rules  = array(
        'email'    => 'required'
    );

    /**
     * 自定义验证消息
     * @var array
     */
    public static $validatorMessages = array(
        'email.required'      => '请输入邮箱。'
    );

    /**
     * 调整器：密码
     * @param  string $value 未处理的密码字符串
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        // 若传入的字符串已经进行了 Hash 加密，则不重复处理
        $this->attributes['password'] = Hash::needsRehash($value) ? Hash::make($value) : $value;
    }
}
