<?php 

class PesertaTableSeeder extends Seeder{


	public function run()
	{
		DB::table('peserta')->delete();

		for ($i=0; $i < 10; $i++) { 			
			$peserta = new Peserta();
			$peserta->nama = 'Siswa Koplak '.$i;
			$peserta->agama = 'Islam';
			$peserta->ttl = '';
			$peserta->anak_ke = rand(1,15);
			$peserta->jumlah_saudara = $peserta->anak_ke + rand(0,5);
			$peserta->jenis_kelamin = rand(0,1);
			$peserta->rt = rand(1,15);
			$peserta->rw = rand(1,20);
			$peserta->desa = 'Pulosari';
			$peserta->kecamatan = 'Babakan';
			$peserta->kab_kota = 'Brebes';
			$peserta->nama_sekolah_asal = 'SD Asal Asalan';
			$peserta->alamat_sekolah_asal = 'Jl. Asal asalan';
			$peserta->nisn_sekolah_asal = 'NISN00123511';
			$peserta->save();

			$ortu = new OrangTua();
			$ortu->peserta_id = $peserta->id;
			$ortu->nama_ayah = 'Ayah Siswa '.$i;
			$ortu->nama_ibu = 'Ibu Siswa '.$i;
			$ortu->pend_ayah = 'S'.rand(1,3);
			$ortu->pend_ibu = 'S'.rand(1,3);
			$ortu->pekerjaan_ayah = rand(0,8);
			$ortu->pekerjaan_ibu = rand(0,8);
			$ortu->agama_ayah = 'Islam';
			$ortu->agama_ibu = 'Islam';
			$ortu->penghasilan = rand(0,5);
			$ortu->rt = rand(1,15);
			$ortu->rw = rand(1,20);
			$ortu->desa = 'Pulosari';
			$ortu->kecamatan = 'Babakan';
			$ortu->kab_kota = 'Brebes';
			$ortu->no_hp = '08'.rand(1,9).rand(1,9).'77123'.rand(1,9).'1'.rand(1,9);
			$ortu->save();
			
			$this->command->info('Siswa : '.$peserta->nama);

			$kelas = Array('V','V','VI');
			$semester = Array('I','II','I');
			for ($j=0; $j < 3; $j++) { 
				for ($k=0; $k < 4; $k++) { 
					$nilai = new NilaiPeserta();
					$nilai->peserta_id = $peserta->id;

					if($k == 0 && $i%2==0)
						$nilai->mapel_id = 1;
					else if($k == 0)
						$nilai->mapel_id = 5;
					else
						$nilai->mapel_id = $k+1;

					$nilai->kelas = $kelas[$j];
					$nilai->semester = $semester[$j];
					$nilai->nilai = rand(55,99);
					$nilai->save();
				}
			}

			$jenisPrestasi = Array('Olimpiade MTK','Juara Bulutangkis','Juara Catur');			
			$jumlahPrestasi = rand(0,2);
			for ($l=0; $l < $jumlahPrestasi; $l++) {
				$prestasi = new PrestasiPeserta();
				$prestasi->peserta_id = $peserta->id;
				$prestasi->jenis = $jenisPrestasi[rand(0,2)];
				$tingkat = rand(0,3);
				$prestasi->tingkat = $tingkat;
				$prestasi->jumlah = ($tingkat+1) * 25;
				$prestasi->save();
			}
		}
	}
}

?>