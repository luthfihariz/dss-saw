@extends('layout')
@section('content')
<?php
	$program = unserialize(PROGRAM);
	$jk = unserialize(JENIS_KELAMIN);
	$status = unserialize(STATUS);
?>
<section class="content-header">
	<h1>Rank Peserta Reguler</h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-solid box-primary">		
				<div class="box-body no-padding">
					<table class="table table-hover">
						<thead>
							<td>Kode Pendaftaran</td>
							<td>Nama</td>
							<td>Jenis Kelamin</td>							
							<td>Asal Sekolah</td>
							<td>Hasil SPK</td>
							<td>Rank</td>
							<td>Status</td>
							<td>Kelas</td>
							<td></td>
						</thead>
						<tbody>
							@foreach($reguler as $key => $peserta)
							<tr>
								<td>{{ $peserta->id }}</td>
								<td>{{ $peserta->nama }}</td>
								<td>{{ $jk[$peserta->jenis_kelamin] }}</td>												
								<td>{{ $peserta->nama_sekolah_asal }}</td>
								<td>{{ number_format($peserta->saw_result,5,'.','.') }}</td>
								<td>{{ $peserta->rank }}</td>
								<td>{{ $status[$peserta->status] }}</td>
								<td>{{ $peserta->kelas }}</td>
								<td><a href="{{ URL::to('peserta').'/'.$peserta->id }}">Detail</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			{{ $reguler->links() }}
		</div>
	</div>
</section>
@stop