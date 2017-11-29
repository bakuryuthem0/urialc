@extends('layouts.admin')

@section('content')
<section class="valign col-xs-12 col-md-8">
	<div class="card">
	  	<div class="card-header">
	    	Modificar categoría
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
		    <form method="POST" action="{{ URL::to('administrador/ver-categorias/'.$cat->id.'/enviar') }}" class="new-cat-form">
		    	<div class="form-group">
		    		<label>Mostrar en menu</label>
		    		<input type="checkbox" name="active" value="1" class="switch" @if($cat->in_menu == 1) checked @endif>
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
    $('.switch').each(function(index, el) {
      if ($(el).is(':checked')) {
        $(el).bootstrapSwitch('toggleState');
      };
    });
  });
</script>
	
@stop