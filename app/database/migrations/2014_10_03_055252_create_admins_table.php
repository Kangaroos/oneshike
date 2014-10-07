<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::dropIfExists('admins');
        Schema::create('admins', function(Blueprint $table)
        {
            $table->increments('id');//自增唯一ID
            $table->string('account', 60)->index();//登录名
            $table->string('pwd', 64);//密码
            $table->string('name', 60)->nullable();//显示名称
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
        Schema::dropIfExists('admins');
	}

}
