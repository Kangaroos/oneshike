<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::dropIfExists('articles');
        Schema::create('articles', function(Blueprint $table)
        {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->integer('draft_article_id')   ->nullable()         ->comment('关联草稿文章ID');
            $table->integer('user_id')            ->unsigned()         ->comment('作者ID');
            $table->string('title', 100)->unique()->nullable()->comment('标题');
            $table->text('content')->nullable()->comment('内容');
            $table->enum('content_format', array('markdown', 'html'))
                ->default('html')->comment('内容格式，为后期加入非 markdown 编辑器做准备');
            $table->smallInteger('comments_count')->default(0)         ->comment('评论数');
            $table->smallInteger('likes_count')->default(0)         ->comment('喜欢数');
            $table->smallInteger('read_count')->default(0)         ->comment('阅读数');
            $table->timestamps();
            $table->softDeletes();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists('articles');
	}

}
