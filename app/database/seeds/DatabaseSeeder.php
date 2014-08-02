<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		//$this->call('PesertaTableSeeder');
		$this->call('UsersTableSeeder');
		$this->command->info('Seeding finished');
	}

}
