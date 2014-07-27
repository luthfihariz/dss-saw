<?php

class HasilTest extends Eloquent {

	protected $table = 'hasil_test';
	public $timestamps = true;

	public function peserta()
	{
		return $this->belongsTo('Peserta','peserta_id');
	}


}