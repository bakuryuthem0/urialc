@extends('layouts.admin')

@section('content')
<section class="col-sm-12">
	<div class="card">
	  	<div class="card-header">
	    	Nuevo banner donaciones
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
		    <form method="POST" action="{{ URL::to('administrador/nuevo-banner-donacion/enviar') }}" class="new-banner-form" enctype="multipart/form-data">
    			@foreach($langs as $l)
		    	<div class="col-sm-12 mb-2">
			    	<label>Titulos ({{ ucfirst($l->names->first()->text) }})</label>
			    	<input 
						type="text" 
						name="title[{{ $l->id }}]" 
						class="form-control" 
						placeholder="Titulo ({{ $l->names->first()->text }})" 
						value="{{ old('title.'.$l->id) }}">
		    	</div>
    			@endforeach
		    	<div class="col-sm-12 mb-2">
		    		<label>Banner</label>
		    		<input type="file" class="form-control-file" name="file">	
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