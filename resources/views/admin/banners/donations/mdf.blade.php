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
		    <form method="POST" action="{{ URL::to('administrador/modificar-banner-donacion/'.$banner->id.'/enviar') }}" class="new-banner-form" enctype="multipart/form-data">
    			@foreach($langs as $l)
		    	<div class="col-sm-12 form-group">
					<label for="categoryName{{ $l->id }}">Titulo ({{ ucfirst($l->names->first()->text) }})</label>
					@if($banner->titles()->where('lang_id','=',$l->id)->first())
					<input 
					type="text" 
					name="title[{{ $banner->titles()->where('lang_id','=',$l->id)->first()->id }}]" 
					class="form-control" 
					id="categoryName{{ $l->id }}" 
					placeholder="Titulo ({{ $l->names->first()->text }})" 
					value="{{ $banner->titles()->where('lang_id','=',$l->id)->first()->text }}">
					@endif
				</div>
				@endforeach
				<div class="col-sm-12 mb-2">
		    		<img src="{{ asset('images/banners/'.$banner->image) }}" class="img-fluid">
				</div>
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