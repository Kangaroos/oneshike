<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCookbooksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::dropIfExists('cookbooks');
        Schema::create('cookbooks', function(Blueprint $table)
        {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->integer('draft_cookbook_id')->nullable()->comment('关联草稿菜谱ID');
            $table->integer('user_id') ->unsigned() ->comment('作者ID');
            $table->string('title', 100)->nullable()->comment('标题');
            $table->string('cover',255)->nullable()->comment('封面');
            $table->string('desc',255)->nullable()->comment('简介');
            $table->string('difficulty',32)->nullable()->comment('难度');
            $table->string('taste',32)->nullable()->comment('口味');
            $table->string('use_hours',32)->nullable()->comment('用时');
            $table->text('tips')->nullable()->comment('小贴士');
            $table->boolean('award')->default(1)->comment('是否独家');
            $table->smallInteger('comments_count')->default(0)         ->comment('评论数');
            $table->smallInteger('likes_count')->default(0)         ->comment('喜欢数');
            $table->smallInteger('read_count')->default(0)         ->comment('阅读数');
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
        Schema::dropIfExists('cookbooks');
	}

}
