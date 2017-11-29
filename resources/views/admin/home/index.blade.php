@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-xs-12 col-md-4">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Nueva categoría</h4>
				 <p class="card-text">Agrega nuevas categorías para facilitar la navegabilidad en tu pagina web.</p>
				<a href="{{ URL::to('administrador/nueva-categoria') }}" class="btn btn-primary">Ir</a>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-md-4">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Nueva noticia</h4>
				 <p class="card-text">Agrega noticias para mostrar sus acciones</p>
				<a href="{{ URL::to('administrador/nueva-noticia') }}" class="btn btn-primary">Ir</a>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-md-4">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Nuevo Banner principal</h4>
				 <p class="card-text">Agrega un banner principal para resaltar alguna información o noticia importante</p>
				<a href="{{ URL::to('administrador/nuevo-banner') }}" class="btn btn-primary">Ir</a>
			</div>
		</div>
	</div>
</div>
@stop