<?php

class PrestasiPeserta extends Eloquent {

	protected $table = 'prestasi_peserta';
	public $timestamps = false;
	protected $fillable = array('peserta_id','jenis','tingkat','jumlah');

}