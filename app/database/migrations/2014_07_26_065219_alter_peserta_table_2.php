<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPesertaTable2 extends Migration {

	public function up()
	{
		Schema::table('peserta', function($table){
			$table->smallInteger('jenis_sekolah_asal');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('peserta', function($table){
			$table->dropColumn('jenis_sekolah_asal');
		});
	}

}
