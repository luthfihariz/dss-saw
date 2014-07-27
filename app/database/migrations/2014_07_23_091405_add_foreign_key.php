<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKey extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('nilai_peserta', function(Blueprint $table) {
			$table->foreign('peserta_id')->references('id')->on('peserta')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('nilai_peserta', function(Blueprint $table) {
			$table->dropForeign('peserta_id');
		});
	}

}
