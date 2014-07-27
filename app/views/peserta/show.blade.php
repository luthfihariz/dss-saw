@extends('layout')
@section('content')
<?php 
	$jk = unserialize(JENIS_KELAMIN);
	$pekerjaan = unserialize(PEKERJAAN);
	$penghasilan = unserialize(PENGHASILAN);
	$tingkat = unserialize(TINGKAT_PRESTASI);
	$orangtua = $peserta->orang_tua;
	$fullday = unserialize(PROGRAM);
	$jumlah = 0;
?>
<section class="content-header">
	<h1>Detail Peserta</h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-4">
			<div class="box box-solid box-primary">
				<div class="box-header">
					<h3 class="box-title">Biodata Peserta</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label>Nama Peserta</label>
						<p class="form-control-static">{{ $peserta->nama }}</p>
					</div>
					<div class="form-group">
						<label>Agama</label>
						<p class="form-control-static">{{ $peserta->agama }}</p>
					</div>
					<div class="form-group">
						<label>TTL</label>
						<p class="form-control-static">{{ $peserta->ttl }}</p>
					</div>
					<div class="form-group">
						<label>Jenis Kelamin</label>
						<p class="form-control-static">{{ $jk[$peserta->jenis_kelamin] }}</p>
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<p class="form-control-static">{{ $peserta->desa.", ".$peserta->kecamatan.", ".$peserta->kab_kota }}</p>
					</div>
					<div class="form-group">
						<label>Anak Ke</label>
						<p class="form-control-static">{{ $peserta->anak_ke }}</p>
					</div>
					<div class="form-group">
						<label>Jumlah Saudara</label>
						<p class="form-control-static">{{ $peserta->jumlah_saudara }}</p>
					</div>					
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="box box-solid box-info">
				<div class="box-header">
					<h3 class="box-title">Profil Orang Tua Peserta</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label>Nama Ayah</label>
						<p class="form-control-static">{{ $orangtua->nama_ayah }}</p>
					</div>
					<div class="form-group">
						<label>Nama Ibu</label>
						<p class="form-control-static">{{ $orangtua->nama_ibu }}</p>
					</div>
					<div class="form-group">
						<label>Pendidikan Ayah</label>
						<p class="form-control-static">{{ $orangtua->pend_ayah }}</p>
					</div>
					<div class="form-group">
						<label>Pendidikan Ibu</label>
						<p class="form-control-static">{{ $orangtua->pend_ibu }}</p>
					</div>
					<div class="form-group">
						<label>Pekerjaan Ayah</label>
						<p class="form-control-static">{{ $pekerjaan[$orangtua->pekerjaan_ayah] }}</p>
					</div>
					<div class="form-group">
						<label>Pekerjaan Ibu</label>
						<p class="form-control-static">{{ $pekerjaan[$orangtua->pekerjaan_ibu] }}</p>
					</div>
					<div class="form-group">
						<label>Jumlah Penghasilan/Bulan</label>
						<p class="form-control-static">{{ $penghasilan[$orangtua->penghasilan] }}</p>
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<p class="form-control-static">{{ $peserta->desa.", ".$peserta->kecamatan.", ".$peserta->kab_kota }}</p>
					</div>					
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="box box-solid box-warning">
				<div class="box-header">
					<h3 class="box-title">Asal Sekolah/Madrasah</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label>Asal Sekolah</label>
						<p class="form-control-static">{{ $peserta->nama_sekolah_asal }}</p>
					</div>				
					<div class="form-group">
						<label>NISN Sekolah Asal</label>
						<p class="form-control-static">{{ $peserta->nisn_sekolah_asal }}</p>
					</div>
					<div class="form-group">
						<label>Alamat Sekolah Asal</label>
						<p class="form-control-static">{{ $peserta->alamat_sekolah_asal }}</p>
					</div>					
				</div>
			</div>
			<div class="box box-solid box-success">
				<div class="box-header">
					<h3 class="box-title">Informasi Pendaftaran</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label>Jenis Program</label>
						<p class="form-control-static">{{ $fullday[$peserta->fullday] }}</p>
					</div>				
					<div class="form-group">
						<label>Hasil Wawancara</label>
						<p class="form-control-static">{{ $hasil_wawancara }}</p>
					</div>
					<div class="form-group">
						<label>Hasil Test</label>
						<p class="form-control-static">{{ $hasil_test }}</p>
					</div>					
				</div>
			</div>		
		</div>
		<div class="col-md-6">
			<div class="box box-solid box-danger">
				<div class="box-header">
					<h3 class="box-title">Nilai Siswa</h3>
				</div>
				<div class="box-body">
					<table class="table table-hover">
						<tr>
							<td>No</td>
							<td>Kelas</td>
							<td>Semester</td>
							<td>Mata Pelajaran</td>
							<td>Nilai</td>
						</tr>
						@foreach($peserta->nilai as $key => $nilai)
							<?php $jumlah += $nilai->nilai ?>
							<tr>
								<td>{{ $key+1 }}</td>
								<td>{{ $nilai->kelas }}</td>
								<td>{{ $nilai->semester }}</td>
								<td>{{ $nilai->mata_pelajaran->nama }}</td>
								<td>{{ $nilai->nilai }}</td>
							</tr>
						@endforeach
						<tr>
							<td colspan="4"><b>Jumlah</b></td>
							<td>{{ $jumlah }}</td>
						</tr>
						<tr>
							<td colspan="4"><b>Rata-rata</b></td>
							<td>{{ round($jumlah/12,2) }}</td>
						</tr>
						<tbody>					
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="box box-solid box-info">
				<div class="box-header">
					<h3 class="box-title">Prestasi Siswa</h3>
				</div>
				<div class="box-body">
					@if(count($peserta->prestasi) == 0)
						<tr>
							Tidak ada
						</tr>
					@else
					<table class="table table-hover">
						<thead>
							<td>No</td>
							<td>Jenis Penghargaan Sertifikat/Piagam</td>
							<td>Tingkat</td>
							<td>Jumlah</td>
						</thead>
						<tbody>						
							@foreach($peserta->prestasi as $key => $prestasi)
								<tr>
									<td>{{ $key+1 }}</td>
									<td>{{ $prestasi->jenis }}</td>
									<td>{{ $tingkat[$prestasi->tingkat] }}</td>
									<td>{{ $prestasi->jumlah }}</td>
								</tr>
							@endforeach
						</tbody>
					@endif
					</table>
				</div>
			</div>
		</div>
		
	</div>
</section>

@stop