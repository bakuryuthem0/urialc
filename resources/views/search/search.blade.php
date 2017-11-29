@extends('layouts.default')


@section('content')
	<div class="container first-element">
		<div class="col-sm-12 banner">
			<h1 class="text-sm-center">{{ $cat->names->first()->text }}</h1>
		</div>
		<div class="col-sm-12 p-0 clearfix">
			@if(count($cat->subnames) > 0)
				<div class="col-sm-12 col-md-3  float-left">
					<h3>{{ $cat->names->first()->text }}</h3>
					<div class="list-group">
						@foreach($cat->subnames as $sn)
					  		<button type="button" class="list-group-item list-group-item-action" >
					  			{{ $sn->names->first()->text }}
					  		</button>
						@endforeach
					</div>
				</div>
			@endif
			<div class="col-sm-12 @if(count($cat->subnames) > 0) col-md-9 @endif float-right">
				@foreach($articles as $a)
				<div class="row mb-4 p-4 news-container">
					<div class="col-sm-12 col-md-4 d-flex align-items-center">
						<a href="{{ URL::to('noticias/ver-noticias/'.$a->slugs->first()->text) }}">
							<img src="{{ asset('images/noticias/'.$a->id.'/'.$a->images->first()->file) }}" class="img-fluid">
						</a>
					</div>
					<div class="col-sm-12 col-md-8 d-flex align-items-center">
						<div class="container">
							<h3 class="text-truncate mt-4">{{ $a->titles->first()->text }}</h3>

							<p class="text-justify">{!! substr(strip_tags($a->descriptions->first()->text),0,300) !!}...</p>
							<a href="{{ URL::to('noticias/ver-noticias/'.$a->slugs->first()->text) }}">{{ trans('lang.read_more') }}...</a>
						</div>
					</div>
				</div>
				@endforeach
			</div>
			<div class="clearfix"></div>
			<div class="col-sm-12">
				@include('partials.pagination')
			</div>
		</div>
	</div>
@stop