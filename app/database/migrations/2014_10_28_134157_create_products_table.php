<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::dropIfExists('products');
		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name')->nullable();//名称
            $table->string('identifier')->nullable();//编号
            $table->string('category')->nullable();;//品类（休闲零食、生鲜果蔬、粮油调味、美酒佳酿、茶·冲饮、滋补养生、营养保健等，可以自由添加和修改）
            $table->boolean('import')->nullable();;//国产/进口
            $table->string('source_area')->nullable();;//原产地
            $table->string('brand')->nullable();;//品牌
            $table->string('price')->nullable();;//价格
            #$table->string('');//图片
            $table->text('desc')->nullable();;//详细介绍
            #$table->string('');//一食客品评
            #$table->string('');//关联菜谱
            #$table->string('');//关联食材
            #$table->string('');//关联文章
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
		Schema::dropIfExists('products');
	}

}
