<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDraftArticlePicturesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::dropIfExists('draft_article_pictures');
        Schema::create('draft_article_pictures', function(Blueprint $table)
        {
            $table->engine = 'MyISAM';
            $table->increments('id');//自增唯一ID
            $table->integer('article_id');//关联编码
            $table->string('path',255);//路径
            $table->string('thumbnail',255);//缩略图路径
            $table->string('desc',255)->nullable();//图片描述
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
        Schema::dropIfExists('draft_article_pictures');
	}

}
