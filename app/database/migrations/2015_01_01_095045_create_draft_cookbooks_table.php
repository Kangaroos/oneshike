<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDraftCookbooksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::dropIfExists('draft_cookbooks');
        Schema::create('draft_cookbooks', function(Blueprint $table)
        {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->integer('user_id') ->unsigned() ->comment('作者ID');
            $table->string('title', 100)->nullable()->comment('标题');
            $table->string('cover',255)->nullable()->comment('封面');
            $table->string('desc',255)->nullable()->comment('简介');
            $table->string('difficulty',32)->nullable()->comment('难度');
            $table->string('taste',32)->nullable()->comment('口味');
            $table->string('use_hours',32)->nullable()->comment('用时');
            $table->text('tips')->nullable()->comment('小贴士');
            $table->boolean('award')->default(1)->comment('是否独家');
            $table->char('status',3)->default('001');//菜谱状态
            $table->string('memo')->nullable();//审核描述
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
        Schema::dropIfExists('draft_cookbooks');
	}

}
