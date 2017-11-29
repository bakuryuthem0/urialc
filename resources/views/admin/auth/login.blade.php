@extends('layouts.admin')

@section('content')
<section class="valign col-xs-12 col-md-8">
	<h3 class="text-center">Sistema de administración Uri</h3>
	<div class="card">
	  	<div class="card-header">
	    	Inicio de sesión
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
		    <form method="POST" action="{{ URL::to('administrador/login/enviar') }}">
				<div class="form-group">
					<label for="exampleInputEmail1">Nombre de usuario</label>
					<input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingrese su usuario">
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Password</label>
					<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
				</div>
				<div class="form-check">
					<label class="custom-control custom-checkbox">
					  <input type="checkbox" class="custom-control-input" name="remember">
					  <span class="custom-control-indicator"></span>
					  <span class="custom-control-description">Recuerdame</span>
					</label>
				</div>
				<button type="submit" class="btn btn-primary">Enviar</button>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			</form>
	  	</div>
	</div>
</section>
@stop