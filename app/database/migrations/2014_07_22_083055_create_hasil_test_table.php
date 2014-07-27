<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHasilTestTable extends Migration {

	public function up()
	{
		Schema::create('hasil_test', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('peserta_id')->unsigned();
			$table->smallInteger('nilai');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('hasil_test');
	}
}