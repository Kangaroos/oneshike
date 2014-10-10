<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::dropIfExists('admin_logs');
        Schema::create('admin_logs', function(Blueprint $table)
        {
            $table->increments('id');//自增唯一ID
            $table->integer('admin_id')->nullable();//操作用户
            $table->timestamp('time')->nullable();//操作时间
            $table->char('type',3)->nullable();//操作类型
            $table->string('remark')->nullable();//备注
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
        Schema::dropIfExists('admin_logs');
	}

}
