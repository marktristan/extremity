<?php

class UserTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->delete();

		User::create(array(
				'username' => 'admin',
				'password' => Hash::make('12345'),
				'key' => str_random()
		));

		User::create(array(
				'username' => 'guest',
				'password' => Hash::make('54321'),
				'key' => str_random()
		));
	}

}