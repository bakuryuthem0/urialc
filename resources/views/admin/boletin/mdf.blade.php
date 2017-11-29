@extends('layouts.admin')

@section('content')
<section class="col-sm-12">
	<div class="card">
	  	<div class="card-header">
	    	Nuevo boletin
	  	</div>
	  	<div class="card-body">
	  		@if($errors->has())
	  		<div class="alert alert-danger" role="alert">
	  			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    	<span aria-hidden="true">&times;</span>
			  	</button>
		  		<ul>
			   	@foreach ($errors->all() as $message)
				    <li>{{ $message }}</li>
				@endforeach
		  		</ul>
	  		</div>
	  		@endif
	  		@if(Session::has('success'))
	  		<div class="alert alert-success">
	  			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	  			{{ Session::get('success') }}
	  		</div>
	  		@endif
		    <form method="POST" action="{{ URL::to('administrador/ver-boletines/modificar/'.$bol->id.'/enviar') }}" class="new-boletin-form" enctype="multipart/form-data">
		    	<div class="alert alert-info mb-2">
		    		<i class="fa fa-info-circle"></i> Debe crear primero el titulo del boletin y luego subir los archivos por separados, esto para evitar problemas de subida cuando los archivos sean muy pesados.
		    	</div>
		    	@foreach($bol->titles as $t)
		    	<div class="col-sm-12 mb-2">
		    		<label>Titulo ({{$t->langs->names->first()->text}})</label>
		    		<input type="text" class="form-control" name="title[{{$t->id}}]" placeholder="Titulo ({{$t->langs->names->first()->text}})" value="{{$t->text}}">	
		    	</div>
		    	@endforeach
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			</form>
			<button type="submit" class="btn btn-primary btn-send mt-2" data-target=".new-boletin-form">Enviar</button>
	  	</div>
	</div>
</section>
@stop

@section('postscript')

@stop