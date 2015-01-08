<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCookbookStepsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::dropIfExists('cookbook_steps');
        Schema::create('cookbook_steps', function(Blueprint $table)
        {
            $table->engine = 'MyISAM';
            $table->increments('id');//自增唯一ID
            $table->integer('cookbook_id');//关联编码
            $table->string('picture',255);//步骤图
            $table->string('desc',255)->nullable();//图片描述
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists('cookbook_steps');
	}

}
