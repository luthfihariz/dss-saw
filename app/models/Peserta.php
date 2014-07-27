<?php

class Peserta extends Eloquent {

	protected $table = 'peserta';
	public $timestamps = true;
	public static $jenis_kelamin = 'Laki-laki';

	public function orang_tua()
	{
		return $this->hasOne('OrangTua', 'peserta_id');
	}

	public function prestasi()
	{
		return $this->hasMany('PrestasiPeserta', 'peserta_id');
	}

	public function nilai()
	{
		return $this->hasMany('NilaiPeserta', 'peserta_id');
	}

	public function hasil_wawancara()
	{
		return $this->hasOne('HasilWawancara','peserta_id');
	}

	public function hasil_test()
	{
		return $this->hasOne('HasilTest','peserta_id');
	}

}