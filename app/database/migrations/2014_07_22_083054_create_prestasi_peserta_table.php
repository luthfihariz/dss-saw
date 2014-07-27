<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePrestasiPesertaTable extends Migration {

	public function up()
	{
		Schema::create('prestasi_peserta', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('peserta_id')->unsigned();
			$table->string('jenis', 100);
			$table->smallInteger('tingkat');
			$table->smallInteger('jumlah');
		});
	}

	public function down()
	{
		Schema::drop('prestasi_peserta');
	}
}