<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration {

	public function up()
	{
		Schema::create('articles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('slug');
			$table->text('content');
			$table->string('tags');
			$table->string('position');
			$table->string('image');
			$table->text('description');
			$table->integer('category_id')->unsigned()->nullable();
      $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
      $table->integer('user_id')->unsigned()->nullable();
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->date('dateWrite');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('articles');
	}

}
