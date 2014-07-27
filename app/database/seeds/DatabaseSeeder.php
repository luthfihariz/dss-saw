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

		$this->command->info('Seeding finished');
		$this->call('PesertaTableSeeder');
		$this->command->info('Seeding finished');
	}

}
