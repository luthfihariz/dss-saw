<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNilaiPesertaTable extends Migration {

	public function up()
	{
		Schema::create('nilai_peserta', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('mapel_id')->unsigned();
			$table->string('kelas', 2);
			$table->string('semester', 3);
			$table->smallInteger('nilai');
		});
	}

	public function down()
	{
		Schema::drop('nilai_peserta');
	}
}