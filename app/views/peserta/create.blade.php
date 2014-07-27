	@extends('layout')
@section('content')
<?php
	$jenisKelamin = unserialize(JENIS_KELAMIN);
	$pekerjaan = unserialize(PEKERJAAN);
	$penghasilan = unserialize(PENGHASILAN);
	$tingkat = unserialize(TINGKAT_PRESTASI);
	$jenisSekolah = unserialize(JENIS_ASAL_SEKOLAH);
?>
<section class="content-header"> 
	<h1>Tambah Peserta Didik</h1>
</section>
<section class="content">
	{{ HTML::ul($errors->all()) }}

	{{ Form::open(array('url' => 'peserta')) }}

	<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Biodata Peserta</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
						{{ Form::checkbox('fullday',1,$fullday)}}
						{{ Form::label('fullday','Fullday') }}						
					</div>
					<div class="form-group">
						{{ Form::label('nama','Nama Siswa') }}
						{{ Form::text('nama', Input::old('nama'), array('class' => 'form-control')) }}
					</div>
					<div class="form-group">
						{{ Form::label('agama','Agama') }}
						{{ Form::text('agama', Input::old('agama'), array('class' => 'form-control')) }}
					</div>
					<div class="form-group">
						{{ Form::label('jk','Jenis Kelamin') }}
						{{ Form::select('jenis_kelamin', array('default' => 'Pilih')+$jenisKelamin, Input::old('jenis_kelamin'), array('class' => 'form-control'), 'default') }}
					</div>
					<div class="form-group">
						{{ Form::label('ttl','Tempat Tanggal Lahir') }}
						{{ Form::text('ttl', Input::old('ttl'), array('class' => 'form-control','placeholder' => 'ex : Brebes, 27 April 2005')) }}
					</div>
					<div class="row">
						<div class="col-xs-6">
							<div class="form-group">
								{{ Form::label('anak_ke','Anak Ke') }}
								{{ Form::text('anak_ke', Input::old('anak_ke'), array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group">
								{{ Form::label('jumlah_saudara','Jumlah Saudara') }}
								{{ Form::text('jumlah_saudara', Input::old('jumlah_saudara'), array('class' => 'form-control')) }}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-4">
							<div class="form-group">
								{{ Form::label('rt','RT') }}
								{{ Form::text('rt', Input::old('rt'), array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-xs-4">
							<div class="form-group">
								{{ Form::label('rw','RW') }}
								{{ Form::text('rw', Input::old('rw'), array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-xs-4">
							<div class="form-group">
								{{ Form::label('desa','Desa') }}
								{{ Form::text('desa', Input::old('desa'), array('class' => 'form-control')) }}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<div class="form-group">
								{{ Form::label('kecamatan','Kecamatan') }}
								{{ Form::text('kecamatan', Input::old('kecamatan'), array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group">
								{{ Form::label('kab_kota','Kabupaten Kota') }}
								{{ Form::text('kab_kota', Input::old('kab_kota'), array('class' => 'form-control')) }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="box box-info">
				<div class="box-header">
					<h3 class="box-title">Orang Tua Peserta</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-6">
							<div class="form-group">
								{{ Form::label('nama_ayah','Nama Ayah') }}
								{{ Form::text('nama_ayah', Input::old('nama_ayah'), array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group">
								{{ Form::label('nama_ibu','Nama Ibu') }}
								{{ Form::text('nama_ibu', Input::old('nama_ibu'), array('class' => 'form-control')) }}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<div class="form-group">
								{{ Form::label('pend_ayah','Pendidikan Ayah') }}
								{{ Form::text('pend_ayah', Input::old('pend_ayah'), array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group">
								{{ Form::label('pend_ibu','Pendidikan Ibu') }}
								{{ Form::text('pend_ibu', Input::old('pend_ibu'), array('class' => 'form-control')) }}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<div class="form-group">
								{{ Form::label('pekerjaan_ayah','Pekerjaan Ayah') }}
								{{ Form::select('pekerjaan_ayah', array('default'=>'Pilih')+$pekerjaan, Input::old('pekerjaan_ayah'), array('class' => 'form-control'), 'default') }}
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group">
								{{ Form::label('pekerjaan_ibu','Pekerjaan Ibu') }}
								{{ Form::select('pekerjaan_ibu',array('default'=>'Pilih')+$pekerjaan, Input::old('pekerjaan_ibu'), array('class' => 'form-control'), 'default') }}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<div class="form-group">
								{{ Form::label('agama_ayah','Agama Ayah') }}
								{{ Form::text('agama_ayah', Input::old('agama_ayah'), array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group">
								{{ Form::label('agama_ibu','Agama Ibu') }}
								{{ Form::text('agama_ibu',Input::old('agama_ibu'), array('class' => 'form-control')) }}
							</div>
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('penghasilan','Jumlah Penghasilan per Bulan') }}
						{{ Form::select('penghasilan',array('default'=>'Pilih')+$penghasilan, Input::old('penghasilan'), array('class' => 'form-control'), 'default') }}
					</div>
					<div class="row">
						<div class="col-xs-4">
							<div class="form-group">
								{{ Form::label('ot_rt','RT') }}
								{{ Form::text('ot_rt', Input::old('ot_rt'), array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-xs-4">
							<div class="form-group">
								{{ Form::label('ot_rw','RW') }}
								{{ Form::text('ot_rw', Input::old('ot_rw'), array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-xs-4">
							<div class="form-group">
								{{ Form::label('ot_desa','Desa') }}
								{{ Form::text('ot_desa', Input::old('ot_desa'), array('class' => 'form-control')) }}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-4">
							<div class="form-group">
								{{ Form::label('ot_kecamatan','Kecamatan') }}
								{{ Form::text('ot_kecamatan', Input::old('ot_kecamatan'), array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-xs-4">
							<div class="form-group">
								{{ Form::label('ot_kab_kota','Kabupaten Kota') }}
								{{ Form::text('ot_kab_kota', Input::old('ot_kab_kota'), array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-xs-4">
							<div class="form-group">
								{{ Form::label('no_hp','No. Telp/HP') }}
								{{ Form::text('no_hp', Input::old('no_hp'), array('class' => 'form-control')) }}
							</div>
						</div>
					</div>					
				</div>
			</div>			
		</div>	
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="box box-success">
				<div class="box-header">
					<h3 class="box-title">Asal Sekolah/Madrasah</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								{{ Form::label('nama_sekolah_asal','Nama Sekolah Asal') }}
								{{ Form::text('nama_sekolah_asal', Input::old('nama_sekolah_asal'), array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								{{ Form::label('jenis_sekolah_asal','Jenis Sekolah') }}
								{{ Form::select('jenis_sekolah_asal', array('default'=>'Pilih')+$jenisSekolah, Input::old('jenis_sekolah_asal'), array('class' => 'form-control')) }}
							</div>
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('nisn_sekolah_asal','NISN Sekolah Asal') }}
						{{ Form::text('nisn_sekolah_asal', Input::old('nisn_sekolah_asal'), array('class' => 'form-control')) }}
					</div>
					<div class="form-group">
						{{ Form::label('alamat_sekolah_asal','Alamat Sekolah Asal') }}
						{{ Form::text('alamat_sekolah_asal', Input::old('alamat_sekolah_asal'), array('class' => 'form-control')) }}
					</div>
					<div class="row">
						<div class="col-xs-8">
							<div class="form-group">
								{{ Form::label('prestasi','Jenis Prestasi') }}
								{{ Form::text('jenis_prestasi_1', Input::old('jenis_prestasi_1'), array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-xs-4">
							<div class="form-group">
								{{ Form::label('prestasi','Tingkat') }}
								{{ Form::select('tingkat_prestasi_1', array('default'=>'Pilih')+$tingkat, Input::old('jenis_prestasi_1'), array('class' => 'form-control')) }}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-8">
							<div class="form-group">
								{{ Form::label('prestasi','Jenis Prestasi') }}
								{{ Form::text('jenis_prestasi_2', Input::old('jenis_prestasi_2'), array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-xs-4">
							<div class="form-group">
								{{ Form::label('prestasi','Tingkat') }}
								{{ Form::select('tingkat_prestasi_2', array('default'=>'Pilih')+$tingkat, Input::old('jenis_prestasi_2'), array('class' => 'form-control')) }}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-8">
							<div class="form-group">
								{{ Form::label('prestasi','Jenis Prestasi') }}
								{{ Form::text('jenis_prestasi_3', Input::old('jenis_prestasi_3'), array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-xs-4">
							<div class="form-group">
								{{ Form::label('prestasi','Tingkat') }}
								{{ Form::select('tingkat_prestasi_3', array('default'=>'Pilih')+$tingkat, Input::old('jenis_prestasi_3'), array('class' => 'form-control')) }}
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="box box-warning">
				<div class="box-header">
					<h3 class="box-title">Data Nilai</h3>
				</div>
				<div class="box-body">
					<b>Kelas V, Semester I</b>
					<div class="row">
						<div class="col-md-3" id="v_i_qh">
							<div class="form-group" >
								{{ Form::label('qh','Quran Hadits') }}
								{{ Form::text('v_i_qh', Input::old('vi_qh'), array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-md-3" id="v_i_pa" style="display:none">
							<div class="form-group">
								{{ Form::label('pa','Pend. Agama') }}
								{{ Form::text('v_i_pa', Input::old('vi_pa'), array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								{{ Form::label('bindo','Bahasa Indonesia') }}
								{{ Form::text('v_i_bindo', Input::old('vi_bindo'), array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								{{ Form::label('mtk','Matematika') }}
								{{ Form::text('v_i_mtk', Input::old('vi_mtk'), array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								{{ Form::label('ipa','IPA') }}
								{{ Form::text('v_i_ipa', Input::old('vi_ipa'), array('class' => 'form-control')) }}
							</div>
						</div>
					</div>
					<b>Kelas V, Semester II</b>
					<div class="row">
						<div class="col-md-3" id="v_ii_qh">
							<div class="form-group" >
								{{ Form::label('qh','Quran Hadits') }}
								{{ Form::text('v_ii_qh', Input::old('vii_qh'), array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-md-3" id="v_ii_pa" style="display:none">
							<div class="form-group">
								{{ Form::label('pa','Pend. Agama') }}
								{{ Form::text('v_ii_pa', Input::old('vii_pa'), array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								{{ Form::label('bindo','Bahasa Indonesia') }}
								{{ Form::text('v_ii_bindo', Input::old('vii_bindo'), array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								{{ Form::label('mtk','Matematika') }}
								{{ Form::text('v_ii_mtk', Input::old('vii_mtk'), array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								{{ Form::label('ipa','IPA') }}
								{{ Form::text('v_ii_ipa', Input::old('vii_ipa'), array('class' => 'form-control')) }}
							</div>
						</div>
					</div>
					<b>Kelas VI, Semester I</b>
					<div class="row">
						<div class="col-md-3" id="vi_i_qh">
							<div class="form-group" >
								{{ Form::label('qh','Quran Hadits') }}
								{{ Form::text('vi_i_qh', Input::old('vi_i_qh'), array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-md-3" id="vi_i_pa" style="display:none">
							<div class="form-group">
								{{ Form::label('pa','Pend. Agama') }}
								{{ Form::text('vi_i_pa', Input::old('vi_i_pa'), array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								{{ Form::label('bindo','Bahasa Indonesia') }}
								{{ Form::text('vi_i_bindo', Input::old('vi_i_bindo'), array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								{{ Form::label('mtk','Matematika') }}
								{{ Form::text('vi_i_mtk', Input::old('vi_i_mtk'), array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								{{ Form::label('ipa','IPA') }}
								{{ Form::text('vi_i_ipa', Input::old('vi_i_ipa'), array('class' => 'form-control')) }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<button class="btn btn-primary btn-block">Simpan</button>
	{{ Form::close() }}
</section>


<script type="text/javascript">

	jQuery("#jenis_sekolah_asal").change(function(){
		val = jQuery(this).val();
		if(val==0)
		{
			jQuery("#v_i_pa").hide();
			jQuery("#v_ii_pa").hide();
			jQuery("#vi_i_pa").hide();
			jQuery("#v_i_qh").show();
			jQuery("#v_ii_qh").show();
			jQuery("#vi_i_qh").show();
		}
		else if(val==1)
		{
			jQuery("#v_i_pa").show();
			jQuery("#v_ii_pa").show();
			jQuery("#vi_i_pa").show();
			jQuery("#v_i_qh").hide();
			jQuery("#v_ii_qh").hide();
			jQuery("#vi_i_qh").hide();	
		} 
	});
</script>

@stop