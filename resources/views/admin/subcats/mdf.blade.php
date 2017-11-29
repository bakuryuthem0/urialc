@extends('layouts.admin')

@section('postcss')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
@stop

@section('content')
<section class="valign col-xs-12 col-md-8">
	<div class="card">
	  	<div class="card-header">
	    	Nueva Sub-categoría
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
	  		<div class="alert alert-success" role="alert">
	  			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    	<span aria-hidden="true">&times;</span>
			  	</button>
		  		{{ Session::get('success') }}
	  		</div>
	  		@endif
		    <form method="POST" action="{{ URL::to('administrador/modificar-subcategoria/'.$cat->id.'/enviar') }}" class="new-cat-form">
		    	<div class="form-group">
					<label for="catSelect">Categoría</label>
						<select class="form-control js-example-basic-single" name="cat" id="catSelect">
						<option value="">Seleccione una opción...</option>
						@foreach($cats as $c)
							<option value="{{ $c->id }}" @if($cat->cat_id == $c->id) selected @endif>
								{{ $c->names->first()->text }}
							</option>
						@endforeach
					</select>
				</div>
		    	@foreach($cat->names as $c)
				<div class="form-group">
					<label for="categoryName{{ $c->id }}">Nombre de la categoría ({{ $c->langs->names->first()->text }})</label>
					<input 
						type="text" 
						name="name[{{ $c->id }}]" 
						class="form-control validate-input novalidate" 
						id="categoryName{{ $c->id }}" 
						aria-describedby="emailHelp" 
						placeholder="Nombre de la categoria ({{ $c->langs->first()->names->first()->text }})" 
						data-name="Nombre de la categoria ({{ $c->langs->first()->names->first()->text }})" 
						value="{{ $c->text }}">
				</div>
				@endforeach
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			</form>
			<button type="submit" class="btn btn-primary btn-send" data-target=".new-cat-form">Enviar</button>
	  	</div>
	</div>
</section>
@stop

@section('postscript')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		
		$('.js-example-basic-single').select2();
	});
</script>
@stop