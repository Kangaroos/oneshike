<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCookbookFoodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::dropIfExists('cookbook_foods');
        Schema::create('cookbook_foods', function(Blueprint $table)
        {
            $table->engine = 'MyISAM';
            $table->increments('id');//自增唯一ID
            $table->integer('cookbook_id');//关联编码
            $table->string('name',100);//路径
            $table->string('quantity',100);//缩略图路径
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists('cookbook_foods');
	}

}
