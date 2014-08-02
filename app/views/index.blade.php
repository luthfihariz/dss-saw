@extends('layout')
@section('content')
<?php
	$program = unserialize(PROGRAM);
	$jk = unserialize(JENIS_KELAMIN);
?>
<link href="{{ URL::to('css/ionicons.min.css') }}" rel="stylesheet" type="text/css" />
<section class="content-header">
	<h1>Dashboard</h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-4">
			<div class="small-box bg-yellow">
				<div class="inner">
					<h3>{{$num_of_peserta}}</h3>
					<p>Peserta Didik Baru</p>
				</div>
				<div class="icon">
					<i class="ion ion-person-add"></i>
				</div>
				<a href="#" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
			</div>
		</div>
		<div class="col-md-4">
			<div class="small-box bg-green">
				<div class="inner">
					<h3>{{$num_of_fullday }}</h3>
					<p>Peserta Fullday</p>
				</div>
				<div class="icon">
					<i class="ion ion-person-add"></i>
				</div>
				<a href="#" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
			</div>
		</div>
		<div class="col-md-4">
			<div class="small-box bg-blue">
				<div class="inner">
					<h3>{{$num_of_peserta - $num_of_fullday}}</h3>
					<p>Peserta Reguler</p>
				</div>
				<div class="icon">
					<i class="ion ion-person-add"></i>
				</div>
				<a href="#" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">			
			<div class="box box-success" id="fullday">
				<div class="box-header">
					<h3 class="box-title">Rank Peserta Fullday</h3>
					<div class="box-tools pull-right">
                        <button class="btn btn-success btn-sm" id="refresh_fullday">
                        	<i class="fa fa-refresh"> Kalkulasi</i>
                        </button>
                    </div>
				</div>
				<div class="box-body">					
					<table class="table table-striped">
						<thead>
							<tr>								
								<td>Kode</td>
								<td>Nama</td>								
								<td>Program</td>
								<td>Rank</td>
								<td>Hasil SPK</td>
								<td></td>
							</tr>
						</thead>
						<tbody>
						@foreach($fullday as $key => $pes)					
							<tr>								
								<td>{{ $pes->id }}</td>
								<td>{{ $pes->nama }}</td>								
								<td>{{ $program[$pes->fullday] }}</td>
								<td>{{ $pes->rank }}</td>
								<td>{{ number_format($pes->saw_result,5,'.','.') }}</td>
								<td><a href="{{ URL::to('peserta').'/'.$pes->id }}">Detail</a></td>
							</tr>
						@endforeach
						</tbody>
					</table>
					<br>
					<a href="{{ URL::to('fullday') }}" class="btn btn-block btn-success">Lihat Semua</a>
				</div>
				<div class="overlay" style="display:none"></div>
				<div class="loading-img" style="display:none"></div>
			</div>
		</div>
		<div class="col-md-6">			
			<div class="box box-info" id="reguler">
				<div class="box-header">
					<h3 class="box-title">Rank Peserta Reguler</h3>
					<div class="box-tools pull-right">
                        <button class="btn btn-info btn-sm" id="refresh_reguler">
                        	<i class="fa fa-refresh"> Kalkulasi</i>
                        </button>
                    </div>
				</div>
				<div class="box-body">					
					<table class="table table-striped">
						<thead>
							<tr>								
								<td>Kode</td>
								<td>Nama</td>								
								<td>Program</td>
								<td>Rank</td>
								<td>Hasil SPK</td>
								<td></td>
							</tr>
						</thead>
						<tbody>
						@foreach($reguler as $key => $pes)					
							<tr>								
								<td>{{ $pes->id }}</td>
								<td>{{ $pes->nama }}</td>								
								<td>{{ $program[$pes->fullday] }}</td>
								<td>{{ $pes->rank }}</td>
								<td>{{ number_format($pes->saw_result,5,'.','.') }}</td>
								<td><a href="{{ URL::to('peserta').'/'.$pes->id }}">Detail</a></td>
							</tr>
						@endforeach
						</tbody>
					</table>
					<br>
					<a href="{{ URL::to('reguler') }}" class="btn btn-info btn-block">Lihat Semua</a>
					<div style="float:none;clear:both"></div>

				</div>
				<div class="overlay" style="display:none"></div>
				<div class="loading-img" style="display:none"></div>
			</div>
		</div>
		
	</div>
	<!-- <div class="row">
		<div class="col-md-6">
			<div class="box box-warning">
				<div class="box-header">
					<h3 class="box-title">Belum Mengikuti Wawancara</h3>
				</div>
				<div class="box-body">
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="box box-warning">
				<div class="box-header">
					<h3 class="box-title">Belum Mengikuti Test</h3>
				</div>
				<div class="box-body">
				</div>
			</div>
		</div>
	</div> -->
</section>
<script type="text/javascript">		
	
	jQuery("#refresh_reguler").click(function(){
		jQuery.ajax({
			url: "{{ URL::to('reguler_data') }}",
			type: "GET",
			beforeSend: function(){
				set_loader(true,"#reguler");
			},
			success: function(data){
				data = simplify(data.result);
				result = calculate_reguler(data);
				update_reguler(result);
			},
			error: function(data){
				console.log("error "+JSON.stringify(data));
				set_loader(false,"#reguler");
			}
		});
	});

	jQuery("#refresh_fullday").click(function(){
		jQuery.ajax({
			url: "{{ URL::to('fullday_data') }}",
			type: "GET",
			beforeSend: function(){
				set_loader(true,"#fullday");
			},
			success: function(data){
				data = simplify(data.result);
				result = calculate_fullday(data);
				update_fullday(result);							
			},
			error: function(data){
				console.log("error "+JSON.stringify(data));
				set_loader(false,"#fullday");
			}
		});
	});

	function set_loader(is_load, id)
	{
		if(is_load)
		{
			jQuery(id+" div.overlay").show();
			jQuery(id+" div.loading-img").show();
		}else{
			jQuery(id+" div.overlay").hide();
			jQuery(id+" div.loading-img").hide();
		}
	}

	/* Penyederhanaan data sebelum di kalkulasi dengan metode SAW. */
	function simplify(data){
		var simplified_data = [];
		$.each(data, function(index, peserta){
			simplified_data[index] = {};
			simplified_data[index]['id'] = peserta.id;
			simplified_data[index]['nama'] = peserta.nama;
			simplified_data[index]['wawancara'] = peserta.hasil_wawancara ? peserta.hasil_wawancara.nilai : 0;
			simplified_data[index]['test'] = peserta.hasil_test ? peserta.hasil_test.nilai : 0;
			
			// hitung rata-rata nilai peserta
			var avg_nilai = 0;
			$.each(peserta.nilai, function(index, nilai){
				avg_nilai += nilai.nilai;
			});
			avg_nilai = avg_nilai/12;
			simplified_data[index]['raport'] = avg_nilai;

			// hitung nilai prestasi
			var avg_prestasi = 0;
			$.each(peserta.prestasi, function(index, prestasi){
				avg_prestasi += prestasi.jumlah;				
			});			
			simplified_data[index]['bonus_piagam'] = avg_prestasi;
		});

		return simplified_data;
	}	

	function calculate_fullday(data){

		/*
		| Pre : definisikan bobot masing-masing kriteria
		*/
		var weight = [];
		weight['wawancara'] = 0.25;
		weight['test'] = 0.25;
		weight['raport'] = 0.25;
		weight['bonus_piagam'] = 0.25;

		/*
		| 1. definisikan nilai tertinggi dari masing-masing kriteria
		*/
		var max_wawancara = 0;
		var max_raport = 0;
		var max_test = 0;
		var max_bonus_piagam = 0;
		$.each(data, function(index, peserta){
			$.each(peserta, function(index, nilai){
				if(index == 'wawancara'){
					max_wawancara = max_wawancara < nilai ? nilai : max_wawancara;
				}else if(index == 'test'){
					max_test = max_test < nilai ? nilai : max_test;
				}else if(index == 'raport'){
					max_raport = max_raport < nilai ? nilai : max_raport;
				}else if(index == 'bonus_piagam'){
					max_bonus_piagam = max_bonus_piagam < nilai ? nilai : max_bonus_piagam;
				}
			});
		});

		console.log("max wawancara : "+max_wawancara);
		console.log("max test : "+max_test);
		console.log("max raport : "+max_raport);
		console.log("max bonus_piagam : "+max_bonus_piagam);


		/*
		| 2. Bagi nilai masing-masing kriteria pada peserta dengan 
		| nilai tertinggi masing-masing kriteria, kemudian kalikan dengan bobot
		*/
		var divided_weighted_matrix = []
		$.each(data, function(index, peserta){
			divided_weighted_matrix[index] = {};
			divided_weighted_matrix[index]['id'] = peserta['id'];
			divided_weighted_matrix[index]['wawancara'] = peserta['wawancara']/max_wawancara * weight['wawancara'];
			divided_weighted_matrix[index]['test'] = peserta['test']/max_test * weight['test'];
			divided_weighted_matrix[index]['raport'] = peserta['raport']/max_raport * weight['raport'];
			divided_weighted_matrix[index]['bonus_piagam'] = peserta['bonus_piagam']/max_bonus_piagam * weight['bonus_piagam'];
		});
		console.log(divided_weighted_matrix);

		/*
		| 3. Jumlahkan seluruh kriteria
		*/
		$.each(data, function(index, peserta){
			peserta['saw_result'] = divided_weighted_matrix[index]['wawancara'] + divided_weighted_matrix[index]['test']
									+ divided_weighted_matrix[index]['raport'] + divided_weighted_matrix[index]['bonus_piagam'];									
		});

		console.log(data);

		/*
		| 4. Urutkan peserta
		*/
		data.sort(function(a,b){
			if(a.saw_result < b.saw_result) return 1
			if(a.saw_result > b.saw_result) return -1
			return 0
		});

		console.log(data);

		return data;

	}

	function update_fullday(result){
		jQuery.ajax({
			url: "{{ URL::to('fullday_update') }}",
			type: "POST",
			data : { data : result },
			success: function(data){
				console.log(data);
				set_loader(false,"#fullday");
				location.reload();						
			},
			error: function(data){
				console.log("update fail : "+JSON.stringify(data));
				set_loader(false,"#fullday");
			}
		});
	}

	function update_reguler(result){
		jQuery.ajax({
			url: "{{ URL::to('reguler_update') }}",
			type: "POST",
			data : { data : result },
			success: function(data){
				console.log("update success");
				set_loader(false,"#reguler");			
				location.reload();
			},
			error: function(data){
				console.log("update fail : "+JSON.stringify(data));
				set_loader(false,"#reguler");
			}
		});
	}

	function calculate_reguler(data){

		/*
		| Pre : definisikan bobot masing-masing kriteria
		*/
		var weight = [];
		weight['test'] = 0.33;
		weight['raport'] = 0.33;
		weight['bonus_piagam'] = 0.33;

		/*
		| 1. definisikan nilai tertinggi dari masing-masing kriteria
		*/
		var max_raport = 0;
		var max_test = 0;
		var max_bonus_piagam = 0;
		$.each(data, function(index, peserta){
			$.each(peserta, function(index, nilai){
				if(index == 'test'){
					max_test = max_test < nilai ? nilai : max_test;
				}else if(index == 'raport'){
					max_raport = max_raport < nilai ? nilai : max_raport;
				}else if(index == 'bonus_piagam'){
					max_bonus_piagam = max_bonus_piagam < nilai ? nilai : max_bonus_piagam;
				}
			});
		});

		console.log("max test : "+max_test);
		console.log("max raport : "+max_raport);
		console.log("max bonus_piagam : "+max_bonus_piagam);


		/*
		| 2. Bagi nilai masing-masing kriteria pada peserta dengan 
		| nilai tertinggi masing-masing kriteria, kemudian kalikan dengan bobot
		*/
		var divided_weighted_matrix = []
		$.each(data, function(index, peserta){
			divided_weighted_matrix[index] = {};
			divided_weighted_matrix[index]['id'] = peserta['id'];			
			divided_weighted_matrix[index]['test'] = peserta['test']/max_test * weight['test'];
			divided_weighted_matrix[index]['raport'] = peserta['raport']/max_raport * weight['raport'];
			divided_weighted_matrix[index]['bonus_piagam'] = peserta['bonus_piagam']/max_bonus_piagam * weight['bonus_piagam'];
		});
		console.log(divided_weighted_matrix);

		/*
		| 3. Jumlahkan seluruh kriteria
		*/
		$.each(data, function(index, peserta){
			peserta['saw_result'] = divided_weighted_matrix[index]['test']
									+ divided_weighted_matrix[index]['raport'] + divided_weighted_matrix[index]['bonus_piagam'];									
		});

		/*
		| 4. Urutkan peserta
		*/
		data.sort(function(a,b){
			if(a.saw_result < b.saw_result) return 1
			if(a.saw_result > b.saw_result) return -1
			return 0
		});

		console.log(data);

		return data;

	}
	
	
</script>

@stop