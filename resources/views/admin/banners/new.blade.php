@extends('layouts.admin')

@section('content')
<section class="col-sm-12">
	<div class="card">
	  	<div class="card-header">
	    	Nuevo banner principal
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
		    <form method="POST" action="{{ URL::to('administrador/nuevo-banner/enviar') }}" class="new-banner-form" enctype="multipart/form-data">
		    	<div class="col-sm-12 mb-2">
		    		<label>Titulo (opcional)</label>
		    		<input type="text" class="form-control" name="title" placeholder="Titulo">	
		    	</div>
		    	<div class="col-sm-12 mb-2">
		    		<label>URL (opcional)</label>
		    		<input type="text" class="form-control" name="url" placeholder="URL">	
		    	</div>
		    	<div class="col-sm-12 mb-2">
		    		<label>Idioma</label>
		    		<select class="form-control" name="lang">
		    			@foreach($langs as $l)
		    				<option value="{{ $l->id }}">{{ $l->names->first()->text }}</option>
		    			@endforeach
		    		</select>
		    	</div>
		    	<div class="col-sm-12 mb-2">
		    		<label>Banner</label>
		    		<input type="file" class="form-control-file" name="file" size="1000">	
		    	</div>
		    	<div class="col-sm-12 mb-2">
		    		<div class="alert alert-info ">
			    		<i class="fa fa-info-circle"></i> Es recomendable enviar una version del banner para dispositivos moviles.
			    	</div>
			    </div>
		    	<div class="col-sm-12 mb-2">
		    		<label>Banner Movil (opcional)</label>
		    		<input type="file" class="form-control-file" name="file_mobil" size="1000">	
		    	</div>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			</form>
			<button type="submit" class="btn btn-primary btn-send mt-2" data-target=".new-banner-form">Enviar</button>
	  	</div>
	</div>
</section>
@stop

@section('postscript')

@stop