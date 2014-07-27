<?php

class OrangTua extends Eloquent {

	protected $table = 'orang_tua';
	public $timestamps = false;	

	public function peserta()
	{
		return $this->belongsTo('Peserta', 'peserta_id');
	}

}