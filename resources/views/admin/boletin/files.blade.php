@extends('layouts.admin')

@section('content')
<section class="col-sm-12">
	<div class="card">
	  	<div class="card-header">
	    	Agregar archivo al boletin
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
		    <form method="POST" action="{{ URL::to('administrador/agregar-archivos/'.$id.'/enviar') }}" class="new-boletin-form" enctype="multipart/form-data">
		    	<div class="col-sm-12">
		    		<div class="alert alert-warning">
		    			<i class="fa fa-exclamation-triangle"></i> Tenga en cuenta que el peso maximo de un archivo es de 35Mb (35 MegaBytes).
		    		</div>
		    	</div>
		    	<div class="col-sm-12">
	    			<label>Idioma</label>
		    		<select name="lang" class="form-control">
				    	@foreach($langs as $l)
				    		<option value="{{ $l->id }}" @if(old('lang') && old('lang') == $l->id) selected @endif>
				    			{{ $l->names->first()->text }}
				    		</option>
				    	@endforeach
		    		</select>
		    	</div>
		    	<div class="col-sm-12">
		    		<label>Archivo</label>
		    		<input type="file" class="form-control-file" name="file">
		    	</div>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			</form>
			<button type="submit" class="btn btn-primary btn-send mt-2" data-target=".new-boletin-form">Enviar</button>
	  	</div>
	</div>
</section>
@stop

@section('postscript')

@stop