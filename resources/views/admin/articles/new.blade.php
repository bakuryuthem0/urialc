@extends('layouts.admin')

@section('content')
<section class="col-sm-12">
	<div class="card">
	  	<div class="card-header">
	    	Nuevo articulo
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
		    <form id="fileupload" method="POST" action="{{ URL::to('administrador/nueva-noticia/enviar') }}" class="new-cat-form" enctype="multipart/form-data">
		    	<div class="alert alert-warning">
		    		<p><i class="fa fa-exclamation-triangle"></i> Los campos no son obligatiorios, pero se recomienda enviar el titulo.</p>
		    	</div>
		  		<div id="accordion" role="tablist">
		  			@foreach($langs as $l)
					<div class="card">
						<div class="card-header" role="tab" id="heading{{$l->id}}">
					  		<h5 class="mb-0">
						    	<a data-toggle="collapse" href="#collapse{{ $l->id }}" aria-expanded="true" aria-controls="collapse{{ $l->id }}">
									<div class="col-sm-12 form-group">
								    	Titulos / Descripción - {{ ucfirst($l->names->first()->text) }}
								    </div>
						    	</a>
						  	</h5>
						</div>

						<div id="collapse{{ $l->id }}" class="collapse" role="tabpanel" aria-labelledby="heading{{$l->id}}" data-parent="#accordion">
					  		<div class="card-body">
						    	<div class="col-sm-12 form-group">
									<label for="categoryName{{ $l->id }}">Titulo</label>
									<input 
										type="text" 
										name="title[{{ $l->id }}]" 
										class="form-control" 
										id="categoryName{{ $l->id }}" 
										aria-describedby="emailHelp" 
										placeholder="Titulo ({{ $l->names->first()->text }})" 
										data-name="Titulo ({{ $l->names->first()->text }})" 
										value="{{ old('title.'.$l->id) }}">
								</div>
								<div class="col-sm-12 form-group">
									<label for="categoryDesc{{ $l->id }}">Descripción</label>
									<textarea name="desc[{{$l->id}}]" id="editor{{ $l->id }}" class="formc-control">{{ old('desc.'.$l->id) }}</textarea>
								</div>
						  	</div>
						</div>
					</div>
					@endforeach

					<div class="card">
						<div class="card-header" role="tab" id="headingThree">
						  <h5 class="mb-0">
						    <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
								<div class="col-sm-12 form-group">
									Categorías / Fecha / Archivos
								</div>
						    </a>
						  </h5>
						</div>
						<div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
					  		<div class="card-body">
					  			<div class="row">
						  			<div class="col-sm-12 col-md-6 mb-2">
						  				<label>Categoría</label>
						  				<select class="form-control category" name="cat" data-url="{{ URL::to('administrador/cargar-subcategorias') }}" data-target=".subcat" data-toremove=".optionResponse">
						  					<option value="">Seleccione una opción...</option>
						  					@foreach($cats as $c)
						  						<option value="{{ $c->id }}">{{ $c->names->first()->text }}</option>
						  					@endforeach
						  				</select>
						  			</div>
						  			<div class="col-sm-12 col-md-6 mb-2">
						  				<label>Sub-categoría</label>
						  				<select class="form-control subcat" name="subcat">
						  					<option value="">Seleccione una opción...</option>
						  				</select>
						  			</div>
					  			</div>
					  			<div class="row">
						  			<div class="col-sm-12 mb-2">
						  				<label>Fecha de la notícia</label>
						  				<input type="date" class="form-control" name="date" value="{{ old('date') }}">
						  			</div>
					  			</div>
						    	<div class="col-sm-12 form-group">
				                <!-- The file upload form used as target for the file upload widget -->
			                  	<!-- Redirect browsers with JavaScript disabled to the origin page -->
			                  	<noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
			                  	<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
			                  	<div class="row">
			                  		<div class="col-sm-12 mb-2">
			                  			<h3>Archivos</h3>
			                  		</div>
			                  		<div class="col-sm-12 mb-2">
			                  			<div class="alert alert-info">
			                  				<p><i class="fa fa-exclamation-circle"></i> Aqui puede subir tanto las imagenes de la galeria como los archivos pdf de los informes, el sistema se encargara de separarlos automaticamente.
			                  				<br>
			                  				<strong>Nota:</strong> los tipos de archivos validos son: .jpg, .png, .gif, .pdf
			                  				</p>
			                  			</div>
			                  		</div>
			                  	</div>

			                  	<div class="row fileupload-buttonbar">
				                    <div class="col-lg-7">
				                      	<!-- The fileinput-button span is used to style the file input field as button -->
				                      	<span class="btn btn-success fileinput-button">
				                        	<i class="glyphicon glyphicon-plus"></i>
				                        	<span>Agregar archivo...</span>
				                        	<input type="file" name="files[]" multiple>
				                      	</span>
				                      	<button type="button" class="btn btn-danger delete">
				                        	<i class="glyphicon glyphicon-trash"></i>
				                        	<span>Remover Todo</span>
				                      	</button>
				                      	<!-- The global file processing state -->
				                      	<span class="fileupload-process"></span>
				                    </div>
				                    <!-- The global progress state -->
				                    <div class="col-lg-5 fileupload-progress fade">
				                      	<!-- The global progress bar -->
				                      	<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
				                        	<div class="progress-bar progress-bar-success" style="width:0%;"></div>
				                      	</div>
				                      	<!-- The extended global progress state -->
				                      	<div class="progress-extended">&nbsp;</div>
				                    </div>
			                  	</div>
				                  <!-- The table listing the files available for upload/download -->
				                <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
				                <br>
				                <!-- The blueimp Gallery widget -->
								</div>	
				                <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
				                <div class="slides"></div>
				                <h3 class="title"></h3>
				                <a class="prev">‹</a>
				                <a class="next">›</a>
				                <a class="close">×</a>
				                <a class="play-pause"></a>
				                <ol class="indicator"></ol>
				                </div>
						  	</div>
						</div>
					</div>
				</div>
		    	
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			</form>
			<button type="submit" class="btn btn-primary btn-send mt-2" data-target=".new-cat-form">Enviar</button>
	  	</div>
	</div>
</section>
@stop

@section('postscript')
@include('partials.codes.jupload')
<script src="https://cdn.ckeditor.com/4.7.3/full-all/ckeditor.js"></script>
<script src="{{ asset('plugins/ckeditor/nanospell/autoload.js') }}"></script>

<script>
	

	CKEDITOR.replace( 'editor1');
	nanospell.ckeditor('editor1',{
	    dictionary : "es",  // 24 free international dictionaries  
	    server : "php"      // can be php, asp, asp.net or java
	}); 
	CKEDITOR.replace( 'editor2');
	
	CKEDITOR.replace( 'editor3');

</script>


		
		
@stop