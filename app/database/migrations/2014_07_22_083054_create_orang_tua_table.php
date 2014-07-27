<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrangTuaTable extends Migration {

	public function up()
	{
		Schema::create('orang_tua', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('peserta_id')->unsigned();
			$table->string('nama_ayah', 255);
			$table->string('nama_ibu', 255);
			$table->string('pend_ayah', 50);
			$table->string('pend_ibu', 255);
			$table->smallInteger('pekerjaan_ayah');
			$table->smallInteger('pekerjaan_ibu');
			$table->string('agama_ayah', 50);
			$table->string('agama_ibu', 50);
			$table->smallInteger('penghasilan');
			$table->string('rt', 4);
			$table->string('rw', 4);
			$table->string('desa', 100);
			$table->string('kecamatan', 100);
			$table->string('kab_kota', 100);
			$table->string('no_hp', 100);
		});
	}

	public function down()
	{
		Schema::drop('orang_tua');
	}
}