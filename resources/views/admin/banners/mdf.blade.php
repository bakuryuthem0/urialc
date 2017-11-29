@extends('layouts.admin')

@section('content')
<section class="col-sm-12">
	<div class="card">
	  	<div class="card-header">
	    	Modificar banner
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
		    <form method="POST" action="{{ URL::to('administrador/modificar-banner/'.$banner->id.'/enviar') }}" class="new-banner-form" enctype="multipart/form-data">
		    	<div class="col-sm-12 mb-2">
		    		<label>Titulo (opcional)</label>
		    		<input type="text" class="form-control" name="title" placeholder="Titulo" value="{{ $banner->title }}">	
		    	</div>
		    	<div class="col-sm-12 mb-2">
		    		<label>URL (opcional)</label>
		    		<input type="text" class="form-control" name="url" placeholder="URL" value="{{ $banner->url }}">	
		    	</div>
		    	<div class="col-sm-12 mb-2">
		    		<label>Idioma</label>
		    		<select class="form-control" name="lang">
		    			@foreach($langs as $l)
		    				<option value="{{ $l->id }}" @if($l->id == $banner->lang_id) selected @endif>{{ $l->names->first()->text }}</option>
		    			@endforeach
		    		</select>
		    	</div>
		    	<div class="col-sm-6 mb-2">
		    		<img src="{{ asset('images/banners/'.$banner->desktop) }}" class="img-fluid">
		    		<label>Banner</label>
		    		<input type="file" class="form-control-file" name="file">	
		    	</div>
		    	<div class="col-sm-6 mb-2">
		    		<img src="{{ asset('images/banners/phone/'.$banner->phone) }}" class="img-fluid">
		    		<label>Banner</label>
		    		<input type="file" class="form-control-file" name="file_mobil">	
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