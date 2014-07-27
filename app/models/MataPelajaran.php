<?php

class MataPelajaran extends Eloquent {

	protected $table = 'mata_pelajaran';
	public $timestamps = false;

	public function nilai_peserta()
	{
		return $this->hasMany('NilaiPeserta', 'mapel_id');
	}

}