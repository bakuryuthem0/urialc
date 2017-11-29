@extends('layouts.admin')

@section('content')
<section class="valign col-xs-12 col-md-8">
	<div class="card">
	  	<div class="card-header">
	    	Nueva categoría
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
		    <form method="POST" action="{{ URL::to('administrador/nueva-categoria/enviar') }}" class="new-cat-form">
		    	<div class="form-group">
		    		<label>Mostrar en menu</label>
		    		<input type="checkbox" name="active" value="1" class="switch">
		    	</div>
		    	@foreach($langs as $l)
				<div class="form-group">
					<label for="categoryName{{ $l->id }}">Nombre de la categoría ({{ $l->names->first()->text }})</label>
					<input 
						type="text" 
						name="name[{{ $l->id }}]" 
						class="form-control validate-input novalidate" 
						id="categoryName{{ $l->id }}" 
						aria-describedby="emailHelp" 
						placeholder="Nombre de la categoria ({{ $l->names->first()->text }})" 
						data-name="Nombre de la categoria ({{ $l->names->first()->text }})" 
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
@section('postscript')

<link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') }}">
<script type="text/javascript" src="{{ asset('plugins/bootstrap-switch/dist/js/bootstrap-switch.min.js') }}"></script>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $(".switch").bootstrapSwitch({
      state   : false,
      onText  : 'Si',
      offText : 'No',
      size    : 'small'
    });
  });
</script>
	@if($errors->has())
	  <script type="text/javascript">
	  jQuery(document).ready(function($) {
	    $('.mySwitch').each(function(index, el) {
	      if ($(el).is(':checked')) {
	        $(el).bootstrapSwitch('toggleState');
	      };
	    });
	  });
	  </script>
	@endif
@stop