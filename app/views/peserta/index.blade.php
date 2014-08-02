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
				{{ $semuaPeserta->links() }}
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
						<td>{{ $key+1+(20*($semuaPeserta->getCurrentPage()-1)) }}</td>
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
<div class="modal fade" id="delete_modal" data-backdrop=static data-keyboard=true tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" id="close-btn" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
			</div>
			<div class="modal-body">				
				<p>Hapus data peserta ?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" id="delete_btn" data-loading-text="Deleting...">Delete</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</section>

<script type="text/javascript">
	
	jQuery(document).ready(function(){
		
		//show modal
		jQuery(".delete").click(function(){
			console.log("delete");
			jQuery("#delete_modal").modal("show");
			id = jQuery(this).attr("key");
			jQuery("#delete_btn").attr("key",id);
		});

		//delete button
		jQuery("#delete_btn").click(function(){
			id = jQuery(this).attr("key");
			url = "{{ URL::to('peserta') }}/"+id;
			jQuery.ajax({
				url: url,
				type: "DELETE",
				success: function(data){
					console.log("ok deleted");
					location.reload();
				},
				error: function(data){
					console.log("error "+JSON.stringify(data));
					location.reload();
				}
			});
		});

	});

</script>

@stop
