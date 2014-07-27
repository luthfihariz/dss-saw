<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMataPelajaranTable extends Migration {

	public function up()
	{
		Schema::create('mata_pelajaran', function(Blueprint $table) {
			$table->increments('id');
			$table->string('nama', 50);
		});
	}

	public function down()
	{
		Schema::drop('mata_pelajaran');
	}
}