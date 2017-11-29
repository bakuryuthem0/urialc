@extends('layouts.default')

@section('content')
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
  	@foreach($banners as $i => $b)
    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}" @if($b->id == $banners->first()->id) class="active" @endif></li>
    @endforeach
  </ol>
  <div class="carousel-inner">
  	@foreach($banners as $b)
    <div class="carousel-item @if($b->id == $banners->first()->id) active @endif">
      <picture>
        <source media="(max-width: 767px)" srcset="{{ asset('images/banners/phone/'.$b->phone) }}">
        <img src="{{ asset('images/banners/'.$b->desktop) }}" class="img-fluid mx-auto" alt="{{ $b->title ? $b->title : $title }}">
      </picture>
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
    <div id="fh5co-feature-product" class="fh5co-section-gray">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center heading-section">
            <h3>{{ trans('lang.urialc') }}</h3>
            <p class="text-sm-center text-md-justify">{{ trans('lang.urial_desc') }}</p>
          </div>
        </div>
      </div>
    </div>
    <div id="fh5co-portfolio">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-6 mx-auto text-center heading-section animate-box">
            <h3>{{ trans('lang.latest_news') }}</h3>
            <p></p>
          </div>
        </div>

        
        <div class="row row-bottom-padded-md">
          <div class="col-md-12">
            <ul id="fh5co-portfolio-list">
            	@foreach($news as $i => $a)
			        <li class="{{ $news_order[$i] }} animate-box" data-animate-effect="fadeIn" style="background-image: url({{ asset('images/noticias/'.$a->id.'/'.$a->images->first()->file) }}); ">
				        <a href="{{ URL::to('noticias/ver-noticias/'.$a->slugs->first()->text) }}" class="color-3">
      					  <div class="case-studies-summary">
      					    <h2 class="text-capitalize text-truncate">{{ $a->titles->first()->text }}</h2>
      					    <span class="text-truncate">{{ strip_tags($a->descriptions->first()->text) }}</span>
      					  </div>
				        </a>
				      </li>
				      @endforeach
            </ul>   
          </div>
        </div>

        <div class="row">
          <div class="d-block mx-auto animate-box">
            <a href="{{ URL::to('noticias/busqueda/noticias') }}" class="btn btn-primary btn-lg">{{ trans('lang.read_all') }}</a>
          </div>
        </div>

        
      </div>
    </div>
    
    <div id="fh5co-blog-section" class="fh5co-section-gray">
      <div class="container">
        <div class="row">
          <div class="d-block mx-auto heading-section animate-box">
            <h3 class="text-center">{{ trans('lang.cc_title') }}</h3>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row row-bottom-padded-md">
          @foreach($circles as $c)
          <div class="col-sm-12 col-md-4">
            <div class="fh5co-blog animate-box">
              <div class="img-container">
                <a href="#">
                  <img class="img-fluid" src="{{ asset('images/noticias/'.$c->id.'/'.$c->images->first()->file) }}" alt="{{ $c->titles->first()->text }}">
                </a>
              </div>
              <div class="blog-text">
                <div class="prod-title">
                  <h3 class="text-truncate">
                    <a href="">
                      {{ $c->titles->first()->text }}
                    </a>
                  </h3>
                  @if(!empty($c->date))
                  <span class="posted_by">
                    {{ date('d/m/Y',strtotime($c->date)) }}
                  </span>
                  @endif

                  <p>{!! substr(strip_tags($c->descriptions->first()->text),0,50) !!}...</p>
                  <p><a href="{{ URL::to('noticias/ver-noticias/'.$c->slugs->first()->text) }}">{{ trans('lang.read_more') }}...</a></p>
                </div>
              </div> 
            </div>
          </div>
          @endforeach
          <div class="clearfix visible-md-block"></div>
        </div>

        <div class="row">
          <div class="col-md-4 d-block mx-auto text-center animate-box">
            <a href="{{ URL::to('noticias/busqueda/circulos-de-cooperación') }}" class="btn btn-primary btn-lg">{{ trans('lang.read_all') }}</a>
          </div>
        </div>

      </div>
    </div>

    <div id="fh5co-blog-section" class="fh5co-section-gray">
      <div class="container">
        <div class="row">
          <div class="d-block mx-auto heading-section animate-box">
            <h3 class="text-center">{{ trans('lang.youtube_channel') }}</h3>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row row-bottom-padded-md">
          @foreach($videos as $video)
            <div class="col-sm-12 col-md-3">
                <iframe src="https://www.youtube.com/embed/{{$video[0]}}" class="img-fluid"></iframe>
            </div>
          @endforeach
        </div>

        <div class="row">
          <div class="col-md-4 d-block mx-auto text-center animate-box">
            <a href="https://www.youtube.com/channel/UCGLib-7ScPCZl3iD5vyyMhg" target="_blank" class="btn btn-primary btn-lg">{{ trans('lang.youtube_channel') }}</a>
          </div>
        </div>

      </div>
    </div>
    
@stop
