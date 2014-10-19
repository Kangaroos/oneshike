<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

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
        'account'    => 'required',
        'email'    => 'required'
    );

    /**
     * 自定义验证消息
     * @var array
     */
    public static $validatorMessages = array(
        'account.required'      => '请输入用户名。',
        'email.required'      => '请输入邮箱。'
    );
}
