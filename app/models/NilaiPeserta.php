<?php

class NilaiPeserta extends Eloquent {

	protected $table = 'nilai_peserta';
	public $timestamps = false;

	public function mata_pelajaran()
	{
		return $this->belongsTo('MataPelajaran', 'mapel_id');
	}

	public function peserta()
	{
		return $this->belongsTo('Peserta','peserta_id');
	}

}