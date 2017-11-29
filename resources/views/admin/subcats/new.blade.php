@extends('layouts.admin')

@section('postcss')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
@stop

@section('content')
<section class="valign col-xs-12 col-md-8">
	<div class="card">
	  	<div class="card-header">
	    	Modificar Sub-categoría
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
	  		
		    <form method="POST" action="{{ URL::to('administrador/nueva-subcategoria/enviar') }}" class="new-cat-form">
		    	<div class="form-group">
					<label for="catSelect">Categoría</label>
					<select class="form-control" name="cat" id="catSelect">
							<option disabled>Seleccione una opción...</option>
							@foreach($cats as $c)
								<option value="{{ $c->id }}" @if(old('cat') && old('cat') == $c->id) selected @endif>
									{{ $c->names->first()->text }}
								</option>
							@endforeach
					</select>
				</div>
				
		    	@foreach($langs as $l)
				<div class="form-group">
					<label for="categoryName{{ $l->id }}">Nombre de la Sub-categoría ({{ $l->names->first()->text }})</label>
					<input 
						type="text" 
						name="name[{{ $l->id }}]" 
						class="form-control validate-input novalidate" 
						id="categoryName{{ $l->id }}" 
						aria-describedby="emailHelp" 
						placeholder="Nombre de la categoría ({{ $l->names->first()->text}})"
						data-name="Nombre de la categoría ({{ $l->names->first()->text }})" 
						value="{{ old('name.'.$l->id) }}">
				</div>
				@endforeach
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			</form>
			<button type="submit" class="btn btn-primary btn-send" data-target=".new-cat-form">Enviar</button>
	  	</div>
	</div>
</section>
@stop

