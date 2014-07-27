@extends('layout')
@section('content')
<?php
	$program = unserialize(PROGRAM);
	$jk = unserialize(JENIS_KELAMIN);
?>
<section class="content-header">
	<h1>Data Peserta Didik Baru</h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<p><a class="btn btn-info" href="{{ URL::to('peserta/create') }}">+ Tambah Peserta Reguler</a>
			<a class="btn btn-success" href="{{ URL::to('peserta/create?fullday=1') }}">+ Tambah Peserta Fullday</a></p>
			<div class="box">
				<table class="table table-hover">
					<thead>
						<td>No</td>
						<td>Kode Pendaftaran</td>
						<td>Nama</td>
						<td>Jenis Kelamin</td>
						<td>Nama Ayah</td>
						<td>Nama Ibu</td>
						<td>Asal Sekolah</td>
						<td>Program</td>
						<td></td>
					</thead>
					@foreach($semuaPeserta as $key => $peserta)
					<tr>
						<td>{{ $key+1 }}</td>
						<td>{{ $peserta->id }}</td>
						<td>{{ $peserta->nama }}</td>
						<td>{{ $jk[$peserta->jenis_kelamin] }}</td>
						<td>{{ $peserta->orang_tua->nama_ayah }}</td>						
						<td>{{ $peserta->orang_tua->nama_ibu }}</td>						
						<td>{{ $peserta->nama_sekolah_asal }}</td>
						<td>{{ $program[$peserta->fullday] }}</td>
						<td>
							<div class="btn-group">
		                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
		                            Actions
		                            <span class="caret"></span>
		                        </button>
		                        <ul class="dropdown-menu" role="menu">
		                            <li><a href="{{URL::to('peserta/'.$peserta->id)}}">Detail</a>
		                            </li>
		                            <li><a href="{{URL::to('peserta/'.$peserta->id.'/edit')}}">Edit</a>
		                            </li>
		                            <li><a href="#" class="delete" key="{{$peserta->id}}">Delete</a>
		                            </li>
		                        </ul>
		                    </div>
                	</td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
	
</section>
@stop
