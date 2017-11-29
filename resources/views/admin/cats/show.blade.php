@extends('layouts.admin')

@section('postcss')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
@stop

@section('content')
<section class="d-flex-row">
	<div class="col-xs-12 col-md-10 card mx-auto">
	  	<div class="card-header">
	    	Ver categorías
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
	  		<div class="alert responseActive">
	  			<p></p>
	  		</div>
			<table id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<th>Id</th>
					<th>Título</th>
					<th>Mostrar en menu</th>
					<th>Modificar</th>
					<th>Eliminar</th>
				</thead>
				<tbody>
					@foreach($cats as $c)
						<tr>
							<td>{{ $c->id }}</td>
							<td>
								<ul>
								@foreach($c->names as $n)
									<li>{{ $n->text }}</li>
								@endforeach
								</ul>
							</td>
							
							<td class="align-middle">
							@if($c->in_menu == 1)
                                <button data-url="{{ URL::to('administrador/categoria/mostrar-en-menu') }}" value="{{ $c->id }}" class="btn btn-dark btn-sm btn-activate">No Mostrar</button>
                            @else
                                <button data-url="{{ URL::to('administrador/categoria/mostrar-en-menu') }}" value="{{ $c->id }}" class="btn btn-ligth btn-sm btn-activate">Mostrar</button>
                            @endif
                            	<img src="{{ asset('images/loader.gif') }}" class="miniLoader">
                    		</td>
							<td class="align-middle">
								<a href="{{ URL::to('administrador/ver-categorias/'.$c->id) }}" class="btn btn-sm btn-warning">Modificar</a>
							</td>
							<td class="align-middle">
								<button class="btn btn-sm btn-danger btn-elim-this" data-toggle="modal" data-target="#modalElim" data-toelim="Eliminar categoría" value="{{ $c->id }}" data-url="{{ URL::to('administrador/ver-categorias/eliminar') }}" data-tosend="id">Eliminar</button>
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