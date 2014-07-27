<?php

class PesertaController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$peserta = Peserta::with('orang_tua','prestasi')->get();
		return View::make('peserta.index')->with('semuaPeserta', $peserta);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$fullday = Input::get('fullday');
		return View::make('peserta.create')->with('fullday', $fullday);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'nama' => 'required',
			'agama' => 'required',
			'jenis_kelamin' => 'required|numeric',
			'ttl' => 'required',
			'anak_ke' => 'required|numeric',
			'jumlah_saudara' => 'required|numeric',
			'rt' => 'required',
			'rw' => 'required',
			'desa' => 'required',
			'kecamatan' => 'required',
			'kab_kota' => 'required',
			'nama_ayah' => 'required',
			'nama_ibu' => 'required',
			'pend_ayah' => 'required',
			'pekerjaan_ayah' => 'required|numeric',
			'pekerjaan_ibu' => 'required|numeric',
			'agama_ayah' => 'required',
			'agama_ibu' => 'required',
			'penghasilan' => 'required|numeric',
			'ot_rt' => 'required',
			'ot_rw' => 'required',
			'ot_desa' => 'required',
			'ot_kecamatan' => 'required',
			'ot_kab_kota' => 'required',
			'no_hp' => 'required',
			'nama_sekolah_asal' => 'required',
			'jenis_sekolah_asal' => 'required|numeric',
			'alamat_sekolah_asal' => 'required',
			'v_i_bindo' => 'required',
			'v_i_mtk' => 'required|numeric',
			'v_i_ipa' => 'required|numeric',
			'v_ii_bindo' => 'required|numeric',
			'v_ii_mtk' => 'required|numeric',
			'v_ii_ipa' => 'required|numeric',
			'vi_i_bindo' => 'required|numeric',
			'vi_i_mtk' => 'required|numeric',
			'vi_i_ipa' => 'required|numeric',
			);
		
		$add_rules_mi = array(
			'v_i_qh' => 'required|numeric',
			'v_ii_qh' => 'required|numeric',
			'vi_i_qh' => 'required|numeric',
			);

		$add_rules_sd = array(
			'v_i_pa' => 'required|numeric',
			'v_ii_pa' => 'required|numeric',
			'vi_i_pa' => 'required|numeric',
			);

		$jenisSekolah = Input::get('jenis_sekolah_asal');
		if($jenisSekolah == 0) 
			$rules = array_merge($rules, $add_rules_mi);
		else if($jenisSekolah == 1) 
			$rules = array_merge($rules, $add_rules_sd);

		$message = array(
			'jenis_kelamin.numeric' => 'Pilih salah satu jenis kelamin.',
			'pekerjaan_ayah.numeric' => 'Pilih salah satu pekerjaan ayah.',
			'pekerjaan_ibu.numeric' => 'Pilih salah satu pekerjaan ibu.',
			'penghasilan.numeric' => 'Pilih salah satu jenis penghasilan.',
			'jenis_sekolah_asal.numeric' => 'Pilih salah satu jenis sekolah.',
			);

		$validator = Validator::make(Input::all(), $rules, $message);
		if($validator->fails()){
			return Redirect::to('peserta/create')
				->withErrors($validator)
				->withInput(Input::all());
		}else{

			//save peserta biodata
			$peserta = new Peserta();
			$peserta->nama = Input::get('nama');
			$peserta->agama = Input::get('agama');
			$peserta->jenis_kelamin = Input::get('jenis_kelamin');
			$peserta->ttl = Input::get('ttl');
			$peserta->anak_ke = Input::get('anak_ke');
			$peserta->jumlah_saudara = Input::get('jumlah_saudara');
			$peserta->rt = Input::get('rt');
			$peserta->desa = Input::get('desa');
			$peserta->kecamatan = Input::get('kecamatan');
			$peserta->kab_kota = Input::get('kab_kota');
			$peserta->nama_sekolah_asal = Input::get('nama_sekolah_asal');
			$peserta->jenis_sekolah_asal = Input::get('jenis_sekolah_asal');
			$peserta->alamat_sekolah_asal = Input::get('alamat_sekolah_asal');
			$peserta->nisn_sekolah_asal = Input::get('nisn_sekolah_asal');
			$peserta->fullday = Input::get('fullday');
			$peserta->save();

			//save prestasi peserta
			for ($i=1; $i < 4; $i++) {
				$jenis = Input::get('jenis_prestasi_'.$i);
				if($jenis){
					$prestasi = new PrestasiPeserta();
					$prestasi->peserta_id = $peserta->id;
					$prestasi->jenis = $jenis;
					$tingkat = Input::get('tingkat_prestasi_'.$i);
					$prestasi->tingkat = $tingkat;
					$prestasi->jumlah = ($tingkat+1) * 25;
					$prestasi->save();
				}
			}

			//save orangtua peserta
			$ortu = new OrangTua();
			$ortu->peserta_id = $peserta->id;
			$ortu->nama_ayah = Input::get('nama_ayah');
			$ortu->nama_ibu = Input::get('nama_ibu');
			$ortu->pend_ayah = Input::get('pend_ayah');
			$ortu->pend_ibu = Input::get('pend_ibu');
			$ortu->pekerjaan_ayah = Input::get('pekerjaan_ayah');
			$ortu->pekerjaan_ibu = Input::get('pekerjaan_ibu');
			$ortu->agama_ayah = Input::get('agama_ayah');
			$ortu->agama_ibu = Input::get('agama_ibu');
			$ortu->penghasilan = Input::get('penghasilan');
			$ortu->rt = Input::get('ot_rt');
			$ortu->rw = Input::get('ot_rw');
			$ortu->desa = Input::get('ot_desa');
			$ortu->kecamatan = Input::get('ot_kecamatan');
			$ortu->kab_kota = Input::get('ot_kab_kota');
			$ortu->no_hp = Input::get('no_hp');
			$ortu->save();

			//save nilai peserta
			$kelasArr = Array('V','V','VI');
			$semesterArr = Array('I','II','I');
			for ($j=0; $j < 3; $j++) { 
				
				$kelas = $kelasArr[$j];
				$lowerStrKelas = strtolower($kelas);
				$semester = $semesterArr[$j];
				$lowerStrSmt = strtolower($semester);

				$nilai = new NilaiPeserta();
				$nilai->peserta_id = $peserta->id;
				$nilai->mapel_id = 2;
				$nilai->kelas = $kelas;
				$nilai->semester = $semester;
				$nilai->nilai = Input::get($lowerStrKelas."_".$lowerStrSmt."_bindo");
				$nilai->save();

				$nilai = new NilaiPeserta();
				$nilai->peserta_id = $peserta->id;
				$nilai->mapel_id = 3;
				$nilai->kelas = $kelas;
				$nilai->semester = $semester;
				$nilai->nilai = Input::get($lowerStrKelas."_".$lowerStrSmt."_mtk");
				$nilai->save();

				$nilai = new NilaiPeserta();
				$nilai->peserta_id = $peserta->id;
				$nilai->mapel_id = 4;
				$nilai->kelas = $kelas;
				$nilai->semester = $semester;
				$nilai->nilai = Input::get($lowerStrKelas."_".$lowerStrSmt."_ipa");
				$nilai->save();

				if(Input::get('jenis_sekolah_asal') == 0){
					$nilai = new NilaiPeserta();
					$nilai->peserta_id = $peserta->id;
					$nilai->mapel_id = 1;
					$nilai->kelas = $kelas;
					$nilai->semester = $semester;
					$nilai->nilai = Input::get($lowerStrKelas."_".$lowerStrSmt."_qh");
					$nilai->save();
				}else if(Input::get('jenis_sekolah_asal') == 1){
					$nilai = new NilaiPeserta();
					$nilai->peserta_id = $peserta->id;
					$nilai->mapel_id = 5;
					$nilai->kelas = $kelas;
					$nilai->semester = $semester;
					$nilai->nilai = Input::get($lowerStrKelas."_".$lowerStrSmt."_pa");
					$nilai->save();
				}				
			}

			//redirect
			Session::flash('message', 'Berhasil menambahkan data peserta baru.');
			return Redirect::to('peserta');
		}


	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$peserta = Peserta::find($id);
		$peserta->load('orang_tua','prestasi','nilai.mata_pelajaran','hasil_wawancara','hasil_test');
		$hasil_wawancara = "Belum Wawancara";
		$hasil_test = "Belum Test";
		if($peserta->hasil_wawancara) 
			$hasil_wawancara = $peserta->hasil_wawancara->nilai;
		if($peserta->hasil_test)
			$hasil_test = $peserta->hasil_test->nilai;
		return View::make('peserta.show')
		->with('peserta',$peserta)
		->with('hasil_wawancara', $hasil_wawancara)
		->with('hasil_test',$hasil_test);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
