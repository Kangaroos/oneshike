<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::dropIfExists('users');
        Schema::create('users', function(Blueprint $table)
        {
            $table->engine = 'MyISAM';
            $table->increments('id');//自增唯一ID
            $table->string('email',255);//邮箱
            $table->string('password', 64);//密码
            $table->string('remember_token', 100)->nullable();//记住我
            $table->string('signature', 128)->nullable();//签名
            $table->string('nickname', 60)->nullable();//昵称
            $table->char('status',3)->default('001');//用户状态
            $table->char('level',3)->default('001');//会员等级
            $table->integer('points')->default(0);//会员积分
            $table->string('phone_number', 16)->nullable();//联系电话
            $table->string('avatar')->default('/static/img/blank-head.png')->nullable();//头像
            $table->string('qq')->nullable();//QQ
            $table->string('wechat')->nullable();//微信
            $table->string('age')->nullable();//年龄
            $table->string('address', 128)->nullable();//收货地址
            $table->timestamp('signin_at')->nullable()->comment('最后登录时间');
            $table->timestamp('activated_at')->nullable()->comment('邮箱激活时间');
            $table->string('signin_ip')->nullable();
            $table->integer('signin_count')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists('users');
	}

}
