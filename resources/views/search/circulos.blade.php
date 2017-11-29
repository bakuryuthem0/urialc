@extends('layouts.default')

@section('postcss')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/fancybox-3.0/dist/jquery.fancybox.min.css') }}">
@stop
@section('content')
<div class="col-sm-12 d-flex align-items-center">
  <div class="col-sm-3">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        @foreach($article->images as $i => $img)
          <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}" @if($img->id == $article->images->first()->id) class="active" @endif></li>
        @endforeach
      </ol>
      <div class="carousel-inner">
        @foreach($article->images as $img)
        <div class="carousel-item @if($img->id == $article->images->first()->id) active @endif">
          <a href="{{ asset('images/noticias/'.$article->id.'/'.$img->file) }}" data-fancybox="{{ ucfirst($article->titles->first()->text) }}" data-caption="{{ $article->titles->first()->text }}" data-type="image" title="{{ $article->titles->first()->text }}"><img class="d-block w-100" src="{{ asset('images/noticias/'.$article->id.'/'.$img->file) }}" alt="{{ $article->titles->first()->text }}"></a>
        </div>
        @endforeach
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
  <div class="col-sm-9">
    <div id="fh5co-feature-title" class="fh5co-section-gray">
      <div class="container">
        <div class="row d-block pb-4 pt-4">
          <div class="col-md-12 m-0 text-center heading-section">
            <h3>{{ $article->titles->first()->text }}</h3>
          </div>
        </div>
      </div>
    </div>
    <div id="fh5co-feature-description">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            {!! $article->descriptions->first()->text !!}
          </div>
          <div class="col-sm-12">
            
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-sm-12 mb-4">
  <div class="card p-2">
    <div class="card-block">
      <div class="fb-share-button" data-href="{{ URL::to('noticias/ver-noticias/'.$article->slugs->first()->text) }}" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fmiurl.com%2F&amp;src=sdkpreparse">Compartir</a></div>
      <a class="twitter-share-button"
        href="https://twitter.com/intent/tweet?text={{ $article->titles->first()->text }}&url={{ URL::to('noticias/ver-noticias/'.$article->slugs->first()->text) }}">
      Tweet</a>
    </div>
  </div>
</div>
@stop

@section('postscript')
<script type="text/javascript" src="{{ asset('plugins/fancybox-3.0/dist/jquery.fancybox.min.js') }}"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
  $('[data-fancybox]').fancybox({
    image : {
      protect: true,
    }

  });
});
</script>
@stop