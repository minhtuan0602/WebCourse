<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePositionColumnTableCategoriesAndArticles extends Migration {

	public function up()
	{
		DB::statement('ALTER TABLE categories MODIFY COLUMN position INTEGER');
		DB::statement('ALTER TABLE articles MODIFY COLUMN position INTEGER');
	}

	public function down()
	{
		DB::statement('ALTER TABLE categories MODIFY COLUMN position VARCHAR(255)');
		DB::statement('ALTER TABLE articles MODIFY COLUMN position VARCHAR(255)');
	}

}
