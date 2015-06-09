<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndexSearchTitleToTableArticles extends Migration {

	public function up()
	{
		DB::statement('ALTER TABLE articles ADD FULLTEXT search(title)');
	}

	public function down()
	{
		Schema::table('articles', function($table) {
       $table->dropIndex('search');
    });
	}

}
