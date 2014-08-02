<?php 

class UsersTableSeeder extends Seeder{


	public function run(){

		DB::table('users')->delete();

		$user = new User();
		$user->username = "timseleksi";
		$user->password = Hash::make('timseleksi');
		$user->save();	

		$user = new User();
		$user->username = "kepsek";
		$user->password = Hash::make('k3ps3k');
		$user->save();
	}

}

 ?>