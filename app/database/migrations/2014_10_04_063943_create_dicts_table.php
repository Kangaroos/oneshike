<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDictsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::dropIfExists('dicts');
        Schema::create('dicts', function(Blueprint $table)
        {
            $table->increments('id');//自增唯一ID
            $table->string('code',32)->nullable();//对象组编码
            $table->string('name', 32)->nullable();//对象组名称
            $table->string('para_code',32)->nullable();//对象编码
            $table->string('para_name',32)->nullable();//对象名称
            $table->string('para_add1',32)->nullable();//对象附加属性1
            $table->string('desc')->nullable();//描述
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
        Schema::dropIfExists('dicts');
	}

}
