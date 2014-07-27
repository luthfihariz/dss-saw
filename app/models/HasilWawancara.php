<?php

class HasilWawancara extends Eloquent {

	protected $table = 'hasil_wawancara';
	public $timestamps = true;

	public function peserta()
	{
		return $this->belongsTo('Peserta','peserta_id');
	}

}