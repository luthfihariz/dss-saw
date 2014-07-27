<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('orang_tua', function(Blueprint $table) {
			$table->foreign('peserta_id')->references('id')->on('peserta')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('prestasi_peserta', function(Blueprint $table) {
			$table->foreign('peserta_id')->references('id')->on('peserta')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('nilai_peserta', function(Blueprint $table) {
			$table->foreign('mapel_id')->references('id')->on('mata_pelajaran')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('hasil_test', function(Blueprint $table) {
			$table->foreign('peserta_id')->references('id')->on('peserta')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('hasil_wawancara', function(Blueprint $table) {
			$table->foreign('peserta_id')->references('id')->on('peserta')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('orang_tua', function(Blueprint $table) {
			$table->dropForeign('orang_tua_peserta_id_foreign');
		});
		Schema::table('prestasi_peserta', function(Blueprint $table) {
			$table->dropForeign('prestasi_peserta_peserta_id_foreign');
		});
		Schema::table('nilai_peserta', function(Blueprint $table) {
			$table->dropForeign('nilai_peserta_mapel_id_foreign');
		});
		Schema::table('hasil_test', function(Blueprint $table) {
			$table->dropForeign('hasil_test_peserta_id_foreign');
		});
		Schema::table('hasil_wawancara', function(Blueprint $table) {
			$table->dropForeign('hasil_wawancara_peserta_id_foreign');
		});
	}
}