<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ $title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="{!! strip_tags(trans('lang.about_text1')) !!}" />
  <meta name="author" content="urialc.org" />

  <!-- 
  //////////////////////////////////////////////////////

  FREE HTML5 TEMPLATE 
  DESIGNED & DEVELOPED by FREEHTML5.CO
    
  Website:    http://freehtml5.co/
  Email:      info@freehtml5.co
  Twitter:    http://twitter.com/fh5co
  Facebook:     https://www.facebook.com/fh5co

  //////////////////////////////////////////////////////
   -->
   @if(isset($self))
    <!-- Facebook and Twitter integration -->
    <meta property="og:url"           content="{{ URL::to('noticias/ver-noticias/'.$article->slugs->first()->text) }}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="{{ $article->titles->first()->text }}" />
    <meta property="og:description"   content="{{ strip_tags($article->descriptions->first()->text) }}" />
    <meta property="og:image"         content="{{ asset('images/noticias/'.$article->id.'/'.$article->images->first()->file) }}" />

    <meta name="twitter:title" content="{{ $article->titles->first()->text }}" />
    <meta name="twitter:image" content="{{ asset('images/noticias/'.$article->id.'/'.$article->images->first()->file) }}" />
    <meta name="twitter:url" content="{{ URL::to('noticias/ver-noticias/'.$article->slugs->first()->text) }}" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@carluchosalazar" />
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.11&appId=154548435161186';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <script>window.twttr = (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0],
      t = window.twttr || {};
    if (d.getElementById(id)) return t;
    js = d.createElement(s);
    js.id = id;
    js.src = "https://platform.twitter.com/widgets.js";
    fjs.parentNode.insertBefore(js, fjs);

    t._e = [];
    t.ready = function(f) {
      t._e.push(f);
    };

    return t;
  }(document, "script", "twitter-wjs"));</script>
  @endif
  <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
  <link rel="shortcut icon" href="favicon.ico">

  <!-- <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'> -->
  
  <!-- Animate.css -->
  <link rel="stylesheet" href="{{ asset('template/charity/css/animate.css') }}">
  <!-- Icomoon Icon Fonts-->
  <link rel="stylesheet" href="{{ asset('template/charity/css/icomoon.css') }}">
  <!-- Bootstrap  -->
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap/dist/css/bootstrap.min.css') }}">
  
  <!-- Superfish -->
  <link rel="stylesheet" href="{{ asset('template/charity/css/superfish.css') }}">

  <link rel="stylesheet" href="{{ asset('template/charity/css/style.css') }}">

  <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">

  <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  @yield('postcss')
  <!-- Modernizr JS -->
  <script src="{{ asset('template/charity/js/modernizr-2.6.2.min.js')}}"></script>
  <!-- FOR IE9 below -->
  <!--[if lt IE 9]>
  <script src="js/respond.min.js"></script>
  <![endif]-->

  </head>
  <body>
    <input type="hidden" class="baseUrl" value="{{ URL::to('/') }}">
    <nav class="navigation" role="navigation">
      <div class="col-sm-12">
        <a href="{{ URL::to('/') }}">
          <img src="{{ asset('images/logo.jpg') }}">
        </a>
      </div>
      <div class="col-sm-12 pt-4" id="exampleAccordion" data-children=".item">
        <div class="item mb-4">
          <a href="{{ URL::to('inicio/que-es-uri') }}">
            {{ trans('lang.menu_btn1') }}
          </a>
        </div>
        @foreach($project::getMenuLinks() as $c)
        <div class="item mb-4">
          <a href="{{ URL::to('noticias/busqueda/'.$c->slugs->first()->text) }}" class="d-inline-block">
            {{ $c->names->first()->text }} 
          </a>
          @if(count($c->subcats) > 0) 
            <i class="fa fa-chevron-down float-right d-inline-block" aria-hidden="true" data-toggle="collapse" data-parent="#exampleAccordion" href="#exampleAccordion{{ $c->id }}" aria-expanded="false" aria-controls="exampleAccordion{{ $c->id }}"></i>
          @endif
          @if(count($c->subcats) > 0)
          <div id="exampleAccordion{{ $c->id }}" class="collapse" role="tabpanel">
            <p class="mb-3">
              <ul>
                @foreach($c->subcats as $sc)
                  <li>
                    <a href="{{ URL::to('noticias/busqueda/'.$c->slugs->first()->text.'/'.$sc->slugs->first()->text) }}">
                      {{ $sc->names()->where('lang_id','=',$lang->id)->first()->text }}
                    </a>
                  </li>
                @endforeach
              </ul>
            </p>
          </div>
          @endif
        </div>
        @endforeach

      </div>
        <div class="col-sm-12 mb-4"><a href="{{ URL::to('inicio/contactenos') }}">{{ trans('lang.menu_btn7') }}</a></div>
        <div class="col-sm-12 mb-4"><a href="{{ URL::to('inicio/festival') }}">{{ trans('lang.menu_btn8') }}</a></div>
      </ul>
    </nav>
    <div id="fh5co-wrapper" class="body">
      <div id="fh5co-page">
        <div class="header-top">
          <div class="container">
            <div class="row">
              <div class="col-md-6 col-sm-6 fh5co-link text-sm-center text-lg-left">
                <a href="{{ URL::to('cambiar-lenguaje/es') }}"><img src="{{ asset('images/idioma/espanol.png') }}" alt="Español" width="16" height="11"></a>
                <a href="{{ URL::to('cambiar-lenguaje/en') }}"><img src="{{ asset('images/idioma/english.png') }}" alt="English" width="16" height="11"></a>
                <a href="{{ URL::to('cambiar-lenguaje/pt') }}"><img src="{{ asset('images/idioma/portugues.png') }}" alt="Português" width="16" height="11"></a>
              </div>
              <div class="col-md-6 col-sm-6 text-right fh5co-social">
                <a href="#" class="grow"><i class="icon-facebook2"></i></a>
                <a href="#" class="grow"><i class="icon-twitter2"></i></a>
                <a href="#" class="grow"><i class="icon-instagram2"></i></a>
              </div>
            </div>
          </div>
        </div>
        <header id="fh5co-header-section" class="sticky-banner clearfix">
          <div class="container">
            <div class="nav-header">
              <button class="btn btn-xs btn-donate" data-toggle="modal" data-target="#donate-modal">{{ trans('lang.donate') }}</button>
              <a href="#!" class="fh5co-nav-toggle dark d-block menu-btn"><i></i></a>
              <h1 id="fh5co-logo" class="d-inline align-middle float-none">
                <a href="{{ URL::to('/') }}"><img src="{{ asset('images/logo.jpg') }}"></a>
              </h1>
              <!-- START #fh5co-menu-wrap -->
            </div>
          </div>
        </header>
        @yield('content')
        <!-- fh5co-blog-section -->
        <footer>
          <div id="footer">
            <div class="container">
              <div class="row">
                <div class="col-md-6 mx-auto text-center">
                  <p class="fh5co-social-icons">
                    <a href="#"><i class="icon-twitter2"></i></a>
                    <a href="#"><i class="icon-facebook2"></i></a>
                    <a href="#"><i class="icon-instagram"></i></a>
                    <a href="#"><i class="icon-dribbble2"></i></a>
                    <a href="#"><i class="icon-youtube"></i></a>
                  </p>
                  <p>
                    Copyright 2017 URi America Latina y el Caribe. All Rights Reserved. <br>Made with <i class="icon-heart3"></i> by <a href="http://freehtml5.co/" target="_blank">Freehtml5.co</a> / {{ trans('lang.developed_by') }} <a href="mailtop:carlos.a.salazar.n@gmail.com">Carlos Salazar</a></p>
                </div>
              </div>
            </div>
          </div>
        </footer>
      </div>
      <!-- END fh5co-page -->
    </div>
  <!-- END fh5co-wrapper -->
    <!-- Modal -->
    <div class="modal fade" id="donate-modal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content hide-after-load">
          <div class="modal-header align-items-center">
            <img src="{{ asset('images/logo.jpg') }}" class="float-left">
            <h4 class="modal-title float-right">
              <strong>Tu ayuda fortalece nuestras esperanzas</strong>
            </h4>
          </div>
          <div class="modal-body row">
            <div class="col-sm-12">
              <div class="alert responseAjax"><p></p></div>
            </div>
            <div class="col-sm-12 col-md-6">
              <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  @foreach($project::getDonateBanners() as $i => $b)
                  <li data-target="#carouselExampleIndicators2" data-slide-to="{{ $i }}" @if($b->id == $project::getDonateBanners()->first()->id) class="active" @endif></li>
                  @endforeach
                </ol>
                <div class="carousel-inner">
                  @foreach($project::getDonateBanners() as $b)
                  <div class="carousel-item modalish @if($b->id == $project::getDonateBanners()->first()->id) active @endif">
                    <picture>
                      <source media="(max-width: 767px)" srcset="{{ asset('images/banners/'.$b->image) }}">
                      <img src="{{ asset('images/banners/'.$b->image) }}" class="img-fluid mx-auto d-block" alt="{{ $b->titles->first() ? $b->titles->first()->text : $title }}">
                    </picture>
                  </div>
                  @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
            </div>
            <div class="col-sm-12 col-md-6">
              <h2>{{ trans('lang.first_step') }}<b>!</b></h2>                            
              <!--<p>D&eacute;janos tus datos</p>-->
              <input type="hidden" id="pais" name="pais" value="3">
              <input type="hidden" id="source" name="source" value="google">
              <div class="form-group">
                  <input type="text" class="form-control name" id="nombre" name="nombre" placeholder="{{ trans('lang.name') }}" required="">
              </div>
              <div class="form-group">
                  <input type="text" class="form-control lastname" id="apellido" name="apellido" placeholder="{{ trans('lang.lastname') }}" required="">
              </div>
              <div class="form-group">
                  <input type="email" class="form-control email" id="email" name="email" placeholder="{{ trans('lang.email') }}" required="">
              </div>
              <div class="form-group">
                  <input type="text" class="form-control phone" id="telefono" name="telefono" placeholder="{{ trans('lang.phone') }}" minlength="7" maxlength="9" smk-type="number" required="">
              </div>
              <div class="form-group">
                  <label class="control-label" for="" style="color:#333;">{{ trans('lang.select_project') }}</label>
                  <select id="proyecto" name="proyecto" class="form-control project">
                      <option value="">{{ trans('lang.projects') }}</option>
                      @foreach($project::getDonateBanners() as $b)
                      <option value="{{ str_replace(' ','-', $b->titles->first()->text) }}">
                        {{ $b->titles->first()->text }}
                      </option>
                      @endforeach                                
                  </select>
              </div>
              <div class="form-group">
                  <!--<label class="control-label" for="formInput1">Forma de Pago</label>-->
                  <select id="forma_pago" name="forma_pago" class="form-control payment_method">
                      <option value="">{{ trans('lang.payment_method') }}</option>
                      <option value="web">{{ trans('lang.web_form') }}</option>
                      <option value="paypal">{{ trans('lang.paypal') }}</option>
                  </select>
              </div>
              <div class="form-group">
                  <input type="text" class="form-control reference_number" id="reference" name="reference_number" placeholder="{{ trans('lang.reference_number') }}" required="">
              </div>
              <div class="checkbox">
                  <label class="control-label">
                      <input type="checkbox" id="permiso" name="permiso" required=""><small style="font-size: 13px;">{{ trans('lang.authorize') }}</small>
                  </label>
              </div>
              <input type="hidden" id="btnclose" name="btnclose" data-dismiss="modal">
              <img src="{{ asset('images/loader.gif') }}" class="miniLoader">
              <button class="btn btn-success btn-donate-modal" data-url="{{ URL::to('enviar-donacion') }}">
                {{ trans('lang.send') }}
              </button>
            </div>
            <div class="col-sm-12 mb-2 mt-4">
              <div class="card">
                <div class="card-header bg-success">
                  <span style="color:#fff;">{{ trans('lang.why') }}</span>
                </div>
                <p class="p-2">{{ trans('lang.because') }}</p>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-content show-after-load invisible">
        <div class="jumbotron text-center">
            <h1>{{ trans('lang.success') }}!</h1>
            <p class="lead">{{ trans('lang.success_text') }}.</p>
            
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

        </div>
      </div>
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!-- jQuery -->

  <script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="{{ asset('plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <!-- jQuery Easing -->
  <script src="{{ asset('template/charity/js/jquery.easing.1.3.js') }}"></script>
  <!-- Waypoints -->
  <script src="{{ asset('template/charity/js/jquery.waypoints.min.js') }}"></script>
  <script src="{{ asset('template/charity/js/sticky.js') }}"></script>

  <!-- Stellar -->
  <script src="{{ asset('template/charity/js/jquery.stellar.min.js') }}"></script>
  <!-- Superfish -->
  <script src="{{ asset('template/charity/js/hoverIntent.js') }}"></script>
  <script src="{{ asset('template/charity/js/superfish.js') }}"></script>
  
  <!-- Main JS -->
  <script src="{{ asset('template/charity/js/main.js') }}"></script>
  <script src="{{ asset('plugins/hammer/hammer.min.js') }}"></script>
  <script src="{{ asset('plugins/jquery.hammer.js/jquery.hammer.js') }}"></script>

  <script src="{{ asset('js/functions.js') }}"></script>
  <script src="{{ asset('js/custom.js') }}"></script>
  @yield('postscript')
  </body>
</html>

