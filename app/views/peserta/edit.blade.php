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
	<h1>Edit Peserta</h1>
</section>
<section class="content">

	{{ HTML::ul($errors->all()) }}

	{{ Form::model($peserta, array('route' => array('peserta.update', $peserta->id), 'method' => 'PUT')) }}
	<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Biodata Peserta</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
						{{ Form::checkbox('fullday',1,$peserta->fullday,array('id' => 'fullday'))}}
						{{ Form::label('fullday','Fullday') }}						
					</div>
					<div class="form-group">
						{{ Form::label('nama','Nama Siswa') }}
						{{ Form::text('nama', null, array('class' => 'form-control')) }}
					</div>
					<div class="form-group">
						{{ Form::label('agama','Agama') }}
						{{ Form::text('agama', null, array('class' => 'form-control')) }}
					</div>
					<div class="form-group">
						{{ Form::label('jk','Jenis Kelamin') }}
						{{ Form::select('jenis_kelamin', $jenisKelamin, null, array('class' => 'form-control'), 'default') }}
					</div>
					<div class="form-group">
						{{ Form::label('ttl','Tempat Tanggal Lahir') }}
						{{ Form::text('ttl', null, array('class' => 'form-control','placeholder' => 'ex : Brebes, 27 April 2005')) }}
					</div>
					<div class="row">
						<div class="col-xs-6">
							<div class="form-group">
								{{ Form::label('anak_ke','Anak Ke') }}
								{{ Form::text('anak_ke', null, array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group">
								{{ Form::label('jumlah_saudara','Jumlah Saudara') }}
								{{ Form::text('jumlah_saudara', null, array('class' => 'form-control')) }}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-4">
							<div class="form-group">
								{{ Form::label('rt','RT') }}
								{{ Form::text('rt', null, array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-xs-4">
							<div class="form-group">
								{{ Form::label('rw','RW') }}
								{{ Form::text('rw', null, array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-xs-4">
							<div class="form-group">
								{{ Form::label('desa','Desa') }}
								{{ Form::text('desa', null, array('class' => 'form-control')) }}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<div class="form-group">
								{{ Form::label('kecamatan','Kecamatan') }}
								{{ Form::text('kecamatan', null, array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group">
								{{ Form::label('kab_kota','Kabupaten Kota') }}
								{{ Form::text('kab_kota', null, array('class' => 'form-control')) }}
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
								{{ Form::text('nama_ayah', $peserta->orang_tua->nama_ayah, array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group">
								{{ Form::label('nama_ibu','Nama Ibu') }}
								{{ Form::text('nama_ibu', $peserta->orang_tua->nama_ibu, array('class' => 'form-control')) }}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<div class="form-group">
								{{ Form::label('pend_ayah','Pendidikan Ayah') }}
								{{ Form::text('pend_ayah', $peserta->orang_tua->pend_ayah, array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group">
								{{ Form::label('pend_ibu','Pendidikan Ibu') }}
								{{ Form::text('pend_ibu', $peserta->orang_tua->pend_ibu, array('class' => 'form-control')) }}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<div class="form-group">
								{{ Form::label('pekerjaan_ayah','Pekerjaan Ayah') }}
								{{ Form::select('pekerjaan_ayah', $pekerjaan, $peserta->orang_tua->pekerjaan_ayah, array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group">
								{{ Form::label('pekerjaan_ibu','Pekerjaan Ibu') }}
								{{ Form::select('pekerjaan_ibu',$pekerjaan, $peserta->orang_tua->pekerjaan_ibu, array('class' => 'form-control'), 'default') }}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6">
							<div class="form-group">
								{{ Form::label('agama_ayah','Agama Ayah') }}
								{{ Form::text('agama_ayah', $peserta->orang_tua->agama_ayah, array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group">
								{{ Form::label('agama_ibu','Agama Ibu') }}
								{{ Form::text('agama_ibu',$peserta->orang_tua->agama_ibu, array('class' => 'form-control')) }}
							</div>
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('penghasilan','Jumlah Penghasilan per Bulan') }}
						{{ Form::select('penghasilan',$penghasilan, $peserta->orang_tua->penghasilan, array('class' => 'form-control'), 'default') }}
					</div>
					<div class="row">
						<div class="col-xs-4">
							<div class="form-group">
								{{ Form::label('ot_rt','RT') }}
								{{ Form::text('ot_rt', $peserta->orang_tua->rt, array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-xs-4">
							<div class="form-group">
								{{ Form::label('ot_rw','RW') }}
								{{ Form::text('ot_rw', $peserta->orang_tua->rw, array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-xs-4">
							<div class="form-group">
								{{ Form::label('ot_desa','Desa') }}
								{{ Form::text('ot_desa', $peserta->orang_tua->desa, array('class' => 'form-control')) }}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-4">
							<div class="form-group">
								{{ Form::label('ot_kecamatan','Kecamatan') }}
								{{ Form::text('ot_kecamatan', $peserta->orang_tua->kecamatan, array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-xs-4">
							<div class="form-group">
								{{ Form::label('ot_kab_kota','Kabupaten Kota') }}
								{{ Form::text('ot_kab_kota', $peserta->orang_tua->kab_kota, array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-xs-4">
							<div class="form-group">
								{{ Form::label('no_hp','No. Telp/HP') }}
								{{ Form::text('no_hp', $peserta->orang_tua->no_hp, array('class' => 'form-control')) }}
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
								{{ Form::text('nama_sekolah_asal', null, array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								{{ Form::label('jenis_sekolah_asal','Jenis Sekolah') }}
								{{ Form::select('jenis_sekolah_asal', $jenisSekolah, $peserta->jenis_sekolah_asal, array('class' => 'form-control','disabled'), $peserta->jenis_sekolah_asal) }}
							</div>
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('nisn_sekolah_asal','NISN Sekolah Asal') }}
						{{ Form::text('nisn_sekolah_asal', null, array('class' => 'form-control')) }}
					</div>
					<div class="form-group">
						{{ Form::label('alamat_sekolah_asal','Alamat Sekolah Asal') }}
						{{ Form::text('alamat_sekolah_asal', null, array('class' => 'form-control')) }}
					</div>
					@for($i=0;$i<3;$i++)
					<?php
						if(count($peserta->prestasi) > $i){
							$jenis = $peserta->prestasi[$i]->jenis;
							$tingkatSelected = $peserta->prestasi[$i]->tingkat;
						}else{
							$jenis = "";
							$tingkatSelected = "default";
						}
						
					 ?>
					<div class="row">
						<div class="col-xs-8">
							<div class="form-group">
								{{ Form::label('prestasi','Jenis Prestasi') }}
								{{ Form::text('jenis_prestasi_'.($i+1), $jenis, array('class' => 'form-control')) }}
							</div>
						</div>
						<div class="col-xs-4">
							<div class="form-group">
								{{ Form::label('prestasi','Tingkat') }}
								{{ Form::select('tingkat_prestasi_'.($i+1), array('default' => 'Pilih')+$tingkat, $tingkatSelected, array('class' => 'form-control')) }}
							</div>
						</div>
					</div>	
					@endfor
					
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="box box-warning">
				<div class="box-header">
					<h3 class="box-title">Data Nilai</h3>
				</div>
				<div class="box-body">
					<?php $kelas_array = array('Kelas V, Semester I','Kelas V, Semester II','Kelas VI, Semester 1'); ?>
					@for($i=0;$i<3;$i++)

					<b>{{ $kelas_array[$i] }}</b>
					<?php $nilai = $nilai_array[$i]; ?>

					<div class="row">
					@foreach($nilai as $key => $nil)
						<?php $field_name = "v"; ?>
						@if($i==0)
							<?php $field_name = "v_i_" ?>
						@elseif($i==1)
							<?php $field_name = "v_ii_" ?>
						@elseif($i==2)
							<?php $field_name = "vi_i_" ?>
						@endif

						@if($key=='Bahasa Indonesia')
							<?php $field_name .= "bindo" ?>
						@elseif($key=='Matematika')
							<?php $field_name .= "mtk" ?>
						@elseif($key=='IPA')
							<?php $field_name .= "ipa" ?>
						@elseif($key=='Pendidikan Agama')
							<?php $field_name .= "pa" ?>
						@else
							<?php $field_name .= "qh" ?>
						@endif

						<div class="col-md-3">
							<div class="form-group" >
								{{ Form::label($key,$key) }}
								{{ Form::text($field_name, $nil, array('class' => 'form-control')) }}
							</div>
						</div>
						
					@endforeach
					</div>
					@endfor					
				</div>
			</div>			
			<div class="box box-danger">
				<div class="box-header">
					<h3 class="box-title">Hasil Test & Wawancara</h3>
				</div>
				<div class="box-body">
					<div class="form-group" id="hasil_wawancara">
						{{ Form::label('hasil_wawancara','Hasil Wawancara') }}
						{{ Form::text('hasil_wawancara', $hasil_wawancara, array('class' => 'form-control'))}}
					</div>
					<div class="form-group">
						{{ Form::label('hasil_test','Hasil Test') }}
						{{ Form::text('hasil_test', $hasil_test, array('class' => 'form-control'))}}
					</div>
				</div>			
			</div>				
		</div>
	</div>
	<button class="btn btn-warning btn-block">Perbaharui</button>
	{{ Form::close() }}
</section>


<script type="text/javascript">
	
	jQuery(document).ready(function(){
		var fullday = jQuery("#fullday").is(':checked');
		console.log("fullday : "+fullday);
		if(fullday)
			jQuery("#hasil_wawancara").show();
		else
			jQuery("#hasil_wawancara").hide();		
	});

	$(document).on('change','#fullday', function(){
		console.log("change!!");
	})




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