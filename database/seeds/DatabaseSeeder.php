<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('UsersTableSeeder');
    $this->call('CategoriesTableSeeder');
	}

}

class UsersTableSeeder extends Seeder {

  public function run()
  {
    DB::table('users')->delete();

    $users = array(
        ['id' => 1, 'username' => 'admin', 'email' => 'admin@gmail.com', 'password' => Hash::make('123456'), 'type' => "A", 'created_at' => new DateTime, 'updated_at' => new DateTime],
        ['id' => 2, 'username' => 'tuannnm', 'email' => 'minhtuan0602@gmail.com', 'password' => Hash::make('123456'), 'type' => "G", 'created_at' => new DateTime, 'updated_at' => new DateTime]
    );

    DB::table('users')->insert($users);
  }

}

class CategoriesTableSeeder extends Seeder {

  public function run()
  {
    DB::table('categories')->delete();

    $categories = array(
        ['id' => 1, 'name' => 'Đào tạo', 'slug' => 'dao-tao', 'isBuiltIn' => true, 'created_at' => new DateTime, 'updated_at' => new DateTime],
        ['id' => 2, 'name' => 'Tin tức', 'slug' => 'tin-tuc', 'isBuiltIn' => true, 'created_at' => new DateTime, 'updated_at' => new DateTime],
        ['id' => 3, 'name' => 'Nghiên cứu', 'slug' => 'nghien-cuu', 'isBuiltIn' => true, 'created_at' => new DateTime, 'updated_at' => new DateTime],
        ['id' => 4, 'name' => 'Lịch Sử', 'slug' => 'lich-su', 'isBuiltIn' => true, 'created_at' => new DateTime, 'updated_at' => new DateTime],
    );

    DB::table('categories')->insert($categories);
  }

}
