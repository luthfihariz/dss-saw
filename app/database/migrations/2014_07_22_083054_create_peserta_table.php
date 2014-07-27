<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePesertaTable extends Migration {

	public function up()
	{
		Schema::create('peserta', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('nama', 255);
			$table->string('agama', 50);
			$table->date('ttl');
			$table->smallInteger('anak_ke');
			$table->smallInteger('jumlah_saudara');
			$table->tinyInteger('jenis_kelamin');
			$table->string('rt', 4);
			$table->string('rw', 4);
			$table->string('desa', 100);
			$table->string('kecamatan', 100);
			$table->string('kab_kota', 100);
			$table->string('nama_sekolah_asal', 255);
			$table->string('alamat_sekolah_asal');
			$table->string('nisn_sekolah_asal');
		});
	}

	public function down()
	{
		Schema::drop('peserta');
	}
}