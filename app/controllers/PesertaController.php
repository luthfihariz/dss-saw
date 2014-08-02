<?php

class PesertaController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$peserta = Peserta::with('orang_tua','prestasi')->paginate(20);
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
			$peserta->rw = Input::get('rw');
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
		$peserta = Peserta::find($id);
		$peserta->load('orang_tua','prestasi','nilai.mata_pelajaran','hasil_wawancara','hasil_test');
		
		$nilai_array = array();
		$array = array();
		$kelas = "";
		$semester = "";
		foreach ($peserta->nilai as $key => $nilai) {			
						
			if(($kelas != $nilai->kelas || $semester != $nilai->semester) && $key != 0){				
				array_push($nilai_array, $array);
				$array = array();
			}			

			$array += array($nilai->mata_pelajaran->nama => $nilai->nilai);

			if($key==11){
				array_push($nilai_array, $array);
			}
			
			$kelas = $nilai->kelas;
			$semester = $nilai->semester;
			
		}
		

		$hasil_wawancara = "-";
		$hasil_test = "-";
		if($peserta->hasil_wawancara) 
			$hasil_wawancara = $peserta->hasil_wawancara->nilai;
		if($peserta->hasil_test)
			$hasil_test = $peserta->hasil_test->nilai;

		return View::make('peserta.edit')
		->with('peserta',$peserta)
		->with('hasil_wawancara', $hasil_wawancara)
		->with('hasil_test',$hasil_test)
		->with('nilai_array',$nilai_array);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$peserta = Peserta::find($id);
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

		$jenisSekolah = $peserta->jenis_sekolah_asal;
		if($jenisSekolah == 0) 
			$rules = array_merge($rules, $add_rules_mi);
		else if($jenisSekolah == 1) 
			$rules = array_merge($rules, $add_rules_sd);

		$message = array(
			'jenis_kelamin.numeric' => 'Pilih salah satu jenis kelamin.',
			'pekerjaan_ayah.numeric' => 'Pilih salah satu pekerjaan ayah.',
			'pekerjaan_ibu.numeric' => 'Pilih salah satu pekerjaan ibu.',
			'penghasilan.numeric' => 'Pilih salah satu jenis penghasilan.',
			);

		$validator = Validator::make(Input::all(), $rules, $message);
		if($validator->fails()){
			return Redirect::to('peserta/'.$id.'/edit')
				->withErrors($validator)
				->withInput(Input::all());
		}else{

			//update peserta biodata
			$peserta = Peserta::find($id);
			$peserta->nama = Input::get('nama');
			$peserta->agama = Input::get('agama');
			$peserta->jenis_kelamin = Input::get('jenis_kelamin');
			$peserta->ttl = Input::get('ttl');
			$peserta->anak_ke = Input::get('anak_ke');
			$peserta->jumlah_saudara = Input::get('jumlah_saudara');
			$peserta->rt = Input::get('rt');
			$peserta->rw = Input::get('rw');
			$peserta->desa = Input::get('desa');
			$peserta->kecamatan = Input::get('kecamatan');
			$peserta->kab_kota = Input::get('kab_kota');
			$peserta->nama_sekolah_asal = Input::get('nama_sekolah_asal');
			$peserta->alamat_sekolah_asal = Input::get('alamat_sekolah_asal');
			$peserta->nisn_sekolah_asal = Input::get('nisn_sekolah_asal');
			$peserta->fullday = Input::get('fullday');
			$peserta->save();

			//update prestasi peserta
			//this code already work, but you can't delete prestasi
			$prestasi_all = PrestasiPeserta::where('peserta_id', '=', $id)->get();

			foreach ($prestasi_all as $key => $prestasi) {
				$prestasi_baru = array(
					'peserta_id' => $id,
					'jenis' => Input::get('jenis_prestasi_'.($key+1)),
					'tingkat' => Input::get('tingkat_prestasi_'.($key+1)),
					'jumlah' => (Input::get('tingkat_prestasi_'.($key+1))+1) * 25
				);
				PrestasiPeserta::find($prestasi->id)->update($prestasi_baru);
			}

			if($prestasi_all->count() < 3){
				$possible_new_prestasi = 3 - $prestasi_all->count();
				for ($i= $possible_new_prestasi; $i > 0; $i--) { 
					$key = ($i*-1)+4;
					$jenis = Input::get('jenis_prestasi_'.$key);
					if($jenis){
						$prestasi_baru = new PrestasiPeserta();
						$prestasi_baru->peserta_id = $id;
						$prestasi_baru->jenis = $jenis;
						$prestasi_baru->tingkat = Input::get('tingkat_prestasi_'.$key);
						$prestasi_baru->jumlah = (Input::get('tingkat_prestasi_'.$key)+1) * 25;
						$prestasi_baru->save();
					}
				}
			}
			

			//update orangtua peserta
			//this code work well
			$ortu = array(
				'nama_ayah' => Input::get('nama_ayah'),
				'nama_ibu' => Input::get('nama_ibu'),
				'pend_ayah' => Input::get('pend_ayah'),
				'pend_ibu' => Input::get('pend_ibu'),
				'pekerjaan_ayah' => Input::get('pekerjaan_ayah'),
				'pekerjaan_ibu' => Input::get('pekerjaan_ibu'),
				'agama_ayah' => Input::get('agama_ayah'),
				'agama_ibu' => Input::get('agama_ibu'),
				'penghasilan' => Input::get('penghasilan'),
				'rt' => Input::get('ot_rt'),
				'rw' => Input::get('ot_rw'),
				'desa' => Input::get('ot_desa'),
				'kecamatan' => Input::get('ot_kecamatan'),
				'kab_kota' => Input::get('ot_kab_kota'),
				'no_hp' => Input::get('no_hp')
			);
			
			OrangTua::where('peserta_id','=',$id)->update($ortu);

			//update hasil		
			//this code is not tested
			if($peserta->fullday){
				$hasil_wawancara = HasilWawancara::where('peserta_id','=',$id)->get();
				if($hasil_wawancara->count() > 0){				
					HasilWawancara::where('peserta_id','=',$id)
					->update(array('nilai'=>Input::get('hasil_wawancara')));
				}else{
					$hasil_wawancara = new HasilWawancara();
					$hasil_wawancara->peserta_id = $id;
					$hasil_wawancara->nilai = Input::get('hasil_wawancara');
					$hasil_wawancara->save();
				}
			}
			
			$hasil_test = HasilTest::where('peserta_id','=',$id)->get();
			if($hasil_test->count() > 0){					
				HasilTest::where('peserta_id','=',$id)
				->update(array('nilai'=>Input::get('hasil_test')));
			}else{					
				$hasil_test = new HasilTest();
				$hasil_test->peserta_id = $id;
				$hasil_test->nilai = Input::get('hasil_test');
				$hasil_test->save();
			}

			//delete current nilai_peserta
			NilaiPeserta::where('peserta_id','=',$id)->delete();

			//save nilai peserta
			$kelasArr = Array('V','V','VI');
			$semesterArr = Array('I','II','I');
			for ($j=0; $j < 3; $j++) { 
				
				$kelas = $kelasArr[$j];
				$lowerStrKelas = strtolower($kelas);
				$semester = $semesterArr[$j];
				$lowerStrSmt = strtolower($semester);

				$nilai = new NilaiPeserta();
				$nilai->peserta_id = $id;
				$nilai->mapel_id = 2;
				$nilai->kelas = $kelas;
				$nilai->semester = $semester;
				$nilai->nilai = Input::get($lowerStrKelas."_".$lowerStrSmt."_bindo");
				$nilai->save();

				$nilai = new NilaiPeserta();
				$nilai->peserta_id = $id;
				$nilai->mapel_id = 3;
				$nilai->kelas = $kelas;
				$nilai->semester = $semester;
				$nilai->nilai = Input::get($lowerStrKelas."_".$lowerStrSmt."_mtk");
				$nilai->save();

				$nilai = new NilaiPeserta();
				$nilai->peserta_id = $id;
				$nilai->mapel_id = 4;
				$nilai->kelas = $kelas;
				$nilai->semester = $semester;
				$nilai->nilai = Input::get($lowerStrKelas."_".$lowerStrSmt."_ipa");
				$nilai->save();

				if($jenisSekolah == 0){
					$nilai = new NilaiPeserta();
					$nilai->peserta_id = $id;
					$nilai->mapel_id = 1;
					$nilai->kelas = $kelas;
					$nilai->semester = $semester;
					$nilai->nilai = Input::get($lowerStrKelas."_".$lowerStrSmt."_qh");
					$nilai->save();
				}else if($jenisSekolah == 1){
					$nilai = new NilaiPeserta();
					$nilai->peserta_id = $id;
					$nilai->mapel_id = 5;
					$nilai->kelas = $kelas;
					$nilai->semester = $semester;
					$nilai->nilai = Input::get($lowerStrKelas."_".$lowerStrSmt."_pa");
					$nilai->save();
				}				
			}

			//redirect
			Session::flash('message', 'Berhasil memperbaharui data peserta.');
			return Redirect::to('peserta/'.$id);
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$peserta = Peserta::find($id);
		$peserta->delete();
	}
	

	public function doSearch()
	{
		$q = Input::get('q');
		$peserta = Peserta::find($q);
		if($peserta){
			return Redirect::to('peserta/'.$q);
		}else{
			return View::make('peserta/not_found');
		}
	}


}
