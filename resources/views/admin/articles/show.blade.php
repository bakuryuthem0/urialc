@extends('layouts.admin')

@section('postcss')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
@stop

@section('content')
<section class="d-flex-row">
	<div class="col-xs-12 col-md-10 card mx-auto">
	  	<div class="card-header">
	    	Ver notícias
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
					<th>Título</th>
					<th>Descripción</th>
					<th>Ver</th>
					<th>Modificar</th>
					<th>Eliminar</th>
				</thead>
				<tbody>
					@foreach($articles as $a)
						<tr>
							<td>{{ $a->id }}</td>
							<td>
								<ul>
								@foreach($a->titles as $t)
									<li>{{ $t->text }}</li>
								@endforeach
								</ul>
							</td>
							<td>
								<ul>
								@foreach($a->descriptions as $d)
									<li class="d-block">{{ substr(strip_tags($d->text),0,30) }}...</li>
								@endforeach
								</ul>
							</td>
							<td class="align-middle">
								<a href="#" class="btn btn-primary">Ver</a>
							</td>
							<td class="align-middle">
								<a href="{{ URL::to('administrador/ver-noticias/'.$a->id) }}" class="btn btn-sm btn-warning" target="_blank">Modificar</a>
							</td>
							<td class="align-middle">
								<button class="btn btn-sm btn-danger btn-elim-this" data-toggle="modal" data-target="#modalElim" data-toelim="Eliminar noticia" value="{{ $a->id }}" data-url="{{ URL::to('administrador/ver-noticias/eliminar') }}" data-tosend="id">Eliminar</button>
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
	jQuery(document).ready(function($) {
		$('#example').DataTable();
	});

</script>
@stop