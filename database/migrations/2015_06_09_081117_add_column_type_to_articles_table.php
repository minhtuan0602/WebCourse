<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnTypeToArticlesTable extends Migration {

	public function up()
	{
		Schema::table('articles', function($table)
		{
	    $table->integer('type')->default(0);
		});
	}

	public function down()
	{
		Schema::table('articles', function($table)
		{
	    $table->dropColumn('type');
		});
	}

}
