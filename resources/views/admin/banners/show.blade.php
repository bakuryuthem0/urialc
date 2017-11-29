@extends('layouts.admin')

@section('postcss')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
@stop

@section('content')
<section class="d-flex-row">
	<div class="col-xs-12 col-md-10 card mx-auto">
	  	<div class="card-header">
	    	Ver banners
	  	</div>
	  	<div class="card-body">
	  		@if(Session::has('success'))
	  		<div class="alert alert-success" role="alert">
	  			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    	<span aria-hidden="true">&times;</span>
			  	</button>
		  		{{ Session::get('success') }}
	  		</div>
	  		@endif
			<table id="example1" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
				<thead>
					<th>Id</th>
					<th>Imagen</th>
					<th>Título</th>
					<th>URL</th>
					<th>Idioma</th>
					<th>Modificar</th>
					<th>Eliminar</th>
				</thead>
				<tbody>
					@foreach($banners as $b)
						<tr>
							<td>{{ $b->id }}</td>
							<td>
								<img src="{{ asset('images/banners/'.$b->desktop) }}" class="img-fluid banner-preview img-thumbnail">
							</td>
							<td>
								@if(empty($b->title))
									Sin especificar
								@else
									{{ $b->title }}
								@endif
							</td>
							<td>
								@if(empty($b->url))
									Sin especificar
								@else
									{{ $b->url }}
								@endif
							</td>
							<td>
								{{ $b->langs->names->first()->text }}
							</td>
							<td class="align-middle">
								<a href="{{ URL::to('administrador/ver-banners/'.$b->id) }}" class="btn btn-sm btn-warning" target="_blank">Modificar</a>
							</td>
							<td class="align-middle">
								<button class="btn btn-sm btn-danger btn-elim-this" data-toggle="modal" data-target="#modalElim" data-toelim="Eliminar banner" value="{{ $b->id }}" data-url="{{ URL::to('administrador/ver-banners/eliminar') }}" data-tosend="id">Eliminar</button>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
	  		
	  	</div>
	</div>
</section>

@include('partials.modalElim')
@stop

@section('postscript')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
	

</script>
@stop