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

