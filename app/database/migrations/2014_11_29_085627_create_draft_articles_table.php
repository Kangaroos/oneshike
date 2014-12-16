<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDraftArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::dropIfExists('draft_articles');
        Schema::create('draft_articles', function(Blueprint $table)
        {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->integer('user_id')            ->unsigned()         ->comment('作者ID');
            $table->string('title', 100)->nullable()->comment('标题');
            $table->text('content')->nullable()->comment('内容');
            $table->enum('content_format', array('markdown', 'html'))
                ->default('html')->comment('内容格式，为后期加入非 markdown 编辑器做准备');
            $table->char('status',3)->default('001');//文章状态
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
        Schema::dropIfExists('draft_articles');
	}

}
